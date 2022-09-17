<?php

namespace App\Entity\Extract;

use Illuminate\Support\Carbon;

interface Extractable
{
    /**
     * @param string $projectID UUID
     * @param string $from
     * @param string $to
     * @param string $originalName
     * @param Carbon|null $date
     * @return ExtractedJSONFile
     */
    function extract(string $projectID, string $from, string $to, string $originalName, ?Carbon $date): ExtractedJSONFile;
}
