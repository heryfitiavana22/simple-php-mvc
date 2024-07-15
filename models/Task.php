<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model {
    protected $table = 'tasks';
    public $timestamps = false;
    protected $fillable = ['title', 'description', 'created_at'];
}
