<?php
// Conexión a la base de datos
include '../inc/header.php';

// Comprueba si el ID de la receta está establecido
if (isset($_GET['id'])) {
    // Prepara la consulta SQL
    $stmt = $conn->prepare("DELETE FROM recetas WHERE id = ?");

    // Vincula el ID de la receta a la consulta
    $stmt->bind_param("i", $_GET['id']);

    // Ejecuta la consulta
    if ($stmt->execute()) {
        // Redirige al usuario a la página de recetas si la eliminación fue exitosa
        header("Location: misrecetas.php");
    } else {
        // Muestra un mensaje de error si algo salió mal
        echo "Error: " . $stmt->error;
    }

    // Cierra la consulta
    $stmt->close();
} else {
    // Redirige al usuario a la página de recetas si no se proporcionó un ID de receta
    header("Location: misrecetas.php");
}

// Cierra la conexión a la base de datos
$conn->close();
