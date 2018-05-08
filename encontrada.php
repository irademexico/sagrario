<?php

$clave=$_GET['clave'];
$numSolicitud=$_GET['ns'];

?>

<!DOCTYPE html>
<html >
<head>

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
    <meta http-equiv="Content-Type" content="text/html" charset="iso-8859-1"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
		$meses = array('ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO',
               'AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE');

		$con= new mysqli("localhost", "root", "", "sagrario");
		if ($con->connect_errno){
    		echo "conexion erronea";
    		exit();
		}

		$basenota='notas';
		$sql="SELECT * FROM $basenota WHERE numSolicitud=$numSolicitud";
		$result=mysqli_query($con, $sql);
		$regs=mysqli_num_rows(mysqli_query($con, $sql));
		$nota=mysqli_fetch_assoc($result);

		if ($regs=0) {
			$notaPie="Valida para tramitar matrimonio en la Parroquia de ";
		}else{
			$notaPie=$nota['notaPie'];
		}

		$clave1=substr($clave,0,1);
//		echo $clave1;
		$solic='solic_local';
		switch ($clave1) {
			case 'c':
				$base="confirma";
				break;
			case 'M':
				$base="matrimonio";
				break;
			default:
				$base="bautismo";
				break;
		}

		$sql="UPDATE $solic SET  status='4' WHERE numSolicitud=$numSolicitud";
		$result=mysqli_query($con, $sql) or die ("no cambio el status");



		$sql = "SELECT * FROM $base WHERE clave = '".$clave."'";
		$result = mysqli_query($con, $sql) or die('no consulto clave'.error_log());
		$regs=mysqli_num_rows(mysqli_query($con, $sql));
		//echo $regs." registros de ".$base;
		$registro=mysqli_fetch_assoc($result);

		if ($clave1=='c') {
			$fecsacr=$registro['fechaconf'];
		}else{
			$fecsacr=$registro['fechasacr'];
		}


		//echo $fecsacr;
		$diasacr=substr($fecsacr, 8, 2);
		$messacr=substr($fecsacr, 5, 2);
		@ $txmessacr=$meses[$messacr-1];
		$anosacr=substr($fecsacr, 0, 4);
		//$fecsacr=$diasacr." de ".$txmessacr." de ".$anosacr;

		if ($base=='confirma') {
			$diabau=substr($registro['fechabau'], 8, 2);
			$mesbau=substr($registro['fechabau'], 5, 2);
			@ $txmesbau=$meses[$mesbau-1];
			$anobau=substr($registro['fechabau'], 0, 4);
			$fecbau=$diabau." de ".$txmesbau." de ".$anobau;

		$xdiacon=$registro['xdiacon'];
		$xmescon=$registro['xmescon'];
		$xanocon=$registro['xanocon'];
		}

		$dianac=substr($registro['fechanac'], 8, 2);
		$mesnac=substr($registro['fechanac'], 5, 2);
		@ $txmesnac=$meses[$mesnac-1];
		$anonac=substr($registro['fechanac'], 0, 4);
		$fechanac=$dianac." de ".$txmesnac." de ".$anonac;

		$solicitud=$registro['solicitud'];
