<?php 
ob_start();
session_start();
include_once 'App/model/Connection.php';
$conn = new Connection;
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

        <div class="col-5 mx-3 mt-5"> <!---MAIN COL--->
                <div class="card p-5 shadow-sm card-config">
                    <div class="body-card">
                        
                        <div class="mx-4 p-2"> <!---LOGIN COL--->

                        <form  method="post"> 
                            <p class=" text-center mb-5 h5" style="color:gray;">Esta é a sua primeira vez iniciando a sessão, por favor coloque as informações correntas para criação da sua nova senha</p>  

                                        <div class="mb-2">
                                            <label for="email" class="label-control mb-1"><i class="fa-solid fa-at me-1 text-black"></i> Email</label>
                                            <input type="email" class="form-control" id="email"  value="<?php if(isset($_SESSION['email'])){echo $_SESSION['email'];}?>" readonly="true">
                                        </div>

                                        <div class="mb-5">
                                            <label for="pass" class="label-control mb-1"><i class="fa-solid fa-key me-1"></i> Palavra-Passe</label>
                                            <input type="password" class="form-control" id="pass" onkeyup="btn_disable()" name="senha">

                                            <div class="mt-2">
                                                <input class="form-check-input" type="checkbox" value="" onclick="showPass()"> Mostrar a Palavra-Passe
                                
                                            </div>
                                            
                                        </div>

                                        <div class="mb-1 mx-auto d-buttons">
                                            <button class="btn btn-success" type="submit" id="btn_login" style="width: 150px;" name="ok">Atualizar</button>
                                            <a href="index.php" class="btn btn-danger" style="width: 150px;">Cancelar</a>
                                        </div>

                                        <?php
                                        if(isset($_POST['senha'])){

                                          $senha = $_POST['senha'];
                                           $email = $_SESSION['email'];

                                          $comand =  $conn->pdo->prepare("UPDATE usuarios SET senha = :s, controleAcesso = :ac  WHERE email = :em");
                                          $comand->bindValue(":s",$senha);
                                          $comand->bindValue(":ac",1);
                                          $comand->bindValue(":em",$email);

                                          if($comand->execute()){

                                              $_SESSION['sucs_pass_new'] = "";
                                              header('Location: index.php');

                                          }else{
                                            echo 'erro no editar a senha';
                                          }
                                        }
                                        
                                        ?>

                                        <script>

                                            var myvar = setInterval(btn_disable, 100);
                                            
                                            
                                            let pass =  document.getElementById('pass');
                                            let btn_login =  document.getElementById('btn_login');

                                            function showPass(){

                                                if (pass.type === "password") {
                                                    pass.type = "text";
                                                } else {
                                                    pass.type = "password";
                                                }
                                                
                                            }

                                            function btn_disable(){

                                            if(pass.value == ""){
                                                btn_login.disabled = true;
                                            }else{
                                                btn_login.disabled = false;
                                            }
                                            }
                                            
                                        </script>
                                        
                               </form>        
                        </div>

                            
                    </div>
                </div>

                
        </div>

        <div class="col"> <!---IMG COL--->
                                                                
                    <p class="text-left mb-2 h1 fw-bolder col  text-white">Sistema de Gestão de Farmácia</p>
                    <p class="text-white h5">A aplicação web que te ajuda a administrar sua Farmácia</p>
                
                </div>
        
    </div>

    <script src="App/view/js/jquery.js"></script>
    <script src="Library/sweetalert/sweetalert2.js"></script>


  <?php

if (isset($_SESSION['succes_email'])) {
  echo '
  <script>
  $(document).ready(function(){
      Swal.fire({
          icon: "success",
          title: "Email enviando com sucesso!",
          text: "Check a sua caixa de entrada no seu email "
      });
  });
</script>
  ';
  unset($_SESSION['succes_email']);
}


 ?>

  <?php

if (isset($_SESSION['sucs_senha'])) {
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
        timer: 5000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener("mouseenter", Swal.stopTimer)
          toast.addEventListener("mouseleave", Swal.resumeTimer)
        }
      });

      toastMixin.fire({
        animation: false,
        title: "Palavra-passe atualiza com sucesso!",
        icon: "success"
      });
  });
  </script>
  ';
  unset($_SESSION['sucs_senha']);
}


 ?>

  <?php

if (isset($_SESSION['erro_senha'])) {
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
        timer: 5000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener("mouseenter", Swal.stopTimer)
          toast.addEventListener("mouseleave", Swal.resumeTimer)
        }
      });

      toastMixin.fire({
        animation: false,
        title: "Nome e/ou senha errados!",
        icon: "error"
      });
  });
  </script>
  ';
  unset($_SESSION['erro_senha']);
}

ob_end_flush();
 ?>

<script src="Library/boostrap5/bootstrap.bundle.min.js"></script>
</body>
</html>