<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\TaskRepository;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $tasks;

    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');
        $this->tasks = $tasks;
    }
    public function index(Request $request)
    {
        return view('tasks.index', [
            'tasks' => $this->tasks->forUser($request->user()),
        ]);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);

        return redirect('/tasks');
    }
    public function edit($id)
    {
        return view('tasks.edit', [
            'task' => Task::findOrFail($id),
        ]);
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $task = Task::find($id);
        $task->name = $request->name;
        $task->save();

        return redirect('/tasks')->with('msg', 'Edit Success');
    }
    public function destroy(Request $request, Task $task)
    {
        $this->authorize('destroy', $task);

        $task->delete();

        return redirect('/tasks');
    }
}
