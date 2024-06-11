<?php include '../inc/header.php'; ?>

<div class="container mt-5">
    <?php
    $id = $_GET["id"]; // Obtener el ID de la receta de la URL

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

    // Obtener la receta de la base de datos
    $sql = "SELECT * FROM recetas WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $receta = $result->fetch_assoc();
    ?>

    <!-- Mostrar la información de la receta -->
    <div class="card">
        <div class="card-body">
            <h1 class="card-title"><?php echo $receta["nombre"]; ?></h1>
            <p class="card-subtitle mb-2 text-muted"><?php echo $receta["fecha_creacion"]; ?></p>
            <div class="d-flex justify-content-center">
                <?php if (empty($receta["imagen"]) || $receta["imagen"] == "img/imagen_predeterminada.svg") : ?>
                    <img class="img-fluid" src="../img/imagen_predeterminada.svg" alt="Imagen de la receta" style="max-width: 500px;">
                <?php else : ?>
                    <img class="img-fluid" src="../uploads/<?php echo $receta["imagen"]; ?>" alt="Imagen de la receta" style="max-width: 500px;">
                <?php endif; ?>
            </div>
            <p class="card-text mt-3"><strong>Dificultad:</strong> <?php echo $receta["dificultad"]; ?></p>
            <p class="card-text"><strong>Explicación:</strong> <?php echo nl2br($receta["explicacion"]); ?></p>
            <a href="editar_receta.php?id=<?php echo $id; ?>" class="btn btn-primary">Editar</a>
            <!-- Botones de exportación -->
            <a class="btn btn-success" href="exportarexcel.php?id=<?php echo $id; ?>" role="button">Exportar a Excel</a>
            <a class="btn btn-warning" href="exportarpdf.php?id=<?php echo $id; ?>" role="button">Exportar a PDF</a>
            <a href="mailto:?subject=<?php echo rawurlencode('Mira esta receta que he encontrado en www.misrecetas.com'); ?>&body=<?php echo rawurlencode("Hola, mira esta receta que he encontrado en www.misrecetas.com\n\nNombre de la receta: " . $receta['nombre'] . "\nDificultad: " . $receta['dificultad'] . "\nExplicación: " . str_replace('<br />', "\n", nl2br($receta['explicacion'])) . "\n\nHaz click aquí para entrar en nuestra página y registrarte. Podrás ver esta y muchas recetas más: http://localhost/recetas.php?id=" . $id); ?>" class="btn btn-primary">Compartir</a>
        </div>
    </div>

    <?php include '../inc/footer.php'; ?>
    </body>

    </html>