<?php
$cadena = "Hola perico";
for ($i=strlen($cadena) - 1; $i >= 0 ; $i--) { 
    //echo substr($cadena, $i, 1);
    echo $cadena[$i];
}




/*

$servername = "localhost";
$username = "tu_usuario";
$password = "tu_contraseña";
$database = "nombre_de_tu_base_de_datos";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
}

$sql = "SELECT * FROM usuarios";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "ID: " . $row["id"] . " - Nombre: " . $row["nombre"] . "<br>";
    }
} else {
    echo "No se encontraron resultados";
}

mysqli_close($conn);

// Recibimos el ID del producto a través del formulario con URL
$producto_id = $_GET["id"];

$sql = "SELECT * FROM productos WHERE id = $producto_id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);

    // Agregar el producto al carrito (puede ser un array o una tabla en la base de datos)
    $carrito[] = $row;
    echo "El producto '" . $row["nombre"] . "' se ha agregado al carrito.";
} else {
    echo "El producto no se encontró.";
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];

    // Validación de datos (ejemplo simplificado)
    if (empty($nombre) || empty($correo)) {
        echo "Por favor, complete todos los campos.";
    } else {
        // Insertar datos en la base de datos
        $sql = "INSERT INTO usuarios (nombre, correo) VALUES ('$nombre', '$correo')";
        if (mysqli_query($conn, $sql)) {
            echo "Usuario registrado exitosamente.";
        } else {
            echo "Error al registrar el usuario: " . mysqli_error($conn);
        }
    }
}
*/
?>
