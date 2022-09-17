<?php

namespace App\Entity\File;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;

interface FileSaveable
{
    /**
     * @param string $projectID UUID
     * @param UploadedFile $file
     * @param Carbon|null $date
     * @return SavedFile
     */
    function save(string $projectID, UploadedFile $file, ?Carbon $date): SavedFile;
}
