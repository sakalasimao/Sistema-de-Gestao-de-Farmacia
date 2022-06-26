<?php 

ob_start();
session_start();
include 'App/view/php_include/internet_connection.php';
include_once 'App/model/Connection.php';
require_once 'Library/src/PHPMailer.php';
require_once 'Library/src/SMTP.php';
require_once 'Library/src/Exception.php';
$conn = new Connection;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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
    <link rel="stylesheet" href="App/view/css/forget _email.css">

    <script src="App/view/js/jquery.js"></script>
    <script src="Library/sweetalert/sweetalert2.js"></script>
</head>
<body>


    <div class="row mt-5 d-login"> <!---MAIN ROW--->

        <div class="col-5 mx-3 mt-5"> <!---MAIN COL--->
                <div class="card p-5 shadow-sm card-config">
                    <div class="body-card">
                        
                        <div class="mx-4 p-2"> <!---LOGIN COL--->

                        <form  method="post"> 
                            <p class=" text-center mb-5 h5" style="color:gray;">Porfavor informe o seu email para recuperar a sua palavra-passe</p>  

                                        <div class="mb-4">
                                            <label for="email" class="label-control mb-1"><i class="fa-solid fa-at me-1 text-black"></i> Email</label>
                                            <input type="email" class="form-control" id="email" name="email" onkeyup="btn_disable()">
                                        </div>


                                        <div class="mb-1 mx-auto d-buttons">
                                            <button class="btn btn-success" type="submit" id="btn_login" style="width: 150px;" name="ok">Enviar</button>
                                            <a href="index.php" class="btn btn-danger" style="width: 150px;">Cancelar</a>
                                        </div>

                                        
                               </form>  
                               
                               <?php 
                               
                               if(isset($_POST['ok'])){

                                $email = addslashes($_POST['email']);

                                $cmd = $conn->pdo->prepare("SELECT * FROM usuarios where email = :em limit 1");
                                $cmd->bindValue(":em",$email);
                                $cmd->execute();

                                if(!$email == ""){

                                if($cmd->rowCount() > 0){
                                    $row = $cmd->fetch();
                                    $id = $row['id_usuario'];

                                    $chave_recuperar_senha = password_hash($id, PASSWORD_DEFAULT);

                                        //echo 'CHAVE - '.$chave_recuperar_senha;

                                    $comand =  $conn->pdo->prepare("UPDATE usuarios SET recuperarSenha = :rs WHERE id_usuario = :id limit 1");
                                    $comand->bindValue(":rs",$chave_recuperar_senha);
                                    $comand->bindValue(":id",$id);

                                    if($comand->execute()){
                                        //echo  "http://localhost/SistemadeFarmacia/atualizar_senha.php?chave=$chave_recuperar_senha";
                                        $link =  "http://localhost/SistemadeFarmacia/atualizar_senha.php?chave=$chave_recuperar_senha";

                                        $mail = new PHPMailer(true);

                                        try{

                                            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                                            
                                            $mail->CharSet = 'UTF-8';   
                                            $mail->isSMTP(); 
                                           // $mail->SMTPSecure = 'tls';  
                                            $mail->SMTPSecure = 'ssl';                                         //Send using SMTP
                                            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                                            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                                            $mail->Username   = 'sakalasimao@gmail.com';                     //SMTP username
                                            $mail->Password   = 'fkgsrvrfjzmfpsus';                               //SMTP password
                                           // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                                            $mail->Port       = 465;  

                                            $mail->setFrom('sakalalusala@gmail.com', 'Sistema de Farmácia');
                                            $mail->addAddress($row['email'], $row['nome']);

                                            $mail->isHTML(true);                                  //Set email format to HTML
                                            $mail->Subject = 'Recuperar Palavra-Passe';

                                            $mail->Body    = 'Prezado(a) '.$row['nome'].", Você solicitou a alteração de sua palavra-passe.<br><br>
                                            Para continuar com o processo de recuperação de sua palavra-passe, click no link abaixo ou cole no seu navegador:<br><br>
                                            ".$link."<br><br> Se você não solicitou essa alteração, nenhuma ação é necessaria. Sua palavra-passe permanecerá a mesma até que ative o este código.<br><br>";

                                            $mail->AltBody = 'Prezado(a) '.$row['nome']."\n\nVocê solicitou a alteração de sua palavra-passe.
                                            \n\nPara continuar com o processo de recuperação de sua palavra-passe, click no link abaixo ou cole no seu navegador:\n\n
                                            ".$link." Se você não solicitou essa alteração, nenhuma ação é necessaria. Sua palavra-passe permanecerá a mesma até que ative o este código.\n\n";

                                            if($mail->send()){
                                                $_SESSION['succes_email'] = "";
                                                header('Location: index.php'); 
                                            }else{
                                                echo '
                                    <script>
                                        $(document).ready(function(){
                                            Swal.fire({
                                                icon: "error",
                                                title: "Erro ao Enviar o Email",
                                                text: ""
                                            });
                                        });
                                    </script>
                                    ';
                                            }
                                            
                                       

                                        }catch(Exception $e){
                                           echo "Erro ao enviar mensagem {$mail->ErrorInfo}";
                                        }



                                    }else{
                                        echo '
                                        <script>
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
                                                    title: "Tente Novamente!",
                                                    icon: "error"
                                                  });
                                            });
                                        </script>
                                        ';

                                    }
                                }else{
                                    echo '
                                    <script>
                                        $(document).ready(function(){
                                            Swal.fire({
                                                icon: "error",
                                                title: "Utilizador não encontrado!",
                                                text: ""
                                            });
                                        });
                                    </script>
                                    ';
                                 
                                }
                            }

                               }
                               
                               
                               ?>
                        </div>

                        
                            
                    </div>
                </div>

                
        </div>

        <div class="col"> <!---IMG COL--->
                                                                
                    <p class="text-left mb-2 h1 fw-bolder col  text-white">Sistema de Gestão de Farmácia</p>
                    <p class="text-white h5">A aplicação web que te ajuda a administrar sua Farmácia</p>
                
                </div>
        
    </div>

  <?php

if (isset($_SESSION['link_invalido'])) {
    echo '
    <script>
        $(document).ready(function(){
            Swal.fire({
                icon: "error",
                title: "Link Inválido!",
                text: "Solicite novo link para atualizar a palavra-passe"
            });
        });
    </script>
    ';
  unset($_SESSION['link_invalido']);
}

ob_end_flush();
 ?>

    <script src="Library/boostrap5/bootstrap.bundle.min.js"></script>
    <script src="App/view/js/index_email_validation.js"></script>

</body>
</html>