<?php 
$solicitud=$_POST['solicitud'];
$libro=$_POST['libro'];
$librobis=$_POST['librobis'];
$foja=$_POST['foja'];
$fojac=$_POST['fojac'];
$acta=$_POST['acta'];
$reg=$_POST['reg'];
$actaab=$_POST['actaab'];
$clave='c';
if (empty($librobis)) {
	$clave=$clave.trim(substr($libro,0));
}else{
	$clave=$clave.trim(substr($libro,0)).'-'.trim($librobis);
}
if ($foja<>0) {
	$clave=$clave.'-'.trim(substr($foja,0));
}
if (empty($fojac)) {
	$clave=$clave;
}else{
	$clave=$clave.'-'.trim($fojac);
}
if ($reg<>0) {
	
	$clave=$clave.'-'.trim(substr($reg,0));
}else{
	$clave=$clave.'-'.trim(substr($acta,0));
	if (! empty($actaab)) {
		$clave=$clave.'-'.trim($actaab);
	}
}

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
    <link href="img/favicon.png" rel="icon" type="image/png" />
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<header style="font-size: 1em; height: 35px;">
		<p style="font-size: 1.3em;height: 15px;">SAGRARIO METROPOLITANO</p>
		Sistema Archivo
	</header>
	<section style="font-size: 1em">
		<form name="form" method="POST" action='busca.php'>
			<input  type="submit" name="home" onclick="enviab('archivo.php')" value="Inicio"  style="background-color: #a4d279; width: 10%; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			
			Clave L.F.A.<input type="text" name="clave">
			<input  type="submit" name="busca" onclick="enviab('busca.php')" value="Busca Acta"  style="background-color: #a4d279; width: 10%; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			<input  type="submit" name="solic_local" onclick="enviab('solic_local.php')" value="Solicitudes"  style="background-color: #a4d279; width: 10%; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			<input  type="submit" name="buscara" onclick="enviab('buscara.php')" value="Busqueda avanzada"  style="background-color: #a4d279; width: auto; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			<input  type="submit" name="caplibbau" onclick="enviab('cvelibrobau.php')" value="Captura Lib. bautismo"  style="background-color: #a4d279; width: auto; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
		</form>
	</section>

	<?php
		echo "CAPTURA DE CONFIRMACION";
		$meses = array('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');

		$con= new mysqli("localhost", "root", "", "sagrario");
		if ($con->connect_errno){
    		echo "conexion erronea";
    		exit();
		}
		$clave1=substr($clave,0,1);
		$solic='solic_local';
		$base="confirma";
		$sql = "SELECT * FROM $base WHERE clave = '".$clave."'";
		
		$result = mysqli_query($con, $sql) or die(error_log('no consulto clave'));
		$regs=mysqli_num_rows(mysqli_query($con, $sql));
		$registro=mysqli_fetch_assoc($result);


		$fecsacr=$registro['fechaconf'];

		$diasacr=substr($fecsacr, 8, 2);
		$messacr=substr($fecsacr, 5, 2);
		@ $txmessacr=$meses[$messacr-1];
		$anosacr=substr($fecsacr, 0, 4);
		$fecsacr=$diasacr." de ".$txmessacr." de ".$anosacr;

		$diabau=substr($registro['fechabau'], 8, 2);
		$mesbau=substr($registro['fechabau'], 5, 2);
		@ $txmesbau=$meses[$mesbau-1];
		$anobau=substr($registro['fechabau'], 0, 4);
		if ($diabau==0) {
			$fecbau=substr($registro['xdiacon'], 0, 5)." - ".substr($registro['xmescon'], 0, 10)." - ".substr($registro['xanocon'], 0, 4);
		}else{
			$fecbau=$diabau." de ".$txmesbau." de ".$anobau;
		}
		

		$dianac=substr($registro['fechanac'], 8, 2);
		$mesnac=substr($registro['fechanac'], 5, 2);
		@ $txmesnac=$meses[$mesnac-1];
		$anonac=substr($registro['fechanac'], 0, 4);
		$fechanac=$dianac." de ".$txmesnac." de ".$anonac;
		
		$agrega='altacon.php';
	?>
	
	<form action="capcon.php" method="POST">
	<table>
	<tr>
		<td>Solicitud: </td>
		<td> <?php echo "<input type='number' name='solicitud' maxlength='7' width='5' size='5' value='".$solicitud."' step='.01'>" ?> </td>
		<td>Libro: </td>
		<td><?php echo "<input type='number' name='libro' maxlength='4' size='4' value='".$libro."'>" ?></td>
		<td><?php echo "<input type='text' name='librobis'	maxlength='2' size='2' placeholder='E' value='".$librobis."'>" ?></td>
		<td>Foja:</td>
		<td><?php echo "<input type='number' name='foja' maxlength='4' size='4' value='".$foja."'>" ?></td>
		<td><?php echo "<input type='text' name='fojac' maxlength='3' size='4' placeholder='FTE/VTA' value='".$fojac."'>" ?></td>

		<td>Acta: </td>
		<td><?php echo "<input type='number' name='acta' maxlength='5' size='4' value='".$acta."'></td>" ?>
		<td><?php echo "<input type='text' name='actaab' maxlength='3' size='1' placeholder='A/B' value='".$actaab."'></td>" ?>
		<td><?php echo "<input type='number' name='reg' maxlength='3' size='1' placeholder='reg.' value='".$reg."'></td>" ?>
		<td><input type="submit" name="" value="Continuar"></td>
	</tr>
