<?php
$dwes = new mysqli();
try {
    $dwes->connect('localhost', 'user_dwes', 'userUSER2', 'dwes');
} catch (mysqli_sql_exception $e) {}
if ($errorNum == 0) {
    $resultado = $dwes->query('SELECT producto, unidades FROM stock', MYSQLI_USE_RESULT);
    if ($resultado) {
        print "<p>Se han borrado $dwes->affected_rows registros.</p>";
    }
    $resultado->free(); //Liberamos la RAM de los datos de la consulta   
    $dwes->close();         
}

?>
