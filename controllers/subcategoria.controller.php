<?php

require_once '../models/Subcategoria.php';
require_once '../models/Funciones.php';

if (isset($_POST['operacion'])) {
  $subcategoria = new Subcategoria();

  switch ($_POST['operacion']) {

    /*case 'listar':
      $datos = [
        'idcategoria' => $_POST['idcategoria']
      ];
      enviarJSON($subcategoria->listar($datos));
      break;

      case 'listarsub':
        enviarJSON($subcategoria->listarsub());
        break;

      case 'listarxd':
        enviarJSON($subcategoria->listarxd());
        break;*/

        case 'listarsub':
          $categoriasProcesadas = array(); // Variable para almacenar las categorías ya procesadas
          $subcategoriasAgrupadas = $subcategoria->listarsub();
    
          $resultadoFinal = array();
    
          foreach ($subcategoriasAgrupadas as $categoriaNombre => $subcategorias) {
            // Verificar si la categoría ya fue procesada
            if (!in_array($categoriaNombre, $categoriasProcesadas)) {
              // Agregar la categoría solo si no ha sido procesada
              $resultadoFinal[] = array(
                'categoria' => $categoriaNombre,
                'subcategorias' => $subcategorias
              );
    
              // Agregar la categoría a las procesadas
              $categoriasProcesadas[] = $categoriaNombre;
            }
          }
          // Devolver el resultado como JSON
          echo json_encode($resultadoFinal);
          break;
    
  }
}