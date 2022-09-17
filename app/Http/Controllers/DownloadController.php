<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DownloadController extends Controller
{
    public function show(): View
    {
        $props = [
            'downloads' => $this->downloads(),
        ];
        return view('download', $props);
    }

    public function saveOrCancel(Request $req): View
    {
        if ($req->input('save') !== "yes") {
            $this->cancelUpload($req->input('uploadID'));
        }
        return $this->show();
    }

    private function cancelUpload(string $uploadID): void
    {
        Upload::whereId($uploadID)->delete();
    }

    private function downloads(): array
    {
        return Project::with("uploads")
            ->with("uploads.records")
            ->get()
            ->map(function (Project $project) {
                return [
                    'project' => $project->name,
                    'count' => $project->recordCount(),
                    'lastDate' => $project?->lastUploadDate() ?? "",
                ];
            })->toArray();
    }
}
