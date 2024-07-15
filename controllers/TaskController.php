<?php

namespace Controllers;

use Framework\Response;
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

    public function store()
    {
        $task = new Task();
        $task->title = $_POST['title'];
        $task->description = $_POST['description'];
        $task->save();

        return Response::redirect("/tasks");
    }

    public function edit()
    {
        $task = Task::find($_GET['id']);
        return Response::views("task/edit", [
            'task' => $task
        ]);
    }

    public function update()
    {
        $task = Task::find($_POST['id']);
        $task->title = $_POST['title'];
        $task->description = $_POST['description'];
        $task->save();

        return Response::redirect("/tasks");
    }

    public function delete()
    {
        $task = Task::find($_GET['id']);
        $task->delete();

        return Response::redirect("/tasks");
    }
}
