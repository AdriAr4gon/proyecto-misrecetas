<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "misrecetas";

$userExists = false;
try {
  // Crear conexión con PDO para mayor seguridad
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // Configurar PDO para lanzar excepciones en caso de error
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Connection failed: " . $e->getMessage());
}

$registered = false;
$loginFailed = false;


// Verificar si se está realizando una solicitud de registro
if (isset($_POST['registerUsername']) && isset($_POST['registerPassword']) && isset($_POST['registerEmail'])) {
  $registerUsername = $_POST['registerUsername'];
  $registerPassword = password_hash($_POST['registerPassword'], PASSWORD_BCRYPT); // Hashear la contraseña
  $registerEmail = $_POST['registerEmail'];

  // Consulta SQL para verificar si el usuario ya existe
  $stmt = $conn->prepare("SELECT * FROM usuarios WHERE username = ? OR email = ?");
  $stmt->execute([$registerUsername, $registerEmail]);

  if ($stmt->fetch(PDO::FETCH_ASSOC)) {
    // El usuario ya existe, mostrar un mensaje de error
    $userExists = true;
  } else {
    // El usuario no existe, proceder a registrarlo
    $stmt = $conn->prepare("INSERT INTO usuarios (username, password, email) VALUES (?, ?, ?)");
    $stmt->execute([$registerUsername, $registerPassword, $registerEmail]);

    if ($stmt->rowCount() > 0) {
      // Redirigir a la misma página para evitar el reenvío del formulario
      header("Location: login.php?registered=true");
      exit;
    } else {
      echo "Error: " . $stmt->errorInfo()[2];
    }
  }
}

if (isset($_GET['registered']) && $_GET['registered'] === 'true') {
  $registered = true;
}

// Verificar si se está realizando una solicitud de inicio de sesión
if (isset($_POST['loginUsername']) && isset($_POST['loginPassword'])) {
  $loginUsername = $_POST['loginUsername'];
  $loginPassword = $_POST['loginPassword'];

  // Consulta SQL para verificar si el usuario existe en la base de datos
  $stmt = $conn->prepare("SELECT * FROM usuarios WHERE username = ?");
  $stmt->execute([$loginUsername]);

  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($user) {
    // Verificar la contraseña
    if (password_verify($loginPassword, $user['password'])) {
      // El usuario existe y la contraseña es correcta, establecer la variable de sesión y redirigir a index.php
      $_SESSION['loggedin'] = true;
      $_SESSION['username'] = $loginUsername; // Almacenar el nombre de usuario en la sesión
      header("Location: ../index.php");
      exit();
    } else {
      $loginFailed = true;
    }
  } else {
    // El usuario no existe, mostrar un mensaje de error
    $loginFailed = true;
  }
}
$conn = null; // Cerrar la conexión
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mis recetas</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
  <div id="successMessage" class="fade-message <?php echo $registered ? 'show' : ''; ?>" style="position: fixed; top: 0; width: 100%; z-index: 100;">
    <div class="alert alert-success text-center" role="alert">
      ¡Te has registrado con éxito!
    </div>
  </div>
  <div id="userExistsMessage" class="fade-message <?php echo $userExists ? 'show' : ''; ?>" style="position: fixed; top: 0; width: 100%; z-index: 100;">
    <div class="alert alert-danger text-center" role="alert">
      El usuario ya existe.
    </div>
  </div>
  <div id="failureMessage" class="fade-message <?php echo $loginFailed ? 'show' : ''; ?>" style="position: fixed; top: 0; width: 100%; z-index: 100;">
    <div class="alert alert-danger text-center" role="alert">
      Este usuario no existe o la contraseña es incorrecta.
    </div>
  </div>
  <section class="vh-100">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 text-black">

          <div class="px-5">
            <i class="fas fa-crow fa-2x me-3 pt-5 mt-4" style="color: #709085;"></i>
            <span class="h1 fw-bold mb-0 titulo"><strong>Mis Recetas 🍳</strong></span>
          </div>

          <div class="d-flex align-items-start h-custom-2 px-5 mt-5 pt-5" style="justify-content: flex-start;">

            <form id="loginForm" class="fade show" action="login.php" method="post" style="width: 23rem;">
              <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Iniciar sesión</h3>

              <div class="form-outline mb-4">
                <input type="text" id="loginUsername" name="loginUsername" class="form-control form-control-lg" required />
                <label class="form-label" for="loginUsername">Usuario</label>
              </div>

              <div class="form-outline mb-4">
                <input type="password" id="loginPassword" name="loginPassword" class="form-control form-control-lg" required />
                <label class="form-label" for="loginPassword">Contraseña</label>
              </div>

              <div class="pt-1 mb-4">
                <button class="btn btn-info btn-lg btn-block" type="submit">Iniciar sesión</button>
              </div>

              <p>¿No tienes una cuenta? <a href="#!" class="link-info" onclick="showRegisterForm()">Regístrate aquí</a></p>
            </form>

            <form id="registerForm" class="fade" action="login.php" method="post" style="width: 23rem; display: none;">
              <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Registro</h3>

              <div class="form-outline mb-4">
                <input type="email" id="registerEmail" name="registerEmail" class="form-control form-control-lg" required />
                <label class="form-label" for="registerEmail">Correo electrónico</label>
              </div>

              <div class="form-outline mb-4">
                <input type="text" id="registerUsername" name="registerUsername" class="form-control form-control-lg" required />
                <label class="form-label" for="registerUsername">Usuario</label>
              </div>

              <div class="form-outline mb-4">
                <input type="password" id="registerPassword" name="registerPassword" class="form-control form-control-lg" required />
                <label class="form-label" for="registerPassword">Contraseña</label>
              </div>

              <div class="pt-1 mb-4">
                <button class="btn btn-info btn-lg btn-block" type="submit">Registrarse</button>
              </div>

              <p>¿Ya tienes una cuenta? <a href="#!" class="link-info" onclick="showLoginForm()">Iniciar sesión</a></p>
            </form>

          </div>

        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
          <img src="../img/login.svg" alt="Login image" class="w-100 vh-100 styled-image" style="object-fit: cover; object-position: left;">
        </div>
      </div>
    </div>
  </section>

  <script src="../js/script.js"></script>

</body>

</html>