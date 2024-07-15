<?php

use Helpers\DbConnection;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

$capsule = new Capsule;

$capsule->addConnection(DbConnection::get());

$capsule->setAsGlobal();
$capsule->bootEloquent();


$capsule->setEventDispatcher(new Dispatcher(new Container));
