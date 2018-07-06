<?php
$numSolicitud=$_POST['numSolicitud'];

$libro=$_POST['libro'];

$foja=$_POST['foja'];
$fojac=$_POST['fojac'];
$partidan=$_POST['partidan'];



		$clave='m';
		$base='matrimonios';
		$titulo='MATRIMONIO';
		$imprime='imp_mat.php';
	
if (empty($librobis)) {
	$clave=$clave.trim(substr($libro,0)).'-';
}else{
	$clave=trim(substr($libro,0)).'-'.trim($librobis).'-';
}
if (empty($fojac)) {
	$clave=$clave.trim(substr($foja,0)).'-';
}else{
	$clave=$clave.trim(substr($foja,0)).'-'.trim($fojac).'-';
}
if (empty($registro)) {
	if (empty($partidaab)) {
		$clave=$clave.trim(substr($partidan,0));
	}else{
		$clave=$clave.trim(substr($partidan,0)).'-'.trim($partidaab);
	}
}else{
	$clave=$clave.trim(substr($registro,0));
}


		$con= new mysqli("localhost", "root", "", "sagrario");
		if ($con->connect_errno){
    		echo "conexion erronea";
    		exit();
    	}


		$sql="INSERT INTO $base (clave, numSolicitud, libro, foja, fojac, partida)  VALUES ('".$clave."', '".$numSolicitud."', '".$libro."', '".$foja."', '".$fojac."', '".$partidan."')";

		$agrega = mysqli_query($con, $sql) or die( "no agrega") ;

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
	<section>
	<?php
	echo "ACTA DE ".$titulo;
		$meses = array('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');




	?>

	<form action="<?php echo $imprime; ?>" method="POST">

		<table style='font-size:1.2em;'>
			<tr>
				<td width="225">Solicitud:  <?php echo $numSolicitud; ?> </td>
				<td width="225">Libro: <?php echo $libro; ?></td>
				<td width="225">Foja: <?php echo $foja."  ".$fojac; ?></td>
				<td width="225">Acta: <?php echo $partidan; ?></td>
			</tr>
		</table>


		<?php
			echo "<input type='hidden' name='numSolicitud'  value='".$numSolicitud."'>"."<input type='hidden' name='libro' maxlength='4' size='4' value='".$libro."'>" ."<input type='hidden' name='foja' maxlength='4' size='4' value='".$foja."'>"."<input type='hidden' name='fojac' maxlength='3' size='4' value='".$fojac."'><input type='hidden' name='partidan' maxlength='4' size='4' value='".$partidan."'><input type='hidden' name='solicitud' maxlength='4' size='4' >";
			echo "<input type='hidden' name='clave' value='".$clave."' visible='hidden'>";
		?>

		<table style="background: #ccff66;">
			<tr>
				<td>Fecha de Sacramento:</td>
				<td><input type="date" data-date-format="dd/mmmm/aaaa"   name="fecsacr"  size="10" ></td>
				<td>Ministro: </td>
			 	<td><input type="text" name="ministro" maxlength="70" size="70"></td>
			</tr>
		</table>
	
					<table width="180" border="0">
						<tr>
							<td>Esposo:</td>
							<td><input type="text" name="esposo" maxlength="70" size="70" >
							</td>
						</tr>
						<tr>
							<td>Esposa:</td>
							<td><input type="text" name="esposa" maxlength="70" size="70" ></td>
						</tr>
					</table>
					<table width="180" border="0">
						<tr>
							<td>Testigos:</td>
							<td><input type="text" name="testigo1" maxlength="50" size="50" ></td>
						</tr>
						<tr>
							<td>Y</td>
							<td><input type="text" name="testigo2" maxlength="50" size="50"></td>
						</tr>
					</table>
					<table width="180" border="0">
						<tr>
							<td>Parroquia de presentación:</td>
							<td><input type="text" name="parrPresento" maxlength="75" size="75" ></td>
						</tr>
						<tr>
							<td>Colonia:</td>
							<td><input type="text" name="colParrPresenta" maxlength="75" size="75"></td>
						</tr>
						<tr>
							<td>Entidad:</td>
							<td><input type="text" name="entidadParrPresenta" maxlength="75" size="75"></td>
						</tr>
					</table>

	
		<input type='submit' name='' value='Imprimir'>
	</form>
</section>
	<SCRIPT LANGUAGE="JavaScript">
	function enviab(pag){
		document.form.action= pag
		document.form.submit()
	}
	</script>

</body>
</html>
