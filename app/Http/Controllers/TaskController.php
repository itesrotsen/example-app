<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Categoria;
use App\Models\Task;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\Factory|View
    {
        $tasks = Task::all();
        return view('tasks.index')->with(['tasks' => $tasks]);
    }

    public function createForm()
    {
        $categorias = Categoria::all();
        return view('tasks.create')->with(['categorias' => $categorias]);
    }

    public function store(CreateTaskRequest $request)
    {
        $taskData = $request->validated();
        $task = new Task();
        $task->fill($taskData);
        $task->save();
        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        return view('tasks.show')->with(['task' => $task]);
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $taskData = $request->validated();
        $task->fill($taskData);
        $task->save();
        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }


}
