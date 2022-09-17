<?php

namespace App\Entity\JSON;

use App\Entity\Extract\ExtractedJSONFile;

interface ExtractedJSONFileConvertable
{
    function convert(string $content): JSONConvertedRecords;
}
