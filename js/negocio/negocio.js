
const myModal = new bootstrap.Modal(document.getElementById("modal-negocio"));
const myModalVisor = new bootstrap.Modal(document.getElementById('modal-visor'));
const myModalPortada = new bootstrap.Modal(document.getElementById('modal-portada'));
let sonDatosNuevos = true;
let idnegocio = -1;
const iddistritoInput = document.getElementById("iddistrito");
const idpersonaInput = document.getElementById("resultado");
const idsubcategoriaInput = document.getElementById("idsubcategoria");
const nrorucInput = document.getElementById("nroruc");
const nombreComercialInput = document.getElementById("nombre");
const descripcionInput = document.getElementById("descripcion");
const direccionInput = document.getElementById("direccion");
const telefonoInput = document.getElementById("telefono");
const correoInput = document.getElementById("correo");
const facebookInput = document.getElementById("facebook");
const whatsappInput = document.getElementById("whatsapp");
const instagramInput = document.getElementById("instagram");
const tiktokInput = document.getElementById("tiktok");
const pagwebInput = document.getElementById("pagweb");
const logoInput = document.getElementById("logo");
const portadaInput = document.getElementById("portada");
const valoracionInput = document.getElementById("valoracion");
const formularioNegocio = document.getElementById("form-negocio")
const tabla = document.querySelector("#tabla-negocios tbody");
const abrirModalButton = document.getElementById("abrir-modal");

if (abrirModalButton) {
  abrirModalButton.addEventListener("click", () => {
    modo = 'registro'; // Cambiar al modo registro al abrir el modal
    idnegocio = -1; // Reiniciar el idpersona a -1
    formularioNegocio.reset(); // Restablecer el formulario
    document.getElementById("modal-titulo").innerText = "Registro de Negocios";
  });
} else {
  console.error("Elemento con ID 'abrir-modal' no encontrado.");
}

function $(id) {
  return document.querySelector(id);
}

function getSubcategoria() {
  const parametros = new FormData();
  parametros.append("operacion", "listar");

  fetch(`./controllers/subcategoria.controller.php`, {
    method: "POST",
    body: parametros
  })
  .then(respuesta => respuesta.json())
  .then(datos => {
    datos.forEach(element => {
      const etiqueta = document.createElement("option");
      etiqueta.value = element.idsubcategoria;
      etiqueta.innerHTML = element.nomsubcategoria;
      $("#idsubcategoria").appendChild(etiqueta);
    });
  })
  .catch(e => {
    console.error(e);
  });
}

function getDistritos() {
  const parametros = new FormData();
  parametros.append("operacion", "listar");

  fetch(`./controllers/distrito.controller.php`, {
    method: "POST",
    body: parametros
  })
  .then(respuesta => respuesta.json())
  .then(datos => {
    datos.forEach(element => {
      const etiqueta = document.createElement("option");
      etiqueta.value = element.iddistrito;
      etiqueta.innerHTML = element.nomdistrito;
      $("#iddistrito").appendChild(etiqueta);
    });
  })
  .catch(e => {
    console.error(e);
  });
}

function busqueda() {
  const parametros = new FormData();
  parametros.append("operacion", "buscar");
  parametros.append("nombre_apellido", $("#nombre_apellido").value);

  fetch(`./controllers/persona.controller.php`, {
    method: "POST",
    body: parametros
  })
  .then(respuesta => respuesta.json())
  .then(datos => {
    console.log("Respuesta de búsqueda:", datos);
    const resultadoInput = $("#resultado");
    resultadoInput.value = datos.idpersona + '' + datos.datos;
    $("#resultadoBusqueda").style.display = "block";
  })
  .catch(e => {
    console.error("Error en la búsqueda:", e);
  });
}

function mostrarImagen(inputId, nombreSpanId) {
  const input = document.getElementById(inputId);
  const nombreSpan = document.getElementById(nombreSpanId);
  const imagenPreview = document.getElementById(`imagen${inputId.charAt(0).toUpperCase() + inputId.slice(1)}`);
  const archivo = input.files[0];

  if (archivo) {
    nombreSpan.textContent = archivo.name;
    const lector = new FileReader();

    lector.onload = function(e) {
      imagenPreview.src = e.target.result;
    };

    lector.readAsDataURL(archivo);
  } else {
    // Limpiar la vista previa si no se selecciona ningún archivo
    nombreSpan.textContent = '';
    imagenPreview.src = '';
  } 
}

