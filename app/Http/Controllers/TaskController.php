<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    public function list(Request $req)
    {
        return Task::where('user_id', $req->user()->id)->get();
    }

    public function store(StoreTaskRequest $req)
    {
        $task = new Task($req->validated());
        $task->user_id = $req->user()->id;
        $task->save();
    }

    public function update(Task $task, Request $req)
    {
        Gate::authorize('interact', $task);

        $req->validate([
            'name' => ['sometimes', Rule::unique(Task::class)->ignoreModel($task)],
            'description' => ['sometimes']
        ]);

        $task->update($req->only('name', 'description'));
    }

    public function fetch(Task $task)
    {
        Gate::authorize('interact', $task);

        return $task;
    }

    public function destroy(Task $task)
    {
        Gate::authorize('interact', $task);

        $task->delete();
    }
}
