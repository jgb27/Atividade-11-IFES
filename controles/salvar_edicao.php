<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = $_POST['codigo'];
    $descricao = $_POST['descricao'];
    $data = $_POST['data'];
    $preco = $_POST['preco'];

    // Recupere a lista de produtos da sessão
    $lista = isset($_SESSION['lista']) ? $_SESSION['lista'] : array();

    // Encontre o índice do produto a ser editado na lista
    $indiceParaEditar = -1;
    foreach ($lista as $indice => $produto) {
        if ($produto["codigo"] == $codigo) {
            $indiceParaEditar = $indice;
            break;
        }
    }

    if ($indiceParaEditar !== -1) {
        // Atualize os detalhes do produto com base nos dados enviados
        $lista[$indiceParaEditar]['desc'] = $descricao;
        $lista[$indiceParaEditar]['data'] = $data;
        $lista[$indiceParaEditar]['preco'] = $preco;

        // Atualize a lista na sessão
        $_SESSION['lista'] = $lista;

        // Redirecione de volta para a página consultar.php após a edição
        header("Location: ../pages/consultar.php");
        exit;
    } else {
        // Produto não encontrado, redirecione para a página consultar.php
        header("Location: ../pages/consultar.php");
        exit;
    }
} else {
    // Método incorreto, redirecione para a página consultar.php
    header("Location: ../pages/consultar.php");
    exit;
}
