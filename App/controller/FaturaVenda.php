<?php
ob_start ();
include_once 'usuario.php';
include_once '../model/Connection.php';
require '../../Library/fpdf184/fpdf.php';
$user = new Usuario;
$conn = new Connection;

/**
 *
 */
class FaturaVenda extends FPDF
{
  function header(){
    $this->Image('../view/images/logo-green.png',10,6,-800,0,'','http://localhost/SistemadeFarmacia/App/view/FarmVenda.php');
    $this->SetFont('Arial','B',14);
    $this->Cell(90,5, utf8_decode('Farmácia Maria Filomena'),0,0,'C');
    $this->Ln();
    $this->SetFont('Times','',12);
    $this->Cell(100,10, utf8_decode('Endereço: Sequele, Rua 01, Bloco 02'),0,0,'C');
    $this->Ln(5);
    $this->Cell(99,10, utf8_decode('NIF: 5416820451'),0,0,'C');
    $this->Ln();
    $this->SetFont('Arial','B',14.5);
    $this->Cell(20,30, utf8_decode('Fatura Recibo'),0,0,'C');
    $this->Ln(15);

    $data_venda = date('Y-m-d');

    $conn = new Connection;
    $cmd = $conn->pdo->query("SELECT id_venda FROM vendas order by id_venda desc");

    $res = $cmd->fetch();

    $this->SetFont('Times','', 12);
    $this->Cell(40,15 ,utf8_decode('Nº da Venda:'),0,0,'C');
    $this->Cell(8,15 ,$res['id_venda'],0,0,'C');
    $this->Ln(5);
    $this->Cell(38,15 ,'Data da Fatura:',0,0,'C');
    $this->Cell(30,15 ,$data_venda,0,0,'C');
    $this->Ln(5);
    $this->Cell(47,15 ,'Operador:',0,0,'C');
    $this->Cell(5,15 ,utf8_decode($_SESSION['nome_farmaceutico']),0,0,'C');
    $this->Ln(5);
    $this->Cell(40,15 ,'Cliente:',0,0,'C');
    $this->Cell(15,15 ,utf8_decode($_POST['cliente']),0,0,'C');
    $this->Ln(17);

    $this->Cell(4,8 ,'----------------------------------------------------------------------------------------------
    -------------------------------------------------------------------------------------------------------------------',0,0,'C');
    $this->Ln(4);
    $this->Cell(45,8 ,'Total da Compra: ',0,0,'L');
    $this->SetFont('Arial','', 13.8);
    $this->Cell(-1,8 ,$_POST['total'].'Kz',0,0,'C');
    $this->SetFont('Times','', 12);
    $this->Ln(4);
    $this->Cell(4,8 ,'----------------------------------------------------------------------------------------------
    -------------------------------------------------------------------------------------------------------------------',0,0,'C');
    //$this->Ln(5);
    // $this->Cell(47,8 ,'Desconto: ',0,0,'C');
    // $this->Cell(-17,8 , $_POST['desconto'].'%',0,0,'C');
    $this->Ln(4);
    $this->Cell(47,8 ,'Valor do Cliente: ',0,0,'C');
    $this->Cell(-2,8 , $_POST['valor_cli'].' Kz',0,0,'C');
    $this->Ln(5);
    
    $this->Cell(54,8 ,'Troco: ',0,0,'C');
    $this->Cell(-28,8 ,$_POST['troco']. 'Kz',0,0,'C');
    $this->Ln(14);




  }


  function footer(){
    $this->SetY(-15);
    $this->SetFont('Arial','B',9);
    $this->Cell(0,10, utf8_decode('OBRIGADO PELA SUA PREFERÊNCIA!'),0,0,'C'); 
    $this->Ln(3.5);
    $this->Cell(0,10, utf8_decode('DOCUMENTO PROCESSADO POR COMPUTADOR'),0,0,'C');
   }

   function headerTable(){
     $this->SetFont('Arial','',12);
     $this->Cell(40,8 ,'Nome',0,0,'L');
     $this->Cell(60,8 , utf8_decode ('Preço'),0,0,'C');
     $this->Ln();

   }

   function viewTable($conn){
     $this->SetFont('Times','', 12);
     $cmd = $conn->pdo->query("SELECT barcode, nomeProduto, precoVenda, qtdVenda, subtotalVenda from 
     carrinho_temp inner join produtos on carrinho_temp.fk_produtos_carrinho = produtos.id_produto");

     while ($res = $cmd->fetch(PDO::FETCH_OBJ)) {
       $this->Cell(40,8,utf8_decode($res->nomeProduto),0,0,'L');
       $this->Cell(60,8,utf8_decode($res->precoVenda),0,0,'C');
       $this->Ln();
     }
   }
}

$pdf = new FaturaVenda;
$tamanho = array(190,105);
$pdf->AliasNbPages();
$pdf->AddPage('P',$tamanho,0);
$pdf->headerTable();
$pdf->viewTable($conn);
$datanome = date('y/m/d');
$pdf->Output(utf8_decode('Fatura Recibo - ').$datanome.'.pdf','I');
ob_end_flush();

 ?>
