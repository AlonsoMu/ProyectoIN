
const myModal = new bootstrap.Modal(document.getElementById("modalId"));
let idpersona = -1;
let modo = 'registro'; // Variable para controlar si estamos en modo registro o edición
const tabla = document.querySelector("#tabla-clientes tbody");
const formularioCliente = document.getElementById("formulario-cliente");
const apellidosInput = document.getElementById("apellidos");
const nombresInput = document.getElementById("nombres");
const numerodocInput = document.getElementById("numerodoc");
const abrirModalButton = document.getElementById("abrir-modal");

if (abrirModalButton) {
  abrirModalButton.addEventListener("click", () => {
    modo = 'registro'; // Cambiar al modo registro al abrir el modal
    idpersona = -1; // Reiniciar el idpersona a -1
    formularioCliente.reset(); // Restablecer el formulario
    document.getElementById("modal-titulo").innerText = "Registro de Clientes";
  });
} else {
  console.error("Elemento con ID 'abrir-modal' no encontrado.");
}


function $(id) {
  return document.querySelector(id);
}

function crearFilaCliente(registro, numFila) {
  return `
  <tr>
    <td>${numFila}</td>
    <td>${registro.datos}</td>
    <td>${registro.numerodoc}</td>
    <td>${registro.cantidad}</td>         
    <td>
      <button data-idpersona="${registro.idpersona}" class='btn btn-danger btn-sm eliminar' type='button'>Eliminar</button>
      <button data-idpersona="${registro.idpersona}" class='btn btn-warning btn-sm editar' type='button'>Editar</button>
    </td>
  </tr>`;
}

function busquedaCliente() {
  const parametros = new FormData();
  parametros.append("operacion", "buscarCliente");
  parametros.append("cliente", $("#cliente").value);

  fetch(`./controllers/persona.controller.php`, {
    method: "POST",
    body: parametros
  })
  .then(respuesta => respuesta.json())
  .then(datos => {
    console.log("Respuesta de búsqueda:", datos);
    $("#tabla-clientes tbody").innerHTML = '';
    let numFila = 1;
    datos.forEach(registro => {
      $("#tabla-clientes tbody").innerHTML += crearFilaCliente(registro, numFila);
      numFila++;
    });
  })
  .catch(e => {
    console.error("Error en la búsqueda:", e);
  });
}

function listar() {
  const parametros = new FormData();
  parametros.append("operacion", "listaCliente");

  fetch(`./controllers/persona.controller.php`, {
    method: 'POST',
    body: parametros
  })
  .then(respuesta => respuesta.json())
  .then(datosRecibidos => {
    let numFila = 1;
    $("#tabla-clientes tbody").innerHTML = '';
    datosRecibidos.forEach(registro => {
      $("#tabla-clientes tbody").innerHTML += crearFilaCliente(registro, numFila);
      numFila++;
    });
  })
  .catch(e => {
    console.error(e)
  });
}

$("#busqueda").addEventListener("click", busquedaCliente);

// Agregar evento de clic para los botones de editar
tabla.addEventListener('click', (event) => {
  const target = event.target;

  if (event.target.classList.contains("eliminar")) {
    const idpersona = event.target.dataset.idpersona;

    // Mostrar el modal de confirmación
    var confirmarModal = new bootstrap.Modal(document.getElementById('confirmarModal'));
    confirmarModal.show();

    // Agregar un evento de clic al botón de confirmar eliminar dentro del modal
    document.getElementById('confirmarEliminarBtn').addEventListener('click', function() {
      // Lógica para eliminar el registro
      const parametros = new FormData();
      parametros.append("operacion", "eliminar");
      parametros.append("idpersona", idpersona);

      fetch(`./controllers/persona.controller.php`, {
        method: "POST",
        body: parametros
      })
      .then(respuesta => respuesta.text())
      .then(datos => {
        console.log(datos);
        // Cerrar el modal después de eliminar
        confirmarModal.hide();
        listar();
      })
      .catch(e => {
        console.error(e);
        // Cerrar el modal en caso de error
        confirmarModal.hide();
      });
    });
  }

  if (target.classList.contains('editar')) {
    modo = 'edicion'; // Cambiar al modo edición
    idpersona = target.getAttribute('data-idpersona');

    // Obtener datos del cliente por su idpersona
    const parametros = new FormData();
    parametros.append("operacion", "obtener");
    parametros.append("idpersona", idpersona);

    fetch(`./controllers/persona.controller.php`, {
      method: 'POST',
      body: parametros
    })
    .then(respuesta => respuesta.json())
    .then(datosRecibidos => {
      console.log(datosRecibidos)
      // Asumiendo que solo hay un elemento en el array
      const primerElemento = datosRecibidos[0];

      // Llenar el formulario con los datos obtenidos
      apellidosInput.value = primerElemento.apellidos || '';
      nombresInput.value = primerElemento.nombres || '';
      numerodocInput.value = primerElemento.numerodoc || '';
      document.getElementById("modal-titulo").innerText = "Editar Negocio";
      // Abrir el modal
      myModal.show();
    })
    .catch(e => {
      console.error(e);
    });
  }
});

// Agregar evento de clic para el botón "Save"
document.getElementById("guardarDatos").addEventListener('click', () => {
  // Obtener los nuevos valores del formulario
  const nuevosDatos = {
    idpersona: idpersona,
    apellidos: apellidosInput.value,
    nombres: nombresInput.value,
    numerodoc: numerodocInput.value
  };

  let url;
  let operacionMensaje;
  if (modo === 'registro') {
    url = './controllers/persona.controller.php'; // URL para el registro
    operacionMensaje = 'registrado';
  } else {
    url = './controllers/persona.controller.php'; // URL para la edición
    operacionMensaje = 'editado';
  }

  const parametrosActualizar = new FormData();
  parametrosActualizar.append("operacion", modo === 'registro' ? 'registrar' : 'editar'); // Usar 'registrar' o 'editar' según el modo
  parametrosActualizar.append("idpersona", nuevosDatos.idpersona);
  parametrosActualizar.append("apellidos", nuevosDatos.apellidos);
  parametrosActualizar.append("nombres", nuevosDatos.nombres);
  parametrosActualizar.append("numerodoc", nuevosDatos.numerodoc);

  // Realizar la llamada a fetch
  fetch(url, {
    method: 'POST',
    body: parametrosActualizar
  })
  .then(respuesta => respuesta.text())
  .then(resultado => {
    console.log(resultado);
    // Cerrar el modal después de completar la operación
    myModal.hide();
    // Mostrar notificación SweetAlert de éxito después de editar el negocio
    Swal.fire(
      `Cliente ${operacionMensaje}`,
      `El cliente ha sido ${operacionMensaje} correctamente.`,
      'success'
    ).then(() => {
      listar(); // Actualizar la lista después de completar la operación
    });
  })
  .catch(e => {
    console.error(e);
    // Mostrar alerta de error si ocurre algún problema
    Swal.fire(
      'Error',
      'Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.',
      'error'
    );
  });
});

listar();
