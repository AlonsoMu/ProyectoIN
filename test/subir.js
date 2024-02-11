document.addEventListener("DOMContentLoaded", () => {
    function $(id) {
        return document.querySelector(id);
    }




    function calcularTamañoArchivos(files) {
        let totalSize = 0;
        for (const file of files) {
            totalSize += file.size;
        }
        // Convertir el tamaño total de bytes a megabytes con dos decimales
        const totalSizeMB = (totalSize / (1024 * 1024)).toFixed(2);
        return `${totalSizeMB} MB`;
    }

    function busqueda() {
        const parametros = new FormData();
        parametros.append("operacion", "buscarNegocio");
        parametros.append("negocio", $("#negocio").value);

        fetch(`../controllers/negocio.controller.php`, {
            method: "POST",
            body: parametros,
        })
            .then((respuesta) => respuesta.json())
            .then((datos) => {
                console.log("Respuesta de búsqueda completa:", datos);

                if (
                    datos.length > 0 &&
                    datos[0].idnegocio !== undefined &&
                    datos[0].nombre !== undefined
                ) {
                    const resultadoInput = $("#resultado");
                    resultadoInput.value = datos[0].idnegocio + ". " + datos[0].nombre;
                    $("#resultadoBusqueda").style.display = "block";
                } else {
                    console.error(
                        "Los campos idnegocio y/o nombre no están presentes en la respuesta."
                    );
                }
            })
            .catch((e) => {
                console.error("Error en la búsqueda:", e);
            });
    }

    $("#buscar").addEventListener("click", busqueda);

    // Function to handle image upload
    function handleImageUpload() {
        const fileInput = $("#fileInput");
        const progressBar = $(".progress-bar");
        const progressPercentage = $("#progressPercentage");
        const uploadStatus = $("#uploadStatus");
        const uploadSuccess = $("#uploadSuccess");
        const uploadedFilesContainer = $("#uploadedFiles");
        const fileSizeInfo = $("#fileSizeInfo");

        const files = fileInput.files;
        const maxImageCount = 12;

        if (files.length === 0) {
            alert("Selecciona al menos una imagen para cargar.");
            return;
        }

        if (files.length > maxImageCount) {
            alert(`Solo puedes subir hasta ${maxImageCount} imágenes.`);
            // Clear the file input
            fileInput.value = "";
            return;
        }

        // Show progress bar
        $("#imageUploadProgress").style.display = "block";

        // Simulate an upload process
        let progress = 0;
        const interval = setInterval(() => {
            progress += 10;
            if (progressBar) {
                progressBar.style.width = `${progress}%`;
                progressPercentage.innerHTML = `${progress}%`;
            }

            if (progress >= 100) {
                clearInterval(interval);
                if (uploadStatus) {
                    uploadStatus.innerHTML =
                        "¡Éxito! Las imágenes se han cargado correctamente.";
                }
                if (uploadSuccess) {
                    uploadSuccess.style.display = "block";
                }

                // Display uploaded file names
                const fileNames = Array.from(files).map((file) => file.name);
                if (uploadedFilesContainer) {
                    uploadedFilesContainer.innerHTML = `Archivos subidos: ${fileNames.join(
                        ", "
                    )}`;
                    uploadedFilesContainer.style.display = "block";
                }
                if (fileSizeInfo) {
                    fileSizeInfo.innerHTML = "";
                }

            }
        }, 200);
    }

    // Attach the handleImageUpload function to the file input change event
    $("#fileInput").addEventListener("change", () => {
        const files = $("#fileInput").files;

        // Actualizar el texto con el tamaño total de archivos seleccionados
        if (fileSizeInfo) {
            fileSizeInfo.innerHTML = `Tamaño total de archivos seleccionados: ${calcularTamañoArchivos(
                files
            )}`;
        }

        handleImageUpload(); // Llamar a handleImageUpload después de actualizar el tamaño
    });

    // Button click event for Cancel
    $("#cancelar").addEventListener("click", () => {

        // Reset the file input
        $("#fileInput").value = "";

        // Hide the progress bar and uploaded files display
        $("#imageUploadProgress").style.display = "none";
        $("#uploadedFiles").style.display = "none";

        // Reset the success message
        $("#uploadSuccess").innerHTML = "";
        $("#uploadSuccess").style.display = "none";
    });


    function validarFotos() {

        const fotos = $("#fileInput")

        if (fotos.files.length > 10) {

            alert("Solo puedes elegir 10 fotos");

        } else {
            insertGaleria();
        }
    }

    function insertGaleria() {
        const parametros = new FormData();
        parametros.append("operacion", "registrar");
        parametros.append("idnegocio", $("#resultado").value);

        const inputFotografia = $("#fileInput");
        const fotosSeleccionadas = inputFotografia.files;

        for (let i = 0; i < Math.min(10, fotosSeleccionadas.length); ++i) {
            parametros.append("rutafoto[]", fotosSeleccionadas[i]);
        }

        // Obtener elementos relevantes
        const imageUploadProgress = $("#imageUploadProgress");
        const progressBar = $(".progress-bar");
        const uploadSuccess = $("#uploadSuccess");
        const uploadedFilesContainer = $("#uploadedFiles");

        fetch(`../controllers/galeria.controller.php`, {
            method: "POST",
            body: parametros
        })
            .then(result => result.json())
            .then(data => {
                alert("Se registró correctamente");

                // Resetear el formulario después del registro
                const form = $("#form-galeria");
                if (form) {
                    form.reset();
                }

                // Resetear la barra de progreso
                if (progressBar) {
                    progressBar.style.width = "0%";
                }

                // Ocultar el cuadro de carga y la barra de progreso
                if (imageUploadProgress) {
                    imageUploadProgress.style.display = "none";
                }




                // También puedes restablecer otros elementos o realizar acciones adicionales si es necesario

            })
            .catch(e => {
                console.error(e);
            });
    }

    $("#form-galeria").addEventListener("submit", (event) => {
        event.preventDefault();
        validarFotos()
    });
});