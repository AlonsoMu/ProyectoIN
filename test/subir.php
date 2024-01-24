<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
  <title>Subir Imágenes con upload-js</title>
  <!-- Incluye la librería upload-js -->
 
</head>
<body>



<input type="file" />


<!-- include FilePond library -->
<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>

<script>
    // Get a reference to the file input element
    const inputElement = document.querySelector('input[type="file"]');
    
    // Create a FilePond instance
    const pond = FilePond.create(inputElement);
</script>


</body>
</html>