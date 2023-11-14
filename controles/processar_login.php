<?php
include("./database.php");
$username = $_POST['username'];
$password = $_POST['password'];

$database = new Database();
$mysqli = $database->connect();

$sql = "SELECT * FROM usuario";
$sql_row = $mysqli->query($sql);
if ($sql_row->num_rows > 0) {
  while ($row = $sql_row->fetch_assoc()) {
    if ($username == $row["email"] && $password == $row["senha"]) {
      header('Location: ../pages/consultar.php');
    } else {
      header('Location: login.php?erro=1');
      exit();
    }
  }
} else {
  echo "0 results";
}
