<?php 
ob_start();
session_start();
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="App/view/images/logo-green.svg" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Library/boostrap5/bootstrap.min.css">
    <link rel="stylesheet" href="Library/fontawesome/fontawesome-free-6.1.1-web/css/all.min.css">
    <title>S.Farmácia</title>
    <link rel="stylesheet" href="App/view/css/index2.css">
</head>
<body>


    <div class="row mt-5 d-login"> <!---MAIN ROW--->

        <div class="col-5 mx-3 mt-5 col-login-index"> <!---MAIN COL--->
                <div class="card p-5 shadow-sm card-config">
                    <div class="body-card">
                        
                        <div class="mx-4 p-2"> <!---LOGIN COL--->

                        <form action="App/model/logarSistema.php" method="post"> 
                            <p class=" text-center mb-5 h5" style="color:gray;">Porfavor entre com as suas credências </p>  

                                        <div class="mb-2">
                                            <label for="email" class="label-control mb-1"><i class="fa-solid fa-at me-1 text-black"></i> Email</label>
                                            <input type="email" class="form-control" id="email" name="nome">
                                        </div>

                                        <div class="mb-5">
                                            <label for="pass" class="label-control mb-1"><i class="fa-solid fa-key me-1"></i> Palavra-Passe</label>
                                            <input type="password" class="form-control" id="pass" onkeyup="btn_disable()" name="senha">

                                            <div class="d-passtools">
                                                <input class="form-check-input" type="checkbox" value="" onclick="showPass()"> Mostrar a Palavra-Passe
                                                    <a href="email_recuperar.php" class="a-config">Esqueceu a sua Palavra-Passe?</a>
                                            </div>
                                            
                                        </div>

                                        <div class="d-grid mb-1 mx-auto">
                                            <button class="btn btn-success" type="submit" id="btn_login" >Entrar</button>
                                        </div>
                               </form>        
                        </div>

                            
                    </div>
                </div>

                
        </div>

        <div class="col col-info-index"> <!---IMG COL--->
                                                                
                    <p class="text-left mb-2 h1 fw-bolder col  text-white">Sistema de Gestão de Farmácia</p>
                    <p class="text-white h5">A aplicação web que te ajuda a administrar sua Farmácia</p>
                
                </div>
        
    </div>

  <script src="App/view/js/jquery.js"></script>
  <script src="Library/sweetalert/sweetalert2.js"></script>

  <?php
  include 'App/view/php_include/login_error.php';
  ob_end_flush();
 ?>

   <script src="Library/boostrap5/bootstrap.bundle.min.js"></script>
   <script src="App/view/js/index_validation.js"></script>
</body>
</html>