<?php
require '../vendor/autoload.php';

use Dompdf\Dompdf;

// Conexión a la base de datos

try {
    $conn = new PDO('mysql:host=localhost;dbname=misrecetas', 'root', '');
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];  // Obtener el ID de la receta de la URL
    $stmt = $conn->prepare("SELECT * FROM recetas WHERE id = ?");
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $receta = $stmt->fetch(PDO::FETCH_ASSOC);
    $filename = "receta_" . preg_replace('/[^A-Za-z0-9\-]/', '', $receta['nombre']) . ".pdf";  // Usar el nombre de la receta para el nombre del archivo

    // Generar el contenido del PDF para una sola receta
    $html = '<h1>Receta</h1>';
    $html .= '<h2>' . $receta['nombre'] . '</h2>';
    $html .= '<p>Tipo: ' . $receta['tipo'] . '</p>';
    $html .= '<p>Fecha de creación: ' . $receta['fecha_creacion'] . '</p>';
    $html .= '<p>Dificultad: ' . $receta['dificultad'] . '</p>';
    $html .= '<p>Explicación: ' . $receta['explicacion'] . '</p>';
} else {
    $stmt = $conn->query("SELECT * FROM recetas ORDER BY nombre");
    $filename = "recetas.pdf";

    // Generar el contenido del PDF para todas las recetas
    $html = '<h1>Recetas</h1>';
    while ($receta_row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $html .= '<h2>' . $receta_row['nombre'] . '</h2>';
        $html .= '<p>Tipo: ' . $receta_row['tipo'] . '</p>';
        $html .= '<p>Fecha de creación: ' . $receta_row['fecha_creacion'] . '</p>';
        $html .= '<p>Dificultad: ' . $receta_row['dificultad'] . '</p>';
        $html .= '<p>Explicación: ' . $receta_row['explicacion'] . '</p>';
    }
}

$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// Renderizar el PDF
$dompdf->render();

// Preparar las cabeceras para la descarga
header('Content-Type: application/pdf');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

// Enviar el PDF al navegador
echo $dompdf->output();
exit;
