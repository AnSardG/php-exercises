<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 9</title>
</head>

<body>
    <!--
    ENUNCIADO:
        9. Crear un formulario que solicite una fecha de nacimiento. Calcular la
        edad del usuario y mostrarla utilizando el método POST.
    -->
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="birthday">Introduzca su fecha de nacimiento: </label>
        <input type="date" name="birthday" required/></br>
        <input type="submit" value="Mostrar edad" name="submit" />
    </form>

    <?php    
    if (isset($_POST['submit'])) {
        $birthday_year = date("Y", strtotime($_POST['birthday']));              
        $today_year = date("Y", strtotime(date("Y-m-d")));
        if($birthday_year > $today_year){
            $mensaje = "Ha introducido una fecha errónea.";
        } else {
            //Extraemos mes y día del año introducido y el de hoy.
            $birthday_month = date("m", strtotime($_POST['birthday']));
            $today_month = date("m", strtotime(date("Y-m-d")));

            $birthday_day = date("d", strtotime($_POST['birthday']));               
            $today_day = date("d", strtotime(date("Y-m-d")));

            // Si a día de hoy no hemos cumplido aún años, descontaremos 1 al año actual para
            // que nos muestre la edad acorde a ello.
            if($today_month >= $birthday_month && $today_day > $birthday_day){
                $today_year--;
            }
            $mensaje = "Edad del usuario: " . $today_year - $birthday_year;
        }
        echo $mensaje;

        unset($_POST['submit']);
    }
    ?>
</body>

</html>