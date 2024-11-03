<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\ImportStoreRequest;
use App\Http\Resources\Project\ProjectResource;
use App\Jobs\ImportProjectExcelJob;
use App\Models\File;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(){
        $projects = ProjectResource::collection(Project::paginate(10));

        return inertia('Project/Index', compact('projects'));
    }

    public function import(){
        return inertia('Project/Import');
    }

    public function importStore(ImportStoreRequest $request){
        $data = $request->validated();

        $file = File::putAndCreate($data['file']);
        $task = Task::create([
            'file_id' => $file->id,
            'user_id' => auth()->id(),
            'type' => $data['type'],
        ]);

        ImportProjectExcelJob::dispatchSync($file->path, $task);
    }
}
