<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    // El usuario no está logueado, redirigir a login.php
    header("Location: ./views/login.php");
    exit();
}

$host = "localhost";
$db   = "misrecetas";
$user = "root";
$pass = "";

// Conexión a la base de datos
$conn = new mysqli($host, $user, $pass, $db);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener todas las recetas
$sql = "SELECT * FROM recetas";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Recetas</title>
    <link rel="icon" href="data:,">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" style="color: #0087F7;" href="index.php">Mis Recetas</a>
        <button class="navbar-toggler" type="button" id="navbarToggler">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="views/misrecetas.php">Recetas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="views/exportar.php">Exportar</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <?php
                    if (isset($_SESSION['username'])) { // Si el usuario ha iniciado sesión
                        echo '<a class="nav-link" href="#" style="color: black;">' . htmlspecialchars($_SESSION['username']) . '</a>'; // Muestra el nombre del usuario en color negro
                    } else {
                        echo '<a class="nav-link" href="views/login.php">Iniciar sesión</a>'; // Si no, muestra el enlace para iniciar sesión
                    }
                    ?>
                </li>
                <?php
                if (isset($_SESSION['username'])) { // Si el usuario ha iniciado sesión
                    echo '<li class="nav-item"><a class="nav-link" href="views/logout.php"><i class="fas fa-power-off"></i></a></li>'; // Muestra el icono de cierre de sesión
                }
                ?>
            </ul>
        </div>
    </nav>