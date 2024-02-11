<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Icono de la página -->
  <link rel="icon" type="image/png" href="./img/sting.svg">
  <link rel="stylesheet" href="./css/recuperar.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <title>Recuperar</title>

</head>

<body>
  <div class="login-container">
    <div class="circular-icon"><img src="./img/candado.svg" alt="Imagen de perfil"></div>
    <h3>¿Olvidaste tú contraseña</h3>
    <h5>Ingresa tu correo electrónico para empezar con el proceso de recuperación de contraseña</h5>
    <form class="login-form" autocomplete="off" id="form-rest">
      <div class="form-group">
        <label for="correo">Correo electrónico:</label>
        <input type="text" id="correo" required>
      </div>
      <div class="form-group">
        <button type="submit" id="submit">Enviar token</button>
      </div>
    </form>
    <form id="form-cambiar">
      <div class="input-group" id="ingresartoken">
        <!--Hacemos una renderización-->
      </div>
    </form>
    <form action="" id="form-cambiarpass" class="hidden">
      <div class="input-group" id="cambiarpass">
        <!--Haremos la renderización para cambiar la contraseña-->
      </div>
    </form>
    <div class="additional-options">
      <a href="./views/usuarios/index.php">Volver al inicio de sesión</a>
    </div>
  </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>
  <script src="./js/toastr.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const div = document.querySelector("#ingresartoken");
      const div2 = document.querySelector("#cambiarpass");
      const boton = document.querySelector("#submit");

      function $(id) {
        return document.querySelector(id);
      }

      function buscarCorreo() {
        const correo = $("#correo").value;

        const parametros = new FormData();
        parametros.append("operacion", "buscarCorreo");
        parametros.append("correo", correo)

        fetch(`./controllers/reset.controller.php`, {
            method: "POST",
            body: parametros
          })
          .then(respuesta => respuesta.json())
          .then(data => {
            if (data.idusuario > 0) {
              notificar('success', 'Se encontró el correo', `Por favor verificar el token en su correo: ${data.correo}`, 3);
              registraToken();
              $("#correo").setAttribute("readonly", "true");

              ingresarToken = `
              <label for="token">Clave de Verificacion</label>
              <br><br>
              <div class="form-card-input-wrapper">
                <input class="form-card-input" id="token" name="token" placeholder="____" maxlength="4" type="tel">
                <div class="form-card-input-bg"></div>
              </div>
              <div class="button-container">
                <button type="button" id="validartoken" class="mt-3">Validar Token</button>
                <button type="button" id="reenviartoken" class="mt-3">Reenviar Token</button>
              </div>
            `;
              div.innerHTML = ingresarToken;
              boton.innerHTML = "Validar Token";

              $("#submit").style.display = "none";

              // Agregar evento click al botón "Reenviar Token"
              $("#reenviartoken").addEventListener("click", () => {
                notificar('info', 'Reenviando token', 'Se ha reenviado el token al correo', 2);
                registraToken(); // Vuelve a enviar el token
              });

              // Agregar evento click al botón "Validar Token"
              $("#validartoken").addEventListener("click", (event) => {
                event.preventDefault();
                ValidarToken();
              });
            } else {
              notificar('error', 'No encontrado', 'El correo no se encuentra registrado', 2);
              $("#form-rest").reset();
            }
          })
          .catch(e => {
            console.error(e);
          });
      }

      function registraToken() {
        const correo = $("#correo").value;
        const parametros = new FormData();
        parametros.append("operacion", "registrartoken");
        parametros.append("correo", correo);

        fetch(`./resources/EnviarTokens.php`, {
            method: "POST",
            body: parametros
          })
          .then(respuesta => respuesta.json())
          .then(data => {
            console.log(data)
          })
          .catch(e => {
            console.error(e);
          });
      }

      function ValidarToken() {
        const parametros = new FormData();
        parametros.append("operacion", "buscarToken");
        parametros.append("correo", $("#correo").value);
        parametros.append("token", $("#token").value);

        fetch(`./controllers/reset.controller.php`, {
            method: "POST",
            body: parametros
          })
          .then(respuesta => respuesta.json())
          .then(data => {
            if (data.length > 0) {
              // Verificar la expiración del token
              const fechaTokenString = data[0].fechatoken;
              const fechaToken = new Date(fechaTokenString);
              const ahora = new Date();
              const tiempoExpiracion = 3 * 60 * 1000; // 1 minuto en milisegundos
              // Calcular la diferencia en milisegundos
              const diferenciaTiempo = ahora - fechaToken;

              if (diferenciaTiempo > tiempoExpiracion) {
                // El token ha expirado
                notificar('warning', 'Token expirado', 'El token ha expirado', 2);
              } else {
                $("#token").setAttribute("readonly", "true");
                notificar('success', 'Encontrado', 'Registro encontrado en la base de datos', 2);

                // Ocultar el área de ingreso de token
                $("#ingresartoken").style.display = "none";

                // Mostrar el formulario de cambio de contraseña
                $("#form-cambiarpass").classList.remove("hidden");
                nuevaContraseña = `
                <label for="claveacceso">Nueva Contraseña</label>
                <input type="password" id="claveacceso" name="claveacceso" placeholder="Ingrese su nueva clave" required>
                <button type="submit" id="cambiarpass" class="mt-3">Cambiar Contraseña</button>
                <br><br>
              `;
                div2.innerHTML += nuevaContraseña;
                // Ocultar el botón de "Validar"
                $("#validartoken").style.display = "none";
                $("#reenviartoken").style.display = "none";
              }
            } else {
              notificar('warning', 'No se encontró', 'No encontrado en la base de datos', 2)
            }
          })
          .catch(e => {
            console.error(e);
          })
      }

      function CambiarPass() {
        const parametros = new FormData();
        parametros.append("operacion", "cambiarpass");
        parametros.append("correo", $("#correo").value);
        parametros.append("token", $("#token").value);
        parametros.append("claveacceso", $("#claveacceso").value);

        fetch(`./controllers/reset.controller.php`, {
            method: "POST",
            body: parametros
          })
          .then(respuesta => respuesta.json())
          .then(data => {
            //console.log(data);
          })
          .catch(e => {
            console.error(e);
          })
      }

      $("#form-rest").addEventListener("submit", (event) => {
        event.preventDefault();
        buscarCorreo();
      });
      $("#form-cambiarpass").addEventListener("submit", (event) => {
        event.preventDefault();
        CambiarPass();
        notificar('info', 'Cambio de contraseña exitoso', 'Ya puedes iniciar sesión', 3);
        setTimeout(function() {
          window.location.href = './views/usuarios/index.php';
        }, 2000);
      });
    });
  </script>
</body>

</html>