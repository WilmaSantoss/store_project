<?php
session_start();

/* Conexão com a base de dados */
include('../conexao.php');

if (isset($_POST['salvarAlteracoes'])) {

    $id_produto = $_POST['idProduto'];
    $novoNome = $_POST['novoNome'];
    $novaQuantidade = $_POST['novoEstoque'];
    $novoPreco = $_POST['novoPreco'];
    $novaCategoria = $_POST['novaCategoria'];
    $novaImg = $_FILES['novaImg']; 

    /* Verifica se um novo arquivo de imagem foi enviado */
    if ($novaImg['error'] === UPLOAD_ERR_OK) {
        $nomeArquivo = basename($novaImg['name']);
        $pastaDestino = '../imagens/produtos/' . $novaCategoria . '/';
        $destinoCompleto = $pastaDestino . $nomeArquivo;

        // Verifica se o diretório existe, se não, cria o diretório
        if (!file_exists($pastaDestino)) {
            mkdir($pastaDestino, 0777, true);
        }

        // Move o arquivo carregado para o diretório de destino
        if (move_uploaded_file($novaImg['tmp_name'], $destinoCompleto)) {
            $novoCaminhoImagem = 'imagens/produtos/' . $novaCategoria . '/' . $nomeArquivo;

            // Atualizar a consulta SQL para incluir o novo caminho da imagem
            $sql = "UPDATE products SET name_product = ?, quantity_product = ?, price_product = ?, category_product = ?, image_product = ? WHERE id_product = ?";
            $comando = $mysqli->prepare($sql);
            $comando->bind_param("sisssi", $novoNome, $novaQuantidade, $novoPreco, $novaCategoria, $novoCaminhoImagem, $id_produto);
        } else {
            echo "Erro ao mover o arquivo carregado.";
            exit();
        }
    } else {
        // Se nenhuma nova imagem foi enviada, atualiza os outros campos
        $sql = "UPDATE products SET name_product = ?, quantity_product = ?, price_product = ?, category_product = ? WHERE id_product = ?";
        $comando = $mysqli->prepare($sql);
        $comando->bind_param("sissi", $novoNome, $novaQuantidade, $novoPreco, $novaCategoria, $id_produto);
    }

    /* Verificando se a consulta foi bem sucedida */
    if ($comando->execute()) {
        echo "Produto Atualizado!<br>";
        echo "<a href='../pages/editar_produto_admin.php?id=$id_produto'>VOLTAR</a>";
    } else {
        echo "Erro ao atualizar o produto: " . $comando->error . "<br>";
        echo "<a href='../pages/pag_admin.php'>VOLTAR</a>";
    }

    $comando->close();
    $mysqli->close();
} else {
    echo "Erro: Verifique se os dados já estão cadastrados no sistema.<br>";
    echo "<a href='../pages/pag_admin.php'>VOLTAR</a>";
}
?>
