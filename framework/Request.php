<?php

namespace Framework;

class Request
{
    private $data;

    public function __construct()
    {
        $this->data = json_decode(file_get_contents('php://input'), true) ?? [];
    }

    public function all()
    {
        return array_merge($this->data, $_POST);
    }

    public function input($key, $default = null)
    {
        return $this->data[$key] ?? $default;
    }

    public function query($key, $default = null)
    {
        return $_GET[$key] ?? $default;
    }
}
