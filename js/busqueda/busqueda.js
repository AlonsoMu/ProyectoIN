document.addEventListener("DOMContentLoaded", () => {
    function $(id) {
      return document.querySelector(id);
    }

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

    function busqueda() {
      // Limpiar marcadores antes de realizar una nueva búsqueda
      clearMarkers();

      const parametros = new FormData();
      parametros.append("operacion", "buscar");
      parametros.append("valor", $("#buscar").value);

      fetch(`./controllers/negocio.controller.php`, {
        method: "POST",
        body: parametros
      })
      .then(respuesta => {
        if (respuesta.ok) {
          return respuesta.json();
        } else {
          throw new Error("No se pudo obtener la información del servidor.");
        }
      })
      .then(datos => {
        if (datos.error) {
          // Si el servidor devuelve un error, mostrar un toast con el mensaje de error
          showToast(datos.mensaje, "#ff3333"); // Rojo
        } else if (datos.length > 0) {
          const primerResultado = datos[0];
          const latitud = parseFloat(primerResultado.latitud);
          const longitud = parseFloat(primerResultado.longitud);

          map.setCenter({ lat: latitud, lng: longitud });
          map.setZoom(16);

          const marcadorNegocio = new google.maps.Marker({
            position: { lat: latitud, lng: longitud },
            map: map,
            title: primerResultado.nombre
          });

          marcadorNegocio.addListener('click', function () {
            mostrarInfoWindow(primerResultado, marcadorNegocio);
          });

          markers.push(marcadorNegocio);

          $("#buscar").value = "";

          // Mostrar el toast al encontrar un negocio
          showToast(`Negocio encontrado: ${primerResultado.nombre}`);
        } else {
          console.log("No se encontraron resultados para la búsqueda.");
          // Mostrar un toast o mensaje indicando que no se encontraron resultados
          showToast("No se encontraron resultados para la búsqueda.", "#ff3333"); // Rojo
        }
      })
      .catch(e => {
        console.error(e);
        // Mostrar un toast o mensaje de error
        showToast("Ocurrió un error al realizar la búsqueda.", "#ff3333"); // Rojo
      });
    }



    $("#buscar").addEventListener("keypress", (event) => {
      if (event.keyCode == 13) {
        busqueda();
      }
    });

    $("#btnBuscar").addEventListener("click", () => {
      busqueda();
    });
  });