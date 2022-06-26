<?php



if (isset($_SESSION['msg_succSales'])) {

  $meg =  '
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
        title: "Venda Efetuada com Sucesso"
      });
  });
  </script>
  ';

  echo $meg;
  unset($_SESSION['msg_succSales']);
  
  
}




 ?>

    <?php

    if (isset($_SESSION['msg_bigStock'])) {
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
            animation: true,
            title: "Valor da quantidade é MAIOR que está em estoque",
            icon: "error"
          });
      });
      </script>
      ';
       unset($_SESSION['msg_bigStock']);
    }

     ?>

   

    <?php

    if (isset($_SESSION['msg_emptySale'])) {
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
            animation: true,
            title: "Preencha os campos",
            icon: "warning"
          });
      });
      </script>
      ';
       unset($_SESSION['msg_emptySale']);
    }

     ?>



    <?php

    if (isset($_SESSION['msg_endStock'])) {
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
            animation: true,
            title: "Produto esgotado no estoque!",
            icon: "warning"
          });
      });
      </script>
      ';
       unset($_SESSION['msg_endStock']);
    }

     ?>



    <?php

    if (isset($_SESSION['msg_notQuant'])) {
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
            animation: true,
            title: "Informe a quantidade do produto",
            icon: "error"
          });
      });
      </script>
      ';
       unset($_SESSION['msg_notQuant']);
    }

     ?>

    <?php

if (isset($_SESSION['valor_menor'])) {
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
        title: "Erro no Valor do Cliente",
        icon: "error"
      });
  });
  </script>
  ';
   unset($_SESSION['valor_menor']);
}

    if (isset($_SESSION['msg_notFound'])) {
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
            animation: true,
            title: "Produto não encontrado!",
            icon: "error"
          });
      });
      </script>
      ';
       unset($_SESSION['msg_notFound']);
    }

     ?>

     <?php

     if (isset($_SESSION['msg_notCode'])) {
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
             animation: true,
             title: "Porfavor informe o código do produto!",
             icon: "error"
           });
       });
       </script>
       ';
        unset($_SESSION['msg_notCode']);
     }

      ?>




    <?php

    if (isset($_SESSION['aberto'])) {
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
            animation: true,
            title: "Aberto com Sucesso",
          });
      });
      </script>
      ';
       unset($_SESSION['aberto']);
    }