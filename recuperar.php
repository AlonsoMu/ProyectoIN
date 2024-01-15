<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Icono de la página -->
    <link rel="icon" type="image/png" href="./img/sting.svg">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Recuperar</title>
    <style>
      body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
      }

      .login-container {
        position: relative;
        background-color: #fff;
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        padding: 20px;
        border-radius: 8px;
        width: 300px;
        text-align: center;
      }

      .login-container h2 {
        color: #333;
      }

      .login-form {
        display: flex;
        flex-direction: column;
        margin-top: 20px;
      }

      .form-group {
        margin-bottom: 15px;
      }

      .form-group label {
        display: block;
        margin-bottom: 5px;
        color: #666;
      }

      .form-group label:focus {
        outline: none;
      }

      .form-group input {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 20px;
        box-sizing: border-box;
      }
      
      .form-group button {
        background-color: #5B4AFF;
        color: #fff;
        padding: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin: 0 auto;
        border-radius: 20px;
        width: 50%;
      }

      .form-group button:hover {
        background-color: #00E7AD;
      }

      .reset-password {
        margin-top: 10px;
        color: #007bff;
        text-decoration: none;
        font-size: 14px;
        display: inline-block;
      }

      .reset-password:hover {
        text-decoration: underline;
      }

      .circular-icon {
        position: absolute;
        width: 70px;
        height: 70px;
        background: #4caf50;
        border-radius: 50%;
        top: -40px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
      }

      .circular-icon img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
      }

      @media screen and (max-width: 600px) {
        .login-container {
          width: 80%;
        }

        .form-group button {
          width: 100%;
        }
        .login-form {
          display: flex;
          flex-direction: column;
          align-items: center;
        }

        .form-group button {
          width: 100%;
          max-width: 200px; /* Ajusta según sea necesario */
          margin: 0 auto;
        }

      }
      @media screen and (max-width: 600px) {
        .circular-icon {
          width: 50px;
          height: 50px;
          top: -30px;
        }
      }

      .form-card {
        width: 280px;
        height: 350px;
        border-radius: 1.2rem;
        background-color: #fff;
        padding: 1.3rem;
        color: #212121;
        text-align: center;
        position: relative;
      }

      .form-card-prompt {
        margin-bottom: 2rem;
        font-size: 19px;
      }
      /* hard reset */
      .form-card-input {
        all: unset;
      }

      .form-card-input-wrapper {
        position: relative;
        width: 100%;
        height: 3rem;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        margin-bottom: 5px;
      }

      .form-card-input {
        font-size: 2rem;
        font-weight: bold;
        letter-spacing: 2rem;
        text-align: start;
        -webkit-transform: translateX(36px);
        -ms-transform: translateX(36px);
        transform: translateX(36px);
        position: absolute;
        z-index: 3;
        background-color: transparent;
      }

      .form-card-input-bg {
        content: '';
        width: 240px;
        height: 60px;
        margin: auto;
        inset: 0;
        bottom: 10px;
        position: absolute;
        z-index: 1;
        border-radius: 12px;
        background-color: rgba(206, 206, 206, 0.664);
      }
      .button-container {
  display: flex;
  flex-direction: column;
  margin-top: 20px;
}

.button-container button {
  background-color: #5B4AFF;
  color: #fff;
  padding: 10px;
  border: none;
  border-radius: 20px;
  cursor: pointer;
  width: 100%;
  margin-bottom: 10px;
}

.button-container button:hover {
  background-color: #00E7AD;
}
/* Estilo para el formulario de cambio de contraseña */
#form-cambiarpass {
  margin-top: 5px;
}

#form-cambiarpass label {
  display: block;
  margin-top: 5px;
  margin-bottom: 5px; /* Ajusta según sea necesario */
  color: #666;
}

#form-cambiarpass input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 20px;
  box-sizing: border-box;
  margin-top: 5px;
}

#form-cambiarpass button {
  background-color: #5B4AFF;
  color: #fff;
  padding: 10px;
  border: none;
  border-radius: 20px;
  cursor: pointer;
  width: 100%;
  margin-top: 15px;
}

#form-cambiarpass button:hover {
  background-color: #00E7AD;
}
    </style>
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

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>
  <script src="./js/toastr.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
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
            notificar('success', 'Se encontró el correo', `Por favor verificar el token en su correo: ${data.correo}`,3);
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
              notificar('info', 'Reenviando token', 'Se ha reenviado el token al correo',2);
              registraToken(); // Vuelve a enviar el token
            });

            // Agregar evento click al botón "Validar Token"
            $("#validartoken").addEventListener("click", (event) => {
              event.preventDefault();
              ValidarToken();
            });
          } else {
            notificar('error', 'No encontrado', 'El correo no se encuentra registrado',2);
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

      function ValidarToken(){
        const parametros = new FormData();
        parametros.append("operacion","buscarToken");
        parametros.append("correo",$("#correo").value);
        parametros.append("token",$("#token").value);

        fetch(`./controllers/reset.controller.php`,{
          method: "POST",
          body: parametros
        })
        .then(respuesta =>respuesta.json())
        .then(data =>{
          if(data.length > 0){
            // Verificar la expiración del token
            const fechaTokenString = data[0].fechatoken;
            const fechaToken = new Date(fechaTokenString);
            const ahora = new Date();
            const tiempoExpiracion = 3 * 60 * 1000; // 1 minuto en milisegundos
            // Calcular la diferencia en milisegundos
            const diferenciaTiempo = ahora - fechaToken;

            if(diferenciaTiempo > tiempoExpiracion){
              // El token ha expirado
              notificar('warning','Token expirado','El token ha expirado',2);
            }else{
              $("#token").setAttribute("readonly", "true");
              notificar('success','Encontrado','Registro encontrado en la base de datos',2);

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
          }else{
            notificar('warning','No se encontró','No encontrado en la base de datos',2)
          }
        })  
        .catch(e =>{
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
        notificar('info','Cambio de contraseña exitoso','Ya puedes iniciar sesión',3);
        setTimeout(function(){
          window.location.href = './views/usuarios/index.php';
        },2000);
      });
    });
  </script>
</body>
</html>
