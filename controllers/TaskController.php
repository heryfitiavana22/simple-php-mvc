<?php

namespace Controllers;

use Framework\Request;
use Framework\Response;
use Framework\Validator;
use Models\Task;

class TaskController
{
    public function index()
    {
        $tasks = Task::all();
        return Response::views("task/list", [
            'tasks' => $tasks
        ]);
    }

    public function create()
    {
        return Response::views("task/create");
    }

    public function store(Request $request)
    {
        $validated = Validator::validate($request->all(),  [
            'title' => 'required|string|maxlength:255',
            'description' => 'required|string',
        ]);
        $task = Task::create($validated);
        return Response::redirect("/tasks", [
            'task' => $task
        ]);       
    }

    public function edit(Request $request, $id)
    {
        $task = Task::find($id);
        return Response::views("task/edit", [
            'task' => $task
        ]);
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        $validated = Validator::validate($request->all(),  [
            'title' => 'string',
            'description' => 'string',
        ]);
        $task->title = $validated['title'];
        $task->description = $validated['description'];
        $task->save();

        return Response::redirect("/tasks");   
    }


    public function delete($id)
    {
        $task = Task::find($id);
        if(!$task) return Response::json(['error' => 'Task not found'], 404);

        $task->delete();

        return Response::redirect("/tasks");   
    }
}
