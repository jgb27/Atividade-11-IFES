<?php
session_start();
include("./../controles/database.php");

$database = new Database();
$mysqli = $database->connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $descricao = $_POST['descricao'];
    $data = $_POST['data'];
    $preco = $_POST['preco'];

    $sqlUpdate = "UPDATE produto SET descricao = ?, data = ?, preco = ? WHERE id = ?";
    $stmtUpdate = $mysqli->prepare($sqlUpdate);
    $stmtUpdate->bind_param("ssdd", $descricao, $data, $preco, $id);

    if ($stmtUpdate->execute()) {
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
        echo "Error: " . $stmtUpdate->error;
    }

    $stmtUpdate->close();

    header("Location: ../pages/consultar.php");
    exit;
} else {
    header("Location: ../pages/consultar.php");
    exit;
}
