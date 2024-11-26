<?php 
session_start();
include 'conexao.php';

// Verifica se o usuário já está logado
if (isset($_SESSION['id_user'])) {
  $user_id = $_SESSION['id_user'];

  // Verifica o tipo de usuário no banco de dados
  $sql_code = "SELECT type_user FROM users WHERE id_user = '$user_id'";
  $resultado = $mysqli->query($sql_code);

  if ($resultado->num_rows > 0) {
    $row = $resultado->fetch_assoc();
    $type_user = $row['type_user'];

    // Se for administrador, redireciona para a página de admin
    if ($type_user == 'administrador') {
      header("Location: pages/pag_admin.php");
      exit();
    } 

    // Se for utilizador, redireciona para a página de carrinho
    if ($type_user == 'utilizador') {
      header("Location: pages/carrinho.php");
      exit();
    }
  }
}
?>



<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- SEO -->
  <title>HypertechPC: Peças de Computador Gamer e Assistência Técnica Online</title>
  <meta name="description" content=" A HypertechPC é uma loja online em Portugal especializada em peças de computador gamer, assistência técnica e PCs workstation. Oferecemos componentes de alta performance e suporte técnico especializado para todas as suas necessidades tecnológicas.">
  <meta name="keyworks" content="hypertechpc, loja online, pc gamer, assistencia tecnica, portugal, peças pc">

  <!-- favicon -->
  <link rel="shortcut icon" href="imagens/favicon/favicon.ico" type="image/x-icon">

  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <!-- css -->
  <link rel="stylesheet" href="css/style_nav_footer.css">
  <link rel="stylesheet" href="css/style_header_main.css">

  <!-- javaScript -->
  <script src="js/script.js" defer></script>

</head>

<body class="vh-100 overflow-auto">

  <header>
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container">

        <!-- logo -->
        <a class="navbar-brand" href="index.php">
          <img class="img-fluid" style="max-width: 250px;" src="imagens/logo/hyperTech_PC.png" alt="Logo">
        </a>

        <!-- nav button -->
        <button class="navbar-toggler shadow-none border-0 d-lg-none" type="button" data-bs-toggle="offcanvas"
          data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse d-lg-flex justify-content-center" id="navbarNav">
          <ul class="navbar-nav mb-2 mb-lg-0 fs-5">
            <li class="nav-item me-3">
              <a class="nav-link" href="pages/sobre_hypertech.html">Sobre HyperTechPC</a>
            </li>
            <li class="nav-item me-3">
              <a class="nav-link" href="pages/atendimento.html">Atendimento</a>
            </li>
          </ul>
        </div>

        <!-- cart icon and login button -->
        <div class="d-none d-lg-flex ms-auto">
          <a href="pages/carrinho.php" class="text-white me-3">
            <i class="bi bi-cart2 fs-4"></i>
          </a>
          <a href="login.php" class="text-dark text-decoration-none px-3 py-1 rounded-4" id="criar_conta">Login</a>
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
                <a class="nav-link" href="pages/sobre_hypertech.html">Sobre HyperTechPC</a>
              </li>
              <li class="nav-item mx-2">
                <a class="nav-link" href="pages/atendimento.html">Atendimento</a>
              </li>
            </ul>

            <!-- cart icon and register button -->
            <div class="d-flex flex-column justify-content-center align-items-center pag-3">
              <a href="pages/carrinho.php" class="text-white text-decoration-none fs-5">
                <i class="bi bi-cart2"></i> Carrinho
              </a><br>
              <a href="login.php" class="text-dark text-decoration-none px-3 py-1 rounded-4 fs-4" id="criar_conta">Login</a>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>

  <main class="container text-white main_login">

   <div class="row row_login">
        <div class="col-md-6 col-sm-12 col_login">

            <h3 class="fs-1">Bem Vindo (a) de Volta!</h3>
            <img src="imagens/outros/pacman_gamer.png" alt="pacman">
            
        </div>
        <div class="col-md-6 col-sm-12  col_login">

            <h3>Faça seu Login:</h3>
            <form action="php/processar_login.php" method="post">
                <input type="email" name="emailLogin" id="emailLogin" placeholder="Email" required><br> 
                <input type="password" name="passLogin" id="passLogin" placeholder="Senha" required><br>
                <button type="submit">Entrar</button>
                <p>Não é cliente? <a href="registro.html">Criar Conta!</a></p>
            </form>
        </div>
   </div>

  </main>

  <!-- all fixed footer content -->
  <footer class="text-center">

    <!-- Social media -->
    <div class="social_icons mt-2">
      <a href="https://www.facebook.com/"><i class="bi bi-facebook text-white "></i></a>
      <a href="https://www.instagram.com/"><i class="bi bi-instagram text-white "></i></a>
      <a href="https://x.com/"><i class="bi bi-twitter text-white "></i></a>
    </div>

    <!-- Links for additional information -->
   <div class="footer_links mt-2 pt-4">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <ul class="list-unstyled">
              <li><a href="pages/politica_troca.html">Política de Troca e Devolução</a></li>
              <li><a href="pages/sobre_hypertech.html">Sobre a HyperTech PC</a></li>
              <li><a href="#">Livro de Reclamações</a></li>
              <li><a href="#">Livro de Elogios</a></li>
            </ul>
          </div>
          <div class="col-md-6">
            <ul class="list-unstyled">
              <li><a href="index.php#pc_gamer">PC Gamer</a></li>
              <li><a href="index.php#workstation">Workstation</a></li>
              <li><a href="index.php#pecas">Peças</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer copy -->
    <div class="footer_copy text-center">
      <p class="mb-0">&copy; 2024 Wilma Santos. Todos os direitos reservados.</p>
    </div>
  </footer>


</body>

</html>