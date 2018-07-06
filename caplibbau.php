<?php

$libro=$_POST['libro'];
$librobis=$_POST['librobis'];
$foja=$_POST['foja'];
$fojac="";
$partidan=$_POST['partidan'];
$partidaab=$_POST['partidaab'];
@$fecsacr=$_POST['fecSacr'];

if (empty($librobis)) {
	$clave=trim(substr($libro,0)).'-';
}else{
	$clave=trim(substr($libro,0)).'-'.trim($librobis).'-';
}
if (empty($fojac)) {
	$clave=$clave.trim(substr($foja,0)).'-';
}else{
	$clave=$clave.trim(substr($foja,0)).'-'.trim($fojac).'-';
}
if (empty($partidaab)) {
	$clave=$clave.trim(substr($partidan,0));
}else{
	$clave=$clave.trim(substr($partidan,0)).'-'.trim($partidaab);
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
		<script src="jquery-latest.js"></script>
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
		CAPTURA DE BAUTISMO
	</section>
	<?php
	
		$meses = array('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');

		$con= new mysqli("localhost", "root", "", "sagrario");
		if ($con->connect_errno){
    		echo "conexion erronea";
    		exit();
		}
		$clave1=substr($clave,0,1);
		$solic='solic_local';
		$base="bautismo";
		$sql = "SELECT * FROM $base WHERE clave = '".$clave."'";


		$result = mysqli_query($con, $sql) or die(error_log('no consulto clave'));
		$regs=mysqli_num_rows(mysqli_query($con, $sql));
		$registro=mysqli_fetch_assoc($result);
		if ($regs=1) {
			$nombre=$registro['nombre'];
			$paterno=$registro['paterno'];
			$materno=$registro['materno'];
		}else{
			$nombre="";
			$paterno="";
			$materno="";
		}
	?>

	<form action="altalibbau.php" method="POST">
		<table style='font-size:1.5em;'>
			<tr>
				<input type='hidden' name='clave' value='<?echo $clave;?>' visible='hidden'>
				<td width="225">Libro: <?php echo $libro." ".$librobis; ?></td>
				
				<td width="225">Foja : <?php echo $foja; ?></td>


				<td width="125">Acta: <?php echo $partidan." </td><td> ".$partidaab; ?></td>

			</tr>
		</table>
		<?php echo "<input type='hidden' name='libro' maxlength='4' size='4' value='".$libro."'>" ."<input type='hidden' name='librobis'	maxlength='2' size='2' value='".$librobis."'>"."<input type='hidden' name='foja' maxlength='4' size='4' value='".$foja."'>"."<input type='hidden' name='fojac' maxlength='3' size='4' value='".$fojac."'><input type='hidden' name='partidan' maxlength='4' size='4' value='".$partidan."'><input type='hidden' name='partidaab' maxlength='1' size='1' value='".$partidaab."'>"
		?>


	<table width="180" border="0">
			<tr>
				<TD>Nombre</TD>
				<td><input class="entradatx" type="text" name="nombre" maxlength="30" size="30" value="<?php echo $nombre;?>"></td>
				<td><input class="entradatx" type="text" id="input1" name="paterno" maxlength="30" size="30" value="<?php echo $paterno;?>"></td>
				<td><input class="entradatx" type="text" id="input3" name="materno" maxlength="30" size="30" value='<?php echo $materno;?>'></td>
			</tr>
		</table>
		<table style="background: #ccff66;">
			<tr>
				<td>Nacio el: <input class="entrada" type="date" name="fechanac" size="10"></td>
			</tr>
		</table>
	<table style="background: #ccff66;">
		<tr> <td>Hij:</td>
			<td><input class="entradatx" type="text" name="hijoa"  maxlength="1" size="1" placeholder="O/A"></td>
			<td>de: <input class="entradatx" type="text" id="input2" name="padre" maxlength="50" size="50"></td>
		</tr>
		<tr><td></td><td></td>
			<td>y de: <input class="entradatx" type="text" id="input4" name="madre" maxlength="50" size="50"></td>
		</tr>
	</table>



<table >
			<tr>
				<td>Fecha de Sacramento:</td>
				<td><input class="entrada" type="date" data-date-format="dd/mmmm/aaaa"   name="fecsacr"  size="10" value="<?php echo $fecsacr;?>"></td>
			</tr>
</table>

<table><tr>
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
