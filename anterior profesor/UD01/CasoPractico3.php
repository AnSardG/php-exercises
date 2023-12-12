<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>   
    <table>     
        <td>Número</td>
        <td>Doble del número</td>
        <td>Número al cuadrado</td>
        <td>Raíz cuadrada</td>
    <?php    
        $i = 1;
        echo("<tr>"
        ."<td style=\"color:blue;\">".$i."</td>"  
        ."<td style=\"color:blue;\">".($i * 2)."</td>"
        ."<td style=\"color:blue;\">".($i ** 2)."</td>"
        ."<td style=\"color:blue;\">".sqrt($i)."</td>"          
        ."</tr>");
        for($i=2; $i<=10; $i++){
            echo("<tr>"
            ."<td style=\"color:blue;\">".$i."</td>"  
            ."<td>".($i * 2)."</td>"
            ."<td>".($i ** 2)."</td>"
            ."<td>".sqrt($i)."</td>"          
            ."</tr>");
        }
    ?>
    </table>
</body>
</html>