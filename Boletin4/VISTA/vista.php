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

<?php if(isset($_GET['modified']) && $_GET['modified'] == "true"): ?>  
    <h2>Se han modificado los datos satisfactoriamente</h2>
<?php endif; ?>

<?php if(isset($_GET['modified']) && $_GET['modified'] == "false"): ?>    
    <h2>No se modificó ningún dato</h2>
<?php endif; ?>