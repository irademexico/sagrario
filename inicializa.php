<?php
date_default_timezone_set('America/Mexico_City');

$dia=date('N'); //1 lunes - 7 domingo
$diasem=$dia;
if ($diasem>4) {
  $de=3;
}else{
  $de=2;
}
$fecent=mktime(0,0,0, date("m"), date("d")+$de, date("Y"));
$fecent=date("Y-m-d",$fecent);
$hoy=date('Y-m-d');

?>
