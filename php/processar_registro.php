
<?php
    /* conexão ao banco de dados */
    include('../conexao.php');

    /* verificação de o email já existe */
    $email = $_POST['emailRegistro'];
    $email = mysqli_real_escape_string($mysqli, $email);
    $sql = "SELECT email_user FROM hypertechpc.users WHERE email_user='$email'";
    $retorno = mysqli_query($mysqli, $sql);


    /* inclusão dos dados na base de dados */
    if (mysqli_num_rows($retorno) > 0) {
        echo 'EMAIL já cadastrado!<br>';
    } else {
        $nome = $_POST['nomeRegistro'];
        $apelido = $_POST['apelidoRegistro'];
        $email = $_POST['emailRegistro'];
        $password = $_POST['passRegistro']; 
        $passConf = $_POST['confPassRegistro'];

        /* Verificação se as senhas são iguais */
        if ($password !== $passConf) {
            echo "As senhas não coincidem!<br>";
            echo "<a href='../registro.html'>Tente novamente</a>";
        } else {
            /* adicionando o md5 */
            $password_md5 = md5($password);
            $passwordConf_md5 = md5($password);

            $sql = "INSERT INTO hypertechpc.users (name_user, last_name_user, email_user, pass_user, confirm_pass_user, type_user) VALUES('$nome', '$apelido', '$email', '$password_md5', '$passwordConf_md5', 'utilizador')";
            $resultado = mysqli_query($mysqli, $sql);
            if ($resultado) {
                echo ">>>> Usuario cadastrado com sucesso <br> <br>";
                echo "<a href='../index.php'>VOLTAR</a>";
            } else {
                echo "Erro ao cadastrar usuário. Por favor, tente novamente.<br>";
            }
        }
    }
?>