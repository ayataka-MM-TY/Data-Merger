<?php

namespace App\Entity\Extract;

use Illuminate\Support\Carbon;

class CommandExtractor implements Extractable
{
    /**
     * @param string $projectID UUID
     * @param string $from
     * @param string $to
     * @param string $originalName
     * @param Carbon|null $date
     * @return ExtractedJSONFile
     */
    public function extract(string $projectID, string $from, string $to, string $originalName, ?Carbon $date): ExtractedJSONFile
    {
        $this->execute($from, $to, $originalName, $date);
        return new ExtractedJSONFile($projectID, $to, $originalName, $date);
    }

    private function execute(string $from, string $to, string $originalName, ?Carbon $date): void
    {
        $dateString = $date?->toDateString() ?? 'null';
        foreach ($this->tryDirectories() as $directory) {
            $directoryPath = self::scriptPath()."/trys/".$directory;
            if ($this->validate($directoryPath, $from, $originalName, $dateString)) {
                $this->denoConvert($directoryPath, $from, $to, $originalName, $dateString);
                return;
            }
        }
        $this->denoConvert(self::scriptPath()."/default", $from, $to, $originalName, $dateString);
    }

    private function denoConvert(string $dirPath, string $from, string $to, string $originalName, string $date): void
    {
        $this->deno($dirPath."/convert.ts", [$from, $to, $originalName, $date]);
    }

    private function validate(string $dirPath, string $from, string $originalName, string $date): bool
    {
        $output = $this->deno($dirPath."/validate.ts", [$from, $originalName, $date]);
        return $output === 'true';
    }

    /**
     * @return string[]
     */
    private function tryDirectories(): array
    {
        $lines = [];
        exec("ls " . self::scriptPath()."/trys", $lines);
        return $lines;
    }

    /**
     * @param string $scriptPath
     * @param string[] $args
     * @return string|null
     */
    private function deno(string $scriptPath, array $args): ?string
    {
        $command = "deno run -A " . $scriptPath;
        foreach ($args as $arg) {
            $command .= " $arg";
        }
        $result = [];
        exec($command, $result);
        return count($result) === 1 ? $result[0] : null;
    }

    private static function scriptPath(): string
    {
        return storage_path() . "/scripts";
    }
}
