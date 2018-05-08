<?php 
	$solini=$_POST['solini'];
	$solfin=$_POST['solfin'];
	$fecsolini=$_POST['fecsolini'];
	$fecsolfin=$_POST['fecsolfin'];
	echo $fecsolfin.$fecsolini;

	$con= new mysqli("localhost", "root", "", "sagrario");
	if ($con->connect_errno){
	    echo "conexion erronea";
	    exit();
	}
	
	$base='solicitudes';

	if ($solini>0) {
		if ($solfin>0) {
			$sql="SELECT  * FROM $base WHERE numSolicitud >= $solini AND numSolicitud <= $solfin";	
			# code... busca numsolini hasta numsolfin
		}else{
			$sql="SELECT  * FROM $base WHERE numSolicitud = $solini";
			# code... busca numsolin
		}
	} else {
		if (empty($fecsolfin)) {
			$sql="SELECT  * FROM $base WHERE fecaSolicitud = '$fecsolini'";
		}else{
			$sql="SELECT  * FROM $base WHERE fecaSolicitud BETWEEN '$fecsolini' AND '$fecsolfin'";
			# busca fecsolini hasta fecsolfin
		}
	}

	$result = mysqli_query($con, $sql) or die(error_log('no encontro Solicitudes'));
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

    <link href="img/favicon.png" rel="icon" type="image/png" />

    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>  <CENTER>
    <header style="font-size: 1em; height: 35px;">
        <p style="font-size: 1.3em;height: 15px;">SAGRARIO METROPOLITANO</p>
        Sistema Archivo
    </header>
    </CENTER>
	<section style="font-size: 1em">
		<form name="form" method="POST" action='busca.php'>
			<input  type="submit" name="home" onclick="enviab('index.php')" value="Inicio"  style="background-color: #a4d279; width: 10%; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			
			Clave L.F.A.<input type="text" name="clave">
			<input  type="submit" name="busca" onclick="enviab('busca.php')" value="Busca Acta"  style="background-color: #a4d279; width: 10%; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			<input  type="submit" name="solic_local" onclick="enviab('solic_local.php')" value="Solicitudes"  style="background-color: #a4d279; width: 10%; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			<input  type="submit" name="buscara" onclick="enviab('buscara.php')" value="Busqueda avanzada"  style="background-color: #a4d279; width: auto; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			<input  type="submit" name="caplibbau" onclick="enviab('cvelibrobau.php')" value="Captura Lib. bautismo"  style="background-color: #a4d279; width: auto; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
		</form>
	</section>

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

  echo "<tr ><td  style='width: 7%;'>".$consulta['numSolicitud']."</td> <td  style='width: 22%;'>".$consulta['nombre']." ".$consulta['apPaterno']." ".$consulta['apMaterno']." ".$consulta['esposo']." - ".$consulta['esposa'].    "</td><td  style='width: 22%;'>".$consulta['padre']." - ".$consulta['madre']."</td> <td  style='width: 22%;'>".$consulta['padrino']." - ".$consulta['madrina']."</td> <td  style='width: 10%;'>".$diafn."/".$mesfn."/".$anofn."</td> <td style='width: 10%; '>".$solic."</td> <td style='width: 8%;'>".$consulta['status']."</td> 
     </tr> ";
  
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