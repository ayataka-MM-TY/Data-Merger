<?php

namespace App\Http\Controllers;

use App\Entity\Extract\Extractable;
use App\Entity\File\UploadedFilesReceiver;
use App\Entity\JSON\ExtractedJSONFileConvertable;
use App\Models\Project;
use Exception;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ConfirmController extends Controller
{
    public function __construct(
    private readonly UploadedFilesReceiver $filesReceiver,
    private readonly Extractable $extractor,
    private readonly ExtractedJSONFileConvertable $converter,
) {}

    /**
     * @throws Exception
     */
    public function confirm(Request $request): View
    {
        /** @var UploadedFile|UploadedFile[] $files */
        $files = $request->file('file');
        /** @var Project $project */
        $project = Project::whereName($request->input('project'))->firstOrFail();
        $date = $request->date('date');
        $dateAssign = $request->boolean('date_assign');


        $savedFiles = $this->filesReceiver->receive($project->id, $files, $dateAssign ? $date : null);
        $jsonFiles = $savedFiles->extracted($this->extractor);
        $jsonFiles->save($this->converter);

        if (!$jsonFiles->hasOnlyOne()) {
            redirect('/download');
        }
        return view('confirm', $jsonFiles->confirmData());
    }
}
