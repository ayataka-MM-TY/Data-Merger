<?php

namespace App\Mock;

use App\Entity\Extract\Extractable;
use App\Entity\Extract\ExtractedJSONFile;
use Illuminate\Support\Carbon;

class MockExtractor implements Extractable
{

    function extract(string $projectID, string $from, string $to, string $originalName, ?Carbon $date): ExtractedJSONFile
    {
        // TODO: Implement extract() method.
    }
}
