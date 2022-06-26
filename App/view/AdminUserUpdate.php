<?php
ob_start();
require_once '../controller/usuario.php';
$user = new usuario;
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

            <li class="navegation-list-item nav-color">
              <a href="#" class="navegation-link">
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
              <a href="#" class="navegation-link">
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
              <a href="#" class="navegation-link">
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
                    <li class="breadcrumb-item"><a href="AdminUser.php" style="font-size: 14px;">Utilizadores</a></li>
                    <li class="breadcrumb-item"><a href="AdminUserUpdate.php" style="font-size: 14px;">Atualizar</a></li>
                </ol>
              </nav>
            </div>
          </div>

          <div class="row mb-3 ms-1">


                                  <?php
                                  if (isset($_GET['id_up'])) {

                                    $id_update = addslashes($_GET['id_up']);
                                    $res = $user->buscarDadosUsuario($id_update);
                                  }



                                  if (isset($_POST['btn_up_user'])) {

                                    $id_upd = addslashes($_GET['id_up']);
                                    $nome = addslashes($_POST['nome_user']);
                                    $senha = addslashes($_POST['senha_user']);
                                    $email = addslashes($_POST['email_user']);
                                    $acesso = addslashes($_POST['acesso_user']);

                                    if (!empty($nome)) {

                                   $user->atualizarDados($id_upd, $nome ,$senha, $email, $acesso);
                                   $_SESSION['up_success'] = "";
                                   header("Location: AdminUser.php");

                                  }else {
                                  echo "VAZIO";
                                  }

                                  }
                                  ob_end_flush();
                                   ?>

          <div class="row mb-1 ms-1 mt-2">
            <form  method="post">
              <div class="card card-config p-2">
                <div class="body-card p-3">

                  <div class="row p-2 ">
                    <div class="row p-2 ">
                      <input type="text" class="form-control form-control-sm  col me-1" name="nome_user" placeholder="Nome do Utilizador" autocomplete="off" value="<?php if (isset($res)) {echo $res['nome'];} ?>">
                      <input type="password" class="form-control form-control-sm  col me-1" name="senha_user" placeholder="Senha" value="<?php if (isset($res)) {echo $res['senha'];} ?>">
                      <input type="email" class="form-control form-control-sm  col me-1" name="email_user" placeholder="E-mail" value="<?php if (isset($res)) {echo $res['email'];} ?>">
                    </div>

                    <div class="row px-2 mb-2">

                      <select class="form-select form-select-sm col-4 me-1"  required name="acesso_user" style="width:500px;" value="<?php if (isset($res)) {echo $res['acesso'];} ?>">
                      <option value="3">Farmaceutico</option>
                      <option value="2">Gerente</option>
                      <option value="1">Administrador</option>
                   </select>
                  </div>
                  </div>

                    <button type="submit" name="btn_up_user" class="btn btn-success btn-sm col-1">Atualizar</button>
                    <a href="AdminUser.php" class="col-5"><button type="button" name="button" class="btn btn-danger btn-sm col" style="width:100px;">Cancelar</button>  </a>
            </form>

          </div>

        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
