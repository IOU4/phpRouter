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

  public function get(string $route, callable $callable)
  {
    $path = parse_url($this->uri, PHP_URL_PATH);
    $query = parse_url($this->uri, PHP_URL_QUERY);
    if ($query) parse_str($query, $query);
    if ('/api' . $route == $path && $this->method == 'GET') {
      call_user_func($callable, $query);
      die();
    }
  }

  public function post(string $route, callable $callable)
  {
    $path = parse_url($this->uri, PHP_URL_PATH);
    if ('/api' . $route == $path && $this->method == 'POST') {
      $data = empty($_POST) ? json_decode(file_get_contents('php://input'), true) : $_POST;
      call_user_func($callable, $data);
      die();
    }
  }

  public function patch(string $route, callable $callable)
  {
    $path = parse_url($this->uri, PHP_URL_PATH);
    if ('/api' . $route == $path && $this->method == 'PATCH') {
      $data = json_decode(file_get_contents('php://input'));
      call_user_func($callable, $data);
      die();
    }
  }

  public function delete(string $route, callable $callable)
  {
    $path = parse_url($this->uri, PHP_URL_PATH);
    if ('/api' . $route == $path && $this->method == 'DELETE') {
      $data = json_decode(file_get_contents('php://input'));
      call_user_func($callable, $data);
      die();
    }
  }
}
