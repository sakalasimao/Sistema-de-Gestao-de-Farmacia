<?php

require_once 'Connection.php';
$conn = new Connection;


$cliente = filter_input(INPUT_GET,'term',FILTER_SANITIZE_STRING);

$res = $conn->pdo->prepare("SELECT nome_cli FROM clientes WHERE nome_cli LIKE '%".$cliente."%' ORDER BY nome_cli ASC LIMIT 4");
$res->execute();

while($row_msg = $res->fetch(PDO::FETCH_ASSOC)){

  $data[] = $row_msg['nome_cli'];
}

echo json_encode($data);



 ?>
