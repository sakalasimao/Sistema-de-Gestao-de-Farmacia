<?php
require_once '../controller/categoria.php';
$catg = new Categoria;
session_start();

if (!isset($_SESSION['nome_gerente'])) {
  echo "<script>window.location.href='../../index.php';</script>";
  exit;
}
?>
<!doctype html>
<html lang="pt-pt">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="shortcut icon" href="images/logo-green.svg" type="image/x-icon">
     <link rel="stylesheet" href="../../Library/boostrap5/bootstrap.min.css">
     <link rel="stylesheet" href="../../Library/fontawesome/fontawesome-free-6.1.1-web/css/all.min.css">
     <link rel="stylesheet" href="../../Library/fontawesome/fontawesome-free-5.15.4-web/css/all.min.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/GerFuncRead.css">
    <title>S. Farmacia</title>
  </head>
  <body>

    <div class="page">

      <div class="sidebar">
        <div class="sidebar-header">
          <div class="sidebar-logo-container">
            <div class="logo-container">
              <img src="images/logo-green.svg" alt="logo" class="logo-sidebar">
            </div>
                <div class="brand-name-container" >
                  <p class="brand-name">
                    <?php echo $_SESSION['nome_gerente']; ?> <br>
                    <span class="brand-subname">
                      Gerente
                    </span>

                  </p>
                </div>
          </div>
        </div>

        <div class="sidebar-body">
          <ul class="navegation-list">
            <li class="navegation-list-item nav-color">
              <a href="GerFuncRead.php" class="navegation-link">
                <div class="row">
                  <div class="col-1">
                    <i class="fas fa-book "></i>
                  </div>
                  <div class="col">
                    Cadastros
                  </div>
                </div>

              </a>
            </li>

            <li class="navegation-list-item">
              <a href="GerVendas.php" class="navegation-link">
                <div class="row">
                  <div class="col-1">
                    <i class="far fa-chart-bar"></i>
                  </div>
                  <div class="col">
                    Vendas
                  </div>
                </div>

              </a>
            </li>

            <li class="navegation-list-item">
              <a href="GerEstoque.php" class="navegation-link">
                <div class="row">
                  <div class="col-1">
                    <i class="fas fa-archive"></i>
                  </div>
                  <div class="col">
                    Estoque
                  </div>
                </div>
              </a>
            </li>

            <form action="../model/logarSistema.php" method="post">
              <button type="submit" name="logout-gerent" class="btn " style="padding:0px; margin:0px; height:50px;">
                <li class="btn-logout">
                  <a href="#" class="navegation-link ">
                    <div class="row d-flex align-items-center ">
                      <div class="col-1">
                        <i class="fa-solid fa-arrow-left"></i>
                      </div>
                      <div class="col">
                      Sair
                      </div>
                    </div>
                  </a>
                </li>
                </button>
              </form>

          </ul>

        </div>

      </div>

      <div class="content">
        <div class="container mt-3">
          <div class="row mb-1 ms-1">
            <div class="col">
              <nav  style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb d-flex align-items-center">
                    <li class="breadcrumb-item"><a href="GerFuncRead.php"  class="ind">Cadastros</a></li>
                    <li class="breadcrumb-item"><a href="GerCatgRead.php"  class="ind">Categoria</a></li>
                  <li class="breadcrumb-item active" aria-current="page"><a class="ind ind-now">Cadastrar</a></li>
                </ol>
              </nav>
            </div>
          </div>

      <div class="row mb-4 ms-1 d-flex align-itens-center mt-5">

      <div class="col mt-5"> <!---CADASTRO--->
        <form  action="../model/AcessarCategoria.php" method="POST">
            <div class="card  p-2" style="border-radius: 8px;">
                <div class="body-card p-3">

                      <div class="row px-2 mb-2 d-flex align-itens-center">

                        <div class="col">
                           <label for="" style="margin-left: -10px; font-weight: 500; font-size: 15px; display:block;">Nome da Categoria</label>
                           <input type="text" class="input-style form-control-sm  me-1"  style="width: 300px; margin-left: -10px;" name="nome_catg" placeholder="Cápsulas" id=""  required>
                        </div>

                          <div class="col mt-4">
                              <button type="submit" name="'btn_cadastrar_catg" class="btn btn-success btn-sm me-2">Cadastrar</button>
                              <a href="GerCatgRead.php" class=" btn btn-danger btn-sm" >Cancelar</a>
                          </div>
                          <span class="mb-4"></span>

                          </div>

                         

                        
                </div>
            </div>
          </form>

      </div>

            <div class="col-4"> <!---IMG CADASTRO--->
            <img src="images/catg_prod.png" alt="cadastro" class="img_config" >
            </div>
        


        </div>
          
    </div>


    <script src="../../Library/boostrap5/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="../../Library/sweetalert/sweetalert2.js"></script>
  </body>
</html>
