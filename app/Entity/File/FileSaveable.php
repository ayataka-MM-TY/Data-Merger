<?php

namespace App\Entity\File;

use Illuminate\Http\UploadedFile;

interface FileSaveable
{
    function save(UploadedFile $file): void;
}
