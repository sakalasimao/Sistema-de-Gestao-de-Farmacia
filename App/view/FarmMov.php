<?php

include_once '../model/Connection.php';
$conn = new Connection;
session_start();

if (!isset($_SESSION['nome_farmaceutico'])) {
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
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="shortcut icon" href="images/logo-green.svg" type="image/x-icon">
     <link rel="stylesheet" href="../../Library/boostrap5/bootstrap.min.css">
     <link rel="stylesheet" href="../../Library/fontawesome/fontawesome-free-6.1.1-web/css/all.min.css">
     <link rel="stylesheet" href="../../Library/fontawesome/fontawesome-free-5.15.4-web/css/all.min.css">
      <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/GerFuncRead.css">
    <title>S. Farmacia</title>
  </head>
  <body>

    <div class="page">

    <div class="sidebar">
        <div class="sidebar-header">
          <div class="sidebar-logo-container"  data-bs-toggle="modal" data-bs-target="#exampleModalToggle" title="Visualizar Perfil"> <!--PERFIL-->
            <div class="logo-container">
              <img src="images/logo-green.svg" alt="logo" class="logo-sidebar">
            </div>
                <div class="brand-name-container" >
                  <p class="brand-name">
                    <?php echo $_SESSION['nome_farmaceutico']; ?> <br>
                    <span class="brand-subname">
                      Farmacêutico
                    </span>

                  </p>
                </div>
          </div>
        </div>

        <div class="sidebar-body">
          <ul class="navegation-list">
            <li class="navegation-list-item ">
              <a href="FarmVenda.php" class="navegation-link active">
                <div class="row">
                  <div class="col-1">
                    <i class="fa-solid fa-box"></i>
                  </div>
                  <div class="col">
                    Caixa
                  </div>
                </div>

              </a>
            </li>

          

            <li class="navegation-list-item">
              <a href="FarmProd.php" class="navegation-link">
                <div class="row">
                  <div class="col-1">
                  <i class="fa-solid fa-receipt"></i>
                  </div>
                  <div class="col">
                    Produtos
                  </div>
                </div>
              </a>
            </li>

            <li class="navegation-list-item nav-color">
              <a href="FarmMov.php" class="navegation-link">
                <div class="row">
                  <div class="col-1 me-2">
                  <i class="fa-solid fa-coins"></i>
                  </div>
                  <div class="col">
                    Movimentos
                  </div>
                </div>
              </a>
            </li>

            <form class="" action="../model/logarSistema.php" method="post">
              <button type="submit" name="logout-farm" class="btn" style="padding:0px; margin:0px; height:50px;">
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
            <nav  style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb d-flex align-items-center">
                  <li class="breadcrumb-item active" aria-current="page"><a class="ind ind-now">Movimentos</a></li>
                </ol>
              </nav>
            </div>
          </div>

          <div class="card p-2  card-config mt-2 mb-2">
            <div class="body-card p-1">
                  
                    <div class="row mt-2"> <!---ARÉA DE PESQUISA E RELATÓRIOS-->
                    

                  <div class="col">
                    <form  method="POST">
                      <div class="input-group mb-3">
                        
                          <input type="text" class="input-style" size="50" name="pesq_prod" placeholder="Pesquisar..." title="Pequisar por ID, Total, Desconto, Tipo Pag, Cliente ">
                          <button class="input-group-text" id="basic-addon2" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                          <span class="input-group-text "><a href="?remove" style="color:#000" title="Remover Pesquisa"><i class="fa-solid fa-xmark"></i></a></span>
                          
                        </div>
                        </form>
                    </div>


                </div>  
            </div>

          </div>

          <div class="row mb-1 ms-1 mt-2 mx-auto">
            
                  <div class="table-responsive">
                    <table class="content-table table shadow-sm" >
                  
                  
                      <thead>
                        <th>ID</th>
                        <th>Operador</th>
                        <th>Total</th>
                        <th>Desconto</th>
                        <th>Tipo de Pagamento</th>
                        <th>Cliente</th>
                        <th>Troco</th>
                        <th>Itens</th>
                      </thead>

                      <?php 
                    
                    if(isset($_POST['pesq_prod'])){

                      $pesq = $_POST['pesq_prod']; 

                      if(empty($pesq)){

                      }
                      

                        //var_dump($pesq);
                        $cmd = $conn->pdo->prepare("SELECT id_venda, nome, vendaTotal, vendaDesconto, vendaCliente, pagamento , vendaTroco, vendaData FROM vendas v JOIN usuarios s 
                        ON v.fk_usuario_venda = s.id_usuario JOIN tipopag t ON v.fk_tipopag_venda = t.id_pag
                         WHERE 
                        id_venda = :id OR vendaTotal = :vt OR 
                        vendaDesconto = :vd OR pagamento LIKE '%$pesq%' OR vendaCliente = :vc  OR vendaTroco = :vr");
                      $cmd->bindValue(':id', $pesq);
                      $cmd->bindValue(':vt', $pesq);
                      $cmd->bindValue(':vd', $pesq);
                      $cmd->bindValue(':vr', $pesq);
                      $cmd->bindValue(':vc', $pesq);
                      $cmd->execute();

                        while ($res = $cmd->fetch(PDO::FETCH_OBJ)) {

                          ?>
                           <tbody>
                            <tr style="color: #1363DF;">
                              <td><?php echo $res->id_venda; ?></td>
                              <td><?php echo $res->nome; ?></td>
                              <td><?php echo $res->vendaTotal; ?></td>
                              <td><?php echo $res->vendaDesconto; ?></td>
                              <td><?php echo $res->pagamento; ?></td>
                              <td><?php echo $res->vendaCliente; ?></td>
                              <td><?php echo $res->vendaTroco; ?></td>
                              <td>
                                <a href= "FarmMov_itens.php?itens=<?php echo $res->id_venda;?>" class="btn btn-sm btn-success it" >Itens</a>
                            </td>
                            </tr>
                          </tbody>


                          <?php
                        }


                      



                    }elseif(isset($_GET['remove']) or !isset($_GET['remove'])){

                    


                      $cmd = $conn->pdo->query("SELECT id_venda, nome, vendaTotal, vendaDesconto, vendaCliente, pagamento , vendaTroco, vendaData FROM vendas v JOIN usuarios s 
                      ON v.fk_usuario_venda = s.id_usuario JOIN tipopag t ON v.fk_tipopag_venda = t.id_pag order by id_venda desc");

                        while ($res = $cmd->fetch(PDO::FETCH_OBJ)) {

                          ?>
                          <tbody>
                            <tr>
                              <td><?php echo $res->id_venda; ?></td>
                              <td><?php echo $res->nome; ?></td>
                              <td><?php echo $res->vendaTotal; ?></td>
                              <td><?php echo $res->vendaDesconto; ?></td>
                              <td><?php echo $res->vendaCliente; ?></td>
                              <td><?php echo $res->pagamento; ?></td>
                              <td><?php echo $res->vendaTroco; ?></td>
                              <td>
                                <a href= "FarmMov_itens.php?itens=<?php echo $res->id_venda;?>" class="btn btn-sm btn-success it" >Itens</a>
                            </td>
                            </tr>
                          </tbody>


                          <?php
                        }


                    }
                    
                    ?>


                  
                     
                    </table>
                  </div>
             
          </div>



    </div>



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

<?php include 'php_include/model_perfil_farm.php';?>
<script src="../../Library/boostrap5/bootstrap.bundle.min.js"></script>
  </body>
</html>
