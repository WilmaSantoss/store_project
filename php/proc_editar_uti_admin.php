<?php
session_start();

/* conexão com a base de dados */
include('../conexao.php');

if (isset($_POST['salvarAlteracoes'])) {

    $id_user = $_POST['idUtilizador'];
    $novoNome = $_POST['novoNome'];
    $novoApelido = $_POST['novoApelido'];
    $novoEmail = $_POST['novoEmail'];

    /* Alterando dados na base de dados */

    $sql = "UPDATE users SET name_user = '$novoNome', last_name_user = '$novoApelido', email_user = '$novoEmail' WHERE id_user = '$id_user'";
    $resultado = mysqli_query($mysqli, $sql);       

    echo "Dados do utilizador alterado! <br>";
    echo "<a href='editar_uti_admin.php?id=$id_user'>VOLTAR</a>";
} else {
    echo "Erro: Verifique se os dados já estão cadastrados no sistema . <br>";
    echo "<a href='../pages/pag_admin.php'>VOLTAR</a>";
}
  