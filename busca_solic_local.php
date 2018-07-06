<?php
	$solini=$_POST['solini'];
	$solfin=$_POST['solfin'];
	$fecsolini=$_POST['fecsolini'];
	$fecsolfin=$_POST['fecsolfin'];
	$nombre=$_POST['nombre'];
	$paterno=$_POST['paterno'];
	$materno=$_POST['materno'];
	$fecsolfin.$fecsolini;

	$con= new mysqli("localhost", "root", "", "sagrario");
	if ($con->connect_errno){
	    echo "conexion erronea";
	    exit();
	}

	$base='solic_local';

	if ($solini>0) {
		if ($solfin>0) {
			$sql="SELECT  * FROM $base WHERE numSolicitud >= $solini AND numSolicitud <= $solfin ORDER BY numSolicitud DESC";
		}else{
			$sql="SELECT  * FROM $base WHERE numSolicitud = $solini";
		}
	} else {
		echo "nompatmat...";
		if (!empty($fecsolini)) {
			$sql="SELECT  * FROM $base WHERE fecaSolicitud = '$fecsolini' ORDER BY numSolicitud DESC";
		}else{

			$sql="SELECT  * FROM $base WHERE fecaSolicitud BETWEEN '$fecsolini' AND '$fecsolfin' ORDER BY numSolicitud DESC";		
			if (!empty($paterno)) {
				
				if (!empty($materno)) {
					if (!empty($nombre)) {
						$sql="SELECT * FROM $base WHERE apPaterno='$paterno' AND apMaterno='$materno' AND nombre like '$nombre' ORDER BY nombre ASC";
						echo "nompatmat";
					}else {
						$sql="SELECT * FROM $base WHERE apPaterno='$paterno' AND apMaterno='$materno' ORDER BY nombre ASC ";
					}
				}else{
					if (!empty($nombre)) {
						$sql="SELECT * FROM $base WHERE apPaterno='$paterno' AND nombre like '$nombre' ORDER BY nombre ASC";
					}else {
						$sql="SELECT * FROM $base WHERE apPaterno='$paterno'  ORDER BY nombre ASC";
					}
				}
			}else{
				
				if(!empty($nombre)){
					$sql="SELECT * FROM $base WHERE nombre='$nombre' ORDER BY nombre ASC";
				}else{
					if (!empty($materno)) {
						$sql="SELECT * FROM $base WHERE apMaterno='$materno' ORDER BY nombre ASC";
					}
				}
			}
		}
	}
	$result = mysqli_query($con, $sql) ;
	$regs=mysqli_num_rows(mysqli_query($con, $sql));
	

 ?>
<!DOCTYPE html>
<html>
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
<body>  <CENTER>
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

<article><h1>Solicitudes Procesadas</h1></article>

<?php

	echo "<table border = '1' style='color:#0000cc; width= 80%;'> \n";
  	echo "<tr><td style='width: 7%;'>Solicitud</td><td style='width: 22%;'>Nombre</td><td style='width: 22%;'> Padres </td><td style='width: 22%;'>Padrinos</td><td style='width: 10%;'>Fec.Solicitud</td><td style='width: 10%; '>Solicitud de</td> <td style='width: 8%;'> Status </td></tr>";

    while ($consulta= mysqli_fetch_array($result))
{

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

  $fechabau=$consulta['fecaSolicitud'];
  $anofn=substr($consulta['fecaSolicitud'],0,4);
  $mesfn=substr($consulta['fecaSolicitud'],5,2);
  $diafn=substr($consulta['fecaSolicitud'],8,2);
	$status=$consulta['status'];
	if ($status==1) {
		$status="en proceso";
	}elseif ($status==2) {
		$status="no se encontro";
	}elseif ($status==4) {
		$status="impresa";
	}
	$sol=$consulta['numSolicitud'];
  echo "<tr ><td  style='width: 7%;'>".$consulta['numSolicitud']."</td> <td  style='width: 22%;'>".$consulta['nombre']." ".$consulta['apPaterno']." ".$consulta['apMaterno']." ".$consulta['esposo']." - ".$consulta['esposa'].    "</td><td  style='width: 22%;'>".$consulta['padre']." - ".$consulta['madre'];
	echo "</td> <td  style='width: 22%;'>".$consulta['padrino']." - ".$consulta['madrina']."</td> <td  style='width: 10%;'>".$diafn."/".$mesfn."/".$anofn."</td> <td style='width: 10%; '>".$solic."</td> <td style='width: 8%;'>".$status."</td><td><a href='restaurasol.php?numsol=".$sol."'><button>Restaura</button></a><td></tr> ";

}

?>

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
