<?php

if (isset($_SESSION['vazio_pesq'])) {
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
        timer: 4000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener("mouseenter", Swal.stopTimer)
          toast.addEventListener("mouseleave", Swal.resumeTimer)
        }
      });

      toastMixin.fire({
        animation: false,
        title: "Preencha o campo de pesquisa",
        icon: "warning"
      });
  });
  </script>
  ';
   unset($_SESSION['vazio_pesq']);
}

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
        animation: false,
        title: "Cadastrado com Sucesso",
      });
  });
  </script>
  ';
   unset($_SESSION['sucesso_cadastro']);
}

if (isset($_SESSION['mesmo_registro'])) {
    echo '
    <script>
    $(document).ready(function(){
        Swal.fire({
            icon: "error",
            title: "Utilizador Existente!",
            text: "Já foi encontrado um utilizador com estes dados"
        });
    });
  </script>
    ';
    unset($_SESSION['mesmo_registro']);
  }

 ?>

 

 <?php

 if (isset($_SESSION['up_success'])) {
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
         animation: false,
         title: "Atualizado com Sucesso",
       });
   });
   </script>
   ';
unset($_SESSION['up_success']);
 }

  ?>