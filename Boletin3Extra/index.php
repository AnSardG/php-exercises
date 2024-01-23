<?php
//Inicialización de la base de datos
try {
    $db = new PDO('mysql:host=localhost;dbname=departamentos', 'gestor_empleados', 'gestorGESTOR2');
    //Configuramos el modo de error para que lance excepciones en lugar de warning.
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Error de conexión: ' . $e->getMessage();
}

session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boletín 3 extra</title>
    <style>        
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        button {
            padding: 10px 15px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .button-primary {
            background-color: #3498db;
            color: #fff;
        }

        .button-success {
            background-color: #2ecc71;
            color: #fff;
        }

        .button-danger {
            background-color: #e74c3c;
            color: #fff;
        }

        a {
            text-decoration: none;
            color: #3498db;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #e74c3c;
        }

    </style>
</head>

<body>
    <!-- Formulario de botones para votar y ver los resultados.-->
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <button class="button-primary" type="submit" name="votar">VOTAR</button>
        <button class="button-success" type="submit" name="resultados">RESULTADOS</button>
    </form>

    <?php
     // Lógica del programa según las acciones del usuario

    if (isset($_GET['dni'])) {
        // Lógica cuando se recibe un DNI ...

        if(isset($_POST['votar'])){
            header("Location: index.php");
        }   

        $_SESSION['dni_votante'] = htmlspecialchars($_GET['dni']);     
        include_once("votaciones.php");

    } else if (isset($_POST['votar'])) {
        // Lógica cuando se presiona el botón de VOTAR...
        include_once("votar.php");

    } else if (isset($_GET['resultados'])) {
        // Lógica cuando se ha votado a un candidato ...
        if (isset($_GET['candidato'])) {
            $candidato = htmlspecialchars($_GET['candidato']);
            $dni = $_SESSION['dni_votante'];

            $db->query("UPDATE EMPLEADO SET VOTA_A = '$candidato' WHERE DNI = '$dni';");
            header("Location: index.php?mostrarresultados=true");
        } else {
            header("Location: index.php");
        }

    } else if (isset($_POST['resultados']) || isset($_GET['mostrarresultados'])) {
        // Lógica cuando se solicitan los RESULTADOS ...
        include_once("resultados.php");

    } else if (isset($_GET['result'])) {
        // Lógica cuando se han cerrado las votaciones ...
        if ($_POST['hayVotos']) {
            $result = $db->query("SELECT E.DNI, E.NOMBRE, E.APELLIDOS, COUNT(V.VOTA_A) AS VOTOS
                FROM EMPLEADO E
                LEFT JOIN EMPLEADO V ON E.DNI = V.VOTA_A
                GROUP BY E.DNI, E.NOMBRE, E.APELLIDOS
                ORDER BY E.APELLIDOS, E.NOMBRE;");

            $mayorVoto = 0;
            while ($rowResult = $result->fetch(PDO::FETCH_ASSOC)) {
                if ($rowResult['VOTOS'] > $mayorVoto) {
                    $mayorVoto = $rowResult['VOTOS'];
                    $candidato = $rowResult['NOMBRE'] . " " . $rowResult['APELLIDOS'];
                }
            }

            echo "El nuevo candidato/a es: $candidato con $mayorVoto votos.";
            $db->query("UPDATE EMPLEADO SET VOTA_A = NULL;");
        } else {
            echo "<p>No se ha cerrado la votación ya que no se ha votado a nadie.</p>";
        }
    }

    ?>

</body>

</html>