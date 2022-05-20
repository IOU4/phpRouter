<?php
class UserModel extends Database
{
  function fetch_all()
  {
    $query = 'select * from users';
    $stmnt = $this->execStatement($query);
    $result = $stmnt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }
}
