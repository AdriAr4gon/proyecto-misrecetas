document.addEventListener("DOMContentLoaded", function () {
  document
    .getElementById("navbarToggler")
    .addEventListener("click", function () {
      var nav = document.getElementById("navbarNav");
      if (nav.style.display === "none") {
        nav.style.display = "block";
      } else {
        nav.style.display = "none";
      }
    });

  document
    .getElementById("registerForm")
    .addEventListener("submit", function (event) {
      event.preventDefault();
      var submitSuccessMessage = document.getElementById("success-message");
      submitSuccessMessage.classList.add("show");

      setTimeout(function () {
        submitSuccessMessage.classList.remove("show");
        submitSuccessMessage.classList.add("hide");
      }, 3000);
    });

  var ano = new Date().getFullYear();
  var mes = ("0" + (new Date().getMonth() + 1)).slice(-2);
  var dia = ("0" + new Date().getDate()).slice(-2);
  document.getElementById("fecha_creacion").value = ano + "-" + mes + "-" + dia;

  var dropzone = document.getElementById("dropzone");
  var fileInput = document.getElementById("imagen");

  dropzone.addEventListener("click", function () {
    console.log("Dropzone clicked");
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
    handleFileSelect(e.dataTransfer.files[0]);
  });

  fileInput.addEventListener("change", function () {
    var file = this.files[0];
    if (file) {
      handleFileSelect(file);
    }
  });

  function handleFileSelect(file) {
    if (file) {
      dropzone.innerHTML = file.name;
    } else {
      dropzone.innerHTML =
        "Arrastra y suelta la imagen aquí o haz click para seleccionar el archivo";
    }
  }
});

document.getElementById("dropzone").addEventListener("click", function () {
  document.getElementById("imagen").click();
});
document.getElementById("imagen").addEventListener("change", function () {
  var file = this.files[0];
  if (file) {
    document.getElementById("dropzone").textContent =
      "Imagen seleccionada correctamente";
    document.getElementById("dropzone").classList.add("selected");
  } else {
    document.getElementById("dropzone").textContent =
      "Arrastra y suelta la imagen aquí o haz click para seleccionar el archivo";
    document.getElementById("dropzone").classList.remove("selected");
  }
});
