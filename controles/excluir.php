<?php
session_start();
include("./database.php");

$database = new Database();
$mysqli = $database->connect();

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $lista = isset($_SESSION['lista']) ? $_SESSION['lista'] : array();

  $sqlDelete = "DELETE FROM produto WHERE id = ?";
  $stmtDelete = $mysqli->prepare($sqlDelete);
  $stmtDelete->bind_param("d", $id);

  if ($stmtDelete->execute()) {
    $sqlSelect = "SELECT * FROM produto";
    $resultSelect = $mysqli->query($sqlSelect);

    if ($resultSelect) {
      $lista = array();

      while ($row = $resultSelect->fetch_assoc()) {
        $lista[$row["id"]] = $row;
      }

      $_SESSION['lista'] = $lista;

      $resultSelect->free();
    } else {
      echo "Error: " . $mysqli->error;
    }
  } else {
    echo "Error: " . $stmtDelete->error;
  }

  $stmtDelete->close();

  header("Location: ../pages/consultar.php");
  exit;
} else {
  header("Location: ../pages/consultar.php");
  exit;
}
?>

