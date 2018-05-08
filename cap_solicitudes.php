<?php 
	date_default_timezone_set('America/Mexico_City');
	$hoy=date('Y-m-d');
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
    <link href="img/favicon.png" rel="icon" type="image/png" />

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- <link href="css/bootstrap.css" rel="stylesheet" type="text/css">-->
</head>

<body>

<?php 

$dia=date('N');
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

	<header >
		<p style="font-size: 1.3em; height: 10px; padding-top: 0px; margin-top: 1px;">SAGRARIO METROPOLITANO</p>
		Sistema Archivo
		<form name="form" method="POST" action=''>
			
            		
			<input  type="submit" name="busca" onclick="enviab('buscasol.php')" value="Corregir"  style="background-color: #a4d279; width: 10%; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			<input  type="submit" name="newsol" onclick="enviab('cap_solicitudes.php')" value="Nueva Solicitud"  style="background-color: #a4d279; width: auto; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			<input  type="submit" name="sube" onclick="enviab('envia.php')" value="Envia a USB"  style="background-color: #a4d279; width: auto; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			<input  type="submit" name="feccon" onclick="enviab('fechascon.php')" value="Fechas de Confirmacion"  style="background-color: #a4d279; width: auto; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
		</form>
	</header>
	
<article><h1>Nueva Solicitud</h1></article>


<section>
<form action="imp_solicitud.php" method="POST">
	<input type="hidden" name="busca" value="0">
	<article>
		<table >
			<caption style="height: 30px"><h3>Tipo de solicitud</h3></caption>
			<tr width="640">
				<td width="150">
					<input type="hidden" name="busca" value="0">
					<input type="radio" id="sol" name="solicitud" value="1" checked onchange="myVisible()"  />Bautismo<br>
					<input type="radio" id="sol" name="solicitud" value="2"  onchange="myVisible2()" />Confirmacion<br>
					<input type="radio" id="sol" name="solicitud" value="3"  onchange="myVisible3()"  />Matrimonio<br>
				</td>
				<td width="150">
					<input type="radio" name="simple" value="1"  checked />Simple<br>
					<input type="radio" name="simple" value="2" />Certificada<br>
				</td>
				<td width="150">
					<input type="radio" name="urgente" value="1" checked />Normal<br>
					<input type="radio" name="urgente" value="2" />Urgente<br>
				</td>
				<td width="190">
					<article id="fMatri" style="height: 40px">
					<input type="radio" name="para" value="1" checked />para Matrimonio<br>
					<input type="radio" name="para" value="2" />para Otros
					</article>
				</td>

			</tr>
		</table>
	</article>
	<article id="fNombre" style="white-space: wrap; overflow: hidden;visibility: visible; align-content: left;">
		<table>
			<tr width="600">
				<td style="padding: 10 10 10 10;">
			
					Nombre:<input type="text" name="nombre" width="25">
				</td>
				<td style="padding: 10 10 10 10;">
					Apellido Paterno:<input type="text" id="input1" name="apPaterno" size="25">
				</td>
				<td style="padding: 10 10 10 10;">
					Apellido Materno:<input type="text" id="input3" name="apMaterno" size="25">
				</td>
			</tr>
		</table>
	</article>
	<article id="fEsposos" style="white-space: wrap; overflow: hidden;visibility: hidden;">
		<table>
			<tr>
				<td style="padding: 10 10 10 10;">
					Esposo:<input type="text" name="esposo" size="50">
				</td>
				<td style="padding: 10 10 10 10;">
					Esposa:<input type="text" name="esposa" size="50">
				</td>
			</tr>
		</table>
	</article>
	<article id="fPadres" style="white-space: wrap; overflow: hidden;visibility: visible;">
		<table>
		<tr>
			<td style="padding: 20 20 20 20;">
				Padre:<input type="text" id="input2" name="padre" size="50" >
			</td>
			<td style="padding: 10 10 10 10;">
				Madre:<input type="text" id="input4" name="madre" size="50">					
			</td>
		</tr>
	</table>
	</article>
	<article id="fPadrinos" style="white-space: wrap; overflow: hidden;visibility: visible;">
		<table>
		<tr>
			<td style="padding: 10 10 10 10;">
				Padrino:<input type="text" name="padrino" size="50">
			</td>
			<article>
			<td id="fMadrina" style="padding: 10 10 10 10;">
				Madrina:<input type="text" name="madrina" size="50">					
			</td></article>
		</tr>
	</table>
	</article>
	<article style="white-space: wrap; overflow: hidden;">
		<table width="600">
			<tr >
				<td align="right" style="padding: 10 10 10 10;">Fecha de:
					<div id="fBautismo"  style="visibility: visible;">Bautismo:</div>
					<div id="fConfirma"  style="visibility: hidden;">Confirmación:</div>
					<div id="fMatrimonio"  style="visibility: hidden;">Matrimonio:</div>
				</td>
				<td style="padding: 10 10 10 10;" >
					<input type="date" name="fecSacr">
				</td>
				<td style="text-align: center;padding: 10 10 10 10;">
					<div id="fNacimiento"  style="visibility: visible;">
						Nacimiento:<input type="date" name="fecNac">
					</div>
				</td>
			</tr>
		</table>
	</article>
	<article id="fSolicita" style="white-space: nowrap; overflow: hidden;">
		<table>
		<tr width="600" align="center">
			<td width="150">
				Original:<input type="checkbox" id="original" name="original" value="1" checked onchange="verAprox()" ><br>
				<div id="hasta" style="visibility: hidden;">Busqueda hasta:<br><input type="date" name="fecAprox"></div>
			</td>
			<td width="150" style="padding: 10 10 10 10;">
				Fecha de Entrega: <?php echo "<input type='date'  name='fecEntrega' value='".$fecent."' />"; ?></td><TD>
				<input type="submit" value="continuar" style="background-color: #a4d279; width: auto; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px">
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
					document.getElementById("hasta").style.visibility = 'hidden'
				}
				else{
					document.getElementById("hasta").style.visibility = 'visible'
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