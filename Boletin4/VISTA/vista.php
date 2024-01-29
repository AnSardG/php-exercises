<h1>Listado de Familias</h1>
<?php if(isset($_GET['err'])): ?>
    <h2>Ha ocurrido un error a la hora de obtener el producto.</h2>
<?php endif; ?>    

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <label for="familias">Seleccione la familia: </label>
    <select name="seleccionado" id="familia">
        <?php foreach ($familias as $familia): ?>
            <option value="<?php echo $familia['COD']?>"><?php echo $familia['NOMBRE']?></option>
        <?php endforeach; ?>       
    </select>
    <input type="submit" name="submit" value="Mostrar">
</form>

<?php if(isset($seleccionado)): ?>
<h3>Listado de productos de la familia <?php echo $nombreSeleccionado ?>:</h3>
<table>
    <tr>
        <th>Nombre</th>
        <th>P.V.P.</th>
    </tr>
    <?php foreach($productos as $producto): ?>
        <tr>
            <td>
                <?php echo $producto["NOMBRE_CORTO"] ?>
            </td>
            <td>
                <?php echo $producto["PVP"] ?>
            </td>
            <td>
                <a href="index.php?cod=<?php echo $producto['COD'];?>">Editar</a>
            </td>
        </tr>
    <?php endforeach; ?>

<?php endif; ?>

<?php if(isset($_GET['cod'])): ?>
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
        <button type="button"><a class="link" href="index.php">Cancelar</a></button>

    </form>
<?php endif; ?>

<?php if(isset($_GET['modified']) && $_GET['modified']): ?>  
    <h2>Se han modificado los datos satisfactoriamente</h2>
<?php endif; ?>

<?php if(isset($_GET['modified']) && !$_GET['modified']): ?>    
    <h2>No se modificó ningún dato</h2>
<?php endif; ?>