<!doctype html>
<html lang="es">
  <head>
    <title>Proyecto</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <!-- CSS -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="./fonts/icomoon/style.css">
    <link rel="stylesheet" href="./css/owl.carousel.min.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/listado.css">
    <link rel="stylesheet" href=".//css/window.css">
    
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
      <div class="site-navbar site-navbar-target js-sticky-header">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-2">
              <h1 class="my-0 site-logo"><a href="index.html"><img src="./img/sting.svg" alt="" height="40" /></a></h1>
            </div>
            <div class="col-10">
              <nav class="site-navigation text-right" role="navigation">
                <div class="container">
                  <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3 text-dark"></span></a></div>

                  <ul class="site-menu main-menu js-clone-nav d-none d-lg-block">
                    <li><a href="#home-section"  class="nav-link">Inicio</a></li>
                    <li><a href="#servicios"  class="nav-link" >Servicios</a></li>
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

    <section class="espacio_eredado"></section>
    <div class="container mt-5 text-center">
      <h1 class="nav_titulo mb-5 lineabajo">¿Qué lugar deseas encontrar?</h1>
      <div class="d-flex justify-content-center mt-4 valor_c" id="categoria">
        <a class="nav-link corrector_nav1" data-bs-toggle="collapse" href="./views/index.php">Todos los negocios</a>
        <span class="text-muted mx-3 m-division"> | </span>
        <!-- <a class="nav-link corrector_nav tabs" data-bs-toggle="collapse" onclick="kiosco(event,'hoteles')">Hoteles <i class="bi bi-chevron-down"></i></a>
        <a class="nav-link corrector_nav tabs" data-bs-toggle="collapse" onclick="kiosco(event,'farmacias')">Farmacias <i class="bi bi-chevron-down"></i></a>
        <a class="nav-link corrector_nav tabs" data-bs-toggle="collapse" onclick="kiosco(event,'restaurantes')">Restaurantes <i class="bi bi-chevron-down"></i></a>
        <a class="nav-link corrector_nav tabs" data-bs-toggle="collapse" onclick="kiosco(event,'bodegas')">Bodegas <i class="bi bi-chevron-down"></i></a> -->
      </div>
    </div>

    <div class="w-100 bg-azul reor " id="subcategoria">
      <!-- <div id="farmacias" class="pb-5 w-820 text-center nego_acti" style="display:none;">
        <span class="topright">&times</span>
        <div class="row pb-4">
          <div class="col-sm"><button type="button" class="btn btn-light col-11">Comida rapidas</button></div>
          <div class="col-sm"><button type="button" class="btn btn-light col-11">Otros</button></div>
          <div class="col-sm"><button type="button" class="btn btn-light col-11">Criollos</button></div>
        </div>
        <div class="row">
          <div class="col-sm"><button type="button" class="btn btn-light col-11">Light</button></div>
          <div class="col-sm"><button type="button" class="btn btn-light col-11">Light</button></div>
          <div class="col-sm"><button type="button" class="btn btn-light col-11">Light</button></div>
          </div>
        </div>

        <div id="restaurantes" class="pb-5 w-820 text-center nego_acti" style="display:none;">
          <span class="topright">&times</span>
          <div class="row pb-4">
            <div class="col-sm"><button type="button" class="btn btn-light col-11">Light</button></div>
            <div class="col-sm"><button type="button" class="btn btn-light col-11">Light</button></div>
            <div class="col-sm"><button type="button" class="btn btn-light col-11">Light</button></div>
          </div>
          <div class="row">
            <div class="col-sm"><button type="button" class="btn btn-light col-11">Mariscos</button></div>
            <div class="col-sm"><button type="button" class="btn btn-light col-11">Extranjeros</button></div>
            <div class="col-sm"><button type="button" class="btn btn-light col-11">Otros</button></div>
          </div>
        </div>

        <div id="bodegas" class="pb-5 w-820 text-center nego_acti" style="display:none;">
          <span class="topright">&times</span>
          <div class="row pb-4">
            <div class="col-sm"><button type="button" class="btn btn-light col-11">Tradicional</button></div>
            <div class="col-sm"><button type="button" class="btn btn-light col-11">Criollos</button></div>
            <div class="col-sm"><button type="button" class="btn btn-light col-11">Extranjeros</button></div>
          </div>
          <div class="row">
            <div class="col-sm"><button type="button" class="btn btn-light col-11">Light</button></div>
            <div class="col-sm"><button type="button" class="btn btn-light col-11">Light</button></div>
            <div class="col-sm"><button type="button" class="btn btn-light col-11">Light</button></div>
          </div>
        </div>
      </div> -->
    </div>

    <!-- BUSCADOR -->
    <div class="container mt-4 d-flex justify-content-center">
      <div class="input-group" style="max-width: 700px;">
        <input type="search" id="buscar" class="form-control" />
        <button type="button" class="bus btn btn-primary">
          <i class="bi bi-search"></i>
        </button>
      </div>
    </div>

    <div class="container mt-5">
      <div class="container">
        <div class="row">
          <label>
            Filtrar por <i class="bi bi-funnel-fill"></i>
          </label>
        </div>
        <div class="row pt-4 distritoc" style="max-width: 300px;">
          <label class="pr-3">Distrito: </label>
          <select class="form-select" aria-label="Selecciona un distrito" id="distrito">
            <option selected value="">Selecciona</option>
            <!-- Agrega más opciones según sea necesario -->
          </select>
        </div>
      </div>
    </div>
    

    <style>
      #mapDiv {
        height: 800px;
        background-color: aqua;
      }
    </style>  
    
    
    <div id="mapDiv" class="mt-5"></div>

    <!-- FOOTER CARRUSEL -->
    <div class="w-100 p-3 background_cote mt-5">
      <section class="container-920">
        <div class="container text-center my-3">
          <!-- IMAGENES -->
          <div class="owl-2-style">
            <div class="owl-carousel owl-2" id="carrusel">
              <!-- <div class="media-29101">
                <a href="#"><img src="./img/1.svg" alt="Image" class="img-fluid"></a>
              </div>
              <div class="media-29101">
                <a href="#"><img src="./img/2.svg" alt="Image" class="img-fluid"></a>
              </div>
              <div class="media-29101">
                <a href="#"><img src="./img/3.svg" alt="Image" class="img-fluid"></a>
              </div>
              <div class="media-29101">
                <a href="#"><img src="./img/1.svg" alt="Image" class="img-fluid"></a>
              </div>
              <div class="media-29101">
                <a href="#"><img src="./img/2.svg" alt="Image" class="img-fluid"></a>
              </div>
              <div class="media-29101">
                <a href="#"><img src="./img/3.svg" alt="Image" class="img-fluid"></a>
              </div> -->
            </div>
          </div>      
        </div>
      </section>
    </div>

    <a href="https://wa.me/51962662710?text=Deseo más información" target=”_blank” class="whatsapp-btn">
      <i class="bi bi-whatsapp"></i>
    </a>
    <div class="cuadro-btn">Inicia con nosotros</div>

    <!-- Footer -->
    <footer id="footer" class="bg-footer">
      <div class="container mb-5">
        <div class="row">
          <div class="col-md-4 pt-5 text-left">
            <h2 class="h2 text-light pb-3 border-light"><img src="./img/sting.svg" alt="" height="40"></h2>
            <ul class="list-unstyled text-light footer-link-list">
              <li>Creativos, Estratégicos <br/>e Innovadores</li>
            </ul>
          </div>
          <div class="col-md-4 pt-5 text-left">
            <h2 class="h2 text-light pb-3 border-light">Síguenos</h2>
            <ul class="list-unstyled text-light d-flex justify-content-left">
              <li class="pr-3 reds"><a class="text-decoration-none text-white fs-4" href="#"><img src="./img/icon _facebook.svg" /></a></li>
              <li class="px-3 reds"><a class="text-decoration-none text-white fs-4" href="#"><img src="./img/icon _instagram.svg" /></a></li>
              <li class="px-3 reds"><a class="text-decoration-none text-white fs-4" href="#"><img src="./img/icon_logo_behance.svg" /></a></li>
              <li class="pl-3 reds"><a class="text-decoration-none text-white fs-4" href="#"><img src="./img/icon_tiktok.svg" /></a></li>
            </ul>
          </div>
          <div class="col-md-4 pt-5 text-left">
            <h2 class="h2 text-light pb-3 border-light">Contáctanos</h2>
            <ul class="list-unstyled text-light footer-link-list">
              <li>Lorem ipsum dolor sit am secta emy dipiscing, elit netus pharetra copy condimentum lacus.</li>
              <li class="py-3">
                <a class="text-decoration-none text-white" href="#">
                  <img src="./img/buzon.svg" /> stingstudio.chincha@gmail.com
                </a>
              </li>
              <li>
                <a class="text-decoration-none text-white" href="#">
                  <img src="./img/phone.svg" /> +51 907 233 783
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

    <!-- Bootstrap JavaScript Libraries -->
    <script src="./js/jquery-3.3.1.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/jquery.sticky.js"></script>
    <script src="./js/owl.carousel.min.js"></script>
    <script src="./js/main.js"></script>

    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAyjyqgSwFgtNUj84wtqmcBLRQvY3W6Jho&libraries=places&callback=initMap"></script>

    <script type="text/javascript">
      let map;
      document.addEventListener("DOMContentLoaded", () => {

        function $(id){
          return document.querySelector(id);
        }

        function busqueda() {
  const parametros = new FormData();
  parametros.append("operacion", "buscar");
  parametros.append("valor", $("#buscar").value);

  fetch(`./controllers/negocio.controller.php`, {
    method: "POST",
    body: parametros
  })
  .then(respuesta => respuesta.json())
  .then(datos => {
    if (datos.length > 0) {
      // Obtener la primera coincidencia (asumiendo que es la más relevante)
      const primerResultado = datos[0];

      // Obtener la latitud y longitud del resultado
      const latitud = parseFloat(primerResultado.latitud);
      const longitud = parseFloat(primerResultado.longitud);

      // Centrar el mapa en la ubicación del negocio
      map.setCenter({ lat: latitud, lng: longitud });
      map.setZoom(16);

      // Agregar un marcador en la ubicación del negocio
      const marcadorNegocio = new google.maps.Marker({
        position: { lat: latitud, lng: longitud },
        map: map,
        title: primerResultado.nombre
      });

      // Mostrar información del negocio al hacer clic en el marcador
      marcadorNegocio.addListener('click', function () {
        mostrarInfoWindow(primerResultado, marcadorNegocio);
      });
    } else {
      console.log("No se encontraron resultados para la búsqueda.");
    }
  })
  .catch(e => {
    console.error(e);
  });
}


        // EVENTOS
        $("#buscar").addEventListener("keypress", (event) =>{
          if(event.keyCode == 13){
            busqueda();
          }
        });

        function getCategoria() {
          const parametros = new FormData();
          parametros.append("operacion", "listar");

          fetch(`./controllers/categoria.controller.php`, {
            method: "POST",
            body: parametros
          })
          .then(respuesta => respuesta.json())
          .then(datos => {
            const categoriaDiv = document.getElementById("categoria");

            datos.forEach(element => {
              const enlace = document.createElement("a");
              enlace.className = "nav-link corrector_nav tabs";
              enlace.setAttribute("data-bs-toggle", "collapse");
              enlace.setAttribute("onclick", `kiosco(event, '${element.nomcategoria}')`);

              const icono = document.createElement("i");
              icono.className = "bi bi-chevron-down";

              enlace.innerHTML = `${element.nomcategoria} `;
              enlace.appendChild(icono);

              categoriaDiv.appendChild(enlace);
            });
          })
          .catch(e => {
            console.error(e);
          });
        }

        function cargarSubcategorias() {
          const parametros = new FormData();
          parametros.append("operacion", "listarsub");

          fetch(`./controllers/subcategoria.controller.php`, {
            method: "POST",
            body: parametros
          })
          .then(respuesta => respuesta.json())
          .then(datos => {
            console.log(datos);
            const subcategoriaDiv = document.getElementById("subcategoria");
            datos.forEach(element => {
              // Mostrar categoría
              const nuevaFilaCategoria = `
                <div id="${element.categoria}" class="pb-5 w-820 text-center nego_acti" style="display:none;" data-id="${element.categoria}">
                  <span class="topright">&times;</span>

                  <div class="row pb-4 hyundai"  id="subcategoria-${element.categoria}"></div>
                </div>
              `;
              subcategoriaDiv.innerHTML += nuevaFilaCategoria;

              // Mostrar subcategorías
              const subcategoriaContainer = document.getElementById(`subcategoria-${element.categoria}`);
              element.subcategorias.forEach(subcategoria => {
                const nuevaFilaSubcategoria = `
                  <div class="col-sm"><button type="button" class="btn btn-light col-11" data-idsubcategoria="${subcategoria.idsubcategoria}">${subcategoria.nomsubcategoria}</button></div>
                `;
                subcategoriaContainer.innerHTML += nuevaFilaSubcategoria;
              });
            });
          })
          .catch(e => {
              console.error(e);
          });
        }

        document.addEventListener('click', function (event) {
          if (event.target.classList.contains('topright')) {
            // Buscar el contenedor padre del elemento clicado
            const subcategoriaContainer = event.target.closest('.nego_acti');
            const categoriaContainer = event.target.classList.contains('tabs');
              
            // Verificar si se encontró un contenedor y cerrarlo
            if (subcategoriaContainer) {
              subcategoriaContainer.style.display = 'none';
            }
            if (categoriaContainer) {
              categoriaContainer.style.display  = 'none';   
            }
          }
        });

        function getDistrito(){
          const parametros = new FormData();
          parametros.append("operacion", "listar")
      
          fetch(`./controllers/distrito.controller.php`, {
            method: "POST",
            body: parametros
          })
          .then(respuesta => respuesta.json())
          .then(datos =>{
            //console.log(datos)
            const distritoSelect = document.getElementById("distrito");
            datos.forEach(element => {
              const etiqueta = document.createElement("option");
              etiqueta.value = element.iddistrito;
              etiqueta.innerHTML = element.nomdistrito;
              distritoSelect.appendChild(etiqueta);
            });
          })
          .catch(e => {
            console.error(e);
          });
        }
      
        function actualizarMapa() {
          const distritoSelect = document.getElementById("distrito");
          const selectedDistritoId = distritoSelect.value;

          //clearMarkers();
          if (selectedDistritoId) {
            // Realiza una llamada para obtener las coordenadas del distrito seleccionado
            obtenerCoordenadasDistrito(selectedDistritoId)
            .then(coordenadas => {
              // Actualiza el mapa con las nuevas coordenadas
              map.setCenter(coordenadas);
              map.setZoom(16);

              // Agrega un marcador en las nuevas coordenadas
              const marcadorDistrito = agregarMarcadorDistrito(selectedDistritoId, coordenadas[0], coordenadas[1]);
            })
            .catch(error => {
              console.error("Error al obtener coordenadas del distrito:", error);
            });
          }
        }

        document.addEventListener('change', function (event) {
          if (event.target.id === 'distrito') {
            actualizarMapa();
          }
        });
      
      
        // Función para obtener las coordenadas del distrito desde el servidor
        function obtenerCoordenadasDistrito(distritoId) {
          const parametros = new FormData();
          parametros.append("operacion", "obtener");
          parametros.append("iddistrito", distritoId);
  
          return fetch(`./controllers/distrito.controller.php`, {
            method: "POST",
            body: parametros
          })
          .then(respuesta => respuesta.json())
          .then(coordenadas => ({
            lat: parseFloat(coordenadas.latitud),
            lng: parseFloat(coordenadas.longitud)
          }));
        }

      
        function carrusel() {
          const parametros = new FormData();
          parametros.append("operacion", "listar");

          fetch(`./controllers/carrusel.controller.php`, {
            method: "POST",
            body: parametros
          })
          .then(respuesta => respuesta.json())
          .then(datos => {
            const subcarruselDiv = document.getElementById("carrusel");

            // Limpiar el contenido existente
            subcarruselDiv.innerHTML = "";

            // Agregar estructura de Owl Carousel
            const owlCarousel = document.createElement("div");
            owlCarousel.className = "owl-carousel owl-2 owl-loaded owl-drag";
            owlCarousel.id = "carrusel";

            const owlStageOuter = document.createElement("div");
            owlStageOuter.className = "owl-stage-outer";
            owlStageOuter.style = "width: 100%; overflow: hidden;";  // Añadido overflow: hidden

            const owlStage = document.createElement("div");
            owlStage.className = "owl-stage";
            owlStage.style = "transform: translate3d(0px, 0px, 0px); transition: all 1s ease 0s; width: 10000%; overflow: hidden;";  //     Ajusta el valor de width según sea necesario

            datos.forEach(element => {
              const owlItem = document.createElement("div");
              owlItem.className = "owl-item";
              owlItem.style = "width: 283.333px; margin-right: 20px;";

              const media29101 = document.createElement("div");
              media29101.className = "media-29101";

              const imgLink = document.createElement("a");
              imgLink.href = "#";

              const imgElement = document.createElement("img");
              imgElement.src = `./imgCarrusel/${element.foto}`;
              imgElement.alt = "Image";
              imgElement.className = "img-fluid";

              imgLink.appendChild(imgElement);
              media29101.appendChild(imgLink);
              owlItem.appendChild(media29101);
              owlStage.appendChild(owlItem);
            });

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
        // Llamar a la función para obtener categorías al cargar la página
        getCategoria();
        cargarSubcategorias();
        getDistrito();
      }); //FIN DEL DOM

      // FUNCIONES PARA EL MAPA
      function initMap() {
        const peruCoords = {
          lat: -13.4098500,
          lng: -76.1323500
        };
        const mapDiv = document.getElementById('mapDiv');
        map = new google.maps.Map(mapDiv, {
          center: peruCoords,
          zoom: 16,
        });
        // Inicializar el objeto infoWindow
        infoWindow = new google.maps.InfoWindow();
        getYourLocation();
      }

      // Declarar una variable global para almacenar los marcadores
      let markers = [];
      let infoWindow;

      function clearMarkers() {
        markers.forEach(marker => {
          marker.setMap(null);
        });
        markers = [];
      } 

      document.addEventListener('change', function (event) {
        if (event.target.id === 'distrito') {
          // Obtener el ID de la subcategoría seleccionada
          console.log(document.querySelector('.nego_acti'));
          const subcategoriaSeleccionada = document.querySelector('.nego_acti').getAttribute('data-idsubcategoria');

          // Obtener el ID del distrito seleccionado
          const distritoSeleccionado = event.target.value;

          // Verificar si se seleccionó una subcategoría y un distrito
          if (subcategoriaSeleccionada && distritoSeleccionado) {
            // Llamar a la función para listar negocios
            listarNegocios(subcategoriaSeleccionada, distritoSeleccionado);
          }
        }
      });

      function listarNegocios(idsubcategoria, iddistrito) {
        console.log("Ingresando a listarNegocios");
        // Limpiar marcadores existentes
        clearMarkers();
        // Limpiar el select de distritos
        const distritoSelect = document.getElementById("distrito");
        distritoSelect.selectedIndex = 0;

        if (iddistrito === distritoSelect.value) {
          return;
        }
        const parametros = new FormData();
        parametros.append("operacion", "obtenerNyH");
        parametros.append("idsubcategoria", idsubcategoria);
        parametros.append("iddistrito", iddistrito);

        fetch('./controllers/negocio.controller.php', {
          method: "POST",
          body: parametros
        })
        .then(respuesta => respuesta.json())
        .then(datos => {
          console.log(datos);
          if (datos.length > 0) {
            // Crear un bucle para recorrer todos los elementos y agregar marcadores
            datos.forEach(element => {
              const point = new google.maps.LatLng(
                parseFloat(element.latitud),
                parseFloat(element.longitud)
              );
              // Agregar un marcador para cada elemento
              const marker = new google.maps.Marker({
                map: map, // Asumo que "map" es tu objeto google.maps.Map
                position: point,
                title: element.nombre,
              });
              // Cambiar 'mouseover' a 'click' para el evento del marcador
              marker.addListener('click', function () {
                mostrarInfoWindow(element, marker);
              });

              markers.push(marker);
            });
            // Centrar y hacer zoom solo si hay marcadores
            if (markers.length > 0) {
              const bounds = new google.maps.LatLngBounds();
              markers.forEach(marker => {
                bounds.extend(marker.getPosition());
              });
              map.fitBounds(bounds);
            }
          }
        })
        .catch(e => {
          console.error(e);
        });
        // Agregar listener para cerrar la ventana de información al hacer clic en el mapa
        map.addListener('click', function () {
          infoWindow.close();
        });
      }

      function agregarMarcadorDistrito(iddistrito, latitud, longitud) {
        const marker = new google.maps.Marker({
          position: new google.maps.LatLng(latitud, longitud),
          map: map,
          icon: "./img/ubicacion.svg"
        });
        return marker;
      }

      // Evento de clic en los botones de subcategoría
      document.addEventListener('click', function (event) {
        if (event.target.classList.contains('btn-light')) {
          const idSubcategoria = obtenerIdSubcategoriaDesdeBoton(event.target);
          if (idSubcategoria !== null) {
            console.log("ID de Subcategoría:", idSubcategoria);
            listarNegocios(idSubcategoria);
          }
        }
      });
    
      // Función para obtener el ID de subcategoría desde el botón
      function obtenerIdSubcategoriaDesdeBoton(boton) {
        // Verificar si el atributo 'data-idsubcategoria' está presente
        if (boton && boton.getAttribute) {
          // Obtener el valor del atributo 'data-idsubcategoria'
          const idSubcategoria = parseInt(boton.getAttribute('data-idsubcategoria'));
          if (!isNaN(idSubcategoria)) {
            return idSubcategoria;
          } else {
            console.error("El botón no tiene un valor válido para 'data-idsubcategoria'.");
            return null;
          }
        } else {
          console.error("El botón no tiene el atributo 'data-idsubcategoria' definido.");
          return null;
        }
      }

      function mostrarInfoWindow(element, marker) {
        // Función para formatear el número de teléfono
        function formatearTelefono(telefono) {
          // Eliminar espacios en blanco existentes y cualquier otro carácter no numérico
          const numeroLimpiado = telefono.replace(/\D/g, '');

          // Dividir el número en bloques de tres dígitos y unirlos con un espacio
          const numeroFormateado = numeroLimpiado.replace(/(\d{3})(\d{3})(\d{3})/, '$1 $2 $3');

          return numeroFormateado;
        }

        // Formatear el número de teléfono antes de insertarlo en la cadena
        const telefono = formatearTelefono(element.telefono);

        

        const contentString = `
          <div class="card-window">
            <div class="logo-window">
              <img src="./img/Donald-Trump-sign-in-snow-Urbandale-IA-Jan.-13-2024.webp" alt="Logo de la chifa oriental" class="imag">
            </div>
            <div class="info-window">
              <h6 class="nombre">Nombre</h6>
              <h1 class="name-window">${element.nombre}</h1>
              <p class="distrito-window">Distrito: ${element.nomdistrito}</>
              <p class="title-window"> <img src="./img/abierto.svg"> ${element.Estado}</p>
              <p class="phone-window" style="color:#5B4AFF; font-weight:600;"><img src="./img/icon_whatsapp.svg"> ${telefono}</p>
            </div>
          </div>`;
// VERIFICAR | ARREGLAR ESTADO
        infoWindow.setContent(contentString);
        infoWindow.open(map, marker);
      }
    
      function getYourLocation() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(
            (position) => {
              const coords = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
              };
              map.setCenter(coords);
              map.setZoom(16);

              new google.maps.Marker({
                position: coords,
                map: map,
                icon: "./img/ubicacion.svg"
              });
            },
            () => {
              alert("Tu navegador está bien, pero ocurrió un error al obtener tu ubicación");
            }
          );
        } else {
          alert("Tu navegador no cuenta con geolocalización");
        }
      } 
    </script>
  </body>
</html>