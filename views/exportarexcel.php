<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conexión a la base de datos


try {
    $conn = new PDO('mysql:host=localhost;dbname=misrecetas', 'root', '');
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Verificar si se proporcionó un ID de receta
if (isset($_GET["id"])) {
    $id = $_GET["id"];  // Obtener el ID de la receta de la URL
    $stmt = $conn->prepare("SELECT * FROM recetas WHERE id = ?");
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $filename = "receta_" . $id . ".xlsx";
} else {
    $result = $conn->query("SELECT * FROM recetas ORDER BY nombre");
    $filename = "recetas.xlsx";
}

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Añadir los títulos de las columnas
$sheet->setCellValue('A1', 'Nombre');
$sheet->setCellValue('B1', 'Tipo');
$sheet->setCellValue('C1', 'Fecha de creación');
$sheet->setCellValue('D1', 'Dificultad');
$sheet->setCellValue('E1', 'Explicación');

// Añadir las recetas
$row = 2;
foreach ($result as $receta) {
    $sheet->setCellValue('A' . $row, $receta['nombre']);
    $sheet->setCellValue('B' . $row, $receta['tipo']);
    $sheet->setCellValue('C' . $row, $receta['fecha_creacion']);
    $sheet->setCellValue('D' . $row, $receta['dificultad']);
    $sheet->setCellValue('E' . $row, $receta['explicacion']);
    $row++;
}

$writer = new Xlsx($spreadsheet);

// Preparar las cabeceras para la descarga
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer->save('php://output');
exit;
