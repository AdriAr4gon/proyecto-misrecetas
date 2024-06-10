function showRegisterForm() {
  var loginForm = document.getElementById("loginForm");
  var registerForm = document.getElementById("registerForm");
  loginForm.classList.remove("show");
  setTimeout(function () {
    loginForm.style.display = "none";
    registerForm.style.display = "block";
    setTimeout(function () {
      registerForm.classList.add("show");
    }, 50);
  }, 500);
}

function showLoginForm() {
  var loginForm = document.getElementById("loginForm");
  var registerForm = document.getElementById("registerForm");
  registerForm.classList.remove("show");
  setTimeout(function () {
    registerForm.style.display = "none";
    loginForm.style.display = "block";
    setTimeout(function () {
      loginForm.classList.add("show");
    }, 50);
  }, 500);
}

window.onload = function () {
  var successMessage = document.getElementById("successMessage");
  var failureMessage = document.getElementById("failureMessage");

  if (successMessage && successMessage.classList.contains("show")) {
    setTimeout(function () {
      successMessage.classList.remove("show");
      successMessage.classList.add("hide");
    }, 3000);
  }

  if (failureMessage && failureMessage.classList.contains("show")) {
    setTimeout(function () {
      failureMessage.classList.remove("show");
      failureMessage.classList.add("hide");
    }, 3000);
  }

  var fecha = new Date(); //Fecha actual
  var mes = fecha.getMonth() + 1; //obteniendo mes
  var dia = fecha.getDate(); //obteniendo dia
  var ano = fecha.getFullYear(); //obteniendo año
  if (dia < 10) dia = "0" + dia; //agrega cero si el menor de 10
  if (mes < 10) mes = "0" + mes; //agrega cero si el menor de 10
  document.getElementById("fecha_creacion").value = ano + "-" + mes + "-" + dia;

  var dropzone = document.getElementById("dropzone");
  var fileInput = document.getElementById("imagen");

  dropzone.addEventListener("click", function () {
    fileInput.click();
  });

  dropzone.addEventListener("dragover", function (e) {
    e.preventDefault();
    this.style.backgroundColor = "#eee";
  });

  dropzone.addEventListener("dragleave", function (e) {
    this.style.backgroundColor = "white";
  });

  dropzone.addEventListener("drop", function (e) {
    e.preventDefault();
    this.style.backgroundColor = "white";
    fileInput.files = e.dataTransfer.files;
  });

  fileInput.addEventListener("change", function () {
    var file = this.files[0];
    if (file) {
      dropzone.innerHTML = file.name;
    }
  });

  // Aquí es donde añadimos el código para mostrar el mensaje de éxito
  document
    .getElementById("registerForm")
    .addEventListener("submit", function (event) {
      event.preventDefault();
      // Aquí puedes agregar el código para enviar los datos del formulario al servidor
      // ...

      // Muestra el mensaje de éxito
      var submitSuccessMessage = document.getElementById("success-message"); // Cambiado a "submitSuccessMessage"
      submitSuccessMessage.classList.add("show");

      // Desvanece el mensaje de éxito después de 3 segundos
      setTimeout(function () {
        submitSuccessMessage.classList.remove("show");
        submitSuccessMessage.classList.add("hide");
      }, 3000);
    });
};

document.getElementById("ordenar").addEventListener("change", function () {
  document.getElementById("formOrdenar").submit();
});

function confirmarEliminacion() {
  return confirm("¿Estás seguro/a que quieres eliminar esta receta?");
}
