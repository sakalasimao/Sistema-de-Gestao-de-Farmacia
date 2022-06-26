<?php

session_start();

include_once '../model/Connection.php';
// include '../model/AcessarCarrinho.php';
$conn = new Connection;



$pesq = $_GET['term'];


$res = $conn->pdo->prepare("SELECT nomeProduto FROM produtos WHERE nomeProduto LIKE '%$pesq%' LIMIT 5");
$res->execute();

while($row_msg = $res->fetch(PDO::FETCH_ASSOC)){

  $data[] = $row_msg['nomeProduto'];
}


echo json_encode($data);


 ?>
