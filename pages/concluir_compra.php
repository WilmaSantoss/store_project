<?php
session_start();
include '../conexao.php';

if (!$mysqli) {
    die('Erro de conexão: ' . $mysqli->connect_error);
}

// Verifica se o usuário está logado
if (!isset($_SESSION['id_user'])) {
    header("Location: ../login.php");
    exit();
}

$userId = $_SESSION['id_user'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['concluir_compra'])) {
    if (isset($_SESSION['carrinho'][$userId]) && !empty($_SESSION['carrinho'][$userId])) {
        
        $productsOrder = [];
        $totalPrice = 0;
        $totalQuantity = 0;

        foreach ($_SESSION['carrinho'][$userId] as $item) {
            $productsOrder[] = $item['nome'];
            $totalPrice += $item['preco'] * $item['quantidade'];
            $totalQuantity += $item['quantidade'];
        }

        $productsOrderString = implode(", ", $productsOrder);
        $nameUserOrder = $_POST['nomeEnvio'];
        $birthUserOrder = $_POST['dataNascimento'];
        $adressUserOrder = $_POST['moradaEnvio'];

         // Maior de 18 anos
         $dataNascimento = new DateTime($birthUserOrder);
         $dataAtual = new DateTime();
         $idade = $dataAtual->diff($dataNascimento)->y;
 
         // Verifica se a idade é menor que 18 anos
         if ($idade < 18) {
             echo "<script>
                     alert('Você precisa ter pelo menos 18 anos para concluir a compra.');
                     window.history.back();
                   </script>";
             exit();
         }

        $comando = $mysqli->prepare("
            INSERT INTO orders 
            (id_user_fk, name_user_order, barth_user_order, adress_user_order, products_order, quantity_prod_order, total_price_order) 
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        
        if (!$comando) {
            die('Erro na preparação da consulta de inserção: ' . $mysqli->error);
        }

        $comando->bind_param("issssis", $userId, $nameUserOrder, $birthUserOrder, $adressUserOrder, $productsOrderString, $totalQuantity, $totalPrice);

        if ($comando->execute()) {
            $_SESSION['carrinho'][$userId] = [];
            echo "<script>
                    alert('Compra concluída com sucesso!');
                    window.location.href = '../index.php';
                  </script>";
            exit();
        } else {
            echo "Erro ao concluir a compra: " . $comando->error;
        }

        $comando->close();
    } else {
        echo "Carrinho vazio!";
    }
}

$mysqli->close();
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
    <meta name="keywords" content="hypertechpc, loja online, pc gamer, assistencia tecnica, portugal, peças pc">

    <!-- favicon -->
    <link rel="shortcut icon" href="../imagens/favicon/favicon.ico" type="image/x-icon">

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <!-- css -->
    <link rel="stylesheet" href="../css/style_nav_footer.css">
    <link rel="stylesheet" href="../css/style_header_main.css">

    <!-- javaScript -->
    <script src="../js/script.js"></script>

    <style>
        .card {
            font-size: 0.9rem;
        }

        .card-img-top {
            width: 100%;
            height: 150px;
            object-fit: contain;
            object-position: center;
        }
    </style>


</head>

<body class="vh-100 overflow-auto">

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">

                <!-- logo -->
                <a class="navbar-brand" href="../index.php">
                    <img class="img-fluid" style="max-width: 250px;" src="../imagens/logo/hyperTech_PC.png" alt="Logo">
                </a>

                <!-- nav button -->
                <button class="navbar-toggler shadow-none border-0 d-lg-none" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse d-lg-flex justify-content-center" id="navbarNav">
                    <ul class="navbar-nav mb-2 mb-lg-0 fs-5">
                        <li class="nav-item me-3">
                            <a class="nav-link" href="sobre_hypertech.html">Sobre HyperTechPC</a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link" href="atendimento.html">Atendimento</a>
                        </li>
                    </ul>
                </div>

                <!-- cart icon and login button -->
                <div class="d-none d-lg-flex ms-auto">
                    <a href="#" class="text-white me-3">
                        <i class="bi bi-cart2 fs-4"></i>
                    </a>
                    <a href="../login.php" class="text-dark text-decoration-none px-3 py-1 rounded-4" id="criar_conta">Login</a>
                </div>

                <!-- sidebar for mobile  -->
                <div class="offcanvas offcanvas-end d-lg-none" tabindex="-1" id="offcanvasNavbar"
                    aria-labelledby="offcanvasNavbarLabel">

                    <!-- sidebar header -->
                    <div class="offcanvas-header text-white border-bottom">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">HyperTechPC</h5>
                        <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>

                    <!-- sidebar body -->
                    <div class="offcanvas-body d-flex flex-column p-4">
                        <ul class="navbar-nav justify-content-center align-items-center fs-5 flex-grow-1 pe-3">
                            <li class="nav-item mx-2">
                                <a class="nav-link" href="sobre_hypertech.html">Sobre HyperTechPC</a>
                            </li>
                            <li class="nav-item mx-2">
                                <a class="nav-link" href="atendimento.html">Atendimento</a>
                            </li>
                        </ul>

                        <!-- cart icon and register button -->
                        <div class="d-flex flex-column justify-content-center align-items-center pag-3">
                            <a href="#" class="text-white text-decoration-none fs-5">
                                <i class="bi bi-cart2"></i> Carrinho
                            </a><br>
                            <a href="../login.php" class="text-dark text-decoration-none px-3 py-1 rounded-4 fs-4" id="criar_conta">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="container text-white main_login">
        <div class="row row_login">
            <div class="col-md-6 col-sm-12 col_checkout">

                <h3 class="fs-1">Concluir Compra</h3>
                <img src="../imagens/outros/pacman.png" alt="pacman">

                <div class="texto_checkout">
                    <h4 class="fs-3 mt-5">Detalhes de envio</h4>

                    <p class="mt-5 texto">
                        - Verifique seus dados de envio. <br>
                        - Certifique-se que todas as informações estão corretas.<br>
                        - Após a conclusão, você receberá um email de confirmação.<br>
                    </p>

                    <p class="fs-3 text-warning"> É rápido e seguro!</p>
                </div>

            </div>
            <div class="col-md-6 col-sm-12  col_checkout">

                <h3 class="margin_top_checkout">Dados para envio:</h3>
                <form action="concluir_compra.php" method="post">
                    <label for="dataNascimento">Nome * :</label><br>
                    <input type="text" name="nomeEnvio" id="nomeEnvio" required><br>

                    <label for="dataNascimento">Data de Nascimento * :</label><br>
                    <input type="date" name="dataNascimento" id="dataNascimento" required><br>

                    <label for="dataNascimento">Morada * :</label><br>
                    <input type="text" name="moradaEnvio" id="moradaEnvio" required><br>

                    <p class="text_buttom_checkout" id="campoObrigatorio">* Campo obrigatório</p>

                    <button type="submit" name="concluir_compra">Concluir a Transação</button>
                </form>
            </div>

        </div>

    </main>

</body>

</html>