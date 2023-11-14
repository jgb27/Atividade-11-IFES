<?php
session_start();

if (isset($_GET['codigo'])) {
  $codigo = $_GET['codigo'];

  $lista = isset($_SESSION['lista']) ? $_SESSION['lista'] : array();

  $indiceParaExcluir = -1;
  foreach ($lista as $indice => $produto) {
    if ($produto["codigo"] == $codigo) {
      $indiceParaExcluir = $indice;
      break;
    }
  }

  if ($indiceParaExcluir !== -1) {
    array_splice($lista, $indiceParaExcluir, 1);

    $_SESSION['lista'] = $lista;
  }

  header("Location: ../pages/consultar.php");
  exit;
} else {
  header("Location: ../pages/consultar.php");
  exit;
}
