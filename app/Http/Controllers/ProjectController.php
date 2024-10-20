<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\ImportStoreRequest;
use App\Jobs\ImportProjectExcelJob;
use App\Models\File;
use App\Models\Task;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(){
        return inertia('Project/Index');
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
        ]);

        ImportProjectExcelJob::dispatchSync($file->path, $task);
    }
}
