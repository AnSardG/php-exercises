<?php
$tabla = array(1,10,1,5,1,5,5,8);

$count = array_count_values($tabla);
foreach ($count as $numero => $veces) {
    if($count == 1){
        echo "El número " .$numero . " aparece $veces vez.</br>";
    } else {
        echo "El número " . $numero . " aparece $veces veces.</br>";
    }
}

for ($i=0; $i < 3; $i++) { 
    echo "</br>";
}

for ($i=0; $i < count($tabla); $i++) { 
    $count = 0;
    $num = $tabla[$i];
    if($tabla[$i] != null) {
        for($j = $i; $j < count($tabla); $j++){
            if($tabla[$j] == $num){
                $count++;
                $tabla[$j] = null;
            }
        }
        if($count == 1){
            echo "El número " .$num . " aparece $count vez.</br>";
        } else {
            echo "El número " . $num . " aparece $count veces.</br>";
        }
    }
}

?>