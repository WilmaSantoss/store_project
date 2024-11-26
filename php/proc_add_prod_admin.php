<?php 
session_start();
include('../conexao.php');  

// Verifica se o usuário está logado
if (!isset($_SESSION['id_user'])) {
    echo "Você precisa estar logado para adicionar um produto.";
    exit();
}

// Recebendo os dados do formulário
$nomeProd = $_POST['nomeProduto'];
$quantProd = $_POST['estoqueProduto'];
$precoProd = $_POST['precoProduto'];
$categoriaProd = $_POST['categoriaProduto'];
$imgProd = $_FILES['imagemProduto'];

// Verifica se o upload da imagem foi feito sem erros
if ($imgProd['error'] == 0) {
    // Obtém o nome do arquivo da imagem
    $imgNome = $imgProd['name']; 

    // Determina o caminho baseado na categoria
    $imgCaminhoBD = '';
    if ($categoriaProd == 'pc_gamer') {
        $imgCaminhoBD = 'imagens/produtos/pcgamer/' . $imgNome;
    } elseif ($categoriaProd == 'workstation') {
        $imgCaminhoBD = 'imagens/produtos/workstation/' . $imgNome;
    } elseif ($categoriaProd == 'pecas') {
        $imgCaminhoBD = 'imagens/produtos/pecas/' . $imgNome;
    } else {
        echo "Categoria inválida.";
        exit();
    }
} else {
    echo "Erro no upload da imagem.";
    exit();
}

// Inserindo o produto na base de dados usando prepared statements
$sql = "INSERT INTO products (name_product, quantity_product, price_product, category_product, image_product) 
        VALUES (?, ?, ?, ?, ?)";

$comando = $mysqli->prepare($sql);
$comando->bind_param("sddss", $nomeProd, $quantProd, $precoProd, $categoriaProd, $imgCaminhoBD);

if ($comando->execute()) {
    echo "Produto adicionado com sucesso!<br><br>";
    echo "<a href='../pages/pag_admin.php'>VOLTAR</a>";
} else {
    echo "Erro ao adicionar o produto: " . $comando->error;
}

$comando->close();
$mysqli->close();


?>