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
    <link href="img/favicon.ico" rel="icon" type="image/png" />
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta http-equiv="Content-Type" content="text/html" charset="iso-8859-1"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
			case 'm':
				$base="matrimonios";
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
		}elseif($clave1=='m'){
			$fecsacr=$registro['fecSacr'];
		}else{
			$fecsacr=$registro['fechasacr'];
		}

		$diasacr=substr($fecsacr, 8, 2);
		$messacr=substr($fecsacr, 5, 2);
		@ $txmessacr=$meses[$messacr-1];
		$anosacr=substr($fecsacr, 0, 4);
		$fecsacrtx=$diasacr." de ".$txmessacr." de ".$anosacr;

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
		if (!$base=="matrimonio"){
			$dianac=substr($registro['fechanac'], 8, 2);
			$mesnac=substr($registro['fechanac'], 5, 2);
			@ $txmesnac=$meses[$mesnac-1];
			$anonac=substr($registro['fechanac'], 0, 4);
			$fechanac=$dianac." de ".$txmesnac." de ".$anonac;

			$solicitud=$registro['solicitud'];
		}else{
			$solicitud=$registro['solicitud'];
		}
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
				$resultnm = mysqli_query($con, $sql);
				$sql = "SELECT * FROM notas WHERE numSolicitud = $solicitud";
				$resultnp = mysqli_query($con, $sql);

				if ($resultnm) {
					$reg_sol=mysqli_fetch_assoc($resultnm);
					$txnotamar=$reg_sol['txnotamar'];
				}else{
					$txnotamar="";
				}
				if ($resultnp) {
					$reg_sol=mysqli_fetch_assoc($resultnp);
					$txnotapie=$reg_sol['notaPie'];
				}else{
					$txnotapie="Valida para tramitar matrimonio en la Parroquia de ";
				}




			}else{
				$txnotamar="";
				$txnotapie="Valida para tramitar matrimonio en la Parroquia de ";
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


	?>

	<form action="<?php echo $imprime ?>" method="POST">
	<table>
	<tr>
		
		<input type="hidden" name="clave" value="<?php echo $clave ?>">
    <input type="hidden" name="solicitud" value="<?php echo $registro['solicitud'] ?>">
    <input type="hidden" name="libro" value="<?php echo $registro['libro'] ?>">
    <input type="hidden" name="librobis" value="<?php echo $registro['librobis'] ?>">
    <input type="hidden" name="foja" value="<?php echo $registro['foja'] ?>">
    <input type="hidden" name="fojac" value="<?php echo $registro['fojac'] ?>">
    <input type="hidden" name="acta" value="<?php echo @$registro['acta'] ?>">
    <input type="hidden" name="actaab" value="<?php echo @$registro['actaab'] ?>">
    <input type="hidden" name="reg" value="<?php echo @$registro['reg'] ?>">
    <input type="hidden" name="partidan" value="<?php echo @$registro['partidan'] ?>">
    <input type="hidden" name="partidaab" value="<?php echo @$registro['partidaab'] ?>">

		<td >Numero de Solicitud: </td> <td  style='font-size:1.3em;'><strong><?php echo $registro['solicitud']	?></strong></td>

		<td>Libro: </td> <td  style='font-size:1.3em;'><strong><?php echo $registro['libro']?></strong></td>

		<td><strong><?php echo " - ".$registro['librobis']." "?></strong></td>

		<td>Foja: </td> <td  style='font-size:1.3em;'><strong><?php echo " ".$registro['foja']?></strong></td>

		<td><strong><?php echo " ".$registro['fojac']." "?></strong></td>


		<td>Acta: </td>
		<?php
			switch ($base) {
				case 'bautismo':
					echo "<td style='font-size:1.3em;'> <strong>".@$registro['partidan']." ".@$registro['partidaab']." "."</strong></td>";
					break;
				case 'confirma':
					echo "<td style='font-size:1.3em;'> <strong> ".@$registro['acta']."  ".@$registro['actaab'];
          if (@$registro['reg']==0) {
            echo "</strong></td>";
          }
            echo "   Reg.  ".@$registro['reg']."</strong></td>";
					break;
				case 'matrimonio':
					echo "<td style='font-size:1.3em;'> <strong> ".@$registro['acta']." "."</strong></td>";
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
				<td>Numero de solicitud: </td>
				<td><input type="number" name="numSolicitud" step=".01" value="<?php echo $registro['solicitud']?>"></td>
			<td>Fecha de Sacramento:
			<td><input class="entrada" type="date" data-date-format="dd/mmmm/aaaa"   name="fecsacr"  size="10" value="<?php echo $fecsacr; ?>"></td>
			<td>Ministro: </td>
		 	<td><input class="entradatx" type="text" name="ministro" maxlength="50" size="70" value="<?php echo $registro['ministro'] ?>"></td>
			</tr>
		</table>
	<table width="180" border="0">
			<tr>
				<td>Nombre:</td>
				<td><input class="entradatx"  type="text" name="nombre" maxlength="30" size="30" value="<?php echo $registro['nombre'];?>"></td>
				<td><input class="entradatx"  type="text" name="paterno" maxlength="30" size="30" value="<?php echo $registro['paterno'];?>"></td>
				<td><input  class="entradatx" type="text" name="materno" maxlength="30" size="30" value="<?php echo $registro['materno'];?>"></td>
			</tr>
		</table>
<table style="background: #ccff66;">
		<tr> <td>Hij: </td>
			<td><input class="entradatx" type="text" name="hijo-a"  maxlength="1" size="1" placeholder="O/A" value="<?php echo $registro['hijoa'];?>"></td>
			<td>de:</td><td>
			<input  class="entradatx" type="text" name="padre" maxlength="50" size="40" value="<?php echo $registro['padre'];?>"></td>
			<td> y de </td>
			<td><input  class="entradatx" type="text" name="madre" maxlength="50" size="40" value="<?php echo $registro['madre'];?>"></td>
		</tr>
		</table>
<table>
	<tr>
		<td>Padrino(s): </td>
		<td><input  class="entradatx" type="text" name="padrino" maxlength="50" size="50" value="<?php echo $registro['padrino'];?>">

		<?php
		if ($base=="bautismo") {
			echo "<br><input  class='entradatx' type='text' name='madrina' maxlength=´50' size='50' value='".$registro['madrina']."'></td>";
		}
		?>
</table>
<table style="background: #ccff66;">
	<tr>
		<td>Nacio el: </td>
<td><input class="entrada" type="date" name="fechanac" size="10" value="<?php echo $registro['fechanac']?>"></td>
		<td>en: </td>
		<td><input class="entradatx" type="text" name="lugarnac" placeholder='entidad-colonia...' size="50" value="<?php echo $registro['lugarnac'];?>"></td></tr>
</table>
<table>
<?php
	if ($base=='confirma') {
		echo "<tr><td>Bautizado el </td>
							<td>
								<input class='entrada' type='date' name='fechabau' size='10' value='".$registro['fechabau']."'><br>
								<input class='entrada' type='text' name='xdiacon' size='2' value='".$registro['xdiacon']."'>
								<input class='entrada' type='text' name='xmescon' size='5' value='".$registro['xmescon']."'>
								<input class='entrada' type='text' name='xanocon' size='2' value='".$registro['xanocon']."'>
							</td>

							<td>en: </td>
							<td>
								<input class='entradatx' type='text' name='parrbau' size='50' placeholder='parroquia' value='".$registro['parrbau']."'></td>
							</tr><tr>
              <td>.</td><td>.</td><td>de: </td>
							<td>	<input class='entradatx' type='text' name='lugarbau' placeholder='entidad-colonia...' size='50' value='".$registro['lugarbau']."'>
							</td>
					</tr>";
	}
?>
</table>
<table><tr>
<?php
	if ($base=='bautismo') {
		echo "<td>Nota marginal: </td>
		<td><input class='entrada' type='text' name='notamar' size='1'  maxlenght='1' value='".$registro['notamar']."'></td>
		<td><textarea class='entradatx' rows='4' cols='50' name='txnotamar'>".$txnotamar."</textarea></td>"."	<td>Nota al pie:</td><td><textarea class='entradatx' rows='4' cols='50' name='notapie'>".$txnotapie." </textarea></td></tr></table>";
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
