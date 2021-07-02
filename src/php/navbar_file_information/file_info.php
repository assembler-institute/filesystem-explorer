<?php

if (isset($_POST["callFunc1"])) {
  echo my_ajax_function_from_js($_POST["callFunc1"]);
}

function my_ajax_function_from_js($data_from_function)
{
  if (isset($_COOKIE["gfg"])) {
    echo "<div class= 'd-flex flex-column justify-content-between align-items-start h-100'>" .
      "<h6> Last modified on " .
      date("Y-m-d", filemtime($_COOKIE["gfg"])) .
      "</h6>" .
      "<h6> Last accessed on " .
      date("Y-m-d", fileatime($_COOKIE["gfg"])) .
      "</h6>" .
      "</div>";
    echo "<div class='d-flex flex-column justify-content-between align-items-end h-100'>" .
      "<button id='btn__close--file--Information' type='button' class='btn__close--file--Information btn d-flex justify-content-center align-items-center btn-outline-secondary'>
			<span></span>
				X
			</button>" .
      "<h6> File size " .
      human_filesize(filesize($_COOKIE["gfg"]), 2) .
      "</h6>" .
      "</div>";
  }
  return $data_from_function;
}

// funcion para pasar los datos de Filesize de PHP a una codificación "leible" para humanos
function human_filesize($bytes, $decimals = 2)
{
  $sz = "BKMGTP";
  $factor = floor((strlen($bytes) - 1) / 3);
  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
}

?>
