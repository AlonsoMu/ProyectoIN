<!DOCTYPE html>

<html lang="html">
<head>
  <title>How to Upload Files with JavaScript</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="./subir.css">
  <link rel="icon" href="../img/arrow_down.png" type="image/png">
</head>

<body>
<div id="app">
  <h1>Awesome JavaScript File Uploader 🦄</h1>
  <div id="dropArea">
    <form>
      <p>
        Drop files here<br><br><span class="bold">or</span>
      </p>
      <input name="file" multiple type="file" accept="image/webp, image/jpeg, image/png">
      <span class="bold">and</span>
      <button type="submit" disabled>Upload</button>
    </form>
  </div>

  <progress value="0" max="100"></progress>

  <p>
    <strong>Uploading status:</strong>
    <span id="statusMessage">🤷‍♂ Nothing's uploaded</span>
  </p>

  <p>
    <strong>Uploaded files:</strong>
    <span id="fileNum">0</span>
  </p>

  <ul id="fileListMetadata"></ul>
</div>
<script src="./subir.js"></script>
</body>
</html>