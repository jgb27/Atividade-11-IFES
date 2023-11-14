<?php
include_once '../includes/insert.php';
?>

<div class="container my-3 col-9">
    <div class="m-5">
        <div class="fs-5 mb-5">
            <h1>Lista de Produtos</h1>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Data inclusão</th>
                        <th scope="col">Preço</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                    if (!empty($lista)) {
                        foreach ($lista as $produto) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $produto["id"] ?>
                                </td>
                                <td>
                                    <?php echo $produto["descricao"] ?>
                                </td>
                                <td>
                                    <?php echo date("d/m/Y", strtotime($produto["data"])); ?>
                                </td>
                                <td>
                                    <?php echo $produto["preco"] ?>
                                </td>
                                <td>
                                    <a href='./editar.php?id=<?php echo $produto["id"]; ?>' class="btn btn-sm btn-primary">
                                        Editar
                                    </a>
                                    <a href='../controles/excluir.php?<?php echo $produto["id"]; ?>'
                                        class="btn btn-sm btn-danger" data-bs-toggle='modal'
                                        data-bs-target="#exampleModal<?php echo $produto["id"]; ?>">
                                        Excluir
                                    </a>
                                </td>
                            </tr>
                            <div class='modal fade' id="exampleModal<?php echo $produto["id"]; ?>" tabindex='-1'
                                aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                <div class='modal-dialog modal-dialog-centered'>
                                    <div class='modal-content'>
                                        <div class='modal-header bg-danger text-white'>
                                            <h1 class='modal-title fs-5 ' id='exampleModalLabel'>ATENÇÃO!</h1>
                                            <button type='button' class='btn-close btn-close-white' data-bs-dismiss='modal'
                                                aria-label='Close'></button>
                                        </div>
                                        <div class='modal-body mb-3 mt-3'>
                                            Tem certeza que deseja <b>EXCLUIR</b> o produto
                                            <?php echo $produto["descricao"]; ?>?
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Voltar
                                            </button>
                                            <a href='../controles/excluir.php?id=<?php echo $produto["id"]; ?>'
                                                class="btn btn-danger">Excluir</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<?php include_once '../includes/footer.php'; ?>

