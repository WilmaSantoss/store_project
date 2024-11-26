<?php
session_start();

/* conexão com a base de dados */
if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
    include('../conexao.php');
    $id_produto = intval($_GET['id']);

    /* Pegando os dados atuais do banco de dados */

    if ($comando = $mysqli->prepare("SELECT * FROM products WHERE 	id_product = ?")) {
        $comando->bind_param("i", $id_produto);
        $comando->execute();
        $result = $comando->get_result();
        $row = $result->fetch_assoc();
        $nomeAtual = $row['name_product'];
        $quantidadeAtual = $row['quantity_product'];
        $precoAtual = $row['price_product'];
        $categoriaAtual = $row['category_product'];
        $imgAtual = $row['image_product'];
        $comando->close();
    }
} else {
    // Redirecionar ou exibir uma mensagem de erro
    echo "ID inválido.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO -->
    <title>HypertechPC: Peças de Computador Gamer e Assistência Técnica Online</title>
    <meta name="description"
        content=" A HypertechPC é uma loja online em Portugal especializada em peças de computador gamer, assistência técnica e PCs workstation. Oferecemos componentes de alta performance e suporte técnico especializado para todas as suas necessidades tecnológicas.">
    <meta name="keyworks" content="hypertechpc, loja online, pc gamer, assistencia tecnica, portugal, peças pc">

    <!-- favicon -->
    <link rel="shortcut icon" href="../imagens/favicon/favicon.ico" type="image/x-icon">

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <!-- css -->
    <link rel="stylesheet" href="../css/style_nav_footer.css">
    <link rel="stylesheet" href="../css/style_header_main.css">

    <!-- javaScript -->
    <script src="../js/script.js"></script>

</head>

<body class="vh-100 overflow-auto">

    <!-- main content -->
    <main class="container text-center text-white container_editar">

        <!-- produto que será editado -->
        <div class="row">
            <div class="col text-bg-light p-3">

                <h2>Editar Produto</h2>

                <?php $imgAtual = "../" . $imgAtual; ?>

                <form method="post" action="../php/proc_editar_prod_admin.php" enctype="multipart/form-data">
                    <input type="hidden" name="idProduto" id="idProduto" value="<?php echo $id_produto ?>">
                    <label>Novo nome: </label><input type="text" name="novoNome" id="novoNome" value="<?php echo $nomeAtual; ?>"> <br>
                    <label>Quantidade Estoque: </label><input type="text" name="novoEstoque" id="novoEstoque" value="<?php echo $quantidadeAtual; ?>"> <br>
                    <label>Novo Preço: </label><input type="text" name="novoPreco" id="novoPreco" value="<?php echo $precoAtual; ?>"> <br>

                    <label>Nova Categoria: </label>
                    <select name="novaCategoria" id="novaCategoria">
                        <option value="pc_gamer" <?php echo ($categoriaAtual == 'pc_gamer') ? 'selected' : ''; ?>>Pc Gamer</option>
                        <option value="workstation" <?php echo ($categoriaAtual == 'workstation') ? 'selected' : ''; ?>>Workstation</option>
                        <option value="pecas" <?php echo ($categoriaAtual == 'pecas') ? 'selected' : ''; ?>>Peças</option>
                    </select> <br>

                    <label>Imagem Atual:</label><br>
                    <img src="<?php echo $imgAtual; ?>" alt="Imagem do Produto" style="max-width: 200px;"><br><br>

                    <label>Nova Imagem:</label>
                    <input type="file" name="novaImg" id="novaImg"><br><br>
                    <input id="salvarAlteracoes" name="salvarAlteracoes" type="submit" value="Salvar Alterações"> <br><br>
                </form>

                <a href="../pages/pag_admin.php?id=$id_user">Voltar para o perfil <i class="fa-solid fa-caret-right"></i></a>
            </div>
        </div>
    </main>


</body>

</html>