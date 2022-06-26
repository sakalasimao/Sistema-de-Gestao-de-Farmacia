<?php

include_once 'usuario.php';
include_once '../model/Connection.php';
require '../../Library/fpdf184/fpdf.php';
$user = new Usuario;
$conn = new Connection;

/**
 *
 */
class Relatorio_itens_02 extends FPDF
{
  function header(){
    $this->Image('../view/images/logo-green.png',10,6,-600,0,'','http://localhost/SistemadeFarmacia/App/view/AdminRendimentos.php');
    $this->SetFont('Arial','B',14);
    $this->Cell(276,5, utf8_decode('Farmácia Maria Filomena'),0,0,'C');
    $this->Ln();
    $this->SetFont('Times','',12);
    $this->Cell(276,10, utf8_decode('Endereço: Sequele, Rua 01, Bloco 02'),0,0,'C');
    $this->Ln(5);
    $this->Cell(276,10, utf8_decode('NIF: 5416820451'),0,0,'C');
    $this->Ln();
    $this->SetFont('Arial','B',13);
    $this->Cell(100,30, utf8_decode('Relatório dos Produtos Mais Vendidos'),0,0,'C');
    $this->Ln(20);

  }


  function footer(){
    $this->SetY(-15);
    $this->SetFont('Arial','',9);
    $this->Cell(0,10, utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
   }

   function headerTable(){
     $this->Cell(30);
     $this->SetFont('Times','',12);
     $this->Cell(45,10,'ID',1,0,'C');
     $this->Cell(60,10,'Produto',1,0,'C');
     $this->Ln();

   }

   function viewTable($conn){
     $this->SetFont('Times','', 12);
     $cmd = $conn->pdo->query("SELECT  sum(fk_vendas_itens) as id, nomeProduto FROM itens_venda i JOIN produtos p 
     ON i.fk_produtos_itens = p.id_produto group by nomeProduto order by id desc;");

     while ($res = $cmd->fetch(PDO::FETCH_OBJ)) {
        $this->Cell(30);
       $this->Cell(45,10,utf8_decode($res->id),1,0,'L');
       $this->Cell(60,10,utf8_decode($res->nomeProduto),1,0,'L');
       $this->Ln();
     }
   }
}

$pdf = new Relatorio_itens_02;
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->viewTable($conn);
$datanome = date('y/m/d');
$pdf->Output(utf8_decode('Relatório de Produtos Mais Vendidos - ').$datanome.'.pdf','I');


 ?>
