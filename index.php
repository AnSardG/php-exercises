<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        footer {
            position: absolute;
            bottom: 10px;
            left: 10px;
        }
    </style>
</head>

<?php
$exCount = 11;
$cont = 1;
?>

<body class="bg-light">
<?php if (isset($_GET['ex']) && $_GET['ex'] >= $cont && $_GET['ex'] <= $exCount) : ?>
    <div class="container mt-3">
        <?php require_once('Boletin2/ejercicio' . $_GET['ex'] . '/ejercicio' . $_GET['ex'] . '.php'); ?>
    </div>
    <footer>
        <div class="col-12">
            <a class="btn btn-secondary" href="/php-exercises">Return to menu</a>
        </div>
    </footer>

<?php else : ?>
    <ul>
        <?php while ($cont <= $exCount) : ?>
            <li>
                <a href="<?php echo '?ex=' . $cont; ?>">Ejercicio <?php echo $cont;?></a>
            </li>
            <?php $cont ++; ?>
        <?php endwhile ?>
    </ul>
<?php endif; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
