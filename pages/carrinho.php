<?php
session_start();
include '../conexao.php';


// Verifica se o usuário está logado
if (!isset($_SESSION['id_user'])) {
  header("Location: ../login.php");
  exit();
}

// ID do usuário logado
$userId = $_SESSION['id_user'];

// Verificação se a sessão do carrinho já foi inicializada para o usuário logado
if (!isset($_SESSION['carrinho'][$userId])) {
  $_SESSION['carrinho'][$userId] = [];
}

// Verificar se o formulário de esvaziar carrinho foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['esvaziar_carrinho'])) {
    $_SESSION['carrinho'][$userId] = [];
    header("Location: carrinho.php");
    exit();
  }

  if (isset($_POST['produto_id'])) {
    $produtoId = filter_var($_POST['produto_id'], FILTER_VALIDATE_INT);
    if ($produtoId === false) {
      echo "ID de produto inválido!";
      exit();
    }

    // Quantidade selecionada
    $quantidade = filter_var($_POST['quantidade'], FILTER_VALIDATE_INT);
    if ($quantidade === false || $quantidade < 1) {
      $quantidade = 1;
    }

    $comando = $mysqli->prepare("SELECT id_product, name_product, price_product, image_product FROM products WHERE id_product = ?");
    $comando->bind_param("i", $produtoId);
    $comando->execute();
    $result = $comando->get_result();

    if ($result->num_rows > 0) {
      $produto = $result->fetch_assoc();

      if (isset($_SESSION['carrinho'][$userId][$produtoId])) {

        $_SESSION['carrinho'][$userId][$produtoId]['quantidade'] += $quantidade;
      } else {
        $_SESSION['carrinho'][$userId][$produtoId] = [
          'id' => $produto['id_product'],
          'nome' => $produto['name_product'],
          'preco' => $produto['price_product'],
          'imagem' => '../' . $produto['image_product'],
          'quantidade' => $quantidade
        ];
      }
    } else {
      echo "Produto não encontrado!";
      exit();
    }

    $comando->close();
    header("Location: ../index.php?msg=adicionado");
    exit();
  }
}


// Fechar a conexão
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

  <main class="container">
    <div>
      <h1 class="text-center">Carrinho</h1>
      <p class="text-center fs-4 text-white mb-3">
        O carrinho tem <?php echo isset($_SESSION['carrinho'][$userId]) ? array_sum(array_column($_SESSION['carrinho'][$userId], 'quantidade')) : 0; ?> produtos.
      </p>
    </div>
    <div class="text-center mb-2">
      <a href="../php/logout.php" class="btn btn-danger mb-3">Logout</a> <!-- Botão de Logout -->
    </div>

    <div class="row mb-5 row_carrinho">
      <h3 class="text-center mt-3">Itens do carrinho</h3>

      <?php
      $totalCompra = 0;
      if (isset($_SESSION['carrinho'][$userId]) && !empty($_SESSION['carrinho'][$userId])):
      ?>
        <ul class="list-group m-2">
          <?php foreach ($_SESSION['carrinho'][$userId] as $item): ?>
            <?php $totalCompra += $item['preco'] * $item['quantidade']; ?>
            <li class="list-group-item d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <img src="<?php echo $item['imagem']; ?>" class="img-thumbnail me-3" style="width: 60px; height: 60px;">
                <span><strong><?php echo $item['nome']; ?></strong></span>
              </div>
              <div class="d-flex flex-column align-items-end">
                <span><b>€<?php echo number_format($item['preco'], 2, ',', '.'); ?></b></span>
                <span>Quantidade: <?php echo $item['quantidade']; ?></span>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>

        <!-- Exibição do valor total -->
        <div class="text-center mt-5">
          <h4 class="text-white">Total da Compra: €<?php echo number_format($totalCompra, 2, ',', '.'); ?></h4>
        </div>

        <div class="text-center mt-5 mb-5">
          <button class="comeceComprar">
            <a href="../index.php?user_id=<?php echo htmlspecialchars($userId); ?>">Escolher mais itens</a>
          </button>
        </div>

        <!-- Formulário para esvaziar o carrinho -->
        <div class="text-center">
          <form method="POST" action="carrinho.php">
            <button type="submit" name="esvaziar_carrinho" class="btn btn-danger mt-1 mb-4">Esvaziar Carrinho</button>
          </form>
        </div>

        <!-- Botão finalizar compra -->
        <div class="text-center">
          <a href="concluir_compra.php" class="btn btn-success mt-4 mb-5 fs-4">Concluir Compra</a>
        </div>

      <?php else: ?>
        <h4 class="text-center text-white">Seu carrinho está vazio.</h4>
        <div class="text-center">
          <button class="comeceComprar">
            <a href="../index.php?user_id=<?php echo htmlspecialchars($userId); ?>">Comece a Comprar</a>
          </button> <br>
        </div>
      <?php endif; ?>
    </div>
  </main>



</body>

</html>