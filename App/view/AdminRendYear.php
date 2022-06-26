<?php

include_once '../model/Connection.php';
require_once '../controller/categoria.php';
$conn = new Connection;
$catg = new Categoria;
session_start();

if (!isset($_SESSION['nome_admin'])) {
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <script defer src="https://use.fontawesome.com/releases/v6.1.1/js/solid.js" integrity="sha384-KPytPVc+hwHwX9HXl4tA7SWJ0Sob6StzjVRoxC4Q4U0JgXujpuVrkBxR0Hsf8A25" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v6.1.1/js/fontawesome.js" integrity="sha384-9zErGp+biBilRrlpD1l3ExnaqXc8QLITlNpGtb4OL6W1JChl0wwmDNs4U/0UA8L8" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
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
                    <?php echo $_SESSION['nome_admin']; ?> <br>
                    <span class="brand-subname">
                      Administrador
                    </span>

                  </p>
                </div>
          </div>
        </div>

        <div class="sidebar-body">
          <ul class="navegation-list">
            <li class="navegation-list-item ">
              <a href="AdminDash.php" class="navegation-link">
                <div class="row">
                  <div class="col-1">
                    <i class="fas fa-cube"></i>
                  </div>
                  <div class="col">
                    Painel Principal
                  </div>
                </div>

              </a>
            </li>

            <li class="navegation-list-item ">
              <a href="AdminUser.php" class="navegation-link">
                <div class="row">
                  <div class="col-1">
                    <i class="fas fa-user-tie"></i>
                  </div>
                  <div class="col">
                    Utilizadores
                  </div>
                </div>

              </a>
            </li>

            <li class="navegation-list-item nav-color">
              <a href="AdminRendimentos.php" class="navegation-link">
                <div class="row">
                  <div class="col-1">
                  <i class="fa-solid fa-sack-dollar"></i>
                  </div>
                  <div class="col">
                    Rendimentos
                  </div>
                </div>
              </a>
            </li>


            <li class="navegation-list-item">
              <a href="AdminAtividade.php" class="navegation-link">
                <div class="row">
                  <div class="col-1">
                    <i class="fas fa-clipboard-list"></i>
                  </div>
                  <div class="col">
                    Atividades
                  </div>
                </div>
              </a>
            </li>

            <form class="" action="../model/logarSistema.php" method="post">
              <button type="submit" name="logout-admin" class="btn" style="padding:0px; margin:0px; height:50px;">
                <li class="btn-logout">
                  <a href="#" class="navegation-link">
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
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb d-flex align-items-center">
                  <li class="breadcrumb-item active" aria-current="page" style="font-size: 14.4px;">Rendimentos</li>
                    <li class="breadcrumb-item"><a href="AdminRendimentos.php" style="font-size: 14px;">Vendas</a></li>
                </ol>
              </nav>
            </div>
          </div>

          <div class="row mb-3 ms-1">
              <div class="p-1 d-flex justify-content-center">
            <div class="btn-group " role="group" aria-label="Basic example">
              <a href="AdminRendimentos.php" class="btn btn-success">Vendas</a>
              <a href="AdminRendVendaD.php"  class="btn btn-success ">Venda Diarias</a>
              <a class="btn btn-success active">Vendas Anuais</a>
              </div>
          </div>

          <div class="row mb-1 ms-1 mt-2">
              <div class="card card-config p-2">
                <div class="body-card p-2">
                  <div class="table-responsive">
                      <a href=""><button type="button" name="button" class="btn btn-success btn-sm btn-plus ms-2 ">Gerar Relatório</button></a>
                    <table class="table table-borderless" id="table_funcionario">
                      <thead>
                        <th>Utilizador</th>
                        <th>Total de Venda</th>
                        <th>Desconto</th>
                        <th>Nome do Cliente</th>
                        <th>Tipo de Pagamento</th>
                        <th>Pagamento do Cliente</th>
                        <th>Troco de Venda</th>
                        <th>Data da Venda</th>
                      </thead>
                      <?php

                      $cmd = $conn->pdo->query("SELECT venda_user, venda_total, venda_desconto, nome_cliente, pagamento,pagamento_cliente, venda_troco, venda_data from vendas inner join tipopag on vendas.tipo_pagamento = tipopag.id_pag where year(venda_data) ORDER BY id_venda DESC;");

                        while ($res = $cmd->fetch(PDO::FETCH_OBJ)) {

                          ?>
                          <tbody>
                            <tr>
                              <td><?php echo $res->venda_user; ?></td>
                              <td><?php echo $res->venda_total; ?></td>
                              <td><?php echo $res->venda_desconto; ?></td>
                              <td><?php echo $res->nome_cliente; ?></td>
                              <td><?php echo $res->pagamento; ?></td>
                              <td><?php echo $res->pagamento_cliente; ?></td>
                              <td><?php echo $res->venda_troco; ?></td>
                              <td><?php echo $res->venda_data; ?></td>
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



        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

     <?php

     if (isset($_SESSION['up_success'])) {
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
             title: "Atualizado com Sucesso",
           });
       });
       </script>
       ';
        unset($_SESSION['up_success']);
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



    <script>
        $(document).ready(function() {
        $('#table_funcionario').DataTable({


          "language":{
        "decimal":        "",
        "emptyTable":     "Não a dados na tabela",
        "info":           "Mostrando _START_ a _END_ de _TOTAL_ ",
        "infoEmpty":      "Nenhum registro disponível",
        "infoFiltered":   "(Filtrado de _MAX_ entradas totais)",
        "infoPostFix":    "",
        "thousands":      ",",
        "lengthMenu":     "Mostrar _MENU_ ",
        "loadingRecords": "Carregando...",
        "processing":     "Processando...",
        "search":         "Procurar:",
        "zeroRecords":    "Nenhum registro correspondente encontrado",
        "paginate": {
            "first":      "Primeiro",
            "last":       "Ultimo",
            "next":       "Próximo",
            "previous":   "Anterior"
        },
        "aria": {
            "sortAscending":  ": ative para classificar a coluna em ordem crescente",
            "sortDescending": ": ativar para ordenar a coluna decrescente"
        }
    }

            });


    } );

    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
