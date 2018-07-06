<?php 

//exec("baja.bat");


$con= new mysqli("localhost", "root", "", "sagrario");

$baselocal= "solicitudes";
if ($con->connect_errno){
    echo "conexion erronea";
    exit();
}

$resul = mysqli_query($con, "SELECT * FROM $baselocal WHERE status = 1");


if ($resul) {

      $solic="";
      $num=0;
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

                  echo "<tr ><td>".$consulta['numSolicitud'] ."</td> <td>".$consulta['nombre']." ".$consulta['apPaterno']." " . $consulta['apMaterno'] ."</td><td>".$consulta['padre']."</td> <td>".$consulta['madre']."</td> <td>". $consulta['fecNac'] ." </td> </tr> \n";
                  echo "<table border = '.1' align = 'center'> \n"; 
                  echo "<tr><td>Solicitud</td><td>Nombre</td><td> Padres </td><td>Padrinos</td><td>Fec.Nacimiento</td><td>CLAVE-LFA</td> </tr>\n"; 
                  $nom="'%".$consulta['nombre']."%'";
                  $apat="'".$consulta['apPaterno']."'";
                  $amat="'".$consulta['apMaterno']."'";
                  echo $nom."  ".$apat."  ".$amat;

                  $encontrado=mysqli_query($con, "SELECT * FROM confirma WHERE  paterno = $apat AND materno= $amat AND nombre like $nom ");
                  $filas = $encontrado->num_rows;
                  echo $filas;

                  if ($filas==0) 
                  {
                        $encontrado=mysqli_query($con, "SELECT * FROM confirma WHERE  paterno = $apat AND nombre like $nom ");
                        $filas = $encontrado->num_rows;
                        echo $filas."2a vta";
                  }
                  if ($filas==0) 
                  {
                        $apat=$consulta['apPaterno'];
                        $sapat="'%".substr($apat, 2,5)."%'";
                        $amat=$consulta['apMaterno'];
                        $samat="'%".substr($amat, 2,5)."'";
                        $encontrado=mysqli_query($con, "SELECT * FROM confirma WHERE  paterno like $sapat AND materno like $samat");
                        $filas = $encontrado->num_rows;
                        echo $filas."3a vta";
                  }
                  
                  while ($buscabase= mysqli_fetch_array($encontrado))
                    {
                         echo "<tr ><td>".$buscabase['solicitud'] ."</td> <td>".$buscabase['nombre']." ".$buscabase['paterno']." " . $buscabase['materno'] ."</td><td>".$buscabase['padre']."</td> <td>".$buscabase['madre']."</td> <td>". $buscabase['fechanac'] ."</td> <td>". $buscabase['clave']." </td> </tr> \n";
                    }

                    echo "</table>";
      }
}

//$result->free();
$con->close(); 



 ?>