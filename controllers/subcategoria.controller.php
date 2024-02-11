<?php

require_once '../models/Subcategoria.php';
require_once '../models/Funciones.php';

if (isset($_POST['operacion'])) {
  $subcategoria = new Subcategoria();

  switch ($_POST['operacion']) {

    case 'listar':
      enviarJSON($subcategoria->listar());
      break;


    case 'listarsub':
      $categoriasProcesadas = array(); 
      $subcategoriasAgrupadas = $subcategoria->listarsub();

      $resultadoFinal = array();

      foreach ($subcategoriasAgrupadas as $categoriaNombre => $subcategorias) {
        if (!in_array($categoriaNombre, $categoriasProcesadas)) {
          $resultadoFinal[] = array(
            'categoria' => $categoriaNombre,
            'subcategorias' => $subcategorias
          );

          $categoriasProcesadas[] = $categoriaNombre;
        }
      }
      echo json_encode($resultadoFinal);
      break;
  }
}
