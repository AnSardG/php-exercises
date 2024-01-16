<?php
$db = new PDO('mysql:host=localhost;dbname=dwes', 'user_dwes', 'userUSER2');

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($db->errorCode()) {
    die("Error de conexión a la base de datos: " . $db->errorInfo());
}

$result = $db->query("SELECT DISTINCT PRODUCTO FROM STOCK");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 3</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        <label for="producto">Selecciona un producto:</label>
        <select name="seleccionado" id="producto">
            <?php                                 
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $cod_producto = $row['PRODUCTO'];
                
                $result_producto = $db->query("SELECT NOMBRE_CORTO FROM PRODUCTO WHERE COD = '$cod_producto';");
                $producto = $result_producto->fetch(PDO::FETCH_ASSOC);
                $nombre_producto = $producto['NOMBRE_CORTO'];                

                echo "<option value='" . $cod_producto . "'>" . $nombre_producto . "</option>";
            }
            ?>
        </select>        
        <input type="submit" name="submit" value="Consultar Stock">
    </form>

    <?php
    
    if(isset($_POST['submit'])){
        $seleccionado = $_POST['seleccionado'];                
        
        $result_producto = $db->query("SELECT NOMBRE_CORTO FROM PRODUCTO WHERE COD = '$seleccionado';");
        $producto = $result_producto->fetch(PDO::FETCH_ASSOC);
        $nombre_producto = $producto['NOMBRE_CORTO'];

        echo "<h2>Stock del producto $nombre_producto.</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Tienda</th><th>Unidades</th></tr>"; 
        
        $result = $db->query("SELECT TIENDA, UNIDADES FROM STOCK WHERE PRODUCTO = '$seleccionado'");
        
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $numtienda = $row['TIENDA'];
            $nombre_tienda_result = $db->query("SELECT NOMBRE FROM TIENDA WHERE COD = '$numtienda';");
            $nombre_tienda_row = $nombre_tienda_result->fetch(PDO::FETCH_ASSOC);
            $nombre_tienda = $nombre_tienda_row['NOMBRE'];

            echo "<tr><td>" . $nombre_tienda . "</td><td>" . $row['UNIDADES'] . "</td></tr>";
        }

        echo "</table>";
    }    
    ?>
</body>
</html>