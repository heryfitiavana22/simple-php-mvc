<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

require  __DIR__ . '/../../config/database.php';

Capsule::schema()->create('tasks', function (Blueprint $table) {
    $table->increments('id');
    $table->string('title');
    $table->text('description');
    $table->timestamp('created_at')->default(Capsule::raw('CURRENT_TIMESTAMP'));
});
