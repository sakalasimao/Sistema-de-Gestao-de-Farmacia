<?php
include_once '../controller/Carrinho.php';
require_once '../controller/funcionario.php';
$conn = new Connection;
$func = new Funcionario;

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
            <li class="navegation-list-item ">
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

            <li class="navegation-list-item nav-color">
              <a href="#" class="navegation-link">
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
                    <li class="breadcrumb-item"><a href="GerVendas.php"  class="ind">Vendas</a></li>
                  <li class="breadcrumb-item active" aria-current="page"><a class="ind ind-now">Itens de Venda</a></li>
                </ol>
              </nav>
            </div>
          </div>

          <div class="row">
          <div class="col">
          <a href="GerVendas.php" class="btn btn-success ms-4 ">Voltar</a>
          </div>
        </div>

<!--AQUI-->
          <div class="row mb-1 ms-1 mt-2">
             
                  <div class="table-responsive">

                      
                    <table class="content-table table shadow-sm mt-2">
                    <thead>
                        <th>ID</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Total</th>
                      </thead>

                      <?php 
                    
                      $cmd = $conn->pdo->prepare("SELECT fk_vendas_itens, nomeProduto, qtdVendaItens, subtotalVendaItens FROM itens_venda i JOIN produtos p ON i.fk_produtos_itens = p.id_produto 
                      where fk_vendas_itens = :id_venda");
                      $cmd->bindValue(":id_venda", @$_GET['itens']);
                      $cmd->execute();

                        while ($res = $cmd->fetch(PDO::FETCH_OBJ)) {

                          ?>
                          <tbody>
                            <tr>
                              <td><?php echo $res->fk_vendas_itens; ?></td>
                              <td><?php echo $res->nomeProduto; ?></td>
                              <td><?php echo $res->qtdVendaItens; ?></td>
                              <td><?php echo $res->subtotalVendaItens; ?></td>
                              
                            </tr>
                          </tbody>


                          <?php
                        }


                    
                    
                    ?>


                  

                    </table>

                  </div>
            
          </div>



        </div>
    </div>

   
    <script src="js/jquery.js"></script>
    <script src="../../Library/sweetalert/sweetalert2.js"></script>

    <?php

    if (isset($_SESSION['sucesso_cadastro'])) {
      echo '
      <script type="text/javascript">
      $(document).ready(function(){
        var toastMixin = Swal.mixin({
            toast: true,
            icon: "success",
            title: "General Title",
            animation: false,
            position: "top-right",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener("mouseenter", Swal.stopTimer)
              toast.addEventListener("mouseleave", Swal.resumeTimer)
            }
          });

          toastMixin.fire({
            animation: true,
            title: "Cadastrado com Sucesso",
          });
      });
      </script>
      ';
       unset($_SESSION['sucesso_cadastro']);
    }

     ?>

  <script>
  // SWEET ALERT DELETE
     $('.btn_sweet_del').on('click', function(e) {
       e.preventDefault();
       const href = $(this).attr('href');

       Swal.fire({
       title: 'Você tem certeza ?',
       text: 'Você não será capaz de reverter isso!',
       icon: 'warning',
       showCancelButton: true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       confirmButtonText: 'Sim, deletar isso!'
     }).then((result) => {
         if (result.value) {
           document.location.href = href;
           var toastMixin = Swal.mixin({
               toast: true,
               icon: "success",
               title: "General Title",
               animation: false,
               position: "top-right",
               showConfirmButton: false,
               timer: 3000,
               timerProgressBar: true,
               didOpen: (toast) => {
                 toast.addEventListener("mouseenter", Swal.stopTimer)
                 toast.addEventListener("mouseleave", Swal.resumeTimer)
               }
             });

             toastMixin.fire({
               animation: true,
               title: "Deletado com Sucesso",
             });
         }
     })

     })
   </script>

<script src="../../Library/boostrap5/bootstrap.bundle.min.js"></script>
  </body>
</html>
