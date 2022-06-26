<?php

if (isset($_SESSION['sucs_pass_new'])) {
  echo '
  <script>
  $(document).ready(function(){
      Swal.fire({
          icon: "success",
          title: "Palavra-Passe alterado com sucesso",
          text: "Inicie a sessão com a sua nova senha"
      });
  });
</script>
  ';
  unset($_SESSION['sucs_pass_new']);
}

if (isset($_SESSION['net'])) {
    echo '
    <script>
    $(document).ready(function(){
        Swal.fire({
            icon: "error",
            title: "Sem Internet",
            text: "Você está sem conexão a internet no momento. Verifique a sua conexão e tente mais tarde!"
        });
    });
  </script>
    ';
    unset($_SESSION['net']);
  }


  if (isset($_SESSION['db_connect'])) {
    echo '
    <script>
    $(document).ready(function(){
        Swal.fire({
            icon: "error",
            title: "Erro Na Base de Dados",
            text: ""
        });
    });
  </script>
    ';
    unset($_SESSION['db_connect']);
  }


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


 ?>