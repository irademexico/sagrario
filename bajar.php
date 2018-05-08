<?php 

exec("archivo/baja.bat");
$command="mysql -uira -p123 <d:solic.sql"; 
//exec($command,$output=array(),$worked);


$con= new mysqli("localhost", "root", "", "sagrario");

$baselocal= "solicitudes";
if ($con->connect_errno){
    echo "conexion erronea";
    exit();
}
$sql= "SELECT * FROM last_solic";
$result= $con->query($sql);
$solic=$result->fetch_assoc();
$solicitud= $solic['solicitud']+1;


$con->real_query( "INSERT INTO solic_local SELECT * FROM solicitudes WHERE numSolicitud > $solicitud");


$con->real_query( "INSERT INTO solic_local SELECT * FROM solicitudes");

$resul = mysqli_query($con, "SELECT * FROM $baselocal WHERE status = 1");


if ($resul) {
    //echo '<a href="busca.php" target="_blank">Buscar</a>';
 //   echo "<table border = '1'> \n"; 
 //   echo "<tr><td>Solicitud</td><td>Nombre</td><td> Padres </td><td>Padrinos</td><td>Fec.Nacimiento</td><td>Solicitud de</td><td>Numero</td> </tr>\n"; 
$solic="";
$num=0;
//$GLOBALS['$solic'] = ""; 
$idclave=0;
while ($consulta= mysqli_fetch_array($resul)) 
{
  echo "<table border = '1'> \n"; 
    echo "<tr><td>SOLICITUD</td><td>Nombre</td><td> Padres </td><td>Padrinos</td><td>Fec.Nacimiento</td><td>Solicitud de</td><td>Numero</td> </tr>\n"; 
    if ($consulta['solicitud']== 1) {
        $solic = "Bautismo";
        $baseBusca= "bautismo";
    }elseif ($consulta['solicitud']== 2) {
        $solic = "Confirmación";
        $baseBusca="confirma";
    }else{
        $solic = "Matrimonio";
        $baseBusca="matrimonios";
    }
    $fechabau=$consulta['fecNac'];
    $anofn=substr($consulta['fecNac'],0,4);
    $mesfn=substr($consulta['fecNac'],5,2);
    $diafn=substr($consulta['fecNac'],8,2);
    ++$num;
   echo "<tr ><td>".$consulta['numSolicitud']."</td> <td>".$consulta['nombre']." ".$consulta['apPaterno']." ".$consulta['apMaterno']." ".$consulta['esposo']." - ".$consulta['esposa'].    "</td><td>".$consulta['padre']." - ".$consulta['madre']."</td> <td>".$consulta['padrino']." - ".$consulta['madrina']."</td> <td>".$diafn."/".$mesfn."/".$anofn."</td> <td>".$solic."</td> <td>".$num."</td>
     </tr> \n";
    echo "<table border = '.1' align = 'center'> \n"; 
    echo "<tr><td>Solicitud</td><td>Nombre</td><td> Padres </td><td>Padrinos</td><td>Fec.Nacimiento</td><td>CLAVE-LFA</td> </tr>\n"; 
     if ($consulta['solicitud'] == 1){
        $nom="'%".rtrim(ltrim($consulta['nombre']))."%'";
        
        $nombres = preg_split('/\s/', $consulta['nombre'], null, PREG_SPLIT_OFFSET_CAPTURE);
        $numnom= count($nombres);
        $nom1 = $nombres[0];
        if ($numnom > 1) {
          $nom2 = $nombres[1];
        }
        else{
          $nom2 = "";
        }

        $apat="'".trim($consulta['apPaterno'])."'";
        $amat="'".trim($consulta['apMaterno'])."'";
        $spat="'".substr($apat,01,6)."'";
        $smat="'".substr($amat,1,6)."'";
        $snom="'".substr($nom,1,2)."'";
        echo $nom.$papa.$mama;
        $encontrado=mysqli_query($con,  "SELECT * FROM bautismo  WHERE  paterno = $apat AND materno = $amat AND nombre like $nom");
        
          //$x= $encontrado;
        //echo "encontrado". $x;
    if (! $encontrado){
      $encontrado=mysqli_query($con,  "SELECT * FROM bautismo  WHERE  paterno = $spat AND materno = $smat AND nombre like $snom");
    }
    elseif ($encontrado) {
    
     while ($buscabase= mysqli_fetch_array($encontrado))
      {
          $arrclave[$idclave]= $buscabase['clave'];

          echo "<tr ><td>".$buscabase['solicitud'] ."</td> <td>".$buscabase['nombre']." ".$buscabase['paterno']." " . $buscabase['materno'] ."</td><td>".$buscabase['padre']."</td> <td>".$buscabase['madre']."</td> <td>". $buscabase['fechanac'] ."</td> <td>". $buscabase['clave']." </td> </tr> \n";

           


            echo "contador de claves=".$idclave;
          ++$idclave;

      }
      echo "</table>";
    }
    else{

      echo " no se encontro en bautismo a ".$consulta['nombre'];
    }

    }
    elseif($consulta['solicitud'] == 2){

        $nom="%".$consulta['nombre']."%";
        $apat="'".$consulta['apPaterno']."'";
        $amat="'".$consulta['apMaterno']."'";
        $encontrado=mysqli_query($con, "SELECT * FROM confirma WHERE  paterno = $apat AND materno = $amat AND nombre like $nom ");
    }
    if ($encontrado) {
           while ($buscabase= mysqli_fetch_array($encontrado))
      {
          $arrclave[$idclave]= $buscabase['clave'];

          echo "<tr ><td>".$buscabase['solicitud'] ."</td> <td>".$buscabase['nombre']." ".$buscabase['paterno']." " . $buscabase['materno'] ."</td><td>".$buscabase['padre']."</td> <td>".$buscabase['madre']."</td> <td>". $buscabase['fechanac'] ."</td> <td>". $buscabase['clave']." </td> </tr> \n";

           


            echo "contador de claves=".$idclave;
          ++$idclave;

      }
      echo "</table>";

    }



  else{
   // $encontrado=mysqli_query($con, "SELECT * FROM matrimonio WHERE  esposo = $consulta['esposo'] AND esposa = $consulta['esposa'] ");
  }
      
    //  echo "<table border = '1'> \n"; 
    //   echo "<tr><td>Solicitud</td><td>Nombre</td><td> Padres </td><td>Padrinos</td><td>Fec.Nacimiento</td><td>Solicitud de</td><td>Numero</td> </tr>\n"; 
      //echo "</table>";

 //  $encontrado=mysqli_query($con, "SELECT * FROM bautismo WHERE  paterno like 'MAYA' and materno like 'HERNANDEZ'");
   //$encontrado=mysqli_query($con, "SELECT * FROM $baseBusca WHERE nombre like $bnombre and paterno like $bpaterno and materno like $bmaterno");
 //  if ($encontrado) { //1-if
 //  	while ($encontrados= mysqli_fetch_array($encontrado)) {//2-while
 //  		echo "<tr><td>".$encontrados['nombre']." ".$encontrados['paterno']." ".$encontrados['materno']." </td><td>".$encontrados['padre']." - ".$encontrados['madre']."</td> <td>".$encontrados['padrino']." - ".$encontrados['madrina']."</td> <td>".$encontrados['fecbau']."</td>   </tr> \n";
  // 	}// fin while
  // }// fin if
//elseif ($encontrado) {
//	$encontrado=mysqli_query($con, "SELECT * FROM $baseBusca WHERE paterno like $bpaterno and materno like $bmaterno");
//}else{
//	echo "no se encontro a lorena";
//}
}

echo "</table>";

}
else {
    echo "fallo consulta";
}




//$result->free();
$con->close(); 



 ?>