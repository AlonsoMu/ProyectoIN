<?php
session_start();


if (isset($_SESSION["status"]) && $_SESSION["status"]) {
  header("./administrador.html");
}

?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
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


    </style>
  </head>
  <body>
    <div class="login-container">
      <div class="circular-icon"><img src="../../img/login.svg" alt="Imagen de perfil"></div>
      <h2>Iniciar sesión</h2>
      <form class="login-form" autocomplete="off" id="frm-login">
        <div class="form-group">
          <label for="correo">Correo electrónico:</label>
          <input type="text" id="correo" required>
        </div>
        <div class="form-group">
          <label for="claveacceso">Contraseña:</label>
          <input type="password" id="claveacceso" required>
        </div>
        <div class="form-group">
          <button type="submit">Iniciar sesión</button>
        </div>
      </form>
      <a href="../../recuperar.php" class="reset-password">¿Olvidaste tu contraseña?</a>
    </div>
    <script>
      document.addEventListener("DOMContentLoaded", () =>{
        function $(id){
          return document.querySelector(id);
        }

        $("#frm-login").addEventListener("submit", (event) =>{
          event.preventDefault();
          login();
        });

        function login(){
          const parametros = new FormData();
          parametros.append("operacion", "login");
          parametros.append("correo", $("#correo").value);
          parametros.append("claveacceso", $("#claveacceso").value);

          fetch(`../../controllers/usuario.controller.php`,{
            method: "POST",
            body: parametros
          })
          .then(respuesta => respuesta.json())
          .then(data =>{
            console.log(data)
            if(data.acceso == true){
              alert("Inicio de sesión exitoso")
              window.location.href = '../usuarios/administrador.php'
            }else{
              alert("Acceso denegado");
            }
          })
          .catch(e =>{
            console.error(e);
          });
        }
      })
    </script>
  </body>
</html>
