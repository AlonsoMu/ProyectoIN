document.addEventListener("DOMContentLoaded", () => {
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
  
 
});