// Función para mostrar la vista previa de la imagen
/*function mostrarImagen(inputId, previewId) {
  const input = document.getElementById(inputId);
  const preview = document.getElementById(previewId);
  const archivo = input.files[0];

  if (archivo) {
    const lector = new FileReader();

    lector.onload = function(e) {
      preview.src = e.target.result;
      preview.style.display = 'block'; // Mostrar la vista previa
    };

    lector.readAsDataURL(archivo);
  } else {
    // Ocultar la vista previa si no se selecciona ningún archivo
    preview.src = '';
    preview.style.display = 'none';
  } 
}

// Evento para mostrar la vista previa del logo al seleccionar un archivo
logoInput.addEventListener('change', function() {
  mostrarImagen('logo', 'logo-preview');
});

// Evento para mostrar la vista previa de la portada al seleccionar un archivo
portadaInput.addEventListener('change', function() {
  mostrarImagen('portada', 'portada-preview');
});
*/

function registrar() {
  const parametros = new FormData();
  parametros.append("operacion", "registrar");
  parametros.append("iddistrito", $("#iddistrito").value);
  parametros.append("idpersona", $("#resultado").value);
  parametros.append("idsubcategoria", $("#idsubcategoria").value);
  parametros.append("nroruc", $("#nroruc").value);
  parametros.append("nombre", $("#nombre").value);
  parametros.append("descripcion", $("#descripcion").value);
  parametros.append("direccion", $("#direccion").value);
  parametros.append("telefono", $("#telefono").value);
  parametros.append("correo", $("#correo").value);
  parametros.append("facebook", $("#facebook").value);
  parametros.append("whatsapp", $("#whatsapp").value);
  parametros.append("instagram", $("#instagram").value);
  parametros.append("tiktok", $("#tiktok").value);
  parametros.append("pagweb", $("#pagweb").value);
  parametros.append("logo", $("#logo").files[0]);
  parametros.append("portada", $("#portada").files[0]);
  parametros.append("valoracion", $("#valoracion").value);

  fetch(`./controllers/negocio.controller.php`, {
    method: "POST",
    body: parametros
  })
  .then(respuesta => respuesta.json())
  .then(datos => {
    if (datos.idnegocio > 0) {
      Swal.fire({
      icon: 'success',
      title: `Negocio registrado con el ID: ${datos.idnegocio}`,
      showConfirmButton: false,
      timer: 1500
    });
      $("#form-negocio").reset();
      myModal.hide();
      listarNegocios();
      } else {
    toastr.error(`Error al registrar negocio: ${datos.message}`);
    }
  })
  .catch(e => {
    console.error("Error en la solicitud:", e);
    toastr.error("Ocurrió un error al realizar la solicitud. Por favor, intenta nuevamente.");
  });
} 

// Comunicación Controlador
// Renderizar los datos en la Tabla > tbody

