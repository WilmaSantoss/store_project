<?php
session_start();
include('conexao.php');


$user_id = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null;
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

  <style>
    .toast {
      opacity: 0;
      transition: opacity 0.5s ease-in-out, visibility 0s linear 0.5s;
      visibility: hidden;
      z-index: 10;
    }

    .toast.show {
      opacity: 1;
      visibility: visible;
      transition: opacity 0.5s ease-in-out;
    }

    .toast-container {
      position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 10;
    }
  </style>


  <!-- javaScript -->
  <script src="js/script.js"></script>

  <!-- mensagem -->
  <script>
    window.onload = function() {
      // Verifica se há uma mensagem de toast para ser exibida
      var toast = document.getElementById('toast');
      if (toast) {
        // Exibe o toast por 5 segundos
        setTimeout(function() {
          toast.classList.remove('show');
        }, 5000);
      }

      // Armazena a posição de rolagem antes de recarregar a página
      window.onbeforeunload = function() {
        localStorage.setItem('scrollPosition', window.scrollY);
      };

      // Retorna à posição de rolagem armazenada após o carregamento da página
      if (localStorage.getItem('scrollPosition') !== null) {
        window.scrollTo(0, localStorage.getItem('scrollPosition'));
        localStorage.removeItem('scrollPosition'); // Remove após o uso
      }
    };
  </script>


</head>

