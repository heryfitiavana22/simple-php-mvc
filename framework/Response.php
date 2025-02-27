<?php

namespace Framework;

class Response
{
    public static function views($view, $data = [])
    {
        extract($data);
        require 'views/' . $view . '.php';
    }
 
    public static function json($data, $status = 200)
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public static function redirect($url)
    {
        header('Location: ' . $url);
    }
}
