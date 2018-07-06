<?php 
$base='datosbautismos';
$con=new mysqli("localhost", "root", "", "sagrario");
if ($con->connect_errno){
    		echo "conexion erronea";
    		exit();
		}
$sql="SELECT * FROM $base";
$result=mysqli_query($con, $sql);
$datos=mysqli_fetch_array($result);

$fechabau=$datos['fechabau'];
$libro=$datos['libro'];
$foja=$datos['foja'];
$partidan=$datos['partida'];
$partidaab=$datos['partidaab'];
$ministro=$datos['ministro'];
echo "l".$libro." f".$foja." p".$partidan." pab ".$partidaab." min:".$ministro;

if ($partidaab=='A') {
	$partidaab='B';
}else{
	$partidaab='A';
	$partidan=$partidan+1;
	$foja=$partidan;
	if ($partidan==501) {
		$libro=$libro+1;
		$foja=1;
		$partidan=1;
		$partidaab='A';
	}
}


$sql="UPDATE $base SET libro='$libro', foja='$partidan', partida='$partidan', partidaab='$partidaab' WHERE id=1" ;
$result=mysqli_query($con, $sql);

?>

<!DOCTYPE html>
<html >
<head>
	<meta charset="utf-8">
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

	<date-util format="dd/MM/yyyy"></date-util>
	
	<header style="font-size: 1em; height: 35px;">
		SAGRARIO METROPOLITANO
		Sistema Archivo
	
	<section style="font-size: 1em">
		<form name="form" method="POST" action=''>
			<input  type="submit" name="nuevo" onclick="enviab('cvenuevosbau.php')" value="Nueva Tanda"  style="background-color: #a4d279; width: 10%; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			<input  type="submit" name="siguiente" onclick="enviab('signvosbau.php')" value="Sig. Acta"  style="background-color: #a4d279; width: 10%; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			
			<input type="text" name="clave">
			<input  type="submit" name="busca" onclick="enviab('busca.php')" value="Busca"  style="background-color: #a4d279; width: 10%; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			<input  type="submit" name="imprime" onclick="enviab('print.php')" value="Imprimir"  style="background-color: #a4d279; width: 10%; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			<input  type="submit" name="baja" onclick="enviab('baja.php')" value="Envia a USB"  style="background-color: #a4d279; width: auto; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
		</form>
	</section>
</header>
<section>
	<article> </article>
	<form action="altanuevosbau.php" method="POST">
	<table style="text-align: left;">
	<tr>
		<td>Fecha de Bautismo: </td>
		<td style="font-size: 1.3em;"><?php echo $fechabau; ?></td>
	</tr>
		<td>Libro: </td>
		<td style="font-size: 1.3em;"><?php echo $libro;?></td>
		<td>Acta: </td>
		<td style="font-size: 1.3em;"><?php echo $partidan;?> </td>
		<td style="font-size: 1.3em;"><?php echo $partidaab;?></td>

	</tr>
	<tr>
		<td>Ministro:</td><td style="font-size: 1.3em;"><?php echo $ministro;?>
	</tr>
	
</table>

<?php
$clave=$libro."-".$partidan."-".$partidan."-".$partidaab;

$base='nuevosbautismo';
$sql="INSERT INTO $base (clave, libro, foja, partidan, partidaab, fechasacr, ministro) VALUES ('".$clave."', '".$libro."', '".$partidan."', '".$partidan."', '".$partidaab."', '".$fechabau."', '".$ministro."')";
$result = mysqli_query($con, $sql);

?>

	<input type="hidden" name="clave" value="<?php echo $clave?>">
	<article style="text-align: left;">
		Registro Civil: <input class="entradatx" type="text" name="regCivil" maxlength="35" size="35">
		Entidad: <input class="entradatx" type="text" name="lugarRegCivil" maxlength="50" size="50">
		Fecha de Reg.: <input class="entrada" type="date" name="fechaRegCivil"  size="30">
	</article>
	<article style="text-align: left;">
		Fecha Nacimiento: <input class="entrada" type="date" name="fecNac" size="10">
		Lugar: <textarea class="entradatx" rows="1" cols="75" name="lugarNac"></textarea>
	</article>
	<article style="text-align: left;">
		Nombre: <input class="entradatx" type="text" name="nombre" maxlength="50" size="50"><br>
		Ap.Paterno:<input class="entradatx" type="text" name="paterno" maxlength="50" size="50">
		Ap.Materno:<input class="entradatx" type="text" name="materno" maxlength="50" size="50">	
	</article>
	<article style="text-align: left;">
		Hij:<input type="text" name="hijoa"  maxlength="1" size="1" placeholder="O/A"> 
		Padre: <input class="entradatx" type="text" name="padre" maxlength="50" size="50">
		Madre: <input class="entradatx" type="text" name="madre" maxlength="50" size="50">
	</article>
	<article style="text-align: left;">
		Domicilio: <textarea class="entradatx" rows="1" cols="50" name="domicilio" placeholder="calle"></textarea>
		Colonia: <input class="entradatx" type="text" name="colonia" maxlength="30" size="30">   
		Entidad: <input class="entradatx" type="text" name="lugarde" maxlength="35" size="30">
	</article>
	<article style="text-align: left;">
		Padrinos: <input class="entradatx" type="text" name="padrino" maxlength="50" size="50">
		 y <input class="entradatx" type="text" name="madrina" maxlength="50" size="50">
	</article>
	<article style="text-align: left; text-align: center;">
		<input class="submitDown" type="submit" value="Continuar">
	</article>

</form>
</section>

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
