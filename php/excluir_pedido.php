<?php 
session_start();

if(!empty($_GET['id'])){
    //conexão com a base de dados
    include('../conexao.php');

    $id_pedido = $_GET['id'];

    $sqlDeletar = "DELETE FROM orders WHERE id_order = $id_pedido";
    $resultado = mysqli_query($mysqli, $sqlDeletar);

    echo "Pedido Excluido! <br>";
    echo "<a href='../pages/pag_admin.php'>VOLTAR</a>";

}
        
?>

