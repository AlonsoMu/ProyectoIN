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
          // Mostrar subcategorías
          const subcategoriaContainer = document.getElementById(`subcategoria-${element.categoria}`);
          element.subcategorias.forEach(subcategoria => {
              const nuevaFilaSubcategoria = `
                  <div class="col-4 mt-4"> <!-- Cambiado de col-sm a col-4 y agregado mb-2 para agregar espacio entre botones -->
                      <button type="button" class="btn btn-light col-11" data-idsubcategoria="${subcategoria.idsubcategoria}">
                          ${subcategoria.nomsubcategoria}
                      </button>
                  </div>
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
    getCategoria();
    cargarSubcategorias();
});