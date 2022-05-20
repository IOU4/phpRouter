<?php

class User
{
  private int|null $id;
  private string $name;
  private string $email;
  private string $password;
  private UserModel $model;

  public function __construct(string $name, string $email, $id = null)
  {
    $this->id = $id;
    $this->username = $name;
    $this->email = $email;
    $this->model = new UserModel();
  }

  public function all()
  {
    echo json_encode($this->model->fetch_all());
  }
}
