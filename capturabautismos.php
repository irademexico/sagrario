<!DOCTYPE html>
<html >
<head>
	<meta charset="u
	tf-8">
    <!-- Always force latest IE rendering engine or request Chrome Frame -->
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title></title>
    <meta name="description" content="Archivo Sagrario Metropolitano" />
    <meta name="keywords" content="sagrario, metropolitano" />
    <link href="css/normalize.css" rel="stylesheet" type="text/css" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/3.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="img/favicon.ico" rel="icon" type="image/png" />
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<header style="font-size: 1em; height: 35px;">
		<p style="font-size: 1.3em;height: 15px;">SAGRARIO METROPOLITANO</p>
		Sistema Archivo
	</header>
	<section style="font-size: 1em">
		<form name="form" method="POST" action=''>
			<input type="submit" name="base" onclick="enviab('basebau.php')" value="Parametros de Inicio" style="background-color: #a4d279; width: 10%; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			<input type="text" name="clave">
			<input  type="submit" name="busca" onclick="enviab('busca.php')" value="Busca"  style="background-color: #a4d279; width: 10%; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			<input  type="submit" name="imprime" onclick="enviab('print.php')" value="Imprime"  style="background-color: #a4d279; width: 10%; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			<input  type="submit" name="envia" onclick="enviab('baja.php')" value="Enviar a USB"  style="background-color: #a4d279; width: auto; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
		</form>
	</section>
<?php

$con=;

$sql="SELECT * FROM datosbautismos";


$datos=;
?>



	
	<form action="altabaunvo.php" method="POST">
	<table style="text-align: left;">
	<tr>
		<td>Fecha de Bautismos: </td>
		<td><input type="date" name="fecBau" maxlength="7" ></td>
	</tr>
		<td>Libro: </td>
		<td><input type="number" name="libro" maxlength="4" size="4" value="<?php echo $datos['libro'];?>"></td>
		<td>Foja:</td>
		<td><input type="number" name="foja" maxlength="4" size="4" value="<?php echo $datos['foja'];?>"> </td>
		<td>Acta: </td>
		<td><input type='number' name='partidan' maxlength='4' size='4' value="<?php echo $datos['partidan'];?>"> </td>
		<td><input type='text' name='partidaab' maxlength='1' size='1'  value="<?php echo $datos['partidaab'];?>"> </td>

	</tr>

	<tr>
		<td>Ministro:</td><td><input type="text" name="ministro" maxlength="50" size="50" value="<?php echo $datos['ministro'];?>"></td>
	</tr>
	<tr><td>Nombre:</td><td><input type="text" name="nombre" maxlength="50" size="50"></td>
		<td>Apellido Paterno:</td><td><input type="text" name="paterno" maxlength="50" size="50"></td>
		<td>Apellido Matrno:</td><td><input type="text" name="materno" maxlength="50" size="50"></td>
	</tr>
</table>
<article style="text-align: left;">
		Hij:<input type="text" name="hijoa"  maxlength="1" size="1" placeholder="O/A"> 
		Padre: s<input type="text" name="padre" maxlength="50" size="50">
		Madre: <input type="text" name="madre" maxlength="50" size="50">
</article>
<article style="text-align: left;">
	
		Padrino: <input type="text" name="padrino" maxlength="50" size="50">
		Madrina: <input type="text" name="madrina" maxlength="50" size="50">
</article>
<article style="text-align: left;">
	
		Fecha Nacimiento: <input type="date" name="fecNac" size="10">
		Lugar: <textarea rows="1" cols="75" name="lugar"></textarea>

</article>
<article style="text-align: left;">
		Domicilio: <textarea rows="1" cols="50" name="domicilio" placeholder="calle"></textarea>
</article>
<article style="text-align: left;">
	
		Colonia: <input type="text" name="colonia" maxlength="30" size="30">   
		Entidad: <input type="text" name="lugarde" maxlength="35" size="30">
		CP:  <input type="number" name="cpDom" maxlength="5" size="5">
</article>
<article style="text-align: left;">
	
		Parroquia: <input type="text" name="parroquiaDom"  maxlength="50" size="50">
</article>
<article style="text-align: left;">
	

		Registro Civil: <input type="text" name="regCivil" maxlength="35" size="35">
		Entidad: <input type="text" name="lugarRegCivil" maxlength="50" size="50">
		Fecha de Reg.: <input type="date" name="fechaRegCivil"  size="30">
</article>


		<input type="submit" value="Continuar">

</table>
</form>
	<footer>
		Derechos Reservados - José Ignacio Virgilio Ruiz Arroyo
	</footer>

	<SCRIPT LANGUAGE="JavaScript">
	function enviab(pag){ 
		document.form.action= pag 
		document.form.submit() 
	} 
	</script>	
</body>
</html>