<body class="vh-100 overflow-auto">

  <?php
  /* msg adicionado */

  if (isset($_GET['msg']) && $_GET['msg'] == 'adicionado') {
    echo '<div class="toast-container">
          <div id="toast" class="toast show bg-success text-white p-3 rounded-3" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
              <strong class="me-auto">Adicionado!</strong>
              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
              Produto adicionado ao carrinho com sucesso!
            </div>
          </div>
        </div>';
  }

  ?>

  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">

      <!-- logo -->
      <a class="navbar-brand" href="index.php">
        <img class="img-fluid" style="max-width: 250px;" src="imagens/logo/hyperTech_PC.png" alt="logo HypertechPC" title="logo HyperTechPC">
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
        <?php if ($user_id): ?>
          <a href="login.php" class="text-dark text-decoration-none px-3 py-1 rounded-4" id="criar_conta">
            <?php
            echo "Conta";
            ?>
          </a>
        <?php else: ?>
          <a href="login.php" class="text-dark text-decoration-none px-3 py-1 rounded-4" id="criar_conta1">Login</a>
        <?php endif; ?>
      </div>

      <!-- sidebar for mobile  -->
      <div class="offcanvas offcanvas-end d-lg-none" tabindex="-1" id="offcanvasNavbar"
        aria-labelledby="offcanvasNavbarLabel">

        <!-- sidebar header -->
        <div class="offcanvas-header text-white border-bottom">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">HypertechPC</h5>
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
            <?php if ($user_id): ?>
              <a href="login.php" class="text-dark text-decoration-none px-3 py-1 rounded-4" id="criar_conta">
                <?php
                echo "Conta";
                ?>
              </a>
            <?php else: ?>
              <a href="login.php" class="text-dark text-decoration-none px-3 py-1 rounded-4" id="criar_conta1">Login</a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <!-- carousel with slides of promotions and news -->

  <header class="container">
    <div id="carouselMain" class="carousel carousel-light slide" data-bs-ride="carousel">
      <ol class="carousel-indicators">
        <li data-bs-target="#carouselMain" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#carouselMain" data-bs-slide-to="1"></li>
        <li data-bs-target="#carouselMain" data-bs-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active text-center" data-bs-interval="4000">
          <img src="imagens/slides/desktop.png" alt="Slide promoção" class="img-fluid d-none d-md-block">
          <img src="imagens/slides/mobile.png" alt="Slide promoção" class="img-fluid d-block d-md-none">
        </div>
        <div class="carousel-item text-center" data-bs-interval="4000">
          <img src="imagens/slides/desktop.png" alt="Slide promoção" class="img-fluid d-none d-md-block">
          <img src="imagens/slides/mobile.png" alt="Slide promoção" class="img-fluid d-block d-md-none">
        </div>
        <div class="carousel-item text-center" data-bs-interval="4000">
          <img src="imagens/slides/desktop.png" alt="Slide promoção" class="img-fluid d-none d-md-block">
          <img src="imagens/slides/mobile.png" alt="Slide promoção" class="img-fluid d-block d-md-none">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselMain" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
        <span class="visually-hidden">Voltar</span>
      </a>
      <a class="carousel-control-next" href="#carouselMain" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
        <span class="visually-hidden">Próximo</span>
      </a>
    </div>
    <hr class="mt-3 text-white">

    <!-- links em circulos para as categorias -->

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-4 img_container">
          <a href="#pc_gamer">
            <img src="imagens/links_header/pcgamer.png" alt="Pc Gamer" title="Pc Gamer">
          </a>
          <p>PC GAMER</p>
        </div>
        <div class="col-4 img_container">
          <a href="#workstation">
            <img src="imagens/links_header/pcworkstation.avif" alt="Workstation" title="Workstation">
          </a>
          <p>WORKSTATION</p>
        </div>
        <div class="col-4 img_container">
          <a href="#pecas">
            <img src="imagens/links_header/peças.png" alt="Peças de PC" title="Peças de PC">
          </a>
          <p>PEÇAS</p>
        </div>
      </div>
    </div>

  </header>

  <!-- main content -->
  <main class="container text-center">

    <!-- PC GAMER -->
    <section>
      <h1><img class="pacman_blue" src="imagens/outros/pacmanblue.png" alt="pacman blue" id="pc_gamer">Pc Gamer</h1>
      <p class="text-center fs-3 text-white mb-5">Venham conhecer a nossa especialidade!</p>

      <div class="row">
        <?php
        // Categoria filtrada
        $categoriaFiltrada = "pc_gamer";

        // Consulta da categoria específica
        $sql = "SELECT id_product, name_product, price_product, quantity_product, image_product 
                FROM products 
                WHERE category_product = ?";

        $comando = $mysqli->prepare($sql);
        $comando->bind_param("s", $categoriaFiltrada);
        $comando->execute();
        $result = $comando->get_result();

        if ($result->num_rows > 0) {
          // Loop que exibe cada um
          while ($row = $result->fetch_assoc()) {
            $nomeProduto = $row["name_product"];
            $valor = number_format($row["price_product"], 2, ',', '.');
            $quantidade = $row["quantity_product"];
            $imagem = $row["image_product"];

            echo '
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6 d-flex align-items-stretch card_margin">
                        <div class="card text-center bg-light">
                            <a href="" class="position-absolute top-0 end-0 p-2 text-danger">
                                <i class="bi bi-suit-heart heart"></i>
                            </a>
                            <img src="' . $imagem . '" class="card-img-top" alt="Produto">
                            <div class="card-header">
                                <h4 class="card-title">' . $nomeProduto . '</h4>
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda aut.
                                </p>
                                <p><b>€' . $valor . '</b></p>
                            </div>
                            <div class="card-footer">
                                <form class="d-block" action="pages/carrinho.php" method="POST">
                                    <input type="hidden" name="produto_id" value="' . $row['id_product'] . '">
                                    
                                    <label for="quantidade_' . $row['id_product'] . '">Quantidade:</label>
                                    <input type="number" id="quantidade_' . $row['id_product'] . '" name="quantidade" min="1" max="' . $quantidade . '" value="1" class="form-control mb-2">

                                    <button type="submit" class="btn btn-dark">
                                        Adicionar ao Carrinho
                                    </button>
                                </form>
                                <small class="' . ($quantidade > 0 ? 'text-success' : 'text-danger') . '">' . ($quantidade > 0 ? $quantidade . ' em estoque' : 'Sem estoque') . '</small>
                            </div>
                        </div>
                    </div>';
          }
        } else {
          echo "Nenhum produto encontrado para a categoria " . $categoriaFiltrada;
        }
        ?>
      </div>
    </section>


    <!-- WORKSTATION -->
    <section>

      <h1><img class="pacman_blue" src="imagens/outros/pacmanblue.png" alt="pacman blue" id="workstation">Workstation</h1>
      <p class="text-center fs-3 text-white mb-5">Seu escritório a sua maneira!</p>

      <div class="row">
        <?php

        // Categoria filtrada
        $categoriaFiltrada = "workstation";

        // Consulta da categoria específica
        $sql = "SELECT id_product, name_product, price_product, quantity_product, image_product 
            FROM products 
            WHERE category_product = ?";

        $comando = $mysqli->prepare($sql);
        $comando->bind_param("s", $categoriaFiltrada);
        $comando->execute();
        $result = $comando->get_result();

        if ($result->num_rows > 0) {
          // Loop que exibe cada um
          while ($row = $result->fetch_assoc()) {
            $nomeProduto = $row["name_product"];
            $valor = number_format($row["price_product"], 2, ',', '.');
            $quantidade = $row["quantity_product"];
            $imagem = $row["image_product"];

            echo '
            <div class="col-lg-3 col-md-4 col-sm-6 col-6 d-flex align-items-stretch card_margin">
              <div class="card text-center bg-light">
                <a href="" class="position-absolute top-0 end-0 p-2 text-danger">
                  <i class="bi bi-suit-heart heart"></i>
                </a>
                <img src="' . $imagem . '" class="card-img-top" alt="Produto">
                <div class="card-header">
                  <h4 class="card-title">' . $nomeProduto . '</h4>
                </div>
                <div class="card-body">
                  <p class="card-text">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda aut.
                  </p>
                  <p><b>€' . $valor . '</b></p>
                </div>
                <div class="card-footer">
                  <form class="d-block" action="pages/carrinho.php" method="POST">
                    <input type="hidden" name="produto_id" value="' . $row['id_product'] . '">

                     <label for="quantidade_' . $row['id_product'] . '">Quantidade:</label>
                     <input type="number" id="quantidade_' . $row['id_product'] . '" name="quantidade" min="1"    max="' . $quantidade . '" value="1" class="form-control mb-2">

                    <button type="submit" class="btn btn-dark">
                      Adicionar ao Carrinho
                    </button>
                  </form>

                  <small class="' . ($quantidade > 0 ? 'text-success' : 'text-danger') . '">' . ($quantidade > 0 ? $quantidade . ' em estoque' : 'Sem estoque') . '</small>

                </div>
              </div>
            </div>';
          }
        } else {
          echo "Nenhum produto encontrado para a categoria " . $categoriaFiltrada;
        }
        ?>
      </div>

    </section>

    <!-- PEÇAS -->
    <section>

      <h1><img class="pacman_blue" src="imagens/outros/pacmanblue.png" alt="pacman blue" id="pecas">Peças</h1>
      <p class="text-center fs-3 text-white mb-5">Todos os detalhes necessários!</p>

      <div class="row">
        <?php

        // Categoria filtrada
        $categoriaFiltrada = "pecas";

        // Consulta da categoria específica
        $sql = "SELECT id_product, name_product, price_product, quantity_product, image_product 
            FROM products 
            WHERE category_product = ?";

        $comando = $mysqli->prepare($sql);
        $comando->bind_param("s", $categoriaFiltrada);
        $comando->execute();
        $result = $comando->get_result();

        if ($result->num_rows > 0) {
          // Loop que exibe cada um
          while ($row = $result->fetch_assoc()) {
            $nomeProduto = $row["name_product"];
            $valor = number_format($row["price_product"], 2, ',', '.');
            $quantidade = $row["quantity_product"];
            $imagem = $row["image_product"];

            echo '
            <div class="col-lg-3 col-md-4 col-sm-6 col-6 d-flex align-items-stretch card_margin">
              <div class="card text-center bg-light">
                <a href="" class="position-absolute top-0 end-0 p-2 text-danger">
                  <i class="bi bi-suit-heart heart"></i>
                </a>
                <img src="' . $imagem . '" class="card-img-top" alt="Produto">
                <div class="card-header">
                  <h4 class="card-title">' . $nomeProduto . '</h4>
                </div>
                <div class="card-body">
                  <p class="card-text">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda aut.
                  </p>
                  <p><b>€' . $valor . '</b></p>
                </div>
                <div class="card-footer">
                  <form class="d-block" action="pages/carrinho.php" method="POST">
                    <input type="hidden" name="produto_id" value="' . $row['id_product'] . '">

                    <label for="quantidade_' . $row['id_product'] . '">Quantidade:</label>
                     <input type="number" id="quantidade_' . $row['id_product'] . '" name="quantidade" min="1"    max="' . $quantidade . '" value="1" class="form-control mb-2">


                     
                    <button type="submit" class="btn btn-dark">
                      Adicionar ao Carrinho
                    </button>
                  </form>

                  <small class="' . ($quantidade > 0 ? 'text-success' : 'text-danger') . '">' . ($quantidade > 0 ? $quantidade . ' em estoque' : 'Sem estoque') . '</small>

                </div>
              </div>
            </div>';
          }
        } else {
          echo "Nenhum produto encontrado para a categoria " . $categoriaFiltrada;
        }
        ?>
      </div>

    </section>

    <?php
    $mysqli->close();
    ?>
    <section>

      <div class="container text-center">

        <!-- entrega  -->
        <div class="row mt-3">
          <div class="col-md-6 col-sm-12">

            <h2>Entregas</h2>

            <img src="imagens/outros/logo_ctt.jpg" id="ctt_img" alt="ctt">
            <p class="text-white fs-4 mt-3">Entrega em até 1 dia útil em toda Portugal continental.</p>
          </div>

          <!-- pagamento -->
          <div class="col-md-6 col-12">

            <h2>Pagamentos</h2>

            <img src="imagens/outros/metodos_de_pagamento.png " id="pay_img" alt="metodos de pagamento">
          </div>

        </div>
      </div>
    </section>

    <section class="text-white faq">
      <h1>FAQ</h1>

      <div>
        <h3>Como saber se um artigo que quero comprar está em stock?</h3>
        <p>
          O nosso website é atualizado de forma automática e em tempo real com a informação de stock de todos os artigos. Pode consultar esta informação abaixo de cada artigo onde mostra "em estoque".

          Caso não haja estoque de um produto que pretende irá aparecer "sem estoque". Para mais informações de quando irá voltar para estoque, pode nos enviar um email no: hypertechpc@atendimento.com. Respondemos em ate 48 horas.</p>
      </div>

      <div>
        <h3>Com quanto tempo consigo receber minha encomenda?</h3>
        <p>Trabalhamos com entregas via CTT Express, dessa forma o prazo de entrega em toda Portugal Continental é de até 1 dia útil.</p>
      </div>

      <div>
        <h3>O que posso fazer se meu produto chegar errado ou danificado?</h3>
        <p>Temos todo suporte e politicas de devolução e troca. Entre na pagina "Política de Troca e Devolução" no rodapé da pagina e veja o que pode ser feito.</p>
      </div>
    </section>
  </main>

  <!-- all fixed footer content -->
  <footer class="text-center">
    <!-- Support button -->
    <div class="mt-2 ">
      <button id="button_bottom" class="px-3 py-1  border-0"><a title="atendimento ao cliente" href="pages/atendimento.html">Atendimento Personalizado</a></button>
    </div>



    <!-- Social media -->
    <div class="social_icons mt-2">
      <a href="https://www.facebook.com/" target="_blank"><i class="bi bi-facebook text-white "></i></a>
      <a href="https://www.instagram.com/" target="_blank"><i class="bi bi-instagram text-white "></i></a>
      <a href="https://x.com/" target="_blank"><i class="bi bi-twitter text-white "></i></a>
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
              <li><a href="#pc_gamer">PC Gamer</a></li>
              <li><a href="#workstation">Workstation</a></li>
              <li><a href="#pecas">Peças</a></li>
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

  <script>
    setTimeout(function() {
      let alert = document.querySelector('.alert');
      if (alert) {
        alert.style.transition = "opacity 0.5s";
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 500);
      }
    }, 3000);
  </script>


</body>

</html>