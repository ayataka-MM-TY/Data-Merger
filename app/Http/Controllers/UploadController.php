<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\View\View;

class UploadController extends Controller
{
    public function show(): View
    {
        $projects = Project::all()->map(fn($project) => $project->name);
        $props = [
            'projects' => $projects,
        ];
        return view('upload', $props);
    }
}
