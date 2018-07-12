<?php 
	$con=new mysqli("localhost","root","","sagrario");

if ($con->connect_errno){
    echo "conexion erronea";
    exit();
}
$base='last_solic';
$sql="SELECT * FROM $base";
$result= $con->query($sql);
$solic=$result->fetch_assoc();
$numSolicitud= $solic['solicitud'];





	date_default_timezone_set('America/Mexico_City');
	$dia=date('N');
	$diasem=$dia;
	if ($diasem>3) {
		$de=4;
	}else{
		$de=2;
	}
	$fecent=mktime(0,0,0, date("m"), date("d")+$de, date("Y"));
	$fecent=date("Y-m-d",$fecent);
	$hoy=date('Y-m-d');


	$con= new mysqli("localhost", "root", "", "sagrario");
	if ($con->connect_errno){
	    echo "conexion erronea";
	    exit();
	}
	
	$base='solicitudes';


	$sql="SELECT  * FROM $base WHERE numSolicitud = $numSolicitud";


	$result = mysqli_query($con, $sql);
	$regs=mysqli_num_rows(mysqli_query($con, $sql));

if ($regs==0) {
	echo "no hay solicitudes";
}else{

 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <!-- Always force latest IE rendering engine or request Chrome Frame -->
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Solicitudes</title>

    <meta name="description" content="Archivo Sagrario Metropolitano" />
    <meta name="keywords" content="sagrario, metropolitano" />

    <link href="css/normalize.css" rel="stylesheet" type="text/css" />
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/3.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <link href="img/favicon.ico" rel="icon" type="image/png" />

    <link rel="stylesheet" type="text/css" href="css/style.css">
    
</head>
<body>  

    <header >
        SAGRARIO METROPOLITANO<br>
        Sistema Archivo

        <form class="formTop" name="form" method="POST" action=''>
            <input class="submitTop" type="submit" name="busca" onclick="enviab('buscasol.php')" value="Corregir"  >
            <input  class="submitTop" type="submit" name="newsol" onclick="enviab('cap_solicitudes.php')" value="Nueva Solicitud" >
            <input  class="submitTop" type="submit" name="sube" onclick="enviab('envia.php')" value="Envia a USB"  >
            <input  class="submitTop" type="submit" name="feccon" onclick="enviab('fechascon.php')" value="Fechas de Confirmacion" >
        </form>
    </header>

    <article class="titulo">Corregir última solicitud</article>


<?php

	//echo "<table border = '1' style='color:#0000cc; width= 80%;'> \n"; 
  	//echo "<tr><td style='width: 7%;'>Solicitud</td><td style='width: 22%;'>Nombre</td><td style='width: 22%;'> Padres </td><td style='width: 22%;'>Padrinos</td><td style='width: 10%;'>Fec.Solicitud</td><td style='width: 10%; '>Solicitud de</td> </tr>"; 
	$checked1="";
	$checked2="";
	$checked3="";
	$checked4="";
	$checked5="";
	$checked6="";
	$checked7="";
	$checked8="";
	$checked9="";
	$func="";

    while ($consulta= mysqli_fetch_array($result)) 
{
 

  if ($consulta['solicitud']== 1) {
  		$sol=1;
        $solic = "Bautismo";
        $baseBusca= "bautismo";
        $checked1="checked";
        $func="javascript:myVisible()";

  }elseif ($consulta['solicitud']== 2) {
  		$sol=2;
        $solic = "Confirmación";
        $baseBusca="confirma";
        $checked2="checked";
        $func="javascript:myVisible2()";
  }else{
  		$sol=3;
        $solic = "Matrimonio";
        $baseBusca="matrimonios";
        $checked3="checked";
        $func="javascript:myVisible3()";
  }
  
  if ($consulta['simple']== 1) {
        $checked4="checked";
  }else{
        $checked5="checked";
  }

  if ($consulta['urgente']== 1) {
        $checked6="checked";
  }else{
        $checked7="checked";
  }

   if ($consulta['para']== 1) {
        $checked8="checked";
        $para=1;
  }else{
        $checked9="checked";
        $para=0;
  }
  $numSol= $consulta['numSolicitud'];
  $fechasol=$consulta['fecaSolicitud'];
  $anosol=substr($consulta['fecaSolicitud'],0,4);
  $messol=substr($consulta['fecaSolicitud'],5,2);
  $diasol=substr($consulta['fecaSolicitud'],8,2);

  //echo "<tr ><td  style='width: 7%;'>".$consulta['numSolicitud']."</td> <td  style='width: 22%;'>".$consulta['nombre']." ".$consulta['apPaterno']." ".$consulta['apMaterno']." ".$consulta['esposo']." - ".$consulta['esposa'].    "</td><td  style='width: 22%;'>".$consulta['padre']." - ".$consulta['madre']."</td> <td  style='width: 22%;'>".$consulta['padrino']." - ".$consulta['madrina']."</td> <td  style='width: 10%;'>".$diasol."/".$messol."/".$anosol."</td> <td style='width: 10%; '>".$solic."</td>       </tr> ";
  $nombre=$consulta['nombre'];
  $paterno=$consulta['apPaterno'];
  $materno=$consulta['apMaterno'];
  $esposo=$consulta['esposo'];
  $esposa=$consulta['esposa'];
  $padre=$consulta['padre'];
  $madre=$consulta['madre'];
  $padrino=$consulta['padrino'];
  $madrina=$consulta['madrina'];
  $fecSacr=$consulta['fecSacr'];
  $fechaNac=$consulta['fecNac'];
  $fecAprox=$consulta['fecAprox'];
  $fecEntrega=$consulta['fecEntrega'];
  $original=$consulta['original'];
}

?>

<?php echo $consulta['numSolicitud'];?>

<form action="imp_solicitud.php" method="POST" target="_blank">
	<article>
		<h4>Numero de solicitud: <?php echo $numSol;?></h4>
		<table >
			<tr><caption style="height: 30px"><h4>Tipo de solicitud</h4></caption>
			</tr>
				<tr width="640">
				<td width="150">
					<input type="hidden" name="busca" value="1">
					<input type="radio" id="sol" name="solicitud" value="1" <?php echo $checked1;?> onchange="myVisible()"  />Bautismo<br>
					<input type="radio" id="sol" name="solicitud" value="2" <?php echo $checked2;?>  onchange="myVisible2()" />Confirmacion<br>
					<input type="radio" id="sol" name="solicitud" value="3" <?php echo $checked3;?>  onchange="myVisible3()"  />Matrimonio<br>
				</td>
				<td width="150">
					<input type="radio" name="simple" value="1"  <?php echo $checked4;?> />Simple<br>
					<input type="radio" name="simple" value="2"  <?php echo $checked5;?> />Certificada<br>
				</td>
				<td width="150">
					<input type="radio" name="urgente" value="1" <?php echo $checked6;?> />Normal<br>
					<input type="radio" name="urgente" value="2" <?php echo $checked7;?> />Urgente<br>
				</td>
				<td width='190'>
				<article id='fMatri' style='height: 40px;'>
				<?php 
				if ($para==1) {
					
				?>		
					<input type='radio' name='para' value='1' checked> para Matrimonio<br>
					<input type='radio' name='para' value='2' >para Otros
				<?php
				}else{
				?>
					<input type='radio' name='para' value='1' >para Matrimonio<br>
					<input type='radio' name='para' value='2' checked>para Otros
				<?php
				}
				?>
	
				</article>
				</td>
			</tr>
		</table>
	</article>
	
	<article id="fNombre" style="white-space: wrap; overflow: hidden;visibility: visible; align-content: left;">
		<table>
			<tr width="600">
				<td style="padding: 10 10 10 10;">
			
					Nombre:<input class="entradatx" type="text" name="nombre"  width="25" value="<?php echo $nombre;?>">
				</td>
				<td style="padding: 10 10 10 10;">
					Apellido Paterno:<input  class="entradatx" type="text" id="input1" name="apPaterno" size="25" value="<?php echo $paterno;?>">
				</td>
				<td style="padding: 10 10 10 10;">
					Apellido Materno:<input  class="entradatx" type="text" id="input3" name="apMaterno" size="25" value="<?php echo $materno;?>">
				</td>
			</tr>
		</table>
	</article>
	<article id="fEsposos" style="white-space: wrap; overflow: hidden;visibility: visible;">
		<table>
			<tr>
				<td style="padding: 10 10 10 10;">
					Esposo:<input  class="entradatx" type="text" name="esposo" size="50" value="<?php echo $esposo;?>">
				</td>
				<td style="padding: 10 10 10 10;">
					Esposa:<input  class="entradatx" type="text" name="esposa" size="50" value="<?php echo $esposa;?>">
				</td>
			</tr>
		</table>
	</article>
	<article id="fPadres" style="white-space: wrap; overflow: hidden;visibility: visible;">
		<table>
		<tr>
			<td style="padding: 20 20 20 20;">
				Padre:<input  class="entradatx" type="text" id="input2" name="padre" size="50" value="<?php echo $padre;?>">
			</td>
			<td style="padding: 10 10 10 10;">
				Madre:<input  class="entradatx" type="text" id="input4" name="madre" size="50" value="<?php echo $madre;?>">					
			</td>
		</tr>
	</table>
	</article>
	<article id="fPadrinos" style="white-space: wrap; overflow: hidden;visibility: visible;">
		<table>
		<tr>
			<td style="padding: 10 10 10 10;">
				Padrino:<input  class="entradatx" type="text" name="padrino" size="50" value="<?php echo $padrino;?>">
			</td>
			<article>
					
					
			<td id="fMadrina" style="padding: 10 10 10 10;">
				<?php 
			if ($sol=1) {
				echo "
				Madrina:<input  class='entradatx' type='text' name='madrina' size='50' value='".$madrina."'>";
			}
			?>					
			</td></article>
		</tr>
	</table>
	</article>
	<article style="white-space: wrap; overflow: hidden;">
		<table width="600">
			<tr >
				<td align="right" style="padding: 10 10 10 10;">Fecha del sacramento:
					
				</td>
				<td style="padding: 10 10 10 10;" >
					<input  class='entrada' type="date" name="fecSacr" value="<?php echo $fecSacr;?>">
				</td>

				<td style="text-align: center;padding: 10 10 10 10;">
					<div id="fNacimiento"  style="visibility: visible;">
						<?php echo "
						Nacimiento:<input  class='entrada' type='date' name='fecNac' value='".$fechaNac."'>";
						?>
					</div>
				</td>
			</tr>
		</table>
	</article>
	<article id="fSolicita" style="white-space: nowrap; overflow: hidden;">
		<table>
		<tr width="600" align="center">
			<td width="150">

						Original:
						<input  class='entrada'  type='checkbox' id='original' name='original' value='1' checked="checked" onchange='verAprox()' >
						<br>
						<div id='hasta'>Busqueda hasta:<br>
						<input  class='entrada' type='date'  name='fecAprox' value='<?php echo $fecAprox; ?>' /> </div>
				

			</td>
			<td width="150" style="padding: 10 10 10 10;">
				Fecha de Entrega: <?php echo "<input  class='entrada'  type='date'  name='fecEntrega' value='".$fecent."' />"; ?></td><TD>
				<input type="hidden" name="hoy" value="<?php echo $hoy;?>">
				
				<input class="submitDown" type="submit" value="Imprimir">
			</td>

		</tr>
	</table>
		
	</article>
	<p align="center">
	<tr>
		
	</tr>
	</p>
</form>
</section>
	<script type="text/javascript">
			
			function myVisible(){
				document.getElementById("fBautismo").style.visibility = 'visible';
				document.getElementById("fNombre").style.visibility = 'visible';
				document.getElementById("fEsposos").style.visibility = 'hidden';
				document.getElementById("fConfirma").style.visibility = 'hidden';
				document.getElementById("fMatrimonio").style.visibility = 'hidden';
				document.getElementById("fMatri").style.visibility = 'visible';
				document.getElementById("fPadres").style.visibility = 'visible';
				document.getElementById("fNacimiento").style.visibility = 'visible';
				document.getElementById("fPadrinos").style.visibility = 'visible';
				document.getElementById("fMadrina").style.visibility = 'visible';
			}
			function myVisible2(){
				document.getElementById("fBautismo").style.visibility = 'hidden';
	   			document.getElementById("fConfirma").style.visibility = 'visible';
	   			document.getElementById("fMatrimonio").style.visibility = 'hidden';
	   			document.getElementById("fMatri").style.visibility = 'hidden';
				document.getElementById("fNombre").style.visibility = 'visible';
				document.getElementById("fEsposos").style.visibility = 'hidden';
				document.getElementById("fPadres").style.visibility = 'visible';
				document.getElementById("fNacimiento").style.visibility = 'hidden';
				document.getElementById("fPadrinos").style.visibility = 'visible';
				document.getElementById("fMadrina").style.visibility = 'hidden';
			}
			function myVisible3(){
				document.getElementById("fBautismo").style.visibility = 'hidden';
	   			document.getElementById("fConfirma").style.visibility = 'hidden';
	   			document.getElementById("fMatrimonio").style.visibility = 'visible';
	   			document.getElementById("fMatri").style.visibility = 'hidden';
	   			document.getElementById("fNombre").style.visibility = 'hidden';
				document.getElementById("fEsposos").style.visibility = 'visible';
				document.getElementById("fPadres").style.visibility = 'hidden';
				document.getElementById("fPadrinos").style.visibility = 'hidden';
				document.getElementById("fNacimiento").style.visibility = 'hidden';
			}
			function verAprox(){
				if(document.getElementById("original").checked){
					document.getElementById("hasta").style.visibility = 'hidden';
					document.getElementById("original").value = '1';
					document.getElementById("original").name = 'original';
				}
				else{
					document.getElementById("hasta").style.visibility = 'visible';
					document.getElementById("original").value = '0';
				}
			}
	</script>
	<SCRIPT LANGUAGE="JavaScript">
	function enviab(pag){ 
		document.form.action= pag 
		document.form.submit() 
	} 
	    $(document).ready(function () {
        $("#input1").keyup(function () {
            var value = $(this).val();
            $("#input2").val(value);
        });
    });

	        $(document).ready(function () {
        $("#input3").keyup(function () {
            var value = $(this).val();
            $("#input4").val(value);
        });
    });
	</script>

    <footer>
        Derechos Reservados - José Ignacio Virgilio Ruiz Arroyo
    </footer>
</body>
</html>
<?php 
}
 ?>