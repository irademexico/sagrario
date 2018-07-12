<?php
	date_default_timezone_set('America/Mexico_City');

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

	<article class="titulo">Nueva Solicitud</article>


<section>
<form action="imp_solicitud.php" method="POST" target="_blank">
	<input type="hidden" name="busca" value="0">
	<article>
		<table width="960" align="">
			<caption>Tipo de solicitud</caption>
			<tr width="960">
				<td width="150" >
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
				<td width="500" >
					<article id="fMatri" style="height: 60px">
						
					<input type="radio" name="para" value="1" checked />p/ Matrimonio
					<input type="radio" name="para" value="2" />p/ Comunión
					<input type="radio" name="para" value="3" />p/ Confirmación<br>
					<input type="radio" name="para" value="4" />para Padrino-Madrina
					<input type="radio" name="para" value="5" />para otros
					</article>
				</td>

			</tr>
		</table>
	</article>
	<article id="fNombre" style="white-space: wrap; overflow: hidden;visibility: visible; align-content: left;">
		<table>
			<tr width="600">
				<td style="padding: 10 10 10 10;">

					Nombre:<input class="entradatx" type="text" name="nombre" size="35">
				</td>
				<td style="padding: 10 10 10 10;">
					Apellido Paterno:<input class="entradatx" type="text" id="input1" name="apPaterno" size="35">
				</td>
				<td style="padding: 10 10 10 10;">
					Apellido Materno:<input class="entradatx" type="text" id="input3" name="apMaterno" size="35">
				</td>
			</tr>
		</table>
	</article>
	<article id="fEsposos" style="white-space: wrap; overflow: hidden;visibility: hidden;">
		<table>
			<tr>
				<td style="padding: 10 10 10 10;">
					Esposo:<input class="entradatx" type="text" name="esposo" size="50">
				</td>
				<td style="padding: 10 10 10 10;">
					Esposa:<input class="entradatx" type="text" name="esposa" size="50">
				</td>
			</tr>
		</table>
	</article>
	<article id="fPadres" style="white-space: wrap; overflow: hidden;visibility: visible;">
		<table>
		<tr>
			<td style="padding: 20 20 20 20;">
				Padre:<input class="entradatx" type="text" id="input2" name="padre" size="50" >
			</td>
			<td style="padding: 10 10 10 10;">
				Madre:<input class="entradatx" type="text" id="input4" name="madre" size="50">
			</td>
		</tr>
	</table>
	</article>
	<article id="fPadrinos" style="white-space: wrap; overflow: hidden;visibility: visible;">
		<table>
		<tr>
			<td style="padding: 10 10 10 10;">
				Padrino:<input class="entradatx" type="text" name="padrino" size="50">
			</td>
			<article>
			<td id="fMadrina" style="padding: 10 10 10 10;">
				Madrina:<input class="entradatx" type="text" name="madrina" size="50">
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
					<input id="fecha_fin" class="entrada" type="date" name="fecSacr">
				</td>
				<td style="text-align: center;padding: 10 10 10 10;">
					<div id="fNacimiento"  style="visibility: visible;">
						Nacimiento:<input id="fecha_inicio" class="entrada" type="date" name="fecNac" onchange="validar()">
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
				Fecha de Entrega: <?php echo "<input class='entrada'  type='date'  name='fecEntrega' value='".$fecent."' />"; ?></td><TD>
				<input class="submitDown" type="submit" value="Continuar">
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
	
	    function validar() {
            var inicio = document.getElementById('fecha_inicio').value; 
            var finalq  = document.getElementById('fecha_fin').value;
            inicio= new Date(inicio);
            finalq= new Date(finalq);
            if(inicio>finalq)
            alert('La fecha de inicio puede ser mayor que la fecha fin');
            }

    </script>
	<footer>
		Derechos Reservados - José Ignacio Virgilio Ruiz Arroyo
	</footer>
</body>
</html>