//		echo $solicitud;

		if ($base=="bautismo") {
			if ($registro['legitimo']== "L") {
				$legitimo="legitimo";
			}elseif ($registro['legitimo']== "N") {
				$legitimo="natural";
			}else{
				$legitimo=$registro['legitimo'];
			}
			if(empty($registro['fecregciv'])){
				$reg_civ_no="0001/01/01";
				$diaciv=substr($reg_civ_no, 8, 2);
				$mesciv=substr($reg_civ_no, 5, 2);
				$txmesciv=$meses[$mesciv-1];
				$anociv=substr($reg_civ_no, 0, 4);
				$fecregciv=$diaciv."/".$mesciv."/".$anociv;
			}else{
				$diaciv=substr($registro['fecregciv'], 8, 2);
				$mesciv=substr($registro['fecregciv'], 5, 2);
			@	$txmesciv=$meses[$mesciv-1];
				$anociv=substr($registro['fecregciv'], 0, 4);
				$fecregciv=$diaciv."/".$mesciv."/".$anociv;
			}
			if (!empty($solicitud)) {
				$sql = "SELECT * FROM notas_marg WHERE solicitud = $solicitud";
				$resultnm = mysqli_query($con, $sql) ;
				if ($resultnm) {
					$reg_sol=mysqli_fetch_assoc($resultnm);
					$txnotamar=$reg_sol['txnotamar'];
				}else{
					$txnotamar="";
				}
			}else{
				$txnotamar="";
			}
		}
		switch ($base) {
			case 'bautismo':
				$imprime='imp_bau.php';
				break;
			case 'confirma':
				$imprime='imp_con.php';
				break;
			case 'matrimonio':
				$imprime='imp_mat.php';
				break;
			default:
				$imprime='imp_no.php';
				break;
		}
		//echo $base;
	?>

	<form action="<?php echo $imprime ?>" method="POST">
	<table>
	<tr>
		<input type="hidden" name="clave" value="<?php echo @$clave ?>">
		<input type="hidden" name="solicitud" value="<?php echo @$solicitud ?>">
		<input type="hidden" name="numSolicitud" value="<?php echo @$numSolicitud; ?>">
		<input type="hidden" name="libro" value="<?php echo @$libro;?>">
		<input type="hidden" name="librobis" value="<?php echo @$librobis;?>">
		<input type="hidden" name="foja" value="<?php echo @$foja;?>">
		<input type="hidden" name="fojac" value="<?php echo @$fojac;?>">
		<input type="hidden" name="partidan" value="<?php echo @$partidan;?>">
		<input type="hidden" name="partidaab" value="<?php echo @$partidaab;?>">
		<input type="hidden" name="acta" value="<?php echo @$acta;?>">
		<input type="hidden" name="actaab" value="<?php echo @$actaab;?>">
		<input type="hidden" name="reg" value="<?php echo @$reg;?>">

		<td height="50px">Solicitud: </td><td width="75px"><strong><?php echo $numSolicitud	?></strong></td>

		<td>Libro: </td> <td width="75px"><strong><?php echo " ".$registro['libro']." ".$registro['librobis']?></strong></td>

		<td>Foja:</td>
		<td width="75px"><strong><?php echo " ".$registro['foja']." ".$registro['fojac'];?></strong></td>

		<td>Acta:</td>
		<?php
			switch ($base) {
				case 'bautismo':
					echo "<td width='75px'><strong>".@$registro['partidan']." ".@$registro['partidaab']."</strong></td>";
					break;
				case 'confirma':
					echo "</td><td><input class='entrada' type='text' name='acta' maxlength='4' size='4' value='".@$registro['acta']."'></td>
					<td><input class='entrada' type='text' name='actaab' maxlength='1' size='1' placeholder='A/B' value='".@$registro['actaab']."'></td>
					<td><input class='entrada' type='text' name='reg' maxlength='2' size='1' placeholder='reg' value='".@$registro['reg']."'></td>";
					break;
				case 'matrimonio':
					echo "</td><td><input class='entrada' type='text' name='acta' maxlength='4' size='4' value='".@$registro['acta']."'></td>";
					break;

				default:
					echo "no pudo leerse el acta";
					break;
			}

		?>
		</tr>
		</table>
		<table style="background: #ccff66;">
			<tr>
			<td>Fecha de Sacramento:</td>
			<td><input class='entrada' type="date" data-date-format="dd/mmmm/aaaa"   name="fecsacr"  size="10" value='<?php echo $fecsacr?>'></td>
			<td>Ministro: </td>
		 	<td><input class='entradatx' type="text" name="ministro" maxlength="30" size="70" value='<?php echo $registro['ministro'] ?>'></td>
			</tr>
		</table>
	<table width="180" border="0">
			<tr>
				<td>Nombre:</td>
				<td><input class='entradatx' type="text" name="nombre" maxlength="30" size="30" value='<?php echo $registro['nombre']?>'></td>
				<td><input class='entradatx' type="text" name="paterno" maxlength="30" size="30" value='<?php echo $registro['paterno']?>'></td>
				<td><input class='entradatx' type="text" name="materno" maxlength="30" size="30" value='<?php echo $registro['materno']?>'></td>
			</tr>
		</table>
<table style="background: #ccff66;">
		<tr> <td>Hij:<input class='entradatx' type="text" name="hijo-a"  maxlength="1" size="1" placeholder="O/A" value='<?php echo $registro['hijoa']?>'></td>
			<td>de: </td> <td><input class='entradatx' type="text" name="padre" maxlength="50" size="40" value='<?php echo $registro['padre']?>'></td><td> y de 	</td>
			<td><input class='entradatx' type="text" name="madre" maxlength="50" size="40" value='<?php echo $registro['madre']?>'></td>
		</tr>
		</table>
<table>
	<tr>
		<td>Padrino(s): <td><input class='entradatx' type="text" name="padrino" maxlength="50" size="50" value='<?php echo $registro['padrino']?>'></td>

		<?php
		if ($base=="bautismo") {
			echo "<td><input class='entradatx' type='text' name='madrina' maxlength=´50' size='50' value='".$registro['madrina']."'></td>";
		}
		?>
</table>
<table style="background: #ccff66;">
	<tr>
		<td>Nacio el: </td>
		<td><input class="entradatx" type="date" name="fechanac" size="10" value="<?php echo $registro['fechanac'];?>"></td>
		<td>en: </td>
		<td><input class="entradatx" type="text" name="lugarnac" placeholder='entidad-colonia...' size="50" value="<?php echo $registro['lugarnac']; ?>"></td></tr>
</table>
<table>
<?php
	if ($base=='confirma') {
		echo "<tr><td>Bautizado el: </td>
		<td><input class='entrada' type='date' name='fechabau' size='10' value='".@$registro['fechabau']."'>
			<br><input  type='text' name='xdiacon' size='2' value='".@$registro['xdiacon']."'>
			<input  type='text' name='xmescon' size='5' value='".@$registro['xmescon']."'>
			<input  type='text' name='xanocon' size='2' value='".@$registro['xanocon']."'>
		</td>

		<td>en: </td>
    <td><input class='entradatx' type='text' name='parrbau' size='50' placeholder='parroquia' value='".$registro['parrbau']."'></td>
    <td>de: </td>
    <td><input class='entradatx' type='text' name='lugarbau' placeholder='entidad-colonia...' size='50' value='".$registro['lugarbau']."'></td></tr>";
	}
?>
</table>
<table><tr>
<?php
	if ($base=='bautismo') {
		echo "<td>Nota marginal:</td><td><input class='entrada' type='text' name='notamar' size='1'  maxlenght='1' value='".$registro['notamar']."'></td><td><textarea class='entradatx' rows='4' cols='50' name='txnotamar'>".$txnotamar."</textarea></td>"."	<td>Nota al pie:</td><td><textarea class='entradatx' rows='4' cols='50' name='notapie'>".$notaPie." </textarea></td></tr></table>";
	}

?>

		<input type='submit' name='' value='Imprimir'>
	</form>

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
