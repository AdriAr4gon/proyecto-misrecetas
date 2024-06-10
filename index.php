<?php
include 'inc/headerindex.php';

if (!isset($_SESSION['loggedin'])) {
    // El usuario no está logueado, redirigir a login.php
    header("Location: ./views/login.php");
    exit();
}


// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'misrecetas');

// Consulta para obtener las recetas
$resultado = $conexion->query("SELECT * FROM recetas");

// Almacenar las recetas en un array
$recetas = $resultado->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a Mis Recetas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <!-- Navbar -->
    <!-- ... -->

    <!-- Jumbotron -->
    <div class="jumbotron text-center">
        <h1 class="display-4">¡Bienvenido a Mis Recetas!</h1>
        <p class="lead">Aquí encontrarás las mejores recetas para cocinar en casa.</p>
        <hr class="my-4">
        <p>¿Quieres aprender a cocinar nuevas recetas? Entra y descubre y añade nuevas recetas cada día.</p>
        <a class="btn btn-primary btn-lg" href="views/misrecetas.php" role="button">Ver recetas</a>
    </div>

    <!-- Imagen -->
    <div class="text-center">
        <img src="img/index.png" class="rounded img-fluid w-50" alt="Imagen de recetas">
    </div>

    <!-- Footer -->
    <!-- ... -->
</body>

</html>