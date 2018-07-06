<?php 
// duplicados solicitud 9331.10, 17lib foja185,  

$con= new mysqli("localhost", "ira", "123", "sagrario");
$baselocal= "bautismo";
$clave= "'%439  L  10%'";
// 439 L 105 291
$resul = mysqli_query($con, "SELECT * FROM $baselocal WHERE clave like $clave");


if ($resul) {
//      echo '<a href="busca.php" target="_blank">Buscar</a>';
    echo "<table border = '1'> \n"; 
    echo "<tr><td>Clave</td><td>Nombre</td><td>Padres</td><td> Padrinos </td><td>Fec.Nacimiento</td> </tr>\n"; 

  $num=0;
  while ($consulta= mysqli_fetch_array($resul)) 
  {
       echo "<tr><td>".$consulta['clave']."</td> <td>".$consulta['nombre']." ".$consulta['paterno']." ".$consulta['materno'].    "</td><td>".$consulta['padre']." - ".$consulta['madre']."</td> <td>".$consulta['padrino']." - ".$consulta['madrina']."</td> <td>".substr($consulta['fechanac'],8,2)."/". substr($consulta['fechanac'], 9,1)."/".substr($consulta['fechanac'], 0,4)."</td> 
       </tr> \n";
       //date("l, d-m-Y (H:i:s)", $miFecha)
     }
}
else{
    echo "fallo consulta";
}
  $con->close(); 


 ?>