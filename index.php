<?php
include 'inc/headerindex.php';

if (!isset($_SESSION['loggedin'])) {
    // El usuario no está logueado, redirigir a login.php
    header("Location: ./views/login.php");
    exit();
}


try {
    $conexion = new PDO('mysql:host=localhost;dbname=misrecetas', 'root', '');

    // Consulta para obtener las recetas
    $consulta = $conexion->query("SELECT * FROM recetas");

    // Almacenar las recetas en un array
    $recetas = $consulta->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>


<body>
    <!-- Navbar -->
    <!-- ... -->

    <div class="jumbotron text-center" style="background-color: #f9f9f9; margin: 0;">
        <h1 class="display-4">¡Bienvenido a Mis Recetas!</h1>
        <p class="lead">Aquí encontrarás las mejores recetas para cocinar en casa.</p>
        <hr class="my-4">
        <p>¿Quieres aprender a cocinar nuevas recetas? Entra y descubre y añade nuevas recetas cada día.</p>
        <a class="btn btn-primary btn-lg" href="views/misrecetas.php" role="button">Ver recetas</a>
    </div>

    <!-- Imagen -->
    <div class="text-center">
        <a href="./views/misrecetas.php"><img src="img/index1.jpg" class="rounded img-fluid w-100" style="object-fit: cover; height: 370px;" alt="Imagen de recetas"></a>
    </div>
    <footer style="background-color: #f8f9fa; padding: 0; margin-top: 0;">
        <div class="container text-center margin: 0; padding: 0;">
            <p style="margin-bottom: 0;">Web creada por Adrián Aragón</p>
        </div>
    </footer>
    <script src="./js/script.js"></script>

</body>

</html>