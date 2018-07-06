<?php 
$numSol=$_POST['numSol'];
$solicitud=$_POST['solicitud'];
$libro=$_POST['libro'];
$ln=$_POST['ln'];
$acta=$_POST['acta'];
$ab=$_POST['ab'];
$nombre=$_POST['nombre'];
$paterno=$_POST['paterno'];
$materno=$_POST['materno'];
$padre=$_POST['padre'];
$madre=$_POST['madre'];
$padrino=$_POST['padrino'];
$madrina=$_POST['madrina'];
$fechabau=$_POST['fechabau'];
$fechanac=$_POST['fechanac'];

switch ($solicitud) {
	case 1:
		$base='bautismo';
		break;
	case 2:
		$base='confirma';
		break;
	case 3:
		$base='matrimonio';
		break;
	default:
		?>
		<script type="text/javascript">
			alert("S'eleccione' la base de busqueda - Bautismo, Confirmacion, Matrimonio")
			window.history.back();
		</script>
		<?php
	}


if ($numSol) {
	$sql="SELECT * FROM $base WHERE solicitud = '$numSol'";
}

if ($libro) {

	$sql="SELECT * FROM $base WHERE libro = '$libro'";
	if ($ln) {

		$sql="SELECT * FROM $base WHERE libro = '$libro' AND librobis = '$ln'";
		if ($acta) {
			$sql="SELECT * FROM $base WHERE libro = '$libro' AND librobis = '$ln' AND partidan = '$acta'";
			if ($ab) {
				$sql="SELECT * FROM $base WHERE libro = '$libro' AND librobis = '$ln' AND partidan = '$acta' AND partidaab = '$ab'";
			}
		}
	}

	else{
		if ($acta) {
			$sql="SELECT * FROM $base WHERE libro = '$libro' AND partidan = '$acta'";
			if ($ab) {
				$sql="SELECT * FROM $base WHERE libro = '$libro' AND  partidan = '$acta' AND partidaab = '$ab'";
	}}}

}

if ($nombre) {
	$nombre="'%".$nombre."%'";
	$sql="SELECT * FROM $base WHERE nombre LIKE $nombre";
	if ($paterno) {
		$paterno="'%".$paterno."%'";
		$sql="SELECT * FROM $base WHERE nombre LIKE $nombre AND paterno LIKE $paterno";
		if ($materno) {
			$materno="'%".$materno."%'";
			$sql="SELECT * FROM $base WHERE nombre LIKE $nombre AND paterno LIKE $paterno AND materno LIKE $materno";
		}
	}
	else{
		if ($materno) {
			$materno="'%".$materno."%'";
			$sql="SELECT * FROM $base WHERE nombre LIKE $nombre AND materno LIKE $materno";
		}
	}
}
if ($padre) {
	$padre="'%".$padre."%'";
	if ($nombre) {
		$nombre="'%".$nombre."%'";
		
		$sql="SELECT * FROM $base WHERE nombre LIKE $nombre AND padre LIKE $padre";
	}else{
		$sql="SELECT * FROM $base WHERE padre LIKE $padre";
	}
}
if ($madre) {
	$madre="'%".$madre."%'";
	if ($nombre) {
		$nombre="'%".$nombre."%'";
		
		$sql="SELECT * FROM $base WHERE nombre LIKE $nombre AND madre LIKE $madre";
	}else{
		$sql="SELECT * FROM $base WHERE madre LIKE $madre";
	}
}

echo $sql;


$con= new mysqli("localhost", "root", "", "sagrario");

 $encontrado=mysqli_query($con, $sql);
    
    while ($buscabase= mysqli_fetch_array($encontrado))
        {
          
          echo "<table border='1'><tr >
          			<td> Solicitud: ".$buscabase['solicitud'] ."</td> 
          			<td> Nombre: ".utf8_encode($buscabase['nombre'])." ".utf8_encode($buscabase['paterno'])." " .utf8_encode($buscabase['materno'])."</td>
          			<td> Padres: ".utf8_encode($buscabase['padre'])."<br>".utf8_encode($buscabase['madre'])."</td> 
          			<td> Padrinos: ".utf8_encode($buscabase['padrino'])."<br> ".utf8_encode($buscabase['madrina'])."</td> 
          			<td> Fecha de Nacimiento: ". $buscabase['fechanac'] ."</td>
          			<td> Clave: ". $buscabase['clave']." </td> 
      			</tr></table>";
          }

 ?>