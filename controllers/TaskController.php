<?php

namespace Controllers;

use Models\Task;

class TaskController
{
    public function index()
    {
        $tasks = Task::all();
        require 'views/task/list.php';
    }

    public function create()
    {
        require 'views/task/create.php';
    }

    public function store()
    {
        $task = new Task();
        $task->title = $_POST['title'];
        $task->description = $_POST['description'];
        $task->save();

        header('Location: /tasks');
    }

    public function edit()
    {
        $task = Task::find($_GET['id']);
        require 'views/task/edit.php';
    }

    public function update()
    {
        $task = Task::find($_POST['id']);
        $task->title = $_POST['title'];
        $task->description = $_POST['description'];
        $task->save();

        header('Location: /tasks');
    }

    public function delete()
    {
        $task = Task::find($_GET['id']);
        $task->delete();

        header('Location: /tasks');
    }
}
