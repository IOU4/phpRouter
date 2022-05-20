<?php
class Database
{
  protected $connection;

  function __construct()
  {
    $connection = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']);
    $this->connection = $connection;
  }

  function execStatement($query, $params = [])
  {
    $stmnt = $this->connection->prepare($query);
    $stmnt->execute($params);
    return $stmnt;
  }
}
