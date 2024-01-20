
      let map;
      document.addEventListener("DOMContentLoaded", () => {

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
              enlace.setAttribute("onclick", kiosco(event, '${element.nomcategoria}'));

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
              const subcategoriaContainer = document.getElementById(subcategoria-"${element.categoria}");
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
              imgElement.src = "./imgCarrusel/${element.foto}";
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
    