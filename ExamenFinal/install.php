<?php
try {    
    // Crear una conexión PDO con la base de datos (sin seleccionar una base de datos específica)
    $db = new PDO("mysql:host=localhost", "root");
    // Configurar el modo de error para que lance excepciones en lugar de warning
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Leer el contenido del archivo SQL
    $sqlScript = file_get_contents("./MODELO/crear_bd_restaurante.sql");

    // Ejecutar el script SQL
    $db->exec($sqlScript);    
} catch (PDOException $e) {
    echo "Error al ejecutar el script SQL: " . $e->getMessage();
}
