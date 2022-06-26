<?php
ob_start();
session_start();
require_once '../model/Connection.php';
require_once '../controller/dash.php';
require_once '../controller/vendas.php';
$conn = new Connection;
$user = new Dash;
$sales = new Vendas;


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
    <link rel="stylesheet" href="../../Library/boostrap5/bootstrap.min.css">
     <link rel="stylesheet" href="../../Library/fontawesome/fontawesome-free-6.1.1-web/css/all.min.css">
     <link rel="stylesheet" href="../../Library/fontawesome/fontawesome-free-5.15.4-web/css/all.min.css">
    <script src="../../Library/chart/chart.min.js"></script>
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/AdminDash.css">
    <title>S. Farmacia</title>
  </head>
  <body>

    <div class="page">

      <div class="sidebar">
        <div class="sidebar-header">
          <div class="sidebar-logo-container"  data-bs-toggle="modal" data-bs-target="#exampleModalToggle" title="Visualizar Perfil">
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
            <li class="navegation-list-item nav-color">
              <a href="#" class="navegation-link">
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

            <li class="navegation-list-item">
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

            <li class="navegation-list-item">
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
          <div class="row mb-1 ms-1 ">


            <div class="col">
              <div class="card p-2 card-config-welcome">
                <div class="body-card p-4">
                  <span class=" h5 text-white">
                    <?php

                   echo ' Bem Vindo(a), ';
                     ?>
                  </span><span style="font-size:18px;"><?php echo '<strong>'.$_SESSION['nome_admin'].'</strong>'; ?></span>
                <h6 class="text-white mt-3 ms_b ">Veja o que está acontecendo com sua farmácia hoje</h6>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="card p-2 card-config">
                <div class="body-card p-3">
                  <div class="row" style="margin:auto;">
                    <?php
                    $user->contarUsuarios();
                    $user->contarFuncionario();
                    ?>
                    <div class="col p-2">
                      <h6>Utilizadores</h6>
                      <span class="h2 text-success"><?php if (isset($_SESSION['quant_user'])) {echo $_SESSION['quant_user'];} ?></span>
                    </div>
                    <div class="col p-2">
                      <h6>Funcionarios</h6>
                      <span class="h2 text-success"><?php if (isset($_SESSION['quant_func'])) {echo $_SESSION['quant_func'];} ?></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

<?php
$user->FaturamentoTotal();

 ?>
          <div class="row mb-1">

            <div class="col ">
              <div class="card p-2 card-config" style=" margin-left:18px;">
                <div class="body-card p-3">
                  <div class="row" style="margin:auto;">
                    <div class="col ">
                      <h6>Faturamento Total</h6>
                      <span class="h2 text-success"><?php if (isset($_SESSION['ftotal'])) {echo $_SESSION['ftotal'].' Kz';} ?></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col ">
              
            </div>

          </div>


          <div class="row">

        <div class="col" style=" margin-top:20px;">
          <h5 class="text-left ms-2">Vendas em cada Mês</h5>
            <div style="width:600px;">
              <canvas id="myChart"></canvas>
              <?php

              $cmd = $conn->pdo->query("SELECT sum(id_venda) as total ,monthname(vendaData) as mes from vendas group by month(vendaData)");
              $res = $cmd->fetchAll();

               //var_dump($res[0]['total']);
               //var_dump($res);

               foreach ($res as $data) {
                 $total[] = $data['total'];
                 $mes[] = $data['mes'];
               }

               ?>

               <script>
   const ctx = document.getElementById('myChart').getContext('2d');
   const myChart = new Chart(ctx, {
       type: 'bar',
       data: {
           labels: <?php echo json_encode($mes); ?>,
           datasets: [{
               label: 'Gráfico de Vendas',
               data: <?php echo json_encode($total); ?>,
               backgroundColor: [
                   'rgba(255, 99, 132, 0.5)',
                   'rgba(54, 162, 235, 0.5)',
                   'rgba(255, 206, 86, 0.5)',
                   'rgba(75, 192, 192, 0.5)',
                   'rgba(153, 102, 255, 0.5)',
                   'rgba(255, 159, 64, 0.5)'
               ],
               borderWidth: 1
           }]
       },
       options: {
           scales: {
               y: {
                   beginAtZero: true
               }
           }
       }
   });
   </script>
            </div>
                </div>


    <?php


    $cmd = $conn->pdo->query("SELECT count(id_venda) as cont ,pagamento from vendas join tipopag on vendas.fk_tipopag_venda = tipopag.id_pag group by pagamento");
    $res = $cmd->fetchAll();


     foreach ($res as $data) {
       $cont[] = $data['cont'];
       $pag[] = $data['pagamento'];
     }


     ob_end_flush();
     ?>
        <div class="col" style=" margin-top:20px;">
          <h5 class="text-left ms-2">Formas de Pagamento</h5>
              <div style="width:300px;">
                <canvas id="myChart2"></canvas>

                <script>
    const ctx1 = document.getElementById('myChart2').getContext('2d');
    const myChart2 = new Chart(ctx1, {
        type: 'doughnut',
        data: {
          labels: <?php echo json_encode($pag); ?>,
          datasets: [{
              //label: 'Gráfico de Vendas',
              data: <?php echo json_encode($cont); ?>,
              backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)'
                ],
                hoverOffset: 4
            }]
        },
        options: {
        }
    });
    </script>
              </div>
            </div>

          </div>
        </div>
     </div>


     <script src="js/jquery.js"></script>
    <script src="../../Library/sweetalert/sweetalert2.js"></script>
    
     <?php include 'php_include/model_perfil_admin.php';?>

     <script src="../../Library/boostrap5/bootstrap.bundle.min.js"></script>

  </body>
</html>
