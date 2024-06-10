<?php
include '../inc/header.php';

$id = $_GET['id'] ?? null;
$tipo = '';
$nombre = '';
$fecha_creacion = '';
$explicacion = '';
$dificultad = '';
$imagen = '';
$recipeAdded = false;

// Asegurarse de que la conexión a la base de datos esté establecida
if ($conn) {
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
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $tipo = $_POST["tipo"];
        $nombre = $_POST["nombre"];
        $fecha_creacion = $_POST["fecha_creacion"];
        $explicacion = $_POST["explicacion"];

        if (empty($_POST['dificultad'])) {
            $dificultad = 'No se ha especificado la dificultad';
        } else {
            $dificultad = $_POST['dificultad'];
        }


        $target_dir = "../uploads/";
        if (empty($_FILES['imagen']['name'])) {
            $imagen = 'img/imagen_predeterminada.svg';
        } else {
            $imagen = basename($_FILES["imagen"]["name"]);
            $target_file = $target_dir . $imagen;
            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
                echo "El archivo " . $imagen . " ha sido subido.";
            } else {
                echo "Lo siento, hubo un error subiendo tu archivo.";
                echo "Error: " . $_FILES["imagen"]["error"];
            }
        }

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
            $recipeAdded = true;
            // Redirigir al usuario a index.php
            header('Location: ../index.php');
        } else {
            echo "Error al añadir receta: " . $stmt->error;
        }
    }
}
?>



<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center">Añadir receta</h2>
                    <form action="añadir_receta.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="tipo">Tipo de receta</label>
                            <select name="tipo" id="tipo" class="form-control" required>
                                <option value="">Selecciona el tipo de receta</option>
                                <option value="Plato principal">Plato principal</option>
                                <option value="Entrante">Entrante</option>
                                <option value="Postre">Postre</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre de la receta</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre de la receta" required>
                        </div>
                        <div class="form-group">
                            <label for="fecha_creacion">Fecha de creación</label>
                            <input type="date" name="fecha_creacion" id="fecha_creacion" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="imagen">Imagen</label>
                            <div id="dropzone" style="border: 2px dashed #aaa; padding: 10px; text-align: center;">Arrastra y suelta la imagen aquí o haz click para seleccionar el archivo</div>
                            <input type="file" name="imagen" id="imagen" class="form-control-file" style="display: none;">
                        </div>
                        <div class="form-group">
                            <label for="dificultad">Dificultad de la receta</label>
                            <select name="dificultad" id="dificultad" class="form-control">
                                <option value="">Selecciona la dificultad de la receta</option>
                                <option value="Muy fácil">Muy fácil</option>
                                <option value="Fácil">Fácil</option>
                                <option value="Normal">Normal</option>
                                <option value="Difícil">Difícil</option>
                                <option value="Muy difícil">Muy difícil</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="explicacion">Explicación</label>
                            <textarea name="explicacion" id="explicacion" class="form-control" placeholder="Explicación" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Añadir receta</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../inc/footer.php'; ?>
</body>

</html>