// DETECTANDO click sobre un elemento asíncrono
// Creado en tiempo de ejecución (ELIMINAR - EDITAR)
tabla.addEventListener("click", function(event) {
  // Obtener el elemento clickeado
  const target = event.target;
  idnegocio = parseInt(event.target.dataset.idnegocio);

  // VISOR
  if (event.target.classList.contains("view")) {
    const logo = event.target.dataset.idnegocio;
    $("#visor").setAttribute("src", `./imgLogos/${logo}`);
    myModalVisor.toggle();
  }

  if (event.target.classList.contains("view-portada")) {
    const portada = event.target.dataset.idnegocio;
    $("#visor-portada").setAttribute("src", `./imgPortada/${portada}`);
    myModalPortada.toggle();
  }

  if (event.target.classList.contains("eliminar")) {
    const idnegocio = event.target.dataset.idnegocio;
    Swal.fire({
      title: '¿Estás seguro?',
      text: "No podrás revertir esta acción.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, eliminar',
      cancelButtonText: 'Cancelar'
    })
    .then((result) => {
      if (result.isConfirmed) {
        // Lógica para eliminar el registro
        const parametros = new FormData();
        parametros.append("operacion", "inactive");
        parametros.append("idnegocio", idnegocio);

        fetch(`./controllers/negocio.controller.php`, {
          method: "POST",
          body: parametros
        })
        .then(respuesta => respuesta.text())
        .then(datos => {
          console.log(datos);
          listarNegocios();
          Swal.fire(
            '¡Eliminado!',
            'El negocio ha sido eliminado exitosamente.',
            'success'
          );
        })
        .catch(e => {
          console.error(e);
          Swal.fire(
            'Error',
            'Hubo un error al intentar eliminar el negocio.',
            'error'
          );
        });
      }
    });
  }

  if (target.classList.contains('editar')) {
    // Obtener el idpersona del botón clickeado
    idnegocio = target.getAttribute('data-idnegocio');

    // Restablecer el formulario si son datos nuevos
    if (sonDatosNuevos) {
      $("#form-negocio").reset();
    }

    // Obtener datos del cliente por su idpersona
    const parametros = new FormData();
    parametros.append("operacion", "obtenerDatos");
    parametros.append("idnegocio", idnegocio);

    fetch(`./controllers/negocio.controller.php`, {
      method: 'POST',
      body: parametros
    })
    .then(respuesta => respuesta.json())
    .then(datosRecibidos => {
      console.log(datosRecibidos)
      // Asumiendo que solo hay un elemento en el array
      const primerElemento = datosRecibidos[0];
      sonDatosNuevos = false;

      // Llenar el formulario con los datos obtenidos
      iddistritoInput.value = primerElemento.iddistrito || '';
      idpersonaInput.value = primerElemento.idpersona + ' ' + primerElemento.Cliente || '';
      idsubcategoriaInput.value = primerElemento.idsubcategoria || '';
      nrorucInput.value = primerElemento.nroruc || '';
      nombreComercialInput.value = primerElemento.NombreComercial || '';
      descripcionInput.value = primerElemento.descripcion || '';
      direccionInput.value = primerElemento.direccion || '';
      telefonoInput.value = primerElemento.telefono || '';
      correoInput.value = primerElemento.correo || '';
      facebookInput.value = primerElemento.facebook || '';
      whatsappInput.value = primerElemento.whatsapp || '';
      instagramInput.value = primerElemento.instagram || '';
      tiktokInput.value = primerElemento.tiktok || '';
      pagwebInput.value = primerElemento.pagweb || '';
      if (primerElemento.logo) {
        $("#logo").setAttribute("src", `./imgLogos/${primerElemento.logo}`);
      }
      // Mostrar la imagen de Portada
      if (primerElemento.portada) {
        $("#portada").setAttribute("src", `./imgPortada/${primerElemento.portada}`);
      }
      valoracionInput.value = primerElemento.valoracion || '';

      document.getElementById("modal-titulo").innerText = "Editar Negocio";
      // Abrir el modal
      myModal.show();
    })
    .catch(e => {
      console.error(e);
    });
  }
});

function editarNegocioExistente() {
  const nuevosDatos = {
    idnegocio: idnegocio,
    iddistrito: iddistritoInput.value,
    idpersona: idpersonaInput.value,
    idsubcategoria: idsubcategoriaInput.value,
    nroruc: nrorucInput.value,
    nombre: nombreComercialInput.value,
    descripcion: descripcionInput.value,
    direccion: direccionInput.value,
    telefono: telefonoInput.value,
    correo: correoInput.value,
    facebook: facebookInput.value,
    whatsapp: whatsappInput.value,
    instagram: instagramInput.value,
    tiktok: tiktokInput.value,
    pagweb: pagwebInput.value,
    logo: logoInput.files[0],
    portada: portadaInput.files[0],
    valoracion: valoracionInput.value
  };

  // Enviar los nuevos datos para la actualización
  const parametrosActualizar = new FormData();
  parametrosActualizar.append("operacion", "editar");
  parametrosActualizar.append("idnegocio", nuevosDatos.idnegocio);
  parametrosActualizar.append("iddistrito", nuevosDatos.iddistrito);
  parametrosActualizar.append("idpersona", nuevosDatos.idpersona);
  parametrosActualizar.append("idsubcategoria", nuevosDatos.idsubcategoria);
  parametrosActualizar.append("nroruc", nuevosDatos.nroruc);
  parametrosActualizar.append("nombre", nuevosDatos.nombre);
  parametrosActualizar.append("descripcion", nuevosDatos.descripcion);
  parametrosActualizar.append("direccion", nuevosDatos.direccion);
  parametrosActualizar.append("telefono", nuevosDatos.telefono);
  parametrosActualizar.append("correo", nuevosDatos.correo);
  parametrosActualizar.append("facebook", nuevosDatos.facebook);
  parametrosActualizar.append("whatsapp", nuevosDatos.whatsapp);
  parametrosActualizar.append("instagram", nuevosDatos.instagram);
  parametrosActualizar.append("tiktok", nuevosDatos.tiktok);
  parametrosActualizar.append("pagweb", nuevosDatos.pagweb);
  if (nuevosDatos.logo) {
    parametrosActualizar.append("logo", nuevosDatos.logo);
  } else {
    parametrosActualizar.append("logo_existente", true);
  }
  if (nuevosDatos.portada) {
    parametrosActualizar.append("portada", nuevosDatos.portada);
  } else {
    parametrosActualizar.append("portada_existente", true);
  }
  parametrosActualizar.append("valoracion", nuevosDatos.valoracion);

  fetch(`./controllers/negocio.controller.php`, {
    method: 'POST',
    body: parametrosActualizar
  })
  .then(respuesta => respuesta.text())
  .then(resultado => {
    console.log(resultado);
    try {
      const datosJSON = JSON.parse(resultado);

      if (datosJSON.success) {
        Swal.fire({
        icon: 'success',
        title: 'Negocio editado',
        showConfirmButton: false,
        timer: 1500
      });
        myModal.hide();
        listarNegocios();
        $("#form-negocio").reset();
        sonDatosNuevos = true;
      } else {
        toastr.error(`Error al editar negocio: ${datosJSON.message}`);
      }
    } 
  catch (error) {
      console.error("Error al analizar la respuesta JSON:", error);
      toastr.error("Ocurrió un error al procesar la respuesta del servidor. Por favor, intenta nuevamente.");
    }
  })
  .catch(e => {
    console.error('Error en la solicitud:', e);
    toastr.error('Ocurrió un error al realizar la solicitud. Por favor, intenta nuevamente.');
  });
}

