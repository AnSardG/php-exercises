<?php
$fechaHoy = date("d-m-Y");
$fechaAyer = date("d-m-Y", strtotime("-1 day"));
$fechaManyana = date("d-m-Y", strtotime("+1 day"));
echo "Hoy: $fechaHoy</br>Ayer: $fechaAyer</br>Mañana: $fechaManyana";
?>