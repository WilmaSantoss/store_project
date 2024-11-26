<?php 
session_start();

if(!empty($_GET['id'])){
    //conexão com a base de dados
    include('../conexao.php');

    $id_produto = $_GET['id'];

    $sqlDeletar = "DELETE FROM products WHERE id_product = $id_produto";
    $resultado = mysqli_query($mysqli, $sqlDeletar);

    echo "Produto Excluido! <br>";
    echo "<a href='../pages/pag_admin.php'>VOLTAR</a>";

}
        
?>

