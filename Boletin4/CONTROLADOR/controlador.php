<?php
    //Incluimos la lógica del modelo
    require_once('./MODELO/modelo.php');
    //Obtenemos la lista de familias
    $familias = getFamilias();
    $codigos = getCodFamilias();
        
    //Incluimos la lógica de la vista
    $data = array();
    $data['title'] = "Tienda Online";
    $data['body'] = 'C:\xampp\htdocs\Boletin4\VISTA\vista.php';
    if (isset($_POST['submit'])) {
        $seleccionado = $_POST['seleccionado'];
        $nombreSeleccionado = getNombre($seleccionado);
        $productos = getProductos($seleccionado);
    }

    if(isset($_GET['cod'])){
        $cod = htmlspecialchars($_GET['cod']);
        $producto = getDatosProducto($cod);

        $nombreCorto = $producto['NOMBRE_CORTO'];
        $nombre = $producto['NOMBRE'];
        $pvp = $producto['PVP'];
        $descripcion = $producto['DESCRIPCION'];

        $data['body'] = 'C:\xampp\htdocs\Boletin4\VISTA\actualizar.php';
    }


    if(isset($_GET['actualizar'])) {
        $cod = htmlspecialchars($_POST['codProducto']);
        $nuevo_nombre_corto = $_POST['nombreCorto'];
        $nuevo_nombre = $_POST['nombre'];
        $nuevo_pvp = $_POST['pvp'];
        $nuevo_descripcion = $_POST['descripcion'];

        $modified = false;            

        if($nuevo_nombre_corto != null 
        || $nuevo_nombre != null 
        || $nuevo_pvp != null 
        || $nuevo_descripcion != null){

            $modified = true;

            if($nuevo_nombre_corto != null) {
                updateNombreCorto($nuevo_nombre_corto, $cod);                
            }
            if($nuevo_nombre != null) {
                updateNombre($nuevo_nombre, $cod);
            }
            if($nuevo_pvp != null) {
                updatePvp($nuevo_pvp, $cod);
            }
            if($nuevo_descripcion != null) {
                updateDescripcion($nuevo_descripcion, $cod);
            }
        }   

        if($modified){
            header("Location: index.php?modified=true");        
        } else {
            header("Location: index.php?modified=false");
        } 
    }
    
    require('./VISTA/LAYOUT/layout.php');

    