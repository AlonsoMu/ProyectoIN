<?php

function filtrarMejorado($cadenaEntrada)
{
  $caracteresProhibidos = array("<", ">", "*", "/", "{", "}", "[", "]", ";", ",", ".", "(", ")", "\"", "'");
  $caracteresReemplazar = array("");
  return str_replace($caracteresProhibidos, $caracteresReemplazar, $cadenaEntrada);
}


function filtroPremium($cadenaEntrada)
{
  return htmlspecialchars($cadenaEntrada, ENT_QUOTES, 'UTF-8');
}

