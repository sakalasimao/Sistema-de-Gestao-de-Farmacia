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
          <div class="sidebar-logo-container" data-bs-toggle="modal" data-bs-target="#exampleModalToggle" title="Visualizar Perfil">
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


            <li class="navegation-list-item nav-color">
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
            <nav  style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb d-flex align-items-center">
                  <li class="breadcrumb-item active" aria-current="page"><a class="ind ind-now">Histórico do Sistema</a></li>
                </ol>
              </nav>
            </div>
          </div>

       
          <div class="card p-2  card-config mt-2">
            <div class="body-card p-1">
                  
                    <div class="row mt-2"> <!---ARÉA DE PESQUISA E RELATÓRIOS-->
                    

                    <div class="col">
                  <form method="POST">
                      <div class="input-group mb-3">
                          <input type="text" class="input-style" size="20" name="pesqAll" placeholder="Pesquisar...">
                          <button type="submit" class="input-group-text" id="basic-addon2"><a href="#" style="color:#000"><i class="fa-solid fa-magnifying-glass"></i></a></button type="submit">
                          <span class="input-group-text "><a href="../model/AcessarFuncionario.php?reportFunc_pesq" style="color:#000"><i class="fa-solid fa-file-lines"></i></a></span>
                      </div>
                    </form>
                    </div>
            
                   <div class="col">
                     <!-------
                               <form method="post" style="display: flex; flex-direction: row; gap:10px;" class="ms-3 mt-2">
                <input type="date" class="form-control " name="data1" style="width: 120px;">
              <input type="date" class="form-control " name="data2" style="width: 120px;">
              <button type="submit" class="btn btn-sm btn-success" name="pes">Pesquisar</button>
              <a href="?stopFilter" class="btn btn-sm btn-danger " style="float: right;" title="Parar de Filtrar"><i class="fa-solid fa-trash-can"></i></a>
              </form>

                ------>
                <form method="post">
                        <div class="input-group mb-3">
                            <input type="date" class="form-control"  name="data1" placeholder=""  title="Data Inicial">
                            <input type="date" class="form-control"  name="data2" placeholder="" title="Data Final">
                          <button class="input-group-text" type="submit" name="pes"><i class="fa-solid fa-magnifying-glass"></i></button>
                            <span class="input-group-text"><a href="../model/AcessarHVenda.php?report_hv_pesqData" style="color:#000"><i class="fa-solid fa-file-lines"></i></a></span>
                          </div>
                </form>

               <?php //var_dump($_POST); ?> 
                       
                    </div>

                    <div class="col  ">
                         <!---- 
                            <a href="?stopFilter" class="btn btn-sm btn-danger " style="float: right;" title="Parar de Filtrar"><i class="fa-solid fa-trash-can"></i></a>
                            <a href="../model/AcessarHVenda.php?report_hv"><button type="button" name="button" class="btn btn-success btn-sm btn-plus ms-2 ">Gerar Relatório</button></a>
                    ---->
                        <div class=" btn-group btn-group-sm" role="group" aria-label="Basic example">
                            <a  class="btn btn-danger" href="?stopFilter" title="Remover Filtração"><i class="fa-solid fa-filter"></i> Remover</a>
                            <a class="btn btn-success" title="Relatório Geral" href="../model/AcessarAdRendi.php?report_log"><i class="fa-solid fa-file-lines"></i> Relatório Geral</a>
                          </div>
                    
                    
                          </div>     
                
                </div>  
            </div>
          </div>


          <div class="row mb-1 ms-1 mt-2">
             
             <div class="table-responsive">

                 
               <table class="content-table table shadow-sm mt-2">
                 <thead>
                   <th>Nome</th>
                   <th>Acesso</th>
                   <th>Tipo</th>
                   <th>Descrição</th>
                   <th>Criando</th>
                 </thead>

                   <?php

                   if(isset($_POST['pes'])){

                     $data2= $_POST['data2'];
                     $data1= $_POST['data1'];
                     

                     $cmd = $conn->pdo->prepare("SELECT nome, nome_nivel, tipo, descricao, criandoLogger FROM logger l JOIN usuarios u ON
                     l.fk_usuario_logger = u.id_usuario JOIN nivel n ON u.fk_acesso_usuario = n.id_nivel
                      where criandoLogger between :d1 and :d2  ORDER BY id_log DESC");
                     $cmd->bindValue(":d1",$data1);
                     $cmd->bindValue(":d2",$data2);
                     $cmd->execute();

                     while ($res = $cmd->fetch(PDO::FETCH_ASSOC)) {

                       ?>
                       <tbody>
                         <tr style="color: #1363DF;">
                         <td><?php echo $res['nome']; ?></td>
                         <td><?php echo $res['nome_nivel']; ?></td>
                         <td><?php echo $res['tipo'];?></td>
                         <td><?php echo  $res['descricao'];?></td>
                         <td><?php echo  $res['criandoLogger'];?></td>
                         </tr>
                       </tbody>


                       <?php
                     }

                     $_SESSION['data1_hvenda'] = $data1;
                     $_SESSION['data2_hvenda'] = $data2;

                   }elseif(isset(($_POST['pesqAll']))){

                     //var_dump($_POST);

                     $pesqAll = $_POST['pesqAll'];

                     
                     $cmd = $conn->pdo->prepare("SELECT nome, nome_nivel, tipo, descricao, criandoLogger FROM logger l JOIN usuarios u ON
                     l.fk_usuario_logger = u.id_usuario JOIN nivel n ON u.fk_acesso_usuario = n.id_nivel
                      where nome LIKE '%$pesqAll%' OR descricao = :des  OR tipo LIKE '%$pesqAll%' OR nome_nivel LIKE '%$pesqAll%' ");
                     $cmd->bindValue(":des", $pesqAll);
                     $cmd->execute();

                     while ($res = $cmd->fetch(PDO::FETCH_ASSOC)) {

                       ?>
                     <tbody>
                         <tr style="color: #1363DF;">
                         <td><?php echo $res['nome']; ?></td>
                         <td><?php echo $res['nome_nivel']; ?></td>
                         <td><?php echo $res['tipo'];?></td>
                         <td><?php echo  $res['descricao'];?></td>
                         <td><?php echo  $res['criandoLogger'];?></td>
                         </tr>
                       </tbody>


                       <?php
                     }


                   }else{

                     unset($_SESSION['data1_hvenda']);
                     unset($_SESSION['data2_hvenda']);

                     $cmd = $conn->pdo->query("SELECT nome, nome_nivel, tipo, descricao, criandoLogger FROM logger l JOIN usuarios u ON
                     l.fk_usuario_logger = u.id_usuario JOIN nivel n ON u.fk_acesso_usuario = n.id_nivel order by id_log desc");
                    
                     while ($res = $cmd->fetch(PDO::FETCH_ASSOC)) {

                       ?>
                       <tbody>
                         <tr>
                         <td><?php echo $res['nome']; ?></td>
                         <td><?php echo $res['nome_nivel']; ?></td>
                         <td><?php echo $res['tipo'];?></td>
                         <td><?php echo  $res['descricao'];?></td>
                         <td><?php echo  $res['criandoLogger'];?></td>
                         </tr>
                       </tbody>


                       <?php
                     }

                      
                   }


                   ?>



               </table>

             </div>
       
     </div>
          

    <script src="../../Library/boostrap5/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="../../Library/sweetalert/sweetalert2.js"></script>

    <?php include 'php_include/model_perfil_admin.php';?>


  </body>
</html>
