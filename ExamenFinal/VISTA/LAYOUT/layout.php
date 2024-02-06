<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./VISTA/LAYOUT/layout.css">
    <title>
        <?php echo $data['title'] ?>
    </title>
</head>
<body>
    <header>
        <?php include $data['header'] ?>
    </header>

    <main>
        <?php include $data['body']; ?>
    </main>

    <footer>
        <?php echo $data['footer'] ?>  
    </footer>
</body>
</html>