<style>
    body {
        font-family: Arial, sans-serif;
    }

    #agenda {
        margin-top: 20px;
    }

    #formulario {
        margin-top: 20px;
    }
</style>

<?php
/**
*
* 11. Debes programar una aplicación para mantener una pequeña
* agenda en una única página web programada en PHP. La agenda
* almacenará únicamente dos datos de cada persona: su nombre y un
* número de teléfono. Además, no podrá haber nombres repetidos en
* la agenda. En la parte superior de la página web se mostrará el
* contenido de la agenda. En la parte inferior debe figurar un sencillo
* formulario con dos cuadros de texto, uno para el nombre y otro para
* el número de teléfono. Cada vez que se envíe el formulario:
* a. Si el nombre está vacío, se mostrará una advertencia.
* b. Si el nombre que se introdujo no existe en la agenda, y el
* número de teléfono no está vacío, se añadirá a la agenda.
* c. Si el nombre que se introdujo ya existe en la agenda y se indica
* un número de teléfono, se sustituirá el número de teléfono
* anterior.
* d. Si el nombre que se introdujo ya existe en la agenda y no se
* indica número de teléfono, se eliminará de la agenda la
* entrada correspondiente a ese nombre
 */

//session_start();
if (empty($_SESSION['agenda'])) {
    $_SESSION['agenda'] = [];
}

function mostrarAgenda($agenda)
{
    echo '<div id="agenda">';
    echo '<h2>AGENDA</h2>';
    echo '<table class="table table-bordered">';
    echo '<thead class="thead-light">';
    echo '<tr>';
    echo '<th scope="col">Nombre</th>';
    echo '<th scope="col">Número de teléfono</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    foreach ($agenda as $nombre => $telefono) {
        echo "<tr><td>$nombre</td><td>$telefono</td></tr>";
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
}

function mostrarAdvertencia($mensaje, $estado)
{
    $class = '';
    if ($estado < 0) {
        $class = 'alert alert-danger';
    } else if ($estado == 0) {
        $class = 'alert alert-warning';
    } else {
        $class = 'alert alert-success';
    }

    echo "<div class='$class' role='alert'>$mensaje</div>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $telefono = $_POST["telefono"];

    if (empty($nombre)) {
        mostrarAdvertencia("No ha introducido datos.", -1);
    } else {
        // a. Verificar si el nombre ya existe en la agenda
        if (array_key_exists($nombre, $_SESSION['agenda'])) {
            // c. Si el nombre ya existe, actualizar o eliminar según corresponda

            if (empty($telefono)) {
                // d. Eliminar la entrada si no se proporciona un número de teléfono

                mostrarAdvertencia("Se ha eliminado el registro de $nombre.", -1);
                unset($_SESSION['agenda'][$nombre]);
            } else {
                // c. Actualizar el número de teléfono

                mostrarAdvertencia("Se ha modificado el registro de $nombre.", 0);
                $_SESSION['agenda'][$nombre] = $telefono;
            }
        } else {
            // b. Añadir a la agenda si el nombre no existe

            if (!empty($telefono)) {
                mostrarAdvertencia("Se ha añadido a $nombre.", 1);
                $_SESSION['agenda'][$nombre] = $telefono;
            } else {
                mostrarAdvertencia("Debe introducir un teléfono para añadir a la agenda.", -1);
            }
        }
    }
}
?>

<?php mostrarAgenda($_SESSION['agenda']); ?>

<div id="formulario">
    <h3>NUEVA PERSONA</h3>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" name="nombre" id="nombre" required>
        </div>
        <div class="form-group">
            <label for="telefono">Número de teléfono:</label>
            <input type="text" class="form-control" name="telefono" id="telefono">
        </div>
        <div class="row">
            <div class="col-12 col-md-3 text-center mt-4">
                <button type="submit" class="btn btn-primary w-100">Registrar</button>
            </div>
        </div>
    </form>
</div>
