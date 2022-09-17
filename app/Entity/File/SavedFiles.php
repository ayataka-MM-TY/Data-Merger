<?php

namespace App\Entity\File;

use App\Entity\Extract\Extractable;
use App\Entity\Extract\ExtractedJSONFiles;

class SavedFiles
{
    /**
     * @param SavedFile[] $files
     */
    public function __construct(
        private readonly array $files,
    ) {}

    public function extracted(Extractable $extractor): ExtractedJSONFiles
    {
        return new ExtractedJSONFiles(array_map(fn ($file) => $file->extracted($extractor), $this->files));
    }
}
