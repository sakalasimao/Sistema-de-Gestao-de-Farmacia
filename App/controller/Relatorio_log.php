<?php

include_once 'usuario.php';
include_once '../model/Connection.php';
require '../../Library/fpdf184/fpdf.php';
$user = new Usuario;
$conn = new Connection;

/**
 *
 */
class Relatorio_log extends FPDF
{
  function header(){
    $this->Image('../view/images/logo-green.png',10,6,-600,0,'','http://localhost/SistemadeFarmacia/App/view/AdminAtividade.php');
    $this->SetFont('Arial','B',14);
    $this->Cell(276,5, utf8_decode('Farmácia Maria Filomena'),0,0,'C');
    $this->Ln();
    $this->SetFont('Times','',12);
    $this->Cell(276,10, utf8_decode('Endereço: Sequele, Rua 01, Bloco 02'),0,0,'C');
    $this->Ln(5);
    $this->Cell(276,10, utf8_decode('NIF: 5416820451'),0,0,'C');
    $this->Ln();
    $this->SetFont('Arial','B',13);
    $this->Cell(100,30, utf8_decode('Relatório dos Atividades'),0,0,'C');
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
     $this->Cell(45,10,'Nome',1,0,'C');
     $this->Cell(35,10,'Acesso',1,0,'C');
     $this->Cell(55,10,'Tipo',1,0,'C');
     $this->Cell(66,10,utf8_decode('Descrição'),1,0,'C');
     $this->Cell(50,10,'Criado',1,0,'C');
     $this->Ln();

   }

   function viewTable($conn){
     $this->SetFont('Times','', 12);
     $cmd = $conn->pdo->query("SELECT nome, nome_nivel, tipo, descricao, criandoLogger FROM logger l JOIN usuarios u ON
     l.fk_usuario_logger = u.id_usuario JOIN nivel n ON u.fk_acesso_usuario = n.id_nivel order by id_log desc");

     while ($res = $cmd->fetch(PDO::FETCH_OBJ)) {
        $this->Cell(30);
       $this->Cell(45,10,utf8_decode($res->nome),1,0,'L');
       $this->Cell(35,10,utf8_decode($res->nome_nivel),1,0,'L');
       $this->Cell(55,10,utf8_decode($res->tipo),1,0,'L');
       $this->Cell(66,10,utf8_decode($res->descricao),1,0,'L');
       $this->Cell(50,10,utf8_decode($res->criandoLogger),1,0,'L');
       $this->Ln();
     }
   }
}

$pdf = new Relatorio_log;
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->viewTable($conn);
$datanome = date('y/m/d');
$pdf->Output(utf8_decode('Relatório de Log - ').$datanome.'.pdf','I');


 ?>
