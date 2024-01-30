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
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            margin-bottom: 20px;
        }

        footer {
            text-align: center;
            margin-top: 20px;
            padding: 10px 0;
            background-color: #333;
            color: #fff;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"],
        a {
            display: inline-block;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            color: #fff;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }

        button[type="button"] {
            background-color: #bbb;
        }

        footer {
            margin-top: auto;
            padding: 10px 0;
            background-color: #333;
            color: #fff;
            text-align: center;
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
            background-color: #007BFF;
            margin-left: 10px;
        }

        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <header>
        <h1>Boletín 3 Extra</h1>
    </header>
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

            echo "<h3>El nuevo candidato/a es: $candidato con $mayorVoto votos.</h3>";
            $db->query("UPDATE EMPLEADO SET VOTA_A = NULL;");
        } else {
            echo "<h3>No se ha cerrado la votación ya que no se ha votado a nadie.</h3>";
        }
    }

    ?>
    <footer>
        <?php
            echo "© Antonio Sard González " . date("Y");
        ?>
    </footer>

</body>

</html>