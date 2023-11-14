<?php
include_once '../includes/header.php';
include('../controles/database.php');

$lista = array();
$erroData = '';

$database = new Database();
$mysqli = $database->connect();

$sqlSelect = "SELECT * FROM produto";
$resultSelect = $mysqli->query($sqlSelect);

if ($resultSelect) {
  while ($row = $resultSelect->fetch_assoc()) {
    $id = $row["id"];
    $lista[$id] = $row;
  }
} else {
  echo "Error: " . $mysqli->error;
}

if (isset($_POST['btn-cadastrar'])) {
  $descricao = $_POST['txtdescricao'];
  $dataBruto = $_POST['txtdata'];
  $preco = $_POST['txtpreco'];

  $dataBruto = preg_replace('/\s+/', '', $dataBruto);
  $dataBruto = preg_replace('/\D/', '', $dataBruto);

  $dataObj = date_create_from_format('dmY', $dataBruto);

  if ($dataObj) {
    $data = date_format($dataObj, 'Y-m-d');

    $sqlInsert = "INSERT INTO produto (`descricao`, `data`, `preco`) VALUES (?, ?, ?)";
    $stmtInsert = $mysqli->prepare($sqlInsert);

    $stmtInsert->bind_param("ssd", $descricao, $data, $preco);

    if ($stmtInsert->execute()) {
      $sqlSelect = "SELECT * FROM produto";
      $resultSelect = $mysqli->query($sqlSelect);

      if ($resultSelect) {
        while ($row = $resultSelect->fetch_assoc()) {
          $id = $row["id"];
          $lista[$id] = $row;
        }
      } else {
        echo "Error: " . $mysqli->error;
      }
    } else {
      echo "Error: " . $stmtInsert->error;
    }

    $stmtInsert->close();
  } else {
    $erroData = 'A data deve estar no formato dd/mm/aaaa.';
  }
}

$resultSelect->close();
$mysqli->close();
?>


<div class="row mt-4">
  <div class="col-8 container my-2">
    <fieldset class="border p-2">
      <legend class="control-label">Incluir produto</legend>
      <?php if (!empty($erroData)): ?>
        <div class="alert alert-danger" role="alert">
          <?php echo $erroData; ?>
        </div>
      <?php endif; ?>
      <form action="consultar.php" method="POST">
        <div class="row mx-3 g-2">
          <div class="col-3">
            <label for="nome" class="form-label">Descrição</label>
            <input type="text" class="form-control" id="descricao" name="txtdescricao" required>
          </div>
          <div class="col-2">
            <label for="sobrenome" class="form-label">Data Inclusão</label>
            <input type="text" class="form-control" id="data" name="txtdata" placeholder="dd/mm/aaaa" required>
          </div>
          <div class="col-4">
            <div class="col-2">
              <label for="idade" class="form-label">Preço</label>
              <input type="number" class="form-control" id="preco" name="txtpreco" min="10" max="120">
            </div>
          </div>
        </div>
        <div class="row mx-3 my-3 g-2">
          <div class="col-2">
            <button type="submit" name="btn-cadastrar" class="btn btn-primary">Cadastrar</button>
          </div>
        </div>
      </form>
    </fieldset>
    <style>
      .sair-link {
        position: absolute;
        top: 10px;
        right: 10px;
      }
    </style>
    <a href='../index.php' class="btn btn-second sair-link">Sair</a>
  </div>
</div>
