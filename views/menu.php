<?php
if (isset($_GET['id'])) {
  $idnegocio = $_GET['id'];

  echo "
    <script>
    const  idnegocio = " . json_encode($idnegocio) . ";
    console.log('ID del Negocio:', idnegocio);
    </script>
  ";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <title>Menu</title>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Quicksand:400,600,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
      integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
      crossorigin="anonymous" />

  <link rel="stylesheet" href="../fonts/icomoon/style.css">

  <link rel="stylesheet" href="../css/owl.carousel.min.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

  <!-- Style -->
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/comentarios.css">

  
</head>

<body>
  <div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close mt-3">
        <span class="icon-close2 js-menu-toggle"></span>
      </div>
    </div>
    <div class="site-mobile-menu-body"></div>
  </div> <!-- .site-mobile-menu -->

  <header class="site-navbar-wrap">
    <div class="site-navbar site-navbar-target js-sticky-header sting">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-2">
            <h1 class="my-0 site-logo"><a href="index.html"><img src="../img/sting.svg" alt="" height="40" /></a></h1>
          </div>
          <div class="col-10">
            <nav class="site-navigation text-right" role="navigation">
              <div class="container">
                <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3 text-dark"></span></a></div>

                <ul class="site-menu main-menu js-clone-nav d-none d-lg-block">
                  <li><a href="#home-section" class="nav-link">Inicio</a></li>
                  <li><a href="#servicios" class="nav-link">Servicios</a></li>
                  <li class="has-children">
                    <a href="#" class="nav-link"><strong>Idioma</strong></a>
                    <ul class="dropdown arrow-top">
                      <li><a href="#" class="nav-link">Español</a></li>
                      <li><a href="#" class="nav-link">English</a></li>
                      <li><a href="#" class="nav-link">Portugues</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </header>

  <section class="portada" id="portadaSection">
    <div class="cuadro-encima2">
      <i class="bi bi-clock icon-sting"></i>
      <p class="text-sting"></p>
    </div>
    <div class="cuadro-encima">
      <!-- Contenido del cuadro encima de la portada -->
      <div class="container mt-4">
        <div class="card custom-card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <!-- Primera sección con el título -->
                <h3 class="card-title text-sting"></h3>
              </div>
              <div class="col-md-4">
                <!-- Segunda sección con estrellas de valoración -->
                <div class="stars estrella-sting">
                </div>
              </div>
            </div>
            <div class="row mt-4">
              <div class="col-md-4 limitador spacing1">
                <!-- Sección de imagen -->
                <img id="logoNegocio" class="img-fluid2" alt="Imagen">
              </div>
              <div class="col-md-4 limitador spacing2 demimv">
                <!-- Sección con lista de redes sociales -->
                <div class="social-list" id="redesSociales">
                </div>
              </div>
              <div class="col-md-4 limitador spacing2 demimv">
                <div class="social-list" id="redesSociales2">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>




  <!-- ACERCA DE -->
  <section class="width100">
    <div class="container mt-l">
      <!-- TEXT -->
      <h1 class="font24 text-sting">Acerca </h1>
      <!-- CONTENIDO -->
      <p></p>
    </div>
  </section>



  <!-- GALERIA -->
  <section class="width100 sting">
    <div class="container mt-5 py-5">
      <!-- TITULO -->
      <h1 class="font24 text-blanco lineabaja mb-5">Galería de fotos</h1>

      <!-- IMAGENES -->
      <div class="owl-2-style">
        <div class="owl-carousel owl-2" id="galeria-carousel">
        </div>
      </div>

    </div>
  </section>

  <!-- VISITANOS -->
  <section class="width100">
    <!-- TITULO -->
    <h1 class="font24 text-sting lineabaja my-5">Visítanos</h1>
  </section>

  <!-- MAPA -->
  <section class="width100 bg-secondary">
    <div id="map" style="height: 400px;"></div>
  </section>

  <!-- Horarios de atención -->
  <section class="width100">
    <div class="container mt-5">
      <!-- TITULO -->
      <h1 class="font24 text-sting lineabaja my-5">Horario de atención</h1>

      <div class="row utils justify-content-center">
      </div>
    </div>
  </section>

  <a href="https://wa.me/1234567890?text=hello+123" target=”_blank” class="whatsapp-btn">
    <i class="bi bi-whatsapp"></i>
  </a>
  <div class="cuadro-btn text-sting">Inicia con nosotros</div>



  <section class="apock-contenedor-comentarios mt-5">
    <div class="apock-area-comentar">
        <div class="apock-avatar">
            <img src="../img/Donald-Trump-sign-in-snow-Urbandale-IA-Jan.-13-2024.webp" alt="img">
        </div>
        <form action="#" method="post" class="apock-inputs-comentarios" id="comentarioForm">
            <textarea name="" class="apock-area-comentario" id="nuevoComentario"></textarea>
            <div class="apock-botones-comentar">
                <button class="apock-boton-enviar" type="submit">
                    <i class="fas fa-paper-plane"></i>
                    Enviar
                </button>
            </div>
        </form>
    </div>
    <div class="apock-publicacion-realizada" style="display: none;" id="comentarioPublicado">
        <!-- Contenido del comentario publicado se agregará aquí dinámicamente -->
    </div>
</section>





  <!-- Footer -->
  <footer id="footer" class="bg-footer">
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-4 pt-5 text-left">
          <h2 class="h2 text-light pb-3 border-light"><img src="../img/sting.svg" alt="" height="40"></h2>
          <ul class="list-unstyled text-light footer-link-list">
            <li>Creativos, Estratégicos <br />e Innovadores</li>
          </ul>
        </div>

        <div class="col-md-4 pt-5 text-left">
          <h2 class="h2 text-light pb-3 border-light">Síguenos</h2>
          <ul class="list-unstyled text-light d-flex justify-content-left">
            <li class="pr-3 reds"><a class="text-decoration-none text-white fs-4" href="#"><img src="../img/icon _facebook.svg" /></a></li>
            <li class="px-3 reds"><a class="text-decoration-none text-white fs-4" href="#"><img src="../img/icon _instagram.svg" /></a></li>
            <li class="px-3 reds"><a class="text-decoration-none text-white fs-4" href="#"><img src="../img/icon_logo_behance.svg" /></a></li>
            <li class="pl-3 reds"><a class="text-decoration-none text-white fs-4" href="#"><img src="../img/icon_tiktok.svg" /></a></li>
          </ul>
        </div>

        <div class="col-md-4 pt-5 text-left">
          <h2 class="h2 text-light pb-3 border-light">Contáctanos</h2>
          <ul class="list-unstyled text-light footer-link-list">
            <li>Lorem ipsum dolor sit am secta emy dipiscing, elit netus pharetra copy condimentum lacus.</li>
            <li class="py-3">
              <a class="text-decoration-none text-white" href="#">
                <img src="../img/buzon.svg" /> stingstudio.chincha@gmail.com
              </a>
            </li>
            <li>
              <a class="text-decoration-none text-white" href="#">
                <img src="../img/phone.svg" /> +51 907 233 783
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="w-100 bg-footer linen pt-3">
      <div class="container">
        <div class="row pie">
          <div class="col-12 py-3 text-center">
            <p class="text-light">
              &copy; Sting Studio 2024 | Creativos, Estratégicos e Innovadores
            </p>
          </div>
        </div>
      </div>
    </div>
  </footer>





  <script src="../js/jquery-3.3.1.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.sticky.js"></script>
  <script src="../js/owl.carousel.min.js"></script>
  <script src="../js/main.js"></script>

  <script>
    // Obtener elementos del DOM
const comentarioForm = document.getElementById('comentarioForm');
const nuevoComentarioInput = document.getElementById('nuevoComentario');
const comentarioPublicado = document.getElementById('comentarioPublicado');

// Manejar el evento de envío del formulario de comentario
comentarioForm.addEventListener('submit', function(event) {
    // Evitar el comportamiento por defecto del formulario
    event.preventDefault();

    // Obtener el texto del nuevo comentario
    const nuevoComentarioTexto = nuevoComentarioInput.value;

    // Crear elementos HTML para el nuevo comentario
    const nuevoComentarioElemento = document.createElement('div');
    nuevoComentarioElemento.classList.add('apock-publicacion-realizada');

    // Construir el contenido del nuevo comentario
    nuevoComentarioElemento.innerHTML = `
        <div class="apock-usuario-publico">
            <div class="apock-avatar">
                <img src="../img/Donald-Trump-sign-in-snow-Urbandale-IA-Jan.-13-2024.webp" alt="img">
            </div>
            <div class="apock-contenido-publicacion">
                <h4>Tu Nombre</h4>
            </div>
            <div class="apock-menu-comentario">
                <i class="fas fa-pen"></i>
                <ul class="apock-menu">
                    <li><a href="#" class="editar-comentario">Editar</a></li>
                    <li><a href="#" class="eliminar-comentario">Eliminar</a></li>
                </ul>
            </div>
        </div>
        <p>${nuevoComentarioTexto}</p>
        <div class="apock-botones-comentario">
            <button type="" class="apock-boton-puntuar">
                <i class="fas fa-thumbs-up"></i>
                <span>0</span>
            </button>
        </div>
    `;

    // Insertar el nuevo comentario en la sección de comentarios publicados
    comentarioPublicado.appendChild(nuevoComentarioElemento);

    // Mostrar el apartado de comentario publicado
    comentarioPublicado.style.display = 'block';

    // Limpiar el campo de texto del comentario
    nuevoComentarioInput.value = '';

    // Manejar la funcionalidad de editar y eliminar comentario
    const editarComentario = nuevoComentarioElemento.querySelector('.editar-comentario');
    const eliminarComentario = nuevoComentarioElemento.querySelector('.eliminar-comentario');

    // Evento clic para editar comentario
    editarComentario.addEventListener('click', function(event) {
        event.preventDefault();
        // Aquí puedes implementar la funcionalidad para editar el comentario
        console.log('Editar comentario');
    });

    // Evento clic para eliminar comentario
    eliminarComentario.addEventListener('click', function(event) {
        event.preventDefault();
        // Aquí puedes implementar la funcionalidad para eliminar el comentario
        console.log('Eliminar comentario');
    });

    // Manejar la funcionalidad de dar Me gusta a un comentario
    const botonMeGusta = nuevoComentarioElemento.querySelector('.apock-boton-puntuar');
    const contadorMeGusta = nuevoComentarioElemento.querySelector('.apock-boton-puntuar span');
    let meGustaActivo = false;

    botonMeGusta.addEventListener('click', function(event) {
        event.preventDefault();
        if (!meGustaActivo) {
            contadorMeGusta.textContent = parseInt(contadorMeGusta.textContent) + 1;
            meGustaActivo = true;
            botonMeGusta.classList.add('activo');
        } else {
            contadorMeGusta.textContent = parseInt(contadorMeGusta.textContent) - 1;
            meGustaActivo = false;
            botonMeGusta.classList.remove('activo');
        }
    });
});

  </script>

  <script>
    function addComment() {
      var authorName = document.getElementById("author-name").value;
      var commentInput = document.getElementById("comment-input").value;

      if (authorName.trim() === "" || commentInput.trim() === "") {
        alert("Por favor completa todos los campos.");
        return;
      }

      var commentElement = document.createElement("div");
      commentElement.classList.add("comment");
      commentElement.innerHTML = `
    <p class="author">${authorName}</p>
    <p class="comment-text">${commentInput}</p>
    <button class="delete-button" onclick="deleteComment(this)">Eliminar</button>
  `;

      var commentsContainer = document.getElementById("comments");
      commentsContainer.appendChild(commentElement);

      document.getElementById("author-name").value = "";
      document.getElementById("comment-input").value = "";
    }

    function deleteComment(button) {
      if (confirm("¿Estás seguro de que quieres eliminar este comentario?")) {
        var comment = button.parentElement;
        comment.remove();
      }
    }
  </script>

  <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAyjyqgSwFgtNUj84wtqmcBLRQvY3W6Jho&libraries=places&callback=initMap"></script>

  <script>
    let map;

    function initMap() {
      const mapDiv = document.getElementById('map');
      const mapOptions = {
        center: {
          lat: -13.4098500,
          lng: -76.1323500
        }, // Coordenadas de ejemplo
        zoom: 15,
      };

      map = new google.maps.Map(mapDiv, mapOptions);

      // Puedes agregar marcadores u otras configuraciones aquí
    }

    function mostrarMarcador() {
      const parametros = new FormData();
      parametros.append("operacion", "obtenerMap");
      parametros.append("idnegocio", idnegocio);

      fetch(`../controllers/negocio.controller.php`, {
          method: "POST",
          body: parametros
        })
        .then(respuesta => respuesta.json())
        .then(datos => {
          // Verifica todos los datos recibidos en la consola
          console.log("Datos recibidos:", datos);

          // Verifica si hay al menos un elemento en el array
          if (Array.isArray(datos) && datos.length > 0) {
            // Accede al primer elemento del array
            const primerElemento = datos[0];

            // Obtén las coordenadas del primer elemento
            const latitud = parseFloat(primerElemento.latitud_obtenida);
            const longitud = parseFloat(primerElemento.longitud_obtenida);

            // Verifica las coordenadas en la consola
            console.log("Latitud:", latitud, "Longitud:", longitud);

            // Crea un objeto LatLng con las coordenadas
            const ubicacion = new google.maps.LatLng(latitud, longitud);

            // Crea un marcador en el mapa
            const marker = new google.maps.Marker({
              position: ubicacion,
              map: map, // Asocia el marcador con la instancia del mapa
              icon: "../img/ubicacion.svg",
              title: 'Negocio'
            });

            // Centra el mapa en la ubicación del marcador
            map.setCenter(ubicacion);
          } else {
            console.error("Datos no válidos o vacíos");
          }
        })
        .catch(e => {
          console.error(e);
        });
    }

    mostrarMarcador();
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const imagenPortadaAlterna = '../img/notFound.jpg'; // Ruta de la imagen alternativa

      function getInfo() {
        const parametros = new FormData();
        parametros.append("operacion", "obtenerid");
        parametros.append("idnegocio", idnegocio);

        fetch(`../controllers/negocio.controller.php`, {
            method: "POST",
            body: parametros
          })
          .then(respuesta => respuesta.json())
          .then(datos => {
            // Actualizar el contenido dinámicamente con los datos obtenidos
            const negocio = datos[0]; // Suponiendo que obtienes un solo negocio

            // Actualizar la portada
            const portadaSection = document.getElementById('portadaSection');

            if (negocio.portada) {
              portadaSection.style.backgroundImage = `url('../imgPortada/${negocio.portada}')`;
            } else {
              portadaSection.style.backgroundImage = `url(${imagenPortadaAlterna})`;
            }

            const logoImg = document.getElementById('logoNegocio');
            // Concatenar la ruta de la carpeta con el nombre del archivo del logo
            if (negocio.logo) {
              // Si hay una imagen de logo, utiliza esa
              logoImg.src = `../imgLogos/${negocio.logo}`;
            } else {
              // Si no hay una imagen de logo, utiliza la imagen por defecto para logos
              logoImg.src = `../galeria/image.svg`;
            }

            // Portada
            document.querySelector('.cuadro-encima2 .text-sting').textContent = `Hoy ${negocio.Estado}`;
            document.querySelector('.cuadro-encima .card-title').textContent = negocio.nombre;

            // Estrellas de Valoración
            const estrellasContainer = document.querySelector('.estrella-sting');
            estrellasContainer.innerHTML = ''; // Limpiar contenido existente

            const valoracion = negocio.valoracion || 0; // Valoración por defecto si no hay datos

            for (let i = 0; i < 5; i++) {
              const estrella = document.createElement('i');
              estrella.classList.add('bi', 'bi-star-fill');

              // Pintar solo las estrellas necesarias
              if (i < valoracion) {
                estrellasContainer.appendChild(estrella);
              } else {
                // Agregar estrellas vacías o negras
                estrella.classList.remove('bi-star-fill');
                estrella.classList.add('bi-star');
                estrellasContainer.appendChild(estrella);
              }
            }

            // Redes Sociales
            const redesSociales = document.getElementById('redesSociales');
            redesSociales.innerHTML = ''; // Limpiar contenido existente

            if (negocio.facebook) {
              const parrafoFacebook = document.createElement('p');
              parrafoFacebook.innerHTML = `<i class="bi bi-facebook font14 icon-sting"></i> ${negocio.facebook}`;
              redesSociales.appendChild(parrafoFacebook);
            }

            if (negocio.whatsapp) {
              const parrafoWhatsapp = document.createElement('p');
              parrafoWhatsapp.innerHTML = `<i class="bi bi-whatsapp font14 icon-sting"></i> ${negocio.whatsapp}`;
              redesSociales.appendChild(parrafoWhatsapp);
            }

            if (negocio.instagram) {
              const parrafoInstagram = document.createElement('p');
              parrafoInstagram.innerHTML = `<i class="bi bi-instagram font14 icon-sting"></i> ${negocio.instagram}`;
              redesSociales.appendChild(parrafoInstagram);
            }

            if (negocio.tiktok) {
              const parrafoTikTok = document.createElement('p');
              parrafoTikTok.innerHTML = `<i class="bi bi-tiktok font14 icon-sting"></i> ${negocio.tiktok}`;
              redesSociales.appendChild(parrafoTikTok);
            }

            const redesSociales2 = document.getElementById('redesSociales2');
            redesSociales2.innerHTML = ''; // Limpiar contenido existente

            const direccionParrafo = document.createElement('p');
            direccionParrafo.innerHTML = `<i class="bi bi-geo-alt font14 icon-sting"></i> ${negocio.direccion}`;
            redesSociales2.appendChild(direccionParrafo);

            const paginaWebParrafo = document.createElement('p');
            paginaWebParrafo.innerHTML = `<i class="bi bi-browser-chrome font14 icon-sting"></i> ${negocio.pagweb}`;
            redesSociales2.appendChild(paginaWebParrafo);
            // Otros elementos según sea necesario

            // Acerca de
            document.querySelector('.width100 h1').textContent = 'Acerca de ' + negocio.nombre;
            document.querySelector('.width100 p').textContent = negocio.descripcion;


          })
          .catch(e => {
            console.error(e);
          });
      }

      // Llama a la función para obtener la información al cargar la página
      getInfo();
    });
  </script>

  <script>
    document.addEventListener("DOMContentLoaded", () => {

      function carrusel() {

        const parametros = new FormData();
        parametros.append("operacion", "listar");
        parametros.append("idnegocio", idnegocio);

        fetch(`../controllers/galeria.controller.php`, {
            method: "POST",
            body: parametros
          })
          .then(respuesta => respuesta.json())
          .then(datos => {

            const subcarruselDiv = document.getElementById("galeria-carousel");

            // Limpiar el contenido existente
            subcarruselDiv.innerHTML = "";

            // Agregar estructura de Owl Carousel
            const owlCarousel = document.createElement("div");
            owlCarousel.className = "owl-carousel owl-2 owl-loaded owl-drag";
            owlCarousel.id = "galeria-carousel";

            const owlStageOuter = document.createElement("div");
            owlStageOuter.className = "owl-stage-outer";
            owlStageOuter.style = "width: 100%; overflow: hidden;";

            const owlStage = document.createElement("div");
            owlStage.className = "owl-stage";
            owlStage.style = "transform: translate3d(0px, 0px, 0px); transition: all 1s ease 0s; width: 10000%; overflow: hidden;";

            if (datos.length === 0) {
              // Agregar imagen alternativa tres veces si no hay imágenes
              for (let i = 0; i < 3; i++) {
                const owlItem = document.createElement("div");
                owlItem.className = "owl-item";
                owlItem.style = "width: 283.333px; margin-right: 20px;";

                const media29101 = document.createElement("div");
                media29101.className = "media-29101";

                const imgLink = document.createElement("a");
                imgLink.href = "#";

                const imgElement = document.createElement("img");
                imgElement.src = "../galeria/image.svg"; // Ruta de la imagen alternativa
                imgElement.alt = "Image";
                imgElement.className = "img-fluid";
                imgElement.style = "width: 300px; height: 200px; object-fit: cover;";

                imgLink.appendChild(imgElement);
                media29101.appendChild(imgLink);
                owlItem.appendChild(media29101);
                owlStage.appendChild(owlItem);
              }
            } else {
              datos.forEach(element => {
                const owlItem = document.createElement("div");
                owlItem.className = "owl-item";
                owlItem.style = "width: 283.333px; margin-right: 20px;";

                const media29101 = document.createElement("div");
                media29101.className = "media-29101";

                const imgLink = document.createElement("a");
                imgLink.href = "#";

                const imgElement = document.createElement("img");
                imgElement.src = `../imgGaleria/${element.rutafoto}`;
                imgElement.alt = "Image";
                imgElement.className = "img-fluid";
                imgElement.style = "width: 300px; height: 200px; object-fit: cover;";

                imgLink.appendChild(imgElement);
                media29101.appendChild(imgLink);
                owlItem.appendChild(media29101);
                owlStage.appendChild(owlItem);
              });
            }

            owlStageOuter.appendChild(owlStage);
            owlCarousel.appendChild(owlStageOuter);
            subcarruselDiv.appendChild(owlCarousel);

            // Inicializar Owl Carousel después de cargar las imágenes
            if ($('.owl-2').length > 0) {
              $('.owl-2').owlCarousel({
                center: false,
                items: 1,
                loop: true,
                stagePadding: 0,
                margin: 20,
                smartSpeed: 1000,
                autoplay: true,
                nav: true,
                dots: true,
                pauseOnHover: false,
                responsive: {
                  600: {
                    margin: 20,
                    nav: true,
                    items: 2
                  },
                  1000: {
                    margin: 20,
                    stagePadding: 0,
                    nav: true,
                    items: 3
                  }
                }
              });
            }

            // Agregar controles y paginación al DOM
            const owlNav = document.createElement("div");
            owlNav.className = "owl-nav";
            owlNav.innerHTML = '<button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button>' +
              '<button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button>';

            const owlDots = document.createElement("div");
            owlDots.className = "owl-dots";
            // Agregar más botones de paginación según la cantidad de elementos en el carrusel
            subcarruselDiv.appendChild(owlNav);
            subcarruselDiv.appendChild(owlDots);

          })
          .catch(e => {
            console.error(e);
          });
      }

      carrusel();

    });
  </script>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      function horarios() {
        const parametros = new FormData();
        parametros.append("operacion", "obtenerHorarios");
        parametros.append("idnegocio", idnegocio);

        fetch(`../controllers/horario.controller.php`, {
            method: "POST",
            body: parametros
          })
          .then(respuesta => respuesta.json())
          .then(datos => {
            console.log(datos);
            renderizarHorarios(datos);
          })
          .catch(e => {
            console.error(e);
          });
      }

      function renderizarHorarios(horarios) {
        const dias = ["Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado", "Domingo"];

        // Obtener el día actual
        const diaActual = new Date().getDay() - 1; // Domingo es 0, Lunes es 1, ..., Sábado es 6

        const container = document.querySelector(".utils");
        container.innerHTML = ""; // Limpiar el contenido existente

        const formatoHora = {
          hour: "numeric",
          minute: "numeric"
        }; // Formato de hora

        horarios.forEach((horario, index) => {
          const dia = dias[index];
          const activo = index === diaActual ? "dia_activo" : "dia_noactivo";

          // Formatear hora de apertura y cierre
          const apertura = new Date(`2000-01-01T${horario.apertura}`).toLocaleTimeString("en-US", formatoHora);
          const cierre = new Date(`2000-01-01T${horario.cierre}`).toLocaleTimeString("en-US", formatoHora);

          const html = `
              <span class="border ${activo}">
                <h3 class="font20 font-weight-bold mt-4 text-sting">${dia}</h3>
                <p class="font12 font-weight-bold">${apertura} - ${cierre}</p>
              </span>
            `;

          container.insertAdjacentHTML("beforeend", html);
        });
      }

      horarios();
    });
  </script>
</body>

</html>