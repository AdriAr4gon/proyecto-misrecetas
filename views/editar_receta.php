<?php

include '../inc/header.php';

$id = $_GET['id'] ?? null;
$tipo = '';
$nombre = '';
$fecha_creacion = '';
$explicacion = '';
$dificultad = '';
$imagen = '';
$recipeUpdated = false;
$error = '';

// Asegurarse de que la conexión a la base de datos esté establecida
if (!$conn) {
    die("Error en la conexión a la base de datos");
}

if ($id) {
    $stmt = $conn->prepare('SELECT * FROM recetas WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $receta = $result->fetch_assoc();

    $tipo = $receta['tipo'];
    $nombre = $receta['nombre'];
    $fecha_creacion = $receta['fecha_creacion'];
    $explicacion = $receta['explicacion'];
    $dificultad = $receta['dificultad'];
    $imagen = $receta['imagen'];

    // Obtén todos los posibles tipos de recetas de la base de datos
    $stmt = $conn->prepare('SELECT DISTINCT tipo FROM recetas');
    $stmt->execute();
    $result = $stmt->get_result();
    $tipos = $result->fetch_all(MYSQLI_ASSOC);

    // Haz lo mismo para la dificultad
    $stmt = $conn->prepare('SELECT DISTINCT dificultad FROM recetas');
    $stmt->execute();
    $result = $stmt->get_result();
    $dificultades = $result->fetch_all(MYSQLI_ASSOC);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo = $_POST["tipo"];
    $nombre = $_POST["nombre"];
    $fecha_creacion = $_POST["fecha_creacion"];
    $explicacion = $_POST["explicacion"];
    $dificultad = $_POST["dificultad"] ?? 'No se ha especificado la dificultad';

    $target_dir = "../uploads/";
    if (empty($_FILES['imagen']['name'])) {
        $imagen = $imagen ?: 'img/imagen_predeterminada.svg';
    } else {
        $imagen = basename($_FILES["imagen"]["name"]);
        $target_file = $target_dir . $imagen;
        if (!move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
            $error = "Lo siento, hubo un error subiendo tu archivo: " . $_FILES["imagen"]["error"];
        }
    }

    if (empty($error)) {
        if ($id) {
            $sql = "UPDATE recetas SET tipo = ?, nombre = ?, fecha_creacion = ?, imagen = ?, dificultad = ?, explicacion = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssi", $tipo, $nombre, $fecha_creacion, $imagen, $dificultad, $explicacion, $id);
        } else {
            $sql = "INSERT INTO recetas (tipo, nombre, fecha_creacion, imagen, dificultad, explicacion) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $tipo, $nombre, $fecha_creacion, $imagen, $dificultad, $explicacion);
        }

        if ($stmt->execute()) {
            $recipeUpdated = true;
            // Usar la ruta absoluta
            header("Location: misrecetas.php");
            exit;
        } else {
            $error = "Error al actualizar receta: " . $stmt->error;
        }
    }
}

?>


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center">Editar receta</h2>
                    <?php if ($error) : ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php elseif ($recipeUpdated) : ?>
                        <div class="alert alert-success">Receta actualizada con éxito</div>
                    <?php endif; ?>
                    <form action="editar_receta.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <div class="form-group">
                            <label for="tipo">Tipo de receta</label>
                            <select name="tipo" id="tipo" class="form-control" required>
                                <option value="">Selecciona el tipo de receta</option>
                                <?php foreach ($tipos as $tipo_receta) : ?>
                                    <option value="<?php echo $tipo_receta['tipo']; ?>" <?php echo $tipo == $tipo_receta['tipo'] ? 'selected' : ''; ?>>
                                        <?php echo $tipo_receta['tipo']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre de la receta</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre de la receta" value="<?php echo $nombre; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="fecha_creacion">Fecha de creación</label>
                            <input type="date" name="fecha_creacion" id="fecha_creacion" class="form-control" value="<?php echo $fecha_creacion; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="imagen">Imagen</label>
                            <label for="imagen" id="dropzone" class="dropzone">Haz click aquí para seleccionar la imagen</label>
                            <input type="file" name="imagen" id="imagen" class="form-control-file" style="display: none;">
                            <?php if ($imagen && file_exists($_SERVER['DOCUMENT_ROOT'] . "/uploads/" . $imagen)) : ?>
                                <img src="/uploads/<?php echo $imagen; ?>" alt="Imagen de la receta" style="width: 100%; height: auto;">
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="dificultad">Dificultad de la receta</label>
                            <select name="dificultad" id="dificultad" class="form-control">
                                <option value="">Selecciona la dificultad de la receta</option>
                                <?php foreach ($dificultades as $dificultad_receta) : ?>
                                    <option value="<?php echo $dificultad_receta['dificultad']; ?>" <?php echo $dificultad == $dificultad_receta['dificultad'] ? 'selected' : ''; ?>>
                                        <?php echo $dificultad_receta['dificultad']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="explicacion">Explicación</label>
                            <textarea name="explicacion" id="explicacion" class="form-control" placeholder="Explicación" required><?php echo $explicacion; ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../js/main.js"></script>
<?php include '../inc/footer.php'; ?>
</body>

</html>