<?php

namespace App\Entity\File;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Ramsey\Uuid\Uuid;

class FileSaver implements FileSaveable
{
    /**
     * @param string $projectID UUID
     * @param UploadedFile $file
     * @param Carbon|null $date
     * @return SavedFile
     */
    function save(string $projectID, UploadedFile $file, ?Carbon $date): SavedFile
    {
        $originalName = $file->getClientOriginalName();
        $filename = Uuid::uuid4() . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('originals', $filename);
        return new SavedFile($projectID, $filePath, $originalName, $date);
    }
}
