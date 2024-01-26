<?php


date_default_timezone_set("America/Lima");
require_once '../models/Negocios.php';
require_once '../models/Funciones.php';

date_default_timezone_set("America/Lima");

if (isset($_POST['operacion'])) {
  $negocio = new Negocio();

  switch ($_POST['operacion']) {
    case 'obtenerNyH':
      $formato = 'EEEE'; 
      $idioma = 'es';

      $intlDateFormatter = new IntlDateFormatter(
        $idioma,
        IntlDateFormatter::FULL,
        IntlDateFormatter::NONE,
        null,
        null,
        $formato
      );

      $dia_actual = $intlDateFormatter->format(time());

      $datos = [
        'idsubcategoria' => $_POST['idsubcategoria'],
        'dia_actual' => $dia_actual
      ];
      enviarJSON($negocio->obtenerNyH($datos));
    break;
    case 'buscar':
      $formato = 'EEEE'; 
      $idioma = 'es';
    
      $intlDateFormatter = new IntlDateFormatter(
        $idioma,
        IntlDateFormatter::FULL,
        IntlDateFormatter::NONE,
        null,
        null,
        $formato
      );
    
      $dia_actual = $intlDateFormatter->format(time());
    
      try {
        // Verificar si el campo "valor" está vacío o nulo
        if (isset($_POST["valor"]) && !empty($_POST["valor"])) {
          $datosEnviar = [
            "valor"  => $_POST["valor"],
            'dia_actual' => $dia_actual
          ];
          $resultados = $negocio->buscar($datosEnviar);
    
          if (!empty($resultados)) {
            // Si hay resultados, enviar el JSON normal
            enviarJson($resultados);
          } else {
            // Si no hay resultados, enviar un JSON específico
            $jsonRespuesta = [
              'mensaje' => 'No se encontraron negocios.',
              'error' => true
            ];
            echo json_encode($jsonRespuesta);
          }
        } else {
          // Retornar un JSON indicando que no se proporcionó un valor para la búsqueda
          $jsonRespuesta = [
            'mensaje' => 'No se proporcionó un valor para la búsqueda.',
            'error' => true
          ];
          echo json_encode($jsonRespuesta);
        }
      } catch (Exception $e) {
        // Capturar cualquier excepción y devolver un JSON de error
        $jsonError = [
          'mensaje' => 'Error al procesar la búsqueda.',
          'error' => true
        ];
        echo json_encode($jsonError);
      }
    break;
    case 'registrar':
      //Generar un nombre a partir del momento exacto
      $ahora = date('dmYhis');
      $nombreArchivo = sha1($ahora) . ".jpg";

      $datosEnviar = [
        'iddistrito'      => $_POST['iddistrito'],
        'idpersona'       => $_POST['idpersona'],
        'idsubcategoria'  => $_POST['idsubcategoria'],
        'nroruc'          => $_POST['nroruc'],
        'nombre'          => $_POST['nombre'],
        'descripcion'     => $_POST['descripcion'],
        'direccion'       => $_POST['direccion'],
        'telefono'        => $_POST['telefono'],
        'correo'          => $_POST['correo'],
        'facebook'        => $_POST['facebook'],
        'whatsapp'        => $_POST['whatsapp'],
        'instagram'       => $_POST['instagram'],
        'tiktok'          => $_POST['tiktok'],
        'pagweb'          => $_POST['pagweb'],
        'logo'            => '',
        'valoracion'      => $_POST['valoracion']
      ];
      //Solo movemos la imagen, si esta existe (uploaded)
      if (isset($_FILES['logo'])){
        if (move_uploaded_file($_FILES['logo']['tmp_name'], "../imgLogos/" . $nombreArchivo)){
          $datosEnviar["logo"] = $nombreArchivo;
        }
      }
      enviarJSON($negocio->registrar($datosEnviar));
    break;

    case 'buscarNegocio':
      $datos = [
        'negocio' => $_POST['negocio']
      ];
      enviarJSON($negocio->buscarNegocio($datos));
      break;
    case 'listar':
      enviarJSON($negocio->listar());
      break;
  }
}