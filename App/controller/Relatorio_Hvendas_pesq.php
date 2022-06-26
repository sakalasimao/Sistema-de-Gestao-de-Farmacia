<?php

include_once 'usuario.php';
include_once '../model/Connection.php';
require '../../Library/fpdf184/fpdf.php';
$user = new Usuario;
$conn = new Connection;

/**
 *
 */
class Relatorio_Hvendas_pesq extends FPDF
{
  function header(){
    $this->Image('../view/images/logo-green.png',10,6,-600,0,'','http://localhost/SistemadeFarmacia/App/view/GerVendas.php');
    $this->SetFont('Arial','B',14);
    $this->Cell(276,5, utf8_decode('Farmácia Maria Helena'),0,0,'C');
    $this->Ln();
    $this->SetFont('Times','',12);
    $this->Cell(276,10, utf8_decode('Endereço: Sequele, Rua 01, Bloco 02'),0,0,'C');
    $this->Ln(5);
    $this->Cell(276,10, utf8_decode('NIF: 5416820451'),0,0,'C');
    $this->Ln();
    $this->SetFont('Arial','B',13);
    $this->Cell(100,30, utf8_decode('Relatório de Histório de Vendas de Pesquisa Por: '. $_SESSION['pesq_report']),0,0,'C');
    $this->Ln(20);

  }


  function footer(){
    $this->SetY(-15);
    $this->SetFont('Arial','',9);
    $this->Cell(0,10, utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
   }

   function headerTable(){
    
     $this->SetFont('Times','',12);
     $this->Cell(45,10,'Operador',1,0,'C');
     $this->Cell(30,10,'Total',1,0,'C');
     $this->Cell(25,10,'Desconto',1,0,'C');
     $this->Cell(45,10,'Nome do Cliente',1,0,'C');
     $this->Cell(30,10,'Pagamento',1,0,'C');
     $this->Cell(30,10,'Troco',1,0,'C');
     $this->Cell(58,10,'Data',1,0,'C');
     $this->Ln();

   }

   function viewTable($conn){
     $this->SetFont('Times','', 12);
      $pesqAll = $_SESSION['pesq_report'];
     $cmd = $conn->pdo->prepare("SELECT nome , vendaTotal, vendaDesconto, vendaCliente, pagamento, vendaTroco, vendaData FROM vendas v JOIN usuarios s 
     ON v.fk_usuario_venda = s.id_usuario
     JOIN tipopag t 
     ON s.id_usuario = t.id_pag  where nome LIKE '%$pesqAll%' OR vendaTotal = :vt  OR 
                          vendaDesconto = :vd OR vendaCliente LIKE '%$pesqAll%' OR vendaTroco = :tr");
      $cmd->bindValue(":vt", $pesqAll);
      $cmd->bindValue(":vd", $pesqAll);
      $cmd->bindValue(":tr", $pesqAll);
      $cmd->execute();

     while ($res = $cmd->fetch(PDO::FETCH_OBJ)) {
       
       $this->Cell(45,10,utf8_decode($res->nome),1,0,'L');
       $this->Cell(30,10,utf8_decode($res->vendaTotal),1,0,'L');
       $this->Cell(25,10,utf8_decode($res->vendaDesconto),1,0,'L');
       $this->Cell(45,10,utf8_decode($res->vendaCliente),1,0,'L');
       $this->Cell(30,10,utf8_decode($res->pagamento),1,0,'L');
       $this->Cell(30,10,utf8_decode($res->vendaTroco),1,0,'L');
       $this->Cell(58,10,utf8_decode($res->vendaData),1,0,'L');
       
       $this->Ln();
     }
   }
}

$pdf = new Relatorio_Hvendas_pesq;
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->viewTable($conn);
$datanome = date('y/m/d');
$pdf->Output(utf8_decode('Relatório dos Hist. de Vendas - ').$datanome.'.pdf','I');


 ?>
