<?php
/**
 * 10. Implementar un formulario que permita al usuario elegir su color
 * favorito de un conjunto de opciones. Al enviar el formulario,
 * mostrar un mensaje personalizado utilizando el método GET.
 */
if(isset($_GET['color'])){
    $color = $_GET['color'];
    echo "El color elegido ha sido el $color.";
} else {
    echo "No ha elegido ningún color.
    <h2>Elige tu color favorito</h2>
    <form action=\"ejercicio10.php\" method=\"get\">
        <label for=\"nombreColor\">Rojo</label>
        <input type=\"radio\" name=\"color\" value=\"rojo\">
        </br>
        <label for=\"nombreColor\">Azul</label>
        <input type=\"radio\" name=\"color\" value=\"azul\">
        </br>
        <label for=\"nombreColor\">Verde</label>
        <input type=\"radio\" name=\"color\" value=\"verde\">
        </br>
        <label for=\"nombreColor\">Morado</label>
        <input type=\"radio\" name=\"color\" value=\"morado\">
        </br>
        <label for=\"nombreColor\">Blanco</label>
        <input type=\"radio\" name=\"color\" value=\"blanco\">
        </br>
        <label for=\"nombreColor\">Negro</label>
        <input type=\"radio\" name=\"color\" value=\"negro\">
        </br></br>
        <input type=\"submit\" value=\"Elegir\">
    </form>";
}
?>