<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class UploadController extends Controller
{
    public function show(Request $request): View
    {
        $files = $request->files;
        $props = [
            'projects' => [
                'My Project',
                'タクシーLog',
                'プロジェクトX',
            ],
        ];
        return view('upload', $props);
    }
}