function crearFilaNegocio(registro, numFila) {
  return `
  <tr>
    <td>${numFila}</td>
    <td>${registro.NombreComercial}</td>
    <td>${registro.nomsubcategoria}</td>
    <td>${registro.Cliente}</td>
    <td>${registro.nroruc}</td>
    <td>${registro.nomdistrito}</td>
    <td>${registro.direccion}</td>
    <td>${registro.correo}</td>
    <td>${registro.whatsapp}</td>
    <td>${registro.telefono}</td>
    <td>${registro.facebook}</td>
    <td>${registro.instagram}</td>
    <td>${registro.tiktok}</td>
    <td class="max-width-ellipsis">${registro.descripcion}</td>
    <td><a href='#' class='view' data-idnegocio='${registro.logo}'>Ver imagen</a></td>
    <td><a href='#' class='view-portada' data-idnegocio='${registro.portada}'>Ver portada</a></td>
    <td>${registro.pagweb}</td>
    <td>${registro.valoracion}</td>
    <td>
      <button data-idnegocio="${registro.idnegocio}" class='btn btn-danger btn-sm eliminar' type='button'>Eliminar</button>
      <button data-idnegocio="${registro.idnegocio}" class='btn btn-warning btn-sm editar' type='button'>Editar</button>
    </td>
  </tr>`;
}

function busquedaNegocios() {
  const parametros = new FormData();
  parametros.append("operacion", "busquedaNegocios");
  parametros.append("nombre_comercial", $("#nombre_comercial").value);

  fetch(`./controllers/negocio.controller.php`, {
    method: "POST",
    body: parametros
  })
  .then(respuesta => respuesta.json())
  .then(datos => {
    console.log("Respuesta de búsqueda:", datos);
    $("#tabla-negocios tbody").innerHTML = '';
    let numFila = 1;
    datos.forEach(registro => {
      $("#tabla-negocios tbody").innerHTML += crearFilaNegocio(registro, numFila);
      numFila++;
    });
  })
  .catch(e => {
    console.error("Error en la búsqueda:", e);
  });
}

function listarNegocios() {
  const parametros = new FormData();
  parametros.append("operacion", "listarAdm");

  fetch(`./controllers/negocio.controller.php`, {
    method: 'POST',
    body: parametros
  })
  .then(respuesta => respuesta.json())
  .then(datosRecibidos => {
    let numFila = 1;
    $("#tabla-negocios tbody").innerHTML = '';
    datosRecibidos.forEach(registro => {
      $("#tabla-negocios tbody").innerHTML += crearFilaNegocio(registro, numFila);
      numFila++;
    });
  })
  .catch(e => {
    console.error(e)
  });
}


$("#buscar").addEventListener("click", busqueda);
$("#busqueda").addEventListener("click", busquedaNegocios);
document.getElementById("guardarDatos").addEventListener('click', () => {
  if (sonDatosNuevos) {
    registrar();
  } else {
    editarNegocioExistente();
  }
});

listarNegocios();
getSubcategoria();
getDistritos();
