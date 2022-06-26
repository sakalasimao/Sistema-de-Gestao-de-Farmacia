<?php
ob_start();

require_once '../controller/funcionario.php';
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
                    <li class="breadcrumb-item"><a href="GerFuncRead.php"  class="ind">Funcionarios</a></li>
                  <li class="breadcrumb-item active" aria-current="page"><a class="ind ind-now">Atualizar</a></li>
                </ol>
              </nav>
            </div>
          </div>

                                 <?php
                                  
                                  if (isset($_GET['id_up'])) {

                                    $id_update = addslashes($_GET['id_up']);
                                    $res = $func->buscarDadosFuncionario($id_update);
                                  }

                                  if (isset($_POST['btnUp_prod'])) {
                                    
                                    $id_upd = addslashes($_GET['id_up']);
                                    $nome = addslashes($_POST['nome_func']);
                                    $telefone = addslashes($_POST['tel_func']);
                                    $email = addslashes($_POST['email_func']);
                                    $endereco = addslashes($_POST['end_func']);
                                    $cargo = addslashes($_POST['cargo_func']);

                                    if (!empty($nome) && !empty($telefone) && !empty($email) && !empty($endereco) && !empty($cargo)) {

                                   $func->atualizarDados($id_upd, $nome ,$telefone, $email, $endereco, $cargo);
                                   header("Location: GerFuncRead.php");

                                  }else {
                                    //preencha os campos
                                  }

                                  }
                                  ob_end_flush();
                                   ?>

          <div class="row mb-4 ms-1 d-flex align-itens-center mt-5">

            <div class="col"> <!---CADASTRO--->
        <form   method="POST">
            <div class="card  p-2" style="border-radius: 8px;">
                <div class="body-card p-3">

                      <div class="row px-2 mb-2 d-flex align-itens-center">

                        <div class="col">
                           <label for="" style="margin-left: -10px; font-weight: 500; font-size: 15px; display:block;">Nome Completo</label>
                           <input type="text" class="input-style form-control-sm  me-1"  style="width: 300px; margin-left: -10px;" name="nome_func" placeholder="Maria de Souza" id=""   value="<?php if (isset($res)) {echo $res['nomeFuncionario'];} ?>">
                        </div>

                        <div class="col">
                           <label for="" style="margin-left: -10px; font-weight: 500; font-size: 15px; display:block;">Telefone</label>
                           <input type="number" min= "1"class="input-style form-control-sm  me-1"  style="width: 300px; margin-left: -10px;" name="tel_func" placeholder="959873857" id=""   value="<?php if (isset($res)) {echo $res['telefone'];} ?>">
                        </div>
                          
                        </div>

                        <div class="row px-2 mb-2">

                          <div class="col">
                            <label for="" style="margin-left: -10px; font-weight: 500; font-size: 15px; display:block;">E-mail</label>
                            <input type="email" class="input-style form-control-sm  me-1"  style="width: 300px; margin-left: -10px;" name="email_func" placeholder="mariesouza@gmail.com" id=""   value="<?php if (isset($res)) {echo $res['emailFuncionario'];} ?>">
                          </div>

                          <div class="col mt-1">
                            <label for="" style="margin-left: -10px; font-weight: 500; font-size: 15px; display:block;">Endereço</label>
                            <input type="text" class="input-style form-control-sm  me-1"  style="width: 300px; margin-left: -10px;" name="end_func" placeholder="Morada ,Bairro, Rua," id=""  value="<?php if (isset($res)) {echo $res['endereco'];} ?>">
                          </div>
                            
                          </div>

                          <div class="row px-2 mb-2">

                          <div class="col">
                            <label for="" style="margin-left: -10px; font-weight: 500; font-size: 15px; display:block;">Cargo</label>
                            <input type="text" class="input-style form-control-sm  me-1"  style="width: 300px; margin-left: -10px;" name="cargo_func" placeholder="Farmaceutico" id=""   value="<?php if (isset($res)) {echo $res['cargo'];} ?>">
                          </div>

                          <div class="col mt-4">
                              <button type="submit" name="btnUp_prod" class="btn btn-success btn-sm me-2">Atualizar</button>
                              <a href="GerFuncRead.php" class=" btn btn-danger btn-sm" >Cancelar</a>
                          </div>
                          <span class="mb-4"></span>

                          </div>

                         

                        
                </div>
            </div>
          </form>

            </div>

            <div class="col-4"> <!---IMG CADASTRO--->

            <img src="images/funcionario.png" alt="cadastro" class="img_config">

            </div>
        


        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
