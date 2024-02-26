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
            options.data = {
                color: color
            };
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

    if (!idsubcategoria) {
        console.log("No se ha seleccionado una subcategoría.");
        showToast("Debe seleccionar una subcategoría antes de buscar en un distrito.", "red");

        // Limpiar el selector de distritos
        const selectDistritos = document.getElementById('selectDistritos');
        selectDistritos.value = '';

        return;
    }

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

                if (jsonDatos !== null && jsonDatos.length > 0) {
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
                    showToast(`No se encontraron negocios para la subcategoría en el distrito seleccionado`, "red");

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
                        calcularYDibujarRuta(point);
                    });

                    markers.push(marker);
                });

                getYourLocation();
                // Centrar y hacer zoom solo si hay marcadores
                if (markers.length > 0) {
                    const bounds = new google.maps.LatLngBounds();
                    markers.forEach(marker => {
                        bounds.extend(marker.getPosition());
                    });
                    map.fitBounds(bounds);

                    map.setZoom(18);
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

function calcularYDibujarRuta(destino) {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const directionsService = new google.maps.DirectionsService();
                const directionsRenderer = new google.maps.DirectionsRenderer();

                directionsRenderer.setMap(map);

                const request = {
                    origin: {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    },
                    destination: destino,
                    travelMode: 'DRIVING'
                };

                directionsService.route(request, function (response, status) {
                    if (status === 'OK') {
                        directionsRenderer.setDirections(response);
                        const route = response.routes[0];
                        const leg = route.legs[0];
                        const arrivalTimeDriving = leg.duration.text;
                        alert({arrivalTimeDriving});

                        
                        // Calcular tiempo estimado caminando
                        request.travelMode = 'WALKING';
                        directionsService.route(request, function (response, status) {
                            if (status === 'OK') {
                                const routeWalking = response.routes[0];
                                const legWalking = routeWalking.legs[0];
                                const arrivalTimeWalking = legWalking.duration.text;


                            } else {
                                console.error("Error al calcular la ruta caminando: " + status);
                            }
                        });
                    } else {
                        console.error("Error al calcular la ruta en coche: " + status);
                    }
                });
            },
            () => {
                console.error("Error al obtener la ubicación actual");
            }
        );
    } else {
        console.error("Tu navegador no admite geolocalización");
    }
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

    // Verificar si element.logo está definido
    const logoPath = element.logo ? `./imgLogos/${element.logo}` : './galeria/image.svg'; // Ruta de la imagen alternativa

    const contentString = `
          <div class="card-window">
            <div class="logo-window">
              <a href="./views/menu.php?id=${element.idnegocio}">
                <img src="${logoPath}" alt="Logo de la chifa oriental" class="imag">
              </a>
            </div>
            <div class="info-window">
              <h6 class="nombre">Nombre</h6>
              <h1 class="name-window">${element.nombre}</h1>
              <p class="distrito-window">Distrito: ${element.nomdistrito}</p>
              <p class="title-window"> <img src="./img/abierto.svg"> ${element.Estado}</p>
              <p class="phone-window" style="color:#5B4AFF; font-weight:600;"><img src="./img/icon_whatsapp.svg"> ${telefono}</p>
            </div>
          </div>
        `;

    infoWindow.setContent(contentString);
    infoWindow.open(map, marker);

    // Agregar evento para cerrar el card cuando el mouse sale del card
    infoWindow.addListener('domready', function () {
        const cardWindow = document.querySelector('.card-window');
        cardWindow.addEventListener('mouseleave', function () {
            infoWindow.close();
        });
    });
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