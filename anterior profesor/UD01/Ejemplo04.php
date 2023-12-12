<?php
echo "Hola, ".$_POST["nombre"]." ".$_POST["apellidos"]."</br>";
echo "Tus intereses son: </br>";
foreach ($_POST["interes"] as $valor) {
    echo "-".$valor."</br>";
}
?>