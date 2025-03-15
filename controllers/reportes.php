<?php

require_once '../fpdf/fpdf.php';
require_once '../config/conexion.php'; // Llamar al archivo de conexión con PDO

class PDF extends FPDF
{
   function Header()
   {
      $pdo = (new Conexion())->conectar();
      $stmt = $pdo->prepare("SELECT * FROM usuarios");
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
      $this->Cell(100, 10, utf8_decode("Listado de Usuarios del Sistema JulySystem"), 0, 1, 'C', 0);
      $this->Ln(7);
      
      $this->SetFillColor(125, 173, 221);
      $this->SetTextColor(0, 0, 0);
      $this->SetDrawColor(163, 163, 163);
      $this->SetFont('Arial', 'B', 9);
      
      $this->Cell(11, 10, '#', 1, 0, 'C', 1);
      $this->Cell(11, 10, 'IDBD', 1, 0, 'C', 1);
      $this->Cell(60, 10, 'Nombre', 1, 0, 'C', 1);
      $this->Cell(50, 10, 'Apellido Paterno', 1, 0, 'C', 1);
      $this->Cell(50, 10, 'Apellido Materno', 1, 0, 'C', 1);
      $this->Cell(50, 10, 'Username', 1, 0, 'C', 1);
      $this->Cell(50, 10, 'Privilegio Asignado', 1, 1, 'C', 1);
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
$pdf->SetFont('Arial', '', 9);
$pdf->SetDrawColor(163, 163, 163);

$pdo = (new Conexion())->conectar();
$sql = "SELECT usuarios.id, usuarios.Nombre_Us ,usuarios.ApellidoPat_Us, usuarios.ApellidoMat_Us,usuarios.username, privilegios.privilegio
        FROM usuarios
        INNER JOIN privilegios ON privilegios.id_privi = usuarios.privi_id";
        
$stmt = $pdo->prepare($sql);
$stmt->execute();

$i = 0;
while ($datos_reporte = $stmt->fetch(PDO::FETCH_OBJ)) {
   $i++;
   $pdf->Cell(11, 8, $i, 1, 0, 'C', 0);
   $pdf->Cell(11, 8, utf8_decode($datos_reporte->id), 1, 0, 'C', 0);
   $pdf->Cell(60, 8, utf8_decode($datos_reporte->Nombre_Us), 1, 0, 'C', 0);
   $pdf->Cell(50, 8, utf8_decode($datos_reporte->ApellidoPat_Us), 1, 0, 'C', 0);
   $pdf->Cell(50, 8, utf8_decode($datos_reporte->ApellidoMat_Us), 1, 0, 'C', 0);
   $pdf->Cell(50, 8, utf8_decode($datos_reporte->username), 1, 0, 'C', 0);
   $pdf->Cell(50, 8, utf8_decode($datos_reporte->privilegio), 1, 1, 'C', 0);
}

$pdf->Output('Reporte de usuarios.pdf', 'I');
?>
