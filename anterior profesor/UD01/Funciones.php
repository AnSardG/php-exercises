<?php
function concatena_puntero(&$cad1, $cad2){
    $cad1=$cad1.$cad2;
    return $cad1;
}

$cad1 = "hola ";
$cad2 = "mundo";
echo concatena_puntero($cad1, $cad2);

function concatena_global($cad2){
    global $cadena1;
    $cadena1 .= $cad2;
}

$cadena1 = "Hola";
$cadena2 = ", mundo";
concatena_global($cadena2);
echo "</br><strong>Redefiniendo cadena1 como global: </strong>";
echo "$cadena1.</br>";

function concatena4($cad2){
    $GLOBALS["cadena1"] .= $cad2;    
}
$cadena1 = "Hola";
$cadena2=", mundo";
concatena4($cadena2);
echo "<strong>Accediendo al vector GLOBALS: </strong>";
echo "$cadena1</br>";

require("cabecera.php");
?>