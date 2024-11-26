  <?php
  session_start();

  if (!isset($_SESSION['id_user'])) {
    header("Location:../index.html");
    exit();
  }

  // Pegando as informações da base de dados
  $user_id = $_SESSION['id_user'];
  include('../conexao.php');

  $sql = "SELECT name_user, last_name_user FROM users WHERE id_user = $user_id";
  $result = $mysqli->query($sql);

  if (!$result) {
    die("Erro ao consultar SQL: " . $mysqli->error);
  }

  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $nome = $row['name_user'];
    $apelido = $row['last_name_user'];
  } else {
    echo "Perfil não encontrado.";
  }

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
    <meta name="keyworks" content="hypertechpc, loja online, pc gamer, assistencia tecnica, portugal, peças pc">

    <!-- favicon -->
    <link rel="shortcut icon" href="../imagens/favicon/favicon.ico" type="image/x-icon">

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <!-- css -->
    <link rel="stylesheet" href="../css/style_nav_footer.css">
    <link rel="stylesheet" href="../css/style_header_main.css">

    <!-- javaScript -->
    <script src="../js/script.js"></script>

    <style>
      .form_add_produto {
        max-width: 500px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
      }

      .form_add_produto label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
      }

      .form_add_produto input[type="text"],
      .form_add_produto select,
      .form_add_produto input[type="file"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border-radius: 4px;
      }

      .form_add_produto input[type="submit"] {
        background-color: white ;
        padding: 10px 15px;
        border: none;
        border-radius: 1.5rem;
        cursor: pointer;
        font-size: 16px;
      }

      .form_add_produto input[type="submit"]:hover {
        background-color: #ffcc00;

      }

      .form_add_produto br {
        display: none;
      }
    </style>
  </head>

  <body class="vh-100 overflow-auto">
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container">

        <!-- logo -->
        <a class="navbar-brand" href="../index.php?user_id=<?php echo htmlspecialchars($user_id); ?>">
          <img class="img-fluid" style="max-width: 250px;" src="../imagens/logo/hyperTech_PC.png" alt="logo HypertechPC" title="logo HyperTechPC">
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
          <a href="login.php" class="text-dark text-decoration-none px-3 py-1 rounded-4" id="criar_conta">Login</a>
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
              <a href="login.php" class="text-dark text-decoration-none px-3 py-1 rounded-4 fs-4" id="criar_conta">Login</a>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <!-- main content -->
    <main class="container text-center text-white">
      <h2>Perfil do Administrador</h2>
      <h3 class="mb-3">Olá <?php echo $nome . " " . $apelido; ?></h3>

      <div class="container container_admin">
        <div class="row row_table">
          <div class="col mt-3">

          <img id="img_pac_pag" src="../imagens/outros/pacman2.png" alt="pacman">

            <!-- dados de todos os utilizadores -->
            <h3 class="mb-4">Todos os utilizadores:</h3>
            <div class="d-flex justify-content-center">
              <div>
                <table class="table_padding">
                  <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Apelido</th>
                    <th>Email</th>
                    <th>Ações</th>
                  </tr>
                  <tr>
                    <?php

                    //informações dos utilizadores da base de dados
                    $user_id = $_SESSION['id_user'];
                    $sql = "SELECT id_user, name_user, last_name_user, email_user FROM users";
                    $result = $mysqli->query($sql);

                    if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                        $user_id = $row['id_user'];
                        $nome = $row['name_user'];
                        $apelido = $row['last_name_user'];
                        $email = $row['email_user'];

                        //utilzadores cadastrados

                        echo "<tr>";
                        echo "<td>$user_id</td>";
                        echo "<td>$nome</td>";
                        echo "<td>$apelido</td>";
                        echo "<td>$email</td>";
                        echo "<td>";
                        echo "<a href='editar_uti_admin.php?id=$user_id'>Editar</a> | ";
                        echo "<a href='../php/excluir_uti_admin.php?id=$user_id'>Excluir</a>";
                        echo "</td>";
                        echo "</tr>";
                      }
                    }

                    ?>
                  </tr>
                </table>
              </div>
            </div>

            <h3 class="mt-4">Pedidos:</h3><br>
            <div class="d-flex justify-content-center">
              <div>
                <table class="table_padding">
                  <tr>
                    <th>ID do Pedido</th>
                    <th>ID do Utilizador</th>
                    <th>Nome do Utilizador</th>
                    <th>Morada</th>
                    <th>Produtos</th>
                    <th>Quantidade</th>
                    <th>Preço Total</th>
                    <th>Ações</th>
                  </tr>
                  <?php
                  // Informações dos pedidos da base de dados
                  $user_id = $_SESSION['id_user'];
                  $sql = "SELECT * FROM orders";
                  $result = $mysqli->query($sql);

                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      $id_pedido = $row['id_order'];
                      $id_user_pedido = $row['id_user_fk'];
                      $nome_utilizador = $row['name_user_order'];
                      $morada = $row['adress_user_order'];
                      $produtos = $row['products_order'];
                      $quantidade = $row['quantity_prod_order'];
                      $preco_total = $row['total_price_order'];

                      echo "<tr>";
                      echo "<td>$id_pedido</td>";
                      echo "<td>$id_user_pedido</td>";
                      echo "<td>$nome_utilizador</td>";
                      echo "<td>$morada</td>";
                      echo "<td>$produtos</td>";
                      echo "<td>$quantidade</td>";
                      echo "<td>$preco_total</td>";
                      echo "<td>";
                      echo "<a href='../php/excluir_pedido.php?id=$id_pedido'>Excluir</a>";
                      echo "</td>";
                      echo "</tr>";
                    }
                  } else {
                    echo "<tr><td colspan='7'>Nenhum pedido cadastrado</td></tr>";
                  }
                  ?>
                </table> <br>
              </div>
            </div>
          </div>


          <div class="col mt-3">
            <!-- adicionar produto -->
            <div>
              <h3 class="mt-5">Adicionar Novo Produto:</h3><br>
              <form class="form_add_produto mb-4" method="post" action="../php/proc_add_prod_admin.php" enctype="multipart/form-data">
                <label>Nome do Produto: </label>
                <input type="text" name="nomeProduto" id="nomeProduto"> <br>

                <label>Quantidade em Estoque: </label>
                <input type="text" name="estoqueProduto" id="estoqueProduto"> <br>

                <label>Preço: </label>
                <input type="text" name="precoProduto" id="precoProduto"> <br>

                <label>Categoria: </label>
                <select name="categoriaProduto" id="categoriaProduto">
                  <option value="pc_gamer">Pc Gamer</option>
                  <option value="workstation">Workstation</option>
                  <option value="pecas">Peças</option>
                </select> <br>

                <label>Imagem do Produto:</label>
                <input type="file" name="imagemProduto" id="imagemProduto"><br><br>

                <input id="adicionarProduto" name="adicionarProduto" type="submit" value="Adicionar Produto"> <br><br>
              </form>

            </div>

            <!-- Produtos cadastrados -->
            <h3>Produtos Cadastrados:</h3><br>
            <div class="d-flex justify-content-center">
              <div>
                <table class="table_padding">
                  <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Categoria</th>
                    <th>Ações</th>
                  </tr>
                  <tr>
                    <?php

                    //informações dos produtos da base de dados
                    $user_id = $_SESSION['id_user'];
                    $sql = "SELECT * FROM products";
                    $result = $mysqli->query($sql);

                    if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                        $id_produto = $row['id_product'];
                        $nome_produto = $row['name_product'];
                        $preco = $row['price_product'];
                        $quantidade = $row['quantity_product'];
                        $categoria = $row['category_product'];

                        echo "<tr>";
                        echo "<td>$id_produto</td>";
                        echo "<td>$nome_produto</td>";
                        echo "<td>$preco</td>";
                        echo "<td>$quantidade</td>";
                        echo "<td>$categoria</td>";
                        echo "<td>";
                        echo "<a href='editar_produto_admin.php?id=$id_produto'>Editar</a> | ";
                        echo "<a href='../php/excluir_produto_admin.php?id=$id_produto'>Excluir</a>";
                        echo "</td>";
                        echo "</tr>";
                      }
                    } else {
                      echo "<tr><td colspan = '5'> Nenhuma reunião cadastrada </td></tr>";
                    }
                    $mysqli->close();

                    ?>
                  </tr>
                </table> <br>
              </div>
            </div>
            <a href="../php/logout.php" class="btn btn-danger">Logout</a> <br><br> <!-- Botão de Logout -->
          </div>
        </div>
      </div>
    </main>


  </body>

  </html>