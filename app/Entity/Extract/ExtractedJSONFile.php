<?php

namespace App\Entity\Extract;

use App\Entity\JSON\ExtractedJSONFileConvertable;
use App\Entity\Merge\MergeRecords;
use App\Models\Upload;
use Exception;
use Illuminate\Support\Carbon;

class ExtractedJSONFile
{
    /**
     * @param string $projectID UUID
     * @param string $path
     * @param string $originalName
     */
    public function __construct(
        private readonly string $projectID,
        private readonly string $path,
        private readonly string $originalName,
        private readonly ?Carbon $date,
    ) {}

    /** @var string|null $uploadID UUID */
    private ?string $uploadID = null;

    /**
     * @throws Exception
     */
    public function save(ExtractedJSONFileConvertable $converter): void
    {
        $records = $converter->convert($this->content());
        $this->uploadID = $records->save($this->projectID, $this->originalName, $this->date ?? Carbon::now());
    }

    /**
     * @throws Exception
     */
    public function confirmData(): array
    {
        if ($this->uploadID === null) {
            throw new Exception('saveされていません');
        }
        /** @var Upload $upload */
        $upload = Upload::find($this->uploadID);
        $records = $upload->records;
        $merge = new MergeRecords($records);
        return [
            'project' => $upload->project->name,
            'filename' => $upload->filename,
            'titles' => $merge->titleCandidates(),
            'records' => $merge->json(),
        ];
    }

    /**
     * @throws Exception
     */
    private function content(): string
    {
        $content = file_get_contents($this->path);
        if ($content === false) throw new Exception("JSONファイルが存在しない");
        return $content;
    }
}
