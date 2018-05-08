<?php
$clave=$_POST['clave'];
//echo $clave;
?>
<!DOCTYPE html>
<html >
<head>
	
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
			<input  type="submit" name="home" onclick="enviab('index.php')" value="Inicio"  style="background-color: #a4d279; width: 10%; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			
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
		
				
		echo $fecsacr;
		$diasacr=substr($fecsacr, 8, 2);
		$messacr=substr($fecsacr, 5, 2);
		@ $txmessacr=$meses[$messacr-1];
		$anosacr=substr($fecsacr, 0, 4);
		$fecsacr=$diasacr." de ".$txmessacr." de ".$anosacr;

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
		echo $base;
	?>
	
	<form action="<?php echo $imprime ?>" method="POST">
	<table>
	<tr>
		<input type="hidden" name="clave" value="<?php echo $clave ?>">
		<td>Solicitud: <strong><?php echo $registro['solicitud']	?></strong></td>
		<td><input type="number" name="solicitud" maxlength="7" width="5" size="5" step=".01"></td>
		<td>Libro: <strong><?php echo $registro['libro']?></strong></td>
		<td><input type="number" name="libro" maxlength="4" size="4"></td>
		<td><strong><?php echo " - ".$registro['librobis']." "?></strong></td>
		<td><input type="text" name="librobis"	maxlength="2" size="2" placeholder="L/N/LN"></td>
		<td>Foja:<strong><?php echo " ".$registro['foja']?></strong></td>
		<td><input type="number" name="foja" maxlength="4" size="4"></td>
		<td><strong><?php echo " ".$registro['fojac']." "?></strong></td>
		<td><input type="text" name="fojac" maxlength="3" size="4" placeholder="FTE/VTA"></td>

		<td>Acta: <strong> 
		<?php
			switch ($base) {
				case 'bautismo':
					echo " ".@$registro['partidan']." ".@$registro['partidaab']." "."</strong></td><td><input type='number' name='partidan' maxlength='4' size='4'></td>
					<td><input type='text' name='partidaab' maxlength='1' size='1' placeholder='A/B'></td>";
					break;
				case 'confirma':
					echo " ".@$registro['acta']." ".@$registro['actaab']."  R.".@$registro['reg']." "."</strong></td>
					<td><input type='number' name='acta' maxlength='4' size='4'></td>
					<td><input type='text' name='actaab' maxlength='1' size='1' placeholder='A/B'></td>
					<td><input type='number' name='reg' maxlength='2' size='1' placeholder='reg'></td>";
					break;
				case 'matrimonio':
					echo " ".@$registro['acta']." "."</strong></td><td><input type='number' name='acta' maxlength='4' size='4'></td>";
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
			<td>Fecha de Sacramento:<br><strong> <?php echo "	".$fecsacr." "?></strong></td>
			<td><input type="date" data-date-format="dd/mmmm/aaaa"   name="fecsacr"  size="10"></td>
			<td>Ministro: <br><strong><?php echo $registro['ministro'] ?> </strong></td>
		 	<td><input type="text" name="ministro" maxlength="30" size="70"></td>
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
			<td><input type="text" name="hijo-a"  maxlength="1" size="1" placeholder="O/A"></td>
			<td>de: <?php echo "<strong>"." ".$registro['padre']?> <td><input type="text" name="padre" maxlength="50" size="40"></td><td><?php echo "<strong> y de ".$registro['madre']." </strong>"?></td>
			<td><input type="text" name="madre" maxlength="50" size="40"></td>
		</tr>
		</table>
<table>
	<tr>
		<td>Padrino(s): <?php echo "<strong> ".$registro['padrino']."</strong>"?></td>
		<td><input type="text" name="padrino" maxlength="50" size="50"></td>

		<?php 
		if ($base=="bautismo") {
			echo "<strong> ".@$registro['madrina']."</strong> </td>	<td><input type='text' name='madrina' maxlength=´50' size='50'></td>";
		}
		?>
</table>
<table style="background: #ccff66;">
	<tr>
		<td>Nacio el: <?php echo "<strong> ".$fechanac."</strong>"?></td>
		<td><input type="date" name="fechanac" size="10"></td>
		<td>en:<?php echo "<strong> ".$registro['lugarnac']."</strong>"?></td>
		<td><input type="text" name="lugarnac" placeholder='entidad-colonia...' size="50"></td></tr>
</table>
<table>
<?php 
	if ($base=='confirma') {
		echo "<tr><td>Bautizado el<strong> ".$fecbau.$xdiacon."+".$xmescon."+".$xanocon." </strong></td>
		<td><input type='date' name='fechabau' size='10'>
			<input type='text' name='xdiacon' size='2'>
			<input type='text' name='xmescon' size='5'>
			<input type='text' name='xanocon' size='2'>
		</td>

		<td>en: <strong> ".$registro['parrbau']."</strong><input type='text' name='parrbau' size='50' placeholder='parroquia'></td><td>de: <strong> ".$registro['lugarbau']."</strong><input type='text' name='lugarbau' placeholder='entidad-colonia...' size='50'></td></tr>";
	}
?>
</table>
<table><tr>
<?php
	if ($base=='bautismo') {
		echo "<td>Nota marginal:</td><td><strong>"." ".$registro['notamar']."</td><td><input type='number' name='notamar' size='1'  maxlenght='1'></td><td><textarea rows='4' cols='50' name='txnotamar'>".$txnotamar."</textarea></td>"."	<td>Nota al pie:</td><td><textarea rows='4' cols='50' name='notapie'>Valida para tramitar matrimonio en la Parroquia de </textarea></td></tr></table>";
	}
echo $base;
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