</table>
</form>
	<form action="altacon.php" method="POST">
		<?php echo "<input type='hidden' name='solicitud' maxlength='7' width='5' size='5' value='".$solicitud."'>"."<input type='hidden' name='libro' maxlength='4' size='4' value='".$libro."'>" ."<input type='hidden' name='librobis'	maxlength='2' size='2' value='".$librobis."'>"."<input type='hidden' name='foja' maxlength='4' size='4' value='".$foja."'>"."<input type='hidden' name='fojac' maxlength='3' size='4' value='".$fojac."'><input type='hidden' name='acta' maxlength='4' size='4' value='".$acta."'><input type='hidden' name='reg' maxlength='4' size='4' value='".$reg."'><input type='hidden' name='actaab' maxlength='1' size='1' value='".$actaab."'>"
		?>

		<table style="background: #ccff66;">
			<tr>
			<td>Fecha de Sacramento:<br><strong> <?php echo "	".$fecsacr." "?></strong></td>
			<td><input type="date" data-date-format="dd/mmmm/aaaa"   name="fecsacr"  size="10"></td>
			<td>Ministro: <br><strong><?php echo $registro['ministro'] ?> </strong></td>
		 	<td><input type="text" name="ministro" maxlength="70" size="70"></td>
			</tr>
		</table>
	<table width="180" border="0">
			<tr>
				<td>Nombre:</td><?php echo "<td><strong>".$registro['nombre']."</td><td><strong>".$registro['paterno']."</td><td><strong>".$registro['materno']."</td></strong>" ?>
				<td><input type="text" name="nombre" maxlength="30" size="30"></td>
				<td><input type="text" name="paterno" maxlength="30" size="30"></td>
				<td><input type="text" name="materno" maxlength="30" size="30"></td>
			</tr>
		</table>
<table style="background: #ccff66;">
		<tr> <td>Hij:<?php echo "<strong>".$registro['hijoa']."</strong>" ?> </td>
			<td><input type="text" name="hijoa"  maxlength="1" size="1" placeholder="O/A"></td>
			<td>de: <?php echo "<strong>"." ".$registro['padre']?></td> 
			<td><input type="text" name="padre" maxlength="30" size="30"></td>
			<td><?php echo "<strong> y de ".$registro['madre']." </strong>"?></td>
			<td><input type="text" name="madre" maxlength="30" size="30"></td>
		</tr>
		</table>
<table>
	<tr>
		<td>Padrino(s): <?php echo "<strong> ".$registro['padrino']."</strong>"?></td>
		<td><input type="text" name="padrino" maxlength="50" size="50"></td>
	</tr>
</table>
<table style="background: #ccff66;">
	<tr>
		<td>Nacio el: <?php echo "<strong> ".$fechanac."</strong>"?></td>
		<td><input type="date" name="fechanac" size="10"></td>
		<td>en:<?php echo "<strong> ".$registro['lugarnac']."</strong>"?></td>
		<td><input type="text" name="lugarnac" placeholder='entidad-colonia...' size="50"></td>
	</tr>
</table>
<table >
	<tr>
		<td>Bautizado el: <?php echo "<strong> ".$fecbau."</strong>"?></td>
		<td><input type="date" name="fechabau" size="10">
			<br><input type="text" name="xdiacon" size="2" placeholder="xdia"><input type="text" name="xmescon" size="10" placeholder="xmes"><input type="text" name="xanocon" size="2" placeholder="xaño"></td>
		<td>en:<?php echo "<strong> ".$registro['parrbau']."</strong>"?></td>
		<td><input type="text" name="parrbau" maxlength="50" size="50"></td>
		<td>de:<?php echo "<strong> ".$registro['lugarbau']."</strong>"?></td>
		<td><input type="text" name="lugarbau" maxlength="50" size="50"></td>
	</tr>
	<tr>
		<td>datos:<?php echo "<strong> ".$registro['librobau']."</strong>"?></td>
		<td><input type="text" name="librobau" size="20" placeholder="l.a. de bau"></td>
	</tr>
</table>
<?php
		
		echo "<input type='hidden' name='clave' value='".$clave."' visible='hidden'>";
?>

	<input type='submit' name='' value='Continuar'>
</form>

	<SCRIPT LANGUAGE="JavaScript">
	function enviab(pag){ 
		document.form.action= pag 
		document.form.submit() 
	} 
	</script>	

</body>
</html>