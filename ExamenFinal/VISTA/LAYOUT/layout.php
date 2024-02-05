<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./VISTA/LAYOUT/layout.css">
    <title>
        <?php echo $GLOBALS['title']; ?>
    </title>
</head>
<body>
    <header>
        <?php include $GLOBALS['header']; ?>
    </header>

    <main>
        <?php include $GLOBALS['body']; ?>
    </main>

    <footer>
        <?php echo $GLOBALS['footer'] ?>  
    </footer>
</body>
</html>