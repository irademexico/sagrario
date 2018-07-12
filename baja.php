<?php

exec("c:/xampp/htdocs/archivo/baja.bat");

?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="utf-8">
    <!-- Always force latest IE rendering engine or request Chrome Frame -->
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Archivo</title>
    <meta name="description" content="Archivo Sagrario Metropolitano" />
    <meta name="keywords" content="sagrario, metropolitano" />
    <link href="css/normalize.css" rel="stylesheet" type="text/css" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/3.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="img/favicon.ico" rel="icon" type="image/png" />
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <header >
    SAGRARIO METROPOLITANO<br>
    Sistema Archivo

    <form name="form" method="POST" action='busca.php'>
      <input class="submitTop" type="button" name="inicio" onclick="enviab('index.php')" value="Inicio"   >
      <input  class="submitTop"  type="button" name="archivo" onclick="enviab('archivo.php')" value="Archivo"  >

      ||<input class="entradaMenu"  type="text" name="clave" placeholder="Clave L-F-A">
      <input  class="submitTop"  type="submit" name="busca" onclick="enviab('busca.php')" value="Buscar"  >||
      <input class="submitTop"   type="button" name="solic_local" onclick="enviab('solic_local.php')" value="Solicitudes"  >
      <input class="submitTop"   type="button" name="buscara" onclick="enviab('buscara.php')" value="Busqueda"   >
      <input class="submitTop"   type="button" name="caplibbau" onclick="enviab('cvelibrobau.php')" value="Captura Lib.bautismo"   >
    </form>
  </header>
<?php

$con= new mysqli("localhost", "root", "", "sagrario");

$basebajo='solicitudes';
$baselocal='solic_local';
$sql= "INSERT INTO solic_local SELECT * FROM solicitudes WHERE status= 1";

$con->query($sql);

$sql= "SELECT * FROM solic_local  WHERE status= 1";

$listasol= mysqli_query($con, $sql);

$solic="";
$num=0;
$idclave=0;

while ($consulta= mysqli_fetch_array($listasol))
{
  echo ".<table border = '1' style='color:#0000cc; width= 80%;'> \n";
  echo "<tr style='height:30px'><td style='width: 7%;'>Solicitud</td><td style='width: 22%;'>Nombre</td><td style='width: 22%;'> Padres </td><td style='width: 22%;'>Padrinos</td><td style='width: 10%;'>Fec.Nacimiento</td><td style='width: 10%; '>Solicitud de</td><td style='width: 8%;'>Fec.Solicitud</td> <td style='width: 8%;'> Acción </td></tr>";
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
  $para=$consulta['para'];
  ++$num;

  echo "<tr  style='font-size:1.2em; height:100px; color:#330066;' ><td  style='width: 7%;'>".$consulta['numSolicitud']."-".$consulta['para']."</td> <td  style='width: 22%;'>".$consulta['nombre']." ".$consulta['apPaterno']." ".$consulta['apMaterno']." ".$consulta['esposo']." <br> ".$consulta['esposa']."</td><td  style='width: 22%;'>".$consulta['padre']." <br> ".$consulta['madre']."</td> <td  style='width: 22%;'>".$consulta['padrino']." <br> ".$consulta['madrina']."</td> <td  style='width: 10%;'>".$diafn."/".$mesfn."/".$anofn."</td> <td style='width: 10%; '>".$solic."</td> <td style='width: 8%;'>".$consulta['fecaSolicitud']."</td> <td style='width: 7%;'><a href='nueva.php?numSolicitud=".$consulta['numSolicitud']."'><button>Continuar</button></a> <p> <a href='noexiste.php?numSolicitud=".$consulta['numSolicitud']."'><button>NO ENCONTRO</button></a></td>
     </tr> ";
  //echo "<table border = '.1' style='color:#003333; width= 80%;' > ";
  //echo "<tr ><td style='width: 7%;'>Solicitud</td><td style='width: 17%;'>Nombre</td><td style='width: 17%;'> Padres </td><td style='width: 17%;'>Padrinos</td><td style='width: 10%;'>Fec.Nacimiento</td><td style='width: 110%;'>CLAVE-LFA</td> <td style='width: 7%;'></td> </tr>";
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
    $spat="'%".substr($apat,0,6)."%'";
    $smat="'%".substr($amat,0,6)."%'";
    $snom="'%".substr($consulta['nombre'],0,2)."%'";
    $nom_5="'%".rtrim(ltrim(substr($consulta['nombre'], 0, 5)))."%'";
    $nom_1="'%".rtrim(ltrim(substr($consulta['nombre'], 0, 1)))."%'";
    $patymat="'".$apat." ".$amat."'";
    $fnac="'".$consulta['fecNac']."'";
    //echo $nom."-".$snom."-".$apat."-".$amat."<br>";
    $encontrado=mysqli_query($con,  "SELECT * FROM bautismo  WHERE  paterno = $apat AND materno = $amat AND nombre like $nom ORDER BY madre ASC");
    $regs=mysqli_num_rows(mysqli_query($con, "SELECT * FROM bautismo  WHERE  paterno = $apat AND materno = $amat AND nombre like $nom" ));
    //echo $regs;
    if ($regs == 0){

      //PENDIENTES DE PROGRAMAR BUSQUEDAS AVANZADAS

      $encontrado=mysqli_query($con,  "SELECT * FROM bautismo  WHERE  paterno = $apat AND materno = $amat AND nombre like $snom ORDER BY madre ASC");

       $regs=mysqli_num_rows(mysqli_query($con, "SELECT * FROM bautismo  WHERE  paterno = $apat AND materno = $amat AND nombre like $snom ORDER BY madre ASC" ));

       if ($regs== 0) {
         $encontrado=mysqli_query($con,  "SELECT * FROM bautismo  WHERE  materno = $amat AND nombre like $nom ORDER BY madre ASC");
         $regs=mysqli_num_rows(mysqli_query($con, "SELECT * FROM bautismo  WHERE  paterno = $apat AND materno = $amat AND nombre like $snom ORDER BY madre ASC" ));
         if ($regs==0) {
           echo "<tr ><td style='color:#ff0000;' colspan= '3'>"."NO SE ENCONTRO"."</td></tr> ";
         }


       }

    }

      while ($buscabase= mysqli_fetch_array($encontrado))
        {
          $arrclave[$idclave]= $buscabase['clave'];
          @$fechabau=$buscabase['fechaNac'];
          @$anofn=substr($buscabase['fechaNac'],0,4);
          @$mesfn=substr($buscabase['fechaNac'],5,2);
          @$diafn=substr($buscabase['fechaNac'],8,2);

          echo "<tr style='color:#330033;font-size: 1.2em; height:90px; background:#ccccee;'><td>Base Datos <br> BAUTISMOS<br>".$buscabase['solicitud'] ."</td> <td>".$buscabase['nombre']." ".$buscabase['paterno']." " . $buscabase['materno'] ."</td><td>".$buscabase['padre']."<br>".$buscabase['madre']."</td> <td>".$buscabase['padrino']."<br>".$buscabase['madrina']."</td>";
          echo "<td>".$diafn."-".$mesfn."-".$anofn."</td> <td colspan='2'>". $buscabase['clave']." </td> <td style='width: 7%;'><a href='encontrada.php?clave=".$buscabase['clave']."&ns=".$consulta['numSolicitud']."&para=".$consulta['para']."'><button>Encontrada</button></a> </td> </tr>";

          ++$idclave;
        }
        echo "</table>";


  }
  elseif($consulta['solicitud'] == 2){

        $nom="'%".trim($consulta['nombre'])."%'";
        $apat="'".trim($consulta['apPaterno'])."'";
        $amat="'".trim($consulta['apMaterno'])."'";
        $snom="'%".trim(substr($consulta['nombre'],0,3))."%'";
        $sapat="'".trim(substr($consulta['apPaterno'],0,3))."'";
        $samat="'".trim(substr($consulta['apMaterno'],0,3))."'";
        $papa="'".trim($consulta['padre'])."'";
        $mama="'".trim($consulta['madre'])."'";
        $padrino="'".trim($consulta['padrino'])."'";


        $sql="SELECT * FROM confirma WHERE  paterno = $apat AND materno=$amat AND nombre LIKE $nom ORDER BY madre ASC";
        $encontrado=mysqli_query($con, $sql);
         $regs=mysqli_num_rows(mysqli_query($con, $sql));
         if ($regs==0) {
           $sql="SELECT * FROM confirma WHERE  paterno = $apat AND papa=$papa AND nombre LIKE $nom ORDER BY madre ASC";
           $encontrado=mysqli_query($con, $sql);
            @$regs=mysqli_num_rows(mysqli_query($con, $sql));
            if ($regs==0) {
              $sql="SELECT * FROM confirma WHERE  paterno like $sapat AND materno like $samat AND nombre LIKE $snom ORDER BY madre ASC";
              $encontrado=mysqli_query($con, $sql);
               $regs=mysqli_num_rows(mysqli_query($con, $sql));
               if ($regs==0) {
                 $sql="SELECT * FROM confirma WHERE  madre = $mama ORDER BY madre ASC";
                 $encontrado=mysqli_query($con, $sql);
                  $regs=mysqli_num_rows(mysqli_query($con, $sql));

               }
            }

         }
      if ($regs>0) {

      while ($buscabase= mysqli_fetch_array($encontrado))
      {
          $arrclave[$idclave]= $buscabase['clave'];

          echo "<tr style='height:90px; color:#330033;font-size:1.2em;background-color:#ccccee'; ><td>".$buscabase['solicitud'] ."</td> <td>".$buscabase['nombre']." ".$buscabase['paterno']." " . $buscabase['materno'] ."</td><td>".$buscabase['padre']."<br>".$buscabase['madre']."</td> <td>".$buscabase['padrino']."</td> <td>".$buscabase['fechanac']."</td><td colspan='2'>".$buscabase['clave']."</td><td style='width: 7%;'><a href='encontrada.php?clave=".$buscabase['clave']."&ns=".$consulta['numSolicitud']."'><button>Encontrada</button></a> </td> </tr> ";

          ++$idclave;
      }

      echo "</table>";
    }else{
      echo "<tr ><td style='color:#ff0000;' colspan= '3'>"."NO SE ENCONTRO"."</td></tr> ";
    }


  }

echo "</table>";
}

//$result->free();
$con->close();

?>

  <form action="archivo.php" >
    <input type="submit" name="" value="Pulsa para continuar" style="background-color: #a4d279; width: 100%; height: 100px; color: #1c541d; font-size: 3em;  border-style: groove; border-radius: 10px 10px 10px 10px">
  </form>

  <SCRIPT LANGUAGE="JavaScript">
  function enviab(pag){
    document.form.action= pag
    document.form.submit()
  }
  </script>

  <footer>
    Derechos Reservados - José Ignacio Virgilio Ruiz Arroyo
  </footer>


</body>
</html>
