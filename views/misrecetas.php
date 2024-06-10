<!--  Header --->
<?php include '../inc/header.php'; ?>

<div class="container text-center p-5">
    <h1 class="titulo-recetas">MIS RECETAS</h1>
</div>

<?php
$ordenar = isset($_GET['ordenar']) ? $_GET['ordenar'] : 'nombre';
?>

<!-- Formulario de filtro -->
<div class="container filtro">
    <form action="misrecetas.php" method="get" id="formOrdenar">
        <label for="ordenar">Ordenar por:</label>
        <select name="ordenar" id="ordenar">
            <option value="nombre" <?php echo $ordenar == 'nombre' ? 'selected' : ''; ?>>Nombre</option>
            <option value="tipo" <?php echo $ordenar == 'tipo' ? 'selected' : ''; ?>>Tipo de plato</option>
            <option value="fecha_creacion" <?php echo $ordenar == 'fecha_creacion' ? 'selected' : ''; ?>>Fecha</option>
            <option value="dificultad" <?php echo $ordenar == 'dificultad' ? 'selected' : ''; ?>>Dificultad</option>
        </select>
    </form>
</div>

<div class="container">
    <?php
    $result = $conn->query("SELECT * FROM recetas ORDER BY $ordenar");
    $count = 0;
    ?>

    <!-- Mostrar recetas -->
    <div class="container">
        <?php $count = 0; ?>
        <?php while ($receta = $result->fetch_assoc()) : ?>
            <?php if ($count % 4 == 0) : ?>
                <?php if ($count != 0) : ?>
    </div>
<?php endif; ?>
<div class="row mb-5">
<?php endif; ?>
<div class="col-md-3">
    <div class="p-1"> <!-- Div adicional con padding -->
        <div class="card tarjeta" style="width: 100%;"> <!-- Cambiado el ancho a 100% -->
            <?php if (empty($receta["imagen"]) || $receta["imagen"] == "img/imagen_predeterminada.svg") : ?>
                <img src="../img/imagen_predeterminada.svg" class="card-img-top img-fluid" alt="Imagen de la receta" style="height: 200px; object-fit: cover;">
            <?php else : ?>
                <img src="../uploads/<?php echo htmlspecialchars($receta["imagen"]); ?>" class="card-img-top img-fluid" alt="Imagen de la receta" style="height: 200px; object-fit: cover;">
            <?php endif; ?>
            <div class="card-body">
                <h4 class="card-title"><?php echo htmlspecialchars($receta["nombre"]); ?></h4>
                <h6 class="card-text"><?php echo htmlspecialchars($receta["tipo"]); ?></h6>
                <p class="card-text"><?php echo htmlspecialchars($receta["fecha_creacion"]); ?></p>
                <p class="card-text"><?php echo htmlspecialchars($receta["dificultad"]); ?></p>
            </div>
            <div class="d-flex justify-content-between p-1"> <!-- Añadido d-flex y justify-content-between -->
                <a href="recetas.php?id=<?php echo htmlspecialchars($receta["id"]); ?>" class="btn btn-primary flex-fill mr-1 btn-sm">Ver Receta</a> <!-- Cambiado flex-grow-1 a flex-fill, añadido mr-1 y btn-sm -->
                <a href="editar_receta.php?id=<?php echo htmlspecialchars($receta["id"]); ?>" class="btn btn-secondary flex-fill mx-1 btn-sm">Editar</a> <!-- Cambiado flex-grow-1 a flex-fill, añadido mx-1 y btn-sm -->
                <a href="eliminar_receta.php?id=<?php echo htmlspecialchars($receta["id"]); ?>" class="btn btn-danger flex-fill ml-1 btn-sm" onclick="return confirmarEliminacion();"><i class="fa fa-trash"></i></a> <!-- Cambiado flex-grow-1 a flex-fill, añadido ml-1, btn-sm, el icono de la papelera y la llamada a la función JavaScript -->
            </div>
        </div>
    </div>
</div>
<?php $count++; ?>
<?php endwhile; ?>
</div> <!-- Cierre de la última fila -->
</div>

<!-- Botón para añadir receta -->
<div class="container text-center">
    <a href="añadir_receta.php" class="btn btn-primary">Añadir Receta</a>
</div>

<?php include '../inc/footer.php'; ?>

</body>

</html>