<?php

mysql_connect("localhost", "root", "");
mysql_select_db('sagrario');
$result = mysql_query("SELECT numSolicitud, padre from solicitudes" ); 
if ($row = mysql_fetch_array($result)){ 
   echo "<table border = '1'> \n"; 
   echo "<tr><td>Nombre</td><td>E-Mail</td></tr> \n"; 
   do { 
      echo "<tr><td>".$row["numSolicitud"]."</td><td>".$row["nombre"]."</td></tr> \n"; 
   } while ($row = mysql_fetch_array($result)); 
   echo "</table> \n"; 
} else { 
echo "¡ No se ha encontrado ningún registro !"; 
} 
?> 
  
