<?php
$usuarios = [
    "user" => "user",
    "antonio" => "1234",
    "pepito" => "perez",
    "asd" => "qwe"
];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nombre = $_POST['nombre'];
    $pass = $_POST['pass'];

    if(array_key_exists($nombre, $usuarios)){
        if($usuarios[$nombre] == $pass){
            echo "Bienvenido $nombre.";
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "No existe el usuario $nombre.";
    }
}
?>
