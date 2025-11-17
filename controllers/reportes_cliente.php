<?php

require_once '../fpdf/fpdf.php';
require_once '../config/conexion.php'; // Llamar al archivo de conexión con PDO

class PDF extends FPDF
{
   function Header()
   {
      $pdo = (new Conexion())->conectar();
      $stmt = $pdo->prepare("SELECT * FROM clientes");
      $stmt->execute();
      $dato_info = $stmt->fetch(PDO::FETCH_OBJ);
      
     
      $this->Cell(180);
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(96, 10, utf8_decode("Culiacán, Sinaloa: ".(date('d/m/Y')) ), 0, 0, '', 0);
      $this->Ln(5);
      
      $this->Cell(180);
      $this->Cell(59, 10, utf8_decode("Hora: " .(date("g:i:s:A"))), 0, 0, '', 0);
      $this->Ln(6);

      $this->SetTextColor(0, 95, 189);
      $this->Cell(100);
      $this->SetFont('Arial', 'B', 20);
      $this->Cell(100, 10, utf8_decode("Estética Unisex Julieta"), 0, 1, 'C', 0);
            
      $this->SetTextColor(0, 95, 189);
      $this->Cell(100);
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(100, 10, utf8_decode("Listado de Clientes del Sistema JulySystem"), 0, 1, 'C', 0);
      $this->Ln(7);
      
      $this->SetFillColor(125, 173, 221);
      $this->SetTextColor(0, 0, 0);
      $this->SetDrawColor(163, 163, 163);
      $this->SetFont('Arial', 'B', 8);
      
      $this->Cell(8, 6, '#', 1, 0, 'C', 1);
      $this->Cell(11, 6, 'IDBD', 1, 0, 'C', 1);
      $this->Cell(30, 6, 'RFC', 1, 0, 'C', 1);
      $this->Cell(30, 6, 'CURP', 1, 0, 'C', 1);
      $this->Cell(20, 6, 'NOMBRE', 1, 0, 'C', 1);
      $this->Cell(25, 6, 'APELLIDO PAT', 1, 0, 'C', 1);
      $this->Cell(25, 6, 'APELLIDO MAT', 1, 0, 'C', 1);
      $this->Cell(60, 6, 'DOMICILIO', 1, 0, 'C', 1);
      $this->Cell(40, 6, 'EMAIL', 1, 0, 'C', 1);
      $this->Cell(30, 6, 'TELEFONO', 1, 1, 'C', 1);
   }

   function Footer()
   {
      $this->SetY(-15);
      $this->SetFont('Arial', 'I', 8);
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
      $this->SetY(-15);
      $this->Cell(540, 10, utf8_decode(date('d/m/Y')), 0, 0, 'C');
   }
}

$pdf = new PDF();
$pdf->AddPage("landscape");
$pdf->AliasNbPages();
$pdf->SetFont('Arial', '', 7);
$pdf->SetDrawColor(163, 163, 163);

$pdo = (new Conexion())->conectar();
$sql = "SELECT idclie, RFC_clie, Curp, nombre_Clie, ApePatClie, ApeMatClie, DomiClie, Correo_Clie, TelClie FROM clientes";
        
$stmt = $pdo->prepare($sql);
$stmt->execute();

$i = 0;
while ($datos_reporte = $stmt->fetch(PDO::FETCH_OBJ)) {
   $i++;
   $pdf->Cell(8, 5, $i, 1, 0, 'C', 0);
   $pdf->Cell(11, 5, utf8_decode($datos_reporte->idclie), 1, 0, 'C', 0);
   $pdf->Cell(30, 5, utf8_decode($datos_reporte->RFC_clie), 1, 0, 'C', 0);
   $pdf->Cell(30, 5, utf8_decode($datos_reporte->Curp), 1, 0, 'C', 0);
   $pdf->Cell(20, 5, utf8_decode($datos_reporte->nombre_Clie), 1, 0, 'C', 0);
   $pdf->Cell(25, 5, utf8_decode($datos_reporte->ApePatClie), 1, 0, 'C', 0);
   $pdf->Cell(25, 5, utf8_decode($datos_reporte->ApeMatClie), 1, 0, 'C', 0);
   $pdf->Cell(60, 5, utf8_decode($datos_reporte->DomiClie), 1, 0, 'C', 0);
   $pdf->Cell(40, 5, utf8_decode($datos_reporte->Correo_Clie), 1, 0, 'C', 0);
   $pdf->Cell(30, 5, utf8_decode($datos_reporte->TelClie), 1, 1, 'C', 0);
}

$pdf->Output('Reporte de usuarios.pdf', 'I');
?>
