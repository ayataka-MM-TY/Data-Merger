<?php

namespace App\Entity\Extract;

use App\Entity\JSON\ExtractedJSONFileConvertable;
use Exception;

class ExtractedJSONFiles
{
    /**
     * @param ExtractedJSONFile[] $files
     */
    public function __construct(
        private readonly array $files,
    ) {}

    public function hasOnlyOne(): bool
    {
        return $this->count() === 1;
    }

    private function count(): int
    {
        return count($this->files);
    }

    /**
     * @throws Exception
     */
    public function save(ExtractedJSONFileConvertable $converter): void
    {
        foreach ($this->files as $file) {
            $file->save($converter);
        }
    }

    /**
     * @throws Exception
     */
    public function confirmData(): array
    {
        if (!$this->hasOnlyOne()) {
            throw new Exception("ファイルが{$this->count()}個なのに呼び出された");
        }

        return $this->files[0]->confirmData();
    }
}
