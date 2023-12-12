<?php
echo "<h2>Array normal</h2>";
$v = array(0, 1, 2, 3, 4);
print_r($v);

echo "<h2>Posición 3 null </h2>";
$v[3] = null;
print_r($v);

echo "<h2>Posición 3 eliminada</h2>";
for ($i=0; $i < count($v); $i++) { 
    if($v[$i] == null) {
        unset($v[$i]);
    }
}
print_r($v);

echo "<h2>Sin reindexar peta</h2>";
if(!array_key_exists(3, $v)){
    echo "No existe el indice";
    echo $v[3];
}

echo "<h2>Reindexando array</h2>";
$v = array_values($v);
print_r($v);

echo "<h1>Array fill</h1>";
$arr = array(1, 2);
$arr += array_fill(count($arr), 20, 3);
print_r($arr);
?>