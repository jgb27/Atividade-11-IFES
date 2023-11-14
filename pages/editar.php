<?php
session_start();
include_once '../includes/header.php';

if (isset($_GET['codigo'])) {
  $codigo = $_GET['codigo'];

  $lista = isset($_SESSION['lista']) ? $_SESSION['lista'] : array();

  $indiceParaEditar = -1;
  foreach ($lista as $indice => $produto) {
    if ($produto["codigo"] == $codigo) {
      $indiceParaEditar = $indice;
      break;
    }
  }

  if ($indiceParaEditar !== -1) {
    $produtoParaEditar = $lista[$indiceParaEditar];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $descricao = $_POST['descricao'];
      $data = $_POST['data'];
      $preco = $_POST['preco'];

      $lista[$indiceParaEditar]['desc'] = $descricao;
      $lista[$indiceParaEditar]['data'] = $data;
      $lista[$indiceParaEditar]['preco'] = $preco;

      $_SESSION['lista'] = $lista;

      header("Location: consultar.php");
      exit;
    }

?>

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 mt-4">
          <div class="card">
            <div class="card-header">
              <h1 class="text-center">Editar Produto</h1>
            </div>
            <div class="card-body">
              <form action="../controles/salvar_edicao.php" method="post">
                <input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
                <div class="mb-3">
                  <label for="descricao" class="form-label">Descrição:</label>
                  <input type="text" name="descricao" value="<?php echo $produtoParaEditar['desc']; ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                  <label for="data" class="form-label">Data Inclusão:</label>
                  <input type="text" name="data" value="<?php echo $produtoParaEditar['data']; ?>" class="form-control">
                </div>
                <div class="mb-3">
                  <label for="preco" class="form-label">Preço:</label>
                  <input type="text" name="preco" value="<?php echo $produtoParaEditar['preco']; ?>" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Salvar Edição</button>
                <a href='./consultar.php' class="btn btn-secondary">Voltar</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php

  } else {
    header("Location: consultar.php");
    exit;
  }
} else {
  header("Location: consultar.php");
  exit;
}
include_once '../includes/footer.php';
?>
