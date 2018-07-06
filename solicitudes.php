<?php

include("inicializa.php");
// echo $hoy."---".$dia."---".$diasem;
include("conectarse.php");
include("auxiliares.js");
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

  <section>
    <form action="imp_solicitud.php" method="POST" id="formSolicitud"> <!-- se envia para añadirlo e imprimirlo-->
  	   <input type="hidden" name="busca" value="0"> <!--cuando valor ="1" sera para corregir e imprimir -->
  	    <article> <!--tipo de solicitud- -con botones -->
  		      <table class="tablaBotones ">
  			         <caption class="tituloTabla">Tipo de solicitud</caption>
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
    <!---// para nombre y apellidos de Bautismo y Confirmación-->
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
    <!--//articulo para esposos en solicitud de matrimonio-->
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
    <!--//articulo de padres del solicitante en Bautismo y confirmación-->
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
    <!--//articulo para padrinos en Bautismo y Confirmacion solo padrino-->
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
	<footer>
		Derechos Reservados - José Ignacio Virgilio Ruiz Arroyo
	</footer>
</body>
</html>
