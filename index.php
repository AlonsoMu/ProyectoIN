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
    <link rel="stylesheet" href="./css/toast.css">


    <!-- Style -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/listado.css">
    <link rel="stylesheet" href="./css/window.css">
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
        <a class="nav-link corrector_nav1" data-bs-toggle="collapse" href="listado.php">Todos los negocios</a>
        <span class="text-muted mx-3 m-division"> | </span>
        
      </div>
    </div>

    <div class="w-100 bg-azul reor " id="subcategoria">
      
    </div>

    <!-- BUSCADOR -->
    <div class="container mt-4 d-flex justify-content-center">
      <div class="input-group" style="max-width: 700px;">
        <input type="search" id="buscar" class="form-control" />
        <button type="button" id="btnBuscar" class="bus btn btn-primary">
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
          <select class="form-select" aria-label="Selecciona un distrito" id="selectDistritos">
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
    <script src="./js//owl.carousel.min.js"></script>
    <script src="./js//main.js"></script>
    <script src="./js/subycat/cate.js"></script>
    <script src="./js/busqueda/busqueda.js"></script>
    <script src="./js/carrusel/carrusel.js"></script>
    <!-- Toastr script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAyjyqgSwFgtNUj84wtqmcBLRQvY3W6Jho&libraries=places&callback=initMap"></script>

    <script type="text/javascript">
      
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
      // Declarar variables globales
      let markers = [];
      let infoWindow;
      let selectedIdSubcategoria;

      function clearMarkers() {
        markers.forEach(marker => {
          marker.setMap(null);
        });
        markers = [];
      }

      function getDistrito() {
        const parametros = new FormData();
        parametros.append("operacion", "listar");

        fetch(`./controllers/distrito.controller.php`, {
          method: "POST",
          body: parametros
        })
        .then(respuesta => respuesta.json())
        .then(datos => {
          const distritoSelect = document.getElementById("selectDistritos");
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

      getDistrito();

      document.addEventListener('DOMContentLoaded', function () {
        const selectDistritos = document.getElementById('selectDistritos');

        if (selectDistritos) {
          selectDistritos.addEventListener('change', function (event) {
            const selectedDistrito = event.target.value;

            if (selectedDistrito !== null) {
              console.log("Distrito seleccionado:", selectedDistrito);
              listarNegociosPorDistrito(selectedIdSubcategoria, selectedDistrito);
            } else {
              console.error("No se ha seleccionado un distrito.");
            }
          });
        } else {
          console.error("Elemento con ID 'selectDistritos' no encontrado.");
        }
      });

      document.addEventListener('click', function (event) {
        if (event.target.classList.contains('btn-light')) {
          selectedIdSubcategoria = obtenerIdSubcategoriaDesdeBoton(event.target);
          const selectDistritos = document.getElementById('selectDistritos');
          const selectedDistrito = selectDistritos.value;

          if (selectedIdSubcategoria !== null && selectedDistrito !== null) {
            console.log("ID de Subcategoría:", selectedIdSubcategoria);
            console.log("Distrito seleccionado:", selectedDistrito);
            listarNegociosPorDistrito(selectedIdSubcategoria, selectedDistrito);
          } else {
            console.error("No se pudo obtener el ID de subcategoría o no se ha seleccionado un distrito.");
          }
        }
      });

      function showToast(message, color) {
        if (Notification.permission === "granted") {
          const options = {
            body: message,
            icon: "./img/sting.svg", // Ruta a un icono opcional
          };

          if (color) {
            options.data = { color: color };
          }

          const notification = new Notification("Éxito", options);
        } else if (Notification.permission !== "denied") {
          Notification.requestPermission().then(permission => {
            if (permission === "granted") {
              showToast(message, color); // Llamar nuevamente a showToast después de obtener el permiso
            }
          });
        }
      } 
            

      function listarNegociosPorDistrito(idsubcategoria, iddistrito) {
        console.log("Ingresando a listarNegociosPorDistrito");
        // Limpiar marcadores existentes
        clearMarkers();

        if (!iddistrito) {
          console.log("No se ha seleccionado un distrito.");
          return;
        }

        const parametros = new FormData();
        parametros.append("operacion", "obtenerdist");
        parametros.append("idsubcategoria", idsubcategoria);
        parametros.append("iddistrito", iddistrito);

        fetch('./controllers/ubicacion.controller.php', {
          method: "POST",
          body: parametros
        })
        .then(respuesta => respuesta.text())
        .then(datos => {
          try {
            const jsonDatos = JSON.parse(datos);
            console.log(jsonDatos);

            if (jsonDatos.length > 0) {
              // Resto del código para agregar marcadores
              jsonDatos.forEach(element => {
                const point = new google.maps.LatLng(
                  parseFloat(element.latitud),
                  parseFloat(element.longitud)
                );

                const marker = new google.maps.Marker({
                  map: map,
                  position: point,
                  title: element.nombre,
                });

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

                // Mostrar notificación con la cantidad de negocios encontrados
                const message = `Se encontraron ${jsonDatos.length} negocios en este distrito para la subcategoría dada`;
                showToast(message, "green");
              }
            } else {
              // No se encontraron negocios en este distrito para la subcategoría dada
              showToast("Debe de seleccionar primero una subcategoría", "red");

              // Obtener coordenadas predeterminadas del distrito
              obtenerCoordenadasDistrito(iddistrito)
              .then(coordenadas => {
                // Centrar el mapa en las coordenadas predeterminadas
                map.setCenter(new google.maps.LatLng(coordenadas.lat, coordenadas.lng));
                map.setZoom(16); // Puedes ajustar el nivel de zoom según tus necesidades
              })
              .catch(error => {
                console.error("Error al obtener coordenadas predeterminadas:", error);
              });      
            }
          } catch (error) {
            console.error("Error al parsear la respuesta como JSON:", error);
          }
        })
        .catch(e => {
          console.error(e);
        })
        .finally(() => {
            // Agregar listener para cerrar la ventana de información al hacer clic en el mapa
            map.addListener('click', function () {
              infoWindow.close();
            });
        });

        const selectDistritos = document.getElementById('selectDistritos');
        selectDistritos.value = ''; // Opcionalmente, puedes establecer el valor a null si no quieres seleccionar nada
      }

      function obtenerCoordenadasDistrito(iddistrito) {
        const parametros = new FormData();
        parametros.append("operacion", "obtener");
        parametros.append("iddistrito", iddistrito);

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

      function listarNegocios(idsubcategoria) {
        console.log("Ingresando a listarNegocios");
        // Limpiar marcadores existentes
        clearMarkers();
        // Limpiar el select de distritos
        
        const parametros = new FormData();
        parametros.append("operacion", "obtenerNyH");
        parametros.append("idsubcategoria", idsubcategoria);

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
        if (boton && boton.getAttribute) {
          const idSubcategoria = boton.getAttribute('data-idsubcategoria');
          if (idSubcategoria !== null) {
            return parseInt(idSubcategoria);
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