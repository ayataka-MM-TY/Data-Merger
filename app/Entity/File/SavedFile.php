<?php

namespace App\Entity\File;

use App\Entity\Extract\Extractable;
use App\Entity\Extract\ExtractedJSONFile;
use Illuminate\Support\Carbon;
use Ramsey\Uuid\Uuid;

class SavedFile
{
    /**
     * @param string $projectID UUID
     * @param string $path
     * @param string $originalName
     * @param Carbon|null $date
     */
    public function __construct(
        private readonly string $projectID,
        private readonly string $path,
        private readonly string $originalName,
        private readonly ?Carbon $date,
    ) {}

    public function extracted(Extractable $extractor): ExtractedJSONFile
    {
        return $extractor->extract(
            $this->projectID,
            $this->path,
            $this->jsonPath(),
            $this->originalName,
            $this->date,
        );
    }

    private function jsonPath(): string
    {
        return storage_path() . '/app/proceeds/' . Uuid::uuid4()->toString() . ".json";
    }
}
