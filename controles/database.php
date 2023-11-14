<?php
class Database
{
  var $host = "localhost";
  var $user = "root";
  var $pass = "";
  var $banco = "ifes_produtos";
  var $mysqli;

  public function connect()
  {
    $this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->banco);
    if ($this->mysqli->connect_error) {
      die("Connection failed: " . $this->mysqli->connect_error);
    }
    return $this->mysqli;
  }
}

