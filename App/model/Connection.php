<?php

/**
 * Conexão com Base de Dados
 */
class Connection
{
  public $pdo;

  function __construct()
  {

    try {
       $this->pdo = new PDO("mysql:host=localhost;dbname=sistemafarmaciav2","root","");
    } catch (PDOException $e) {
      //echo "<strong>Erro com a base de dados: </strong>".$e->getMessage();
    
      $_SESSION['db_connect'] = "";
      echo '<script>location.href = "index.php"</script>';

      exit();

    }catch(Exception $e){
      echo "<strong>Erro gererico: </strong>".$e->getMessage();
      exit();
    }

  }
}



 ?>
