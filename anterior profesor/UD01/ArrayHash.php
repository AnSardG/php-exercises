<?php
$contactos = array("Juan"=>array("Tlno"=>"1111111", "Email"=>"juan@gmail.com"),
                "Maria"=>array("Tfno"=>"2222222", "Email"=>"maria@gmail.com"),
                "Elena"=>array("Tfno"=>"333333", "Email"=>"elena@gmail.com"));
foreach ($contactos as $clave1 => $contacto) {
    echo("<br/><strong>Nombre contacto: $clave1</strong><br/>");
    foreach ($contacto as $clave2 => $valor) {
        echo " <strong>$clave2: </strong>$valor";        
    }
}
?>