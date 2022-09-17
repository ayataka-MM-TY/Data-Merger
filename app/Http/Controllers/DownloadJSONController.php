<?php

namespace App\Http\Controllers;

use App\Entity\Merge\MergeRecords;
use App\Models\Project;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DownloadJSONController extends Controller
{
    function download(string $projectID): BinaryFileResponse
    {
        /** @var Project $project */
        $project = Project::whereId($projectID)->firstOrFail();

        $merge = new MergeRecords($project->records());
        $path = storage_path() . "/app/merged/" . Uuid::uuid4()->toString() . "json";
        $json = json_encode(array_values($merge->json()), JSON_UNESCAPED_UNICODE);

        $utf8Data = mb_convert_encoding($json, "UTF-8");
        file_put_contents($path, $utf8Data);

        return response()->file($path);
    }
}
