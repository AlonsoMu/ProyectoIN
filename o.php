<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apock web design</title>
    <link rel="stylesheet" type="text/css" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
        crossorigin="anonymous" />
</head>

<body>



    <style type="text/css">


        html {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            text-size-adjust: 100%;
            line-height: 1.4;
        }


        * {
            margin: 0;
            padding: 0;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        body {
            color: #404040;
            font-family: "Arial", Segoe UI, Tahoma, sans-serifl, Helvetica Neue, Helvetica;
            width: 650px;
            margin-left: auto;
            margin-right: auto;
            padding: 1rem;
        }

        /*=====================================
        estilos de la utilidad
        Copiar esto
        =====================================*/
        .apock-contenedor-comentarios {
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;
            width: 100%;
        }

        .apock-contenedor-comentarios img {
            width: 100%;
        }

        .apock-area-comentar {
            display: flex;
            flex-wrap: wrap;
            flex-direction: row;
            margin-bottom: 1.5rem;
            padding: 18px;
            background-color: #fff;
            box-shadow: 0 0 5px 2px rgba(0, 0, 0, .1);
            border-radius: 12px;
        }




        .apock-comentar-publicacion .apock-avatar,
        .apock-publicacion-realizada .apock-usuario-publico .apock-avatar,
        .apock-contenedor-comentarios .apock-comentario-principal-usuario .apock-avatar,
        .apock-area-comentar .apock-avatar {
            display: flex;
            width: 65px;
            height: 65px;
            background-color: #F4F4F4;
            border-radius: 50%;
            overflow: hidden;
        }






        .apock-boton-enviar {
            display: inline-block;
            border: 0;
            background-color: #374D71;
            padding: 7px 15px;
            margin-right: .5rem;
            color: #fff;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color ease-in 200ms;
        }


        .apock-boton-enviar:hover {
            background-color: #4C6FA7;
        }

        /* fin */
        .apock-contenedor-comentarios .apock-comentario,
        .apock-area-comentar .apock-inputs-comentarios {
            flex-grow: 1;
            flex-basis: 0;
            margin-left: .5rem;
        }

        .apock-area-comentar .apock-inputs-comentarios {
            margin-left: 1rem;
        }

        .apock-contenedor-comentarios .apock-texto,
        .apock-area-comentar .apock-inputs-comentarios .apock-area-comentario {
            border: 0;
            background-color: #F0F0F0;
            display: block;
            width: 100%;
            border-radius: 12px;
            margin-bottom: .5rem;
        }



        .apock-area-comentar .apock-inputs-comentarios .apock-area-comentario {
            padding: 12px 15px;
        }

        .apock-area-comentar .apock-inputs-comentarios .apock-botones-comentar {
            display: flex;
        }





        .apock-menu-comentario {
            position: absolute;
            width: 30px;
            height: 30px;
            background-color: #E9E9E9;
            border-radius: 50%;
            display: none;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }




        .apock-publicacion-realizada .apock-menu-comentario {
            display: flex;
            right: 0;
        }

        .apock-menu-comentario .apock-menu {
            list-style: none;
            position: absolute;
            right: 100%;
            background-color: #fff;
            box-shadow: 0 0 5px 1px rgba(0, 0, 0, .2);
            border-radius: 8px;
            padding-top: 7px;
            padding-bottom: 7px;
            opacity: 0;
            visibility: hidden;
            transition: all ease-in 200ms;
        }

        .apock-menu-comentario:hover .apock-menu {
            opacity: 1;
            visibility: visible;
        }

        .apock-menu-comentario .apock-menu a {
            display: block;
            padding: 7px 15px;
            color: inherit;
        }

        .apock-menu-comentario .apock-menu a:hover {
            background-color: #E1E1E1;
        }

        .apock-publicacion-realizada .apock-usuario-publico .apock-avatar {
            width: 45px;
            height: 45px;
        }


        .apock-botones-comentario button {
            display: inline-block;
            border: 0;
            padding: 3px 8px;
            font-size: .8rem;
            border-radius: 8px;
            cursor: pointer;
        }

        .apock-botones-comentario button:hover {
            background-color: #D5D8E1;
        }



        .apock-boton-enviar i,
        .apock-boton-file i,
        .apock-boton-puntuar i,
        .apock-boton-responder i {
            margin-right: .5rem;
        }



        .apock-publicacion-realizada .apock-usuario-publico {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            margin-bottom: .5rem;
            position: relative;
        }

        .apock-publicacion-realizada .apock-usuario-publico .apock-contenido-publicacion {
            margin-left: 1rem;
        }




        .apock-publicacion-realizada p {
            margin-bottom: 0.5rem;
            font-size: 0.9em;
        }

    </style>
    <!--==========================
=            html            =
===========================-->
    <section class="apock-contenedor-comentarios">
        <div class="apock-area-comentar">
            <div class="apock-avatar">
                <img src="img/Donald-Trump-sign-in-snow-Urbandale-IA-Jan.-13-2024.webp" alt="img">
            </div>
            <form action="#" method="post" class="apock-inputs-comentarios">
                <textarea name="" class="apock-area-comentario"></textarea>
                <div class="apock-botones-comentar">
                    <button class="apock-boton-enviar" type="submit">
                        <i class="fas fa-paper-plane"></i>
                        Enviar
                    </button>
                </div>
            </form>
        </div>
        <div class="apock-publicacion-realizada">
            <div class="apock-usuario-publico">
                <div class="apock-avatar">
                    <img src="img/Donald-Trump-sign-in-snow-Urbandale-IA-Jan.-13-2024.webp" alt="img">
                </div>
                <div class="apock-contenido-publicacion">
                    <h4>Carolina de la valle</h4>
                    <!-- <ul>
                        <li>Hace 3 min</li>
                    </ul> -->
                </div>
                <div class="apock-menu-comentario">
                    <i class="fas fa-pen"></i>
                    <ul class="apock-menu">
                        <li><a href="">Editar</a></li>
                        <li><a href="">Eliminar</a></li>
                    </ul>
                </div>
            </div>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Asperiores aliquam possimus, doloremque repellat assumenda ipsam magni ducimus, dolorem explicabo</p>
            <div class="apock-botones-comentario">
                <button type="" class="apock-boton-puntuar">
                    <i class="fas fa-thumbs-up"></i>
                    45
                </button>
                <button type="" class="apock-boton-responder">
                    Comentar
                </button>
            </div>
        </div>
    </section>
</body>

</html>
