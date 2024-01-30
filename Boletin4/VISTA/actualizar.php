<!-- Mostramos la información con los valores ya puestos por defecto.-->
<h1>DESCRIPCIÓN DEL PRODUCTO SELECCIONADO</h1>
<form action="<?php echo $_SERVER['PHP_SELF'] . "?actualizar=true"?>" method="post">
    <label for="nombre"><b>Nombre: </b></label>
    <input type="text" name="nombre" id="nombre" value="<?php echo $nombre?>">

    <label for="nombreCorto"><b>Nombre Corto: </b></label>
    <input type="text" name="nombreCorto" id="nombreCorto" value="<?php echo $nombreCorto?>">

    <label for="pvp"><b>P.V.P.: </b></label>
    <input type="number" name="pvp" id="pvp" value="<?php echo $pvp?>">

    <label for="descripcion"><b>Descripción: </b></label>
    <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>

    <input type="hidden" name="codProducto" value="<?php echo $cod; ?>">        

    <button type="submit">Actualizar</button>
    <a class="link" href="index.php">Cancelar</a>

</form>