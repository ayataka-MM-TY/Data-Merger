<?php

namespace App\Entity\File;

use Illuminate\Http\UploadedFile;

class UploadedFilesReceiver
{
    public function __construct(
        private readonly FileSaveable $saver,
    ) {}

    /**
     * @param UploadedFile[] $files
     * @return void
     */
    public function receive(array $files): void
    {
        foreach ($files as $file) {
            $this->saver->save($file);
        }
    }
}
