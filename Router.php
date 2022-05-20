<?php

class Router
{
  private $method;
  private $uri;

  public function __construct()
  {
    $this->method = $_SERVER['REQUEST_METHOD'];
    $this->uri = $_SERVER['REQUEST_URI'];
  }

  public function get($route, $callable)
  {
    $parsed_url = parse_url($this->uri);
    $query = [];
    if (isset($parsed_url['query'])) {
      parse_str($parsed_url['query'], $query);
    }
    if ('/api' . $route == $parsed_url['path'] && $this->method == 'GET') {
      $callable($query);
      die();
    }
  }

  public function post($route, $callable)
  {
    $path = parse_url($this->uri)['path'];
    if ('/api' . $route == $path && $this->method == 'POST') {
      if (empty($_SESSION['user_id']) && $route != '/login' && $route != '/singup') {
        die(json_encode(['logged' => false]));
      }

      $data = $_POST;
      $callable($data);
      die();
    }
  }
}
