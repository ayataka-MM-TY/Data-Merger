<?php

namespace App\Entity\File;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;

class UploadedFilesReceiver
{
    public function __construct(
        private readonly FileSaveable $saver,
    ) {}

    /**
     * @param string $projectID UUID
     * @param UploadedFile[]|UploadedFile $files
     * @param Carbon|null $date
     * @return SavedFiles
     */
    public function receive(string $projectID, array|UploadedFile $files, ?Carbon $date): SavedFiles
    {
        /** @var UploadedFile[] $saveFiles */
        $saveFiles = is_array($files) ? $files : [$files];
        return new SavedFiles(array_map(fn ($file) => $this->saver->save($projectID, $file, $date), $saveFiles));
    }
}
