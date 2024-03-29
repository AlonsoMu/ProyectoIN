<?php


date_default_timezone_set("America/Lima");
require_once '../models/Negocios.php';
require_once '../models/Funciones.php';


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
        'portada'         => ''
      ];
      //Solo movemos la imagen, si esta existe (uploaded)
      if (isset($_FILES['logo'])) {
        if (move_uploaded_file($_FILES['logo']['tmp_name'], "../imgLogos/" . $nombreArchivo)) {
          $datosEnviar["logo"] = $nombreArchivo;
        }
      }
      if (isset($_FILES['portada'])) {
        if (move_uploaded_file($_FILES['portada']['tmp_name'], "../imgPortada/" . $nombreArchivo)) {
          $datosEnviar["portada"] = $nombreArchivo;
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
    case 'listarSubyDis':
      $datosEnviar = [
        'idsubcategoria' => $_POST['idsubcategoria'],
        'iddistrito' => $_POST['iddistrito']
      ];
      $resultados = $negocio->listarSubyDis($datosEnviar);

      if (empty($resultados)) {
        $mensaje = "No se encontraron negocios para la subcategoría y el distrito especificados.";
        enviarJSON(['mensaje' => $mensaje]);
      } else {
        enviarJSON($resultados);
      }

      break;
    case 'listarCardSub':
      $datosEnviar = [
        'idsubcategoria' => $_POST['idsubcategoria']
      ];
      enviarJSON($negocio->listarPorSub($datosEnviar));
      break;
    case 'listarPorDis':
      $datosEnviar = [
        'iddistrito' => $_POST['iddistrito']
      ];
      enviarJSON($negocio->listarPorDis($datosEnviar));
      break;

    case 'busquedaCard':
      $nombreComercial = $_POST['nombre_comercial'];
      $datosEnviar = [
        'nombre_comercial' => $nombreComercial
      ];
      $resultados = $negocio->busquedaCard($datosEnviar);

      if (empty($resultados)) {
        // Si no hay resultados, enviar un mensaje indicando que no se encontró el negocio
        $respuesta = [
          'mensaje' => 'No se encontró el negocio',
          'resultados' => []
        ];
      } else {
        // Si hay resultados, enviar los resultados
        $respuesta = [
          'mensaje' => 'Negocio encontrado',
          'resultados' => $resultados
        ];
      }

      enviarJSON($respuesta);
      break;


    case 'obtenerid':
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
        'idnegocio' => $_POST['idnegocio'],
        'dia_actual' => $dia_actual
      ];
      enviarJSON($negocio->obtenerid($datos));
      break;

    case 'obtenerMap':
      $datosEnviar = [
        'idnegocio' => $_POST['idnegocio']
      ];
      enviarJSON($negocio->obtenerMapa($datosEnviar));
      break;

    case 'listarAdm':
      enviarJSON($negocio->listarAdm());
      break;

    case 'inactive':
      $datosEnviar = [
        'idnegocio' => $_POST['idnegocio']
      ];
      enviarJSON($negocio->inactive($datosEnviar));
      break;

    case 'editar':
      try {
        //Generar un nombre a partir del momento exacto
        $ahora = date('dmYhis');
        $nombreArchivo = sha1($ahora) . ".jpg";

        $datosEnviar = [
          'idnegocio'       => $_POST['idnegocio'],
          'iddistrito'      => $_POST['iddistrito'],
          'idpersona'       => $_POST['idpersona'],
          'idsubcategoria'  => $_POST['idsubcategoria'],
          'nombre'          => $_POST['nombre'],
          'descripcion'     => $_POST['descripcion'],
          'direccion'       => $_POST['direccion'],
          'telefono'        => $_POST['telefono'],
          'correo'          => $_POST['correo'],
          'facebook'        => $_POST['facebook'],
          'whatsapp'        => $_POST['whatsapp'],
          'instagram'       => $_POST['instagram'],
          'tiktok'          => $_POST['tiktok'],
          'pagweb'          => $_POST['pagweb']
        ];

        if (isset($_POST['nroruc'])) {
          $datosEnviar['nroruc'] = $_POST['nroruc'];
        }

        // Verificar si se seleccionó una nueva imagen de logo
        if (isset($_FILES['logo']) && $_FILES['logo']['size'] > 0) {
          if (move_uploaded_file($_FILES['logo']['tmp_name'], "../imgLogos/" . $nombreArchivo)) {
            $datosEnviar["logo"] = $nombreArchivo;
          } else {
            throw new Exception('Error al mover la imagen de logo.');
          }
        } else {
          // Si no se selecciona una nueva imagen de logo, mantener la imagen actual
          $datosNegocio = $negocio->obtenerDatos(['idnegocio' => $datosEnviar['idnegocio']]);
          $datosEnviar["logo"] = $datosNegocio['logo'] ?? null;
        }

        // Verificar si se seleccionó una nueva imagen de portada
        if (isset($_FILES['portada']) && $_FILES['portada']['size'] > 0) {
          if (move_uploaded_file($_FILES['portada']['tmp_name'], "../imgPortada/" . $nombreArchivo)) {
            $datosEnviar["portada"] = $nombreArchivo;
          } else {
            throw new Exception('Error al mover la imagen de portada.');
          }
        } else {
          // Si no se selecciona una nueva imagen de portada, mantener la imagen actual
          $datosNegocio = $negocio->obtenerDatos(['idnegocio' => $datosEnviar['idnegocio']]);
          $datosEnviar["portada"] = $datosNegocio['portada'] ?? null;
        }

        // Lógica para editar el negocio
        $negocio->editar($datosEnviar);

        // Respuesta exitosa
        echo json_encode(['success' => true, 'message' => 'Negocio actualizado correctamente']);
      } catch (Exception $e) {
        // En caso de error durante la edición
        echo json_encode(['success' => false, 'message' => 'Error al actualizar el negocio: ' . $e->getMessage()]);
      }
      break;



    case 'obtenerDatos':
      $datosEnviar = [
        'idnegocio' => $_POST['idnegocio']
      ];
      enviarJSON($negocio->obtenerDatos($datosEnviar));
      break;

    case 'busquedaNegocios':
      $datosEnviar = [
        'nombre_comercial' => $_POST['nombre_comercial']
      ];
      enviarJSON($negocio->busquedaNegocios($datosEnviar));
      break;

    case 'busquedaGeneral':
      enviarJson($negocio->busquedaGeneral());
      break;
  }
}
