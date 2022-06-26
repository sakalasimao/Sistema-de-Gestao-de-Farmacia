<?php
ob_start();
require_once '../model/Connection.php';
require_once '../controller/usuario.php';
$conn = new Connection;
$user = new Usuario;
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

            <li class="navegation-list-item nav-color">
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
          <div class="row mb-1 ms-1">
            <div class="col">
            <nav  style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb d-flex align-items-center">
                    <li class="breadcrumb-item"><a href="AdminUser.php"  class="ind">Utilizadores</a></li>
                  <li class="breadcrumb-item active" aria-current="page"><a class="ind ind-now">Atualizar</a></li>
                </ol>
              </nav>
            </div>
          </div>

          <?php
                                  if (isset($_GET['id_up'])) {

                                    $id_update = addslashes($_GET['id_up']);
                                    $res = $user->buscarDadosUsuario($id_update);
                                  }

                  

                                  if (isset($_POST['btn_up_user'])) {
                                    $id_upd = addslashes($_GET['id_up']);
                                    $nome = addslashes($_POST['nome_user']);
                                   // $senha = addslashes($_POST['senha_user']);
                                    $email = addslashes($_POST['email_user']);
                                    $acesso = addslashes($_POST['acesso_user']);

                                    if (!empty($nome)) {

                                   $user->atualizarDados($id_upd, $nome, $email, $acesso);
                                   $_SESSION['user_up'] = "";
                                    header('Location: AdminUser.php');

                                   

                                  }else {
                                    echo 'CAMPOS';
                                  }

                                  }
                                  ob_end_flush();
                                   ?>

          <div class="row mb-4  ms-1 d-flex align-itens-center mt-5">
      <div class="col"> <!---CADASTRO--->

     <form   method="POST">
            <div class="card  p-2" style="border-radius: 8px;">
            <div class="body-card p-3">

<div class="row px-2 mb-2 d-flex align-itens-center">

  <div class="col">
     <label for="" style="margin-left: -10px; font-weight: 500; font-size: 15px; display:block;">Nome do Completo </label>
     <input type="text"  class="input-style form-control-sm  me-1"  style="width: 300px; margin-left: -10px;" name="nome_user"  placeholder = "Amélia Figueiro" required value="<?php if (isset($res)) {echo $res['nome'];} ?>">
  </div>

  <div class="col">
     <label for="" style="margin-left: -10px; font-weight: 500; font-size: 15px; display:block;">Senha </label>
     <input type="number" min = "1" class="input-style form-control-sm  me-1"  style="width: 300px; margin-left: -10px;" name="senha_user" placeholder="Protegida"  disabled>
  </div>
    
  </div>

  <div class="row px-2 mb-2">

    <div class="col">
      <label for="" style="margin-left: -10px; font-weight: 500; font-size: 15px; display:block;">E-mail </label>
      <input type="email" class="input-style form-control-sm  me-1"  style="width: 300px; margin-left: -10px;" name="email_user" placeholder="ameliafigueiro@gmail.com"  value="<?php if (isset($res)) {echo $res['email'];} ?>">
    </div>

    <div class="col">
    <label for="" style="margin-left: -10px; font-weight: 500; font-size: 15px; display:block;"> Nível de Acesso </label>

    <select  class="input-style form-control-sm  me-1"  style="width: 300px; margin-left: -10px;" required name="acesso_user">
    <?php

        $cmd = $conn->pdo->prepare("SELECT * from nivel order by id_nivel desc");
        $cmd->execute();

        if ($cmd->rowCount() > 0) {
          while ($res2 = $cmd->fetch(PDO::FETCH_ASSOC)) {

          echo "<option value='{$res2['id_nivel']}'";

          if($res2['id_nivel'] == $res['fk_acesso_usuario']){
              echo 'selected="seletcted"';
          }
          
          
          echo " >{$res2['nome_nivel']}</option>";

        }
        }

        ?>
    </select>

    </div>
      
    </div>

    




    <div class="row px-2 mb-2">


      <div class="col mt-4">
            <button type="submit" name="btn_up_user" class="btn btn-success btn-sm me-2">Atualizar</button>
            <a href="AdminUser.php" class=" btn btn-danger btn-sm" >Cancelar</a>
        </div>


</div>

  
  
</div>
            </div>
          </form>

      </div>

            <div class="col-4"> 
            <img src="images/register_user.png" alt="cadastro" class="img_config" >
            </div>
        


        </div>
    </div>



    <script src="js/jquery.js"></script>
    <script src="../../Library/sweetalert/sweetalert2.js"></script>

    <?php include 'php_include/model_perfil_admin.php';?>
    <?php include 'php_include/adminUser_error.php';?>

    <script src="../../Library/boostrap5/bootstrap.bundle.min.js"></script>
  </body>
</html>
