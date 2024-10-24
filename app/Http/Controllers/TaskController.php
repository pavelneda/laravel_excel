<?php

namespace App\Http\Controllers;

use App\Http\Resources\FailedRow\FailedRowResource;
use App\Http\Resources\Task\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
        $tasks = TaskResource::collection(Task::paginate(10));
        return inertia('Task/Index', compact(['tasks']));
    }

    public function failedList(Task $task)
    {
        $failedList = FailedRowResource::collection($task->failedRows()->paginate(10));
        return inertia('Task/FailedList', compact(['failedList']));
    }
}
