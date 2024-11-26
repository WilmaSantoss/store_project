<?php 
session_start();
include('../conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $mysqli->real_escape_string($_POST['emailLogin']);
    $senha = $_POST['passLogin'];

    // Criptografar a senha com MD5
    $senha_md5 = md5($senha);

    $sql_code = "SELECT id_user, type_user, pass_user FROM users WHERE email_user= '$email'";
    $resultado = $mysqli->query($sql_code);

    if (!$resultado) {
        die("Erro na consulta SQL: " . $mysqli->error);
    }

    if ($resultado->num_rows == 1) {
        $row = $resultado->fetch_assoc();

        // Comparar a senha criptografada MD5 do banco de dados com a senha enviada
        if ($row['pass_user'] === $senha_md5) {
            $_SESSION['id_user'] = $row['id_user'];

            if ($row['type_user'] === 'utilizador') {
                header("Location: ../pages/carrinho.php");
            } else if ($row['type_user'] === 'administrador' && $email === 'janedoe@admin.com' && $senha_md5 === md5('12345')) {
                header("Location: ../pages/pag_admin.php");
            }     

            exit();
        } else {
            echo "Nome de usuário ou senha incorretos.<br><br>";
            echo "<a href='../login.php'>VOLTAR</a>";
        }
    }
}
?>