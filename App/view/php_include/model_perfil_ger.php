


<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 8px; border-color: white;">
      <div class="modal-header  border-0">
        <h5 class="modal-title" id="exampleModalToggleLabel">Perfil</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body  ">

      <div class="row " style="text-align: center;">
                    <div class="row mb-2">
                        <img src="images/perfil.png" alt="" style="max-width: 80%; object-fit: cover;">
                    </div>

                    <div class="col ">
                            <div class="row" >
                                <div class="col">
                                    <label for="" class="me-2"> <strong>Nome: </strong></label>
                                    <span><?php echo $_SESSION['nome_gerente']; ?></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="" class="me-2"> <strong>Gerente </strong></label>
                                   
                                </div>

                            <div class="row">
                                <div class="col">
                                    <label for="" class="me-2"> <strong>E-mail: </strong></label>
                                    <span><?php  echo $_SESSION['email_ger']; ?></span>
                                </div>
                            </div>
                    </div>
                </div>
                
              </div>

      </div>
      <div class="modal-footer border-0">
        <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Editar Perfil</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 8px; border-color: white;">
      <div class="modal-header  border-0">
        <h5 class="modal-title" id="exampleModalToggleLabel2">Editar Perfil</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
      <div class="row " style="text-align: center;">
                    <div class="row mb-2">
                        <img src="images/perfil.png" alt="" style="max-width: 80%; object-fit: cover;">
                    </div>

                    <div class="col">
                            <div class="row">
                                <div class="col">
                                    <label for="" class="me-2"> <strong>Nome: </strong></label>
                                    <span><?php echo $_SESSION['nome_gerente']; ?></span>
                                </div>
                            </div>


                    <form method="POST">
                            <div class="row d-flex align-items-center">
                            
                                <div class="col">
                                    <label for="" class="me-2"> <strong>Atualizar o E-mail: </strong></label>
                                    <span ><input type="email"  style="box-shadow: 0 0 0 0; outline: 0; border: 2px solid #eee; padding: 5px; border-radius: 5px;" name="email" placeholder="<?php  echo $_SESSION['email_ger']; ?>" required></span>
                                    
                                </div>
                            

                            <?php
                                if(isset($_POST['email'])){
                                    $id_user_admin = $_SESSION['id_usuario_ger'];
                                        $email = $conn->pdo->prepare("UPDATE usuarios SET email = :em WHERE id_usuario = :id");
                                        $email->bindValue(":em", @$_POST['email']);
                                        $email->bindValue(":id", $id_user_admin);
                                        $email->execute();
                                    }else{
                                        echo '<p style = "color:#F94C66; margin-top:7px;"><strong> Informe o seu E-mail </strong></p>';
                                    }

                                    ?>
                                
                            </div>
                   
                </div>
                
              </div>
            

     
      </div>
         <div class="modal-footer border-0">
         <button class="btn btn-success" type="submit">Atualizar</button>
    </form>
        <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal" style="float: right;">Voltar</button>
      </div>
    
      </div>

    </div>
  </div>

</div>
