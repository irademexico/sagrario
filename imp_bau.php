<?php
header("Content-type: text/html;charset=utf-8");
header("mime-content-type: text/html;charset=utf-8");
header("mime_content-type: text/html;charset=utf-8");
date_default_timezone_set('America/Mexico_City');
// Imprimir
require('fpdf.php');

class PDF extends FPDF
{
protected $B = 0;
protected $I = 0;
protected $U = 0;
protected $HREF = '';

function WriteHTML($html)
{
    // Intérprete de HTML
    $html = str_replace("\n",' ',$html);
    $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
    foreach($a as $i=>$e)
    {
        if($i%2==0)
        {
            // Text
            if($this->HREF)
                $this->PutLink($this->HREF,$e);
            else
                $this->Write(5,$e);
        }
        else
        {
            // Etiqueta
            if($e[0]=='/')
                $this->CloseTag(strtoupper(substr($e,1)));
            else
            {
                // Extraer atributos
                $a2 = explode(' ',$e);
                $tag = strtoupper(array_shift($a2));
                $attr = array();
                foreach($a2 as $v)
                {
                    if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                        $attr[strtoupper($a3[1])] = $a3[2];
                }
                $this->OpenTag($tag,$attr);
            }
        }
    }
}

function OpenTag($tag, $attr)
{
    // Etiqueta de apertura
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,true);
    if($tag=='A')
        $this->HREF = $attr['HREF'];
    if($tag=='BR')
        $this->Ln(5);
}

function CloseTag($tag)
{
    // Etiqueta de cierre
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,false);
    if($tag=='A')
        $this->HREF = '';
}

function SetStyle($tag, $enable)
{
    // Modificar estilo y escoger la fuente correspondiente
    $this->$tag += ($enable ? 1 : -1);
    $style = '';
    foreach(array('B', 'I', 'U') as $s)
    {
        if($this->$s>0)
            $style .= $s;
    }
    $this->SetFont('',$style);
}

function PutLink($URL, $txt)
{
    // Escribir un hiper-enlace
    $this->SetTextColor(0,0,255);
    $this->SetStyle('U',true);
    $this->Write(5,$txt,$URL);
    $this->SetStyle('U',false);
    $this->SetTextColor(0);
}
}

$meses = array('ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO',
               'AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE');
//$solicitud = $_POST["solicitud"];

$clave=$_POST['clave'];
$numSolicitud=$_POST['numSolicitud'];
$notaPie=trim($_POST['notapie']);
@$altasol=$_POST['altasolcap'];
@$alta=$_POST['alta'];

$con= new mysqli("localhost", "root", "", "sagrario");
if ($con->connect_errno){
    echo "conexion erronea";
    exit();
    }
$clave="'".$clave."'";
$base= "bautismo";
$solic="solic_local";
$notas="notas";
if (!empty(trim($notaPie))) {
  $sql="INSERT INTO $notas(numSolicitud, notaPie) VALUES ('$numSolicitud', '$notaPie')";
  $agreganota= mysqli_query($con, $sql);
}

    $ministro=$_POST['ministro'];
    $fechasacr=$_POST['fecsacr'];
    $fechanac=$_POST['fechanac'];
    $foja=$_POST['foja'];
    $fojac=$_POST['fojac'];
    $hijo=$_POST['hijo-a'];
    $librobis=$_POST['librobis'];
    $libro=$_POST['libro'];
    $lugarnac=$_POST['lugarnac'];
    $madre = utf8_decode($_POST["madre"]);
    $madrina = utf8_decode($_POST["madrina"]);
    $materno  = utf8_decode($_POST["materno"]);
    $nombre = utf8_decode($_POST["nombre"]);
    $notamar=$_POST['notamar'];
    $padre  = utf8_decode($_POST["padre"]);
    $padrino = utf8_decode($_POST["padrino"]);
    $partidaab=$_POST['partidaab'];
    $partidan=$_POST['partidan'];
    $paterno  = utf8_decode($_POST["paterno"]);

    if ($alta) {
        
        $sql="INSERT INTO $base(clave, ministro, fechasacr, fechanac, foja,  fojac, hijoa, librobis, libro, lugarnac, madre, madrina, materno, nombre, notamar, padre, padrino, partidaab, partidan, paterno, solicitud) VALUES($clave,'$ministro', '$fechasacr', '$fechanac', '$foja',  '$fojac', '$hijo', '$librobis', '$libro', '$lugarnac', '$madre', '$madrina', '$materno', '$nombre', '$notamar', '$padre', '$padrino', '$partidaab', '$partidan', '$paterno', '$numSolicitud')";
        }
    else {
        $sql="UPDATE  $base SET ministro='$ministro', fechasacr='$fechasacr', fechanac='$fechanac', foja='$foja',  fojac='$fojac', hijoa ='$hijo', librobis='$librobis', libro='$libro', lugarnac='$lugarnac', madre='$madre', madrina='$madrina', materno='$materno', nombre='$nombre', notamar='$notamar', padre='$padre', padrino='$padrino', partidaab='$partidaab', partidan='$partidan', paterno='$paterno', solicitud='$numSolicitud' WHERE clave=$clave";
        }
        $result = mysqli_query($con, $sql);

    $notapie=utf8_decode($_POST['notapie']);
        if (empty(trim($notapie))) {
            $borde=0;
        }else{
            $basenota='notas';

            $sql="INSERT INTO $basenota (numSolicitud, notapie) VALUES ('$numSolicitud', '$notapie')";
            $result = mysqli_query($con, $sql);
     
            $sql="UPDATE $basenota SET notaPie='$notapie' WHERE numSolicitud = $numSolicitud";
            $result = mysqli_query($con, $sql);
        }


$sql = "SELECT * FROM $base WHERE clave = $clave";
$result = mysqli_query($con, $sql);
$reg_bau=mysqli_fetch_assoc($result);
$regs=mysqli_num_rows(mysqli_query($con, $sql));
// $reg_bau['nombre'];
    $diabau=substr($reg_bau['fechasacr'], 8, 2);
    if (substr($diabau,0,1)=='0') {
        $diabau=substr($diabau,1,1);
    }
    $mesbau=substr($reg_bau['fechasacr'], 5, 2);
    @$txmesbau=$meses[$mesbau-1];
    $anobau=substr($reg_bau['fechasacr'], 0, 4);
//    $fechabau=$diabau." de ".$txmesbau." de ".$anobau;

    $dianac=substr($reg_bau['fechanac'], 8, 2);
    if (substr($dianac,0,1)=='0') {
        $dianac=substr($dianac,1,1);
    }
    $mesnac=substr($reg_bau['fechanac'], 5, 2);
    @$txmesnac=$meses[$mesnac-1];
    $anonac=substr($reg_bau['fechanac'], 0, 4);
//    $fechanac=$dianac." de ".$txmesnac." de ".$anonac;


$tiempo=getdate(date("U"));

$idano = substr($tiempo['year'], -4, 4);
$idmes = $tiempo['mon'];
$txmes=$meses[$idmes-1];
$iddia = $tiempo['mday'];

$nombre=utf8_encode($reg_bau['nombre']);
$paterno=utf8_encode($reg_bau['paterno']);
$materno=utf8_encode($reg_bau['materno']);
$padre=utf8_encode($reg_bau['padre']);
$madre=utf8_encode($reg_bau['madre']);
$padrino=utf8_encode($reg_bau['padrino']);
$madrina=utf8_encode($reg_bau['madrina']);
$nortamar=utf8_encode($reg_bau['notamar']);
$txnotamar=utf8_encode($_POST['txnotamar']);
$libro=$reg_bau['libro'];
$librobis=$reg_bau['librobis'];
$lugarnac=$reg_bau['lugarnac'];
$foja=$reg_bau['foja'];
$fojac=$reg_bau['fojac'];
$partidan=$reg_bau['partidan'];
$partidaab=$reg_bau['partidaab'];
$notapie=utf8_encode(trim($notapie)) ;
$fecsac=$reg_bau['fechasacr'];
if ($altasol) {
 
$newsol="INSERT INTO solic_local(numSolicitud, solicitud, nombre, apPaterno, apMaterno, padre, madre, fecSacr, status) VALUES('$numSolicitud', '1', '$nombre', '$paterno', '$materno', '$padre', '$madre', '$fecsac', '4') ";
mysqli_query($con, $newsol);
}
if (empty($notapie)){
    $borde=0;
}else{
    $borde=1;
}


if ($notamar==0) {
    $nm1="                         N I N G U N A";
}else{
    $nm1=utf8_decode($txnotamar); //pendiente de programación
}

$txlib=$libro." ".$librobis;
if (trim($foja) == trim($fojac)) {
    $txfoja=$foja;
}else{
    $txfoja=$foja." ".$fojac;
}


$txpart=$partidan." ".$partidaab;

$nomaps=$nombre." ".$paterno." ".$materno;
//*
$pdf = new PDF();
// Primera página
$pdf->AddPage();

$pdf->ln(56);
$pdf->SetFont('Arial','',11);
$pdf->SetX(79);
$pdf->Write(1,$diabau);
$pdf->SetX(100);
$pdf->Write(1,$txmesbau);
$pdf->SetX(145);
$pdf->Write(1,$anobau);

$pdf->ln(15);
$pdf->SetFont('Arial','',11);
$pdf->Cell(0,0,utf8_decode($nomaps),0,0,'C');

$pdf->ln(15);
$pdf->SetFont('Arial','',11);
$pdf->SetX(50);
$pdf->Write(1,$dianac);
$pdf->SetX(75);
$pdf->Write(1,$txmesnac);
$pdf->SetX(105);
$pdf->Write(1,$anonac);
$pdf->SetX(125);
$pdf->Write(1,utf8_decode(substr($lugarnac, 0, 25)));

$pdf->ln(6);
$pdf->SetX(125);
$pdf->Write(1,ltrim(utf8_decode(substr($lugarnac,25))));
//$pdf->MultiCell(60,4, $lugarnac);

$pdf->ln(10);
$pdf->SetX(65);
$pdf->Write(1, utf8_decode($padre));

$pdf->ln(8);
$pdf->SetX(65);
$pdf->Write(1, utf8_decode($madre));

$pdf->ln(8);
$pdf->SetX(65);
$pdf->Write(1, utf8_decode($padrino));

$pdf->ln(8);
$pdf->SetX(65);
$pdf->Write(1, utf8_decode($madrina));



$pdf->ln(48);
$pdf->SetX(113);
$pdf->Write(1, $txlib);

$pdf->SetX(137);
$pdf->Write(1, $txfoja);

$pdf->SetX(165);
$pdf->Write(1, $txpart);

$pdf->ln(15);
$pdf->SetX(50);
$pdf->Write(1, $iddia);
$pdf->SetX(74);
$pdf->Write(1, $txmes);
$pdf->SetX(106);
$pdf->Write(1, $idano);


$pdf->ln(47);
$pdf->SetX(105);
$pdf->SetFont('','',11);
$pdf->Write(1, 'M.I.SR. CANGO. ERNESTO REYNOSO Y VALLE');

$pdf->ln(-98);
$pdf->SetX(65);
$pdf->MultiCell(120,8, utf8_decode($nm1));

$pdf->ln(57);
$pdf->SetFont('','',9);
$pdf->SetX(20);
$pdf->MultiCell(70,5, utf8_decode($notapie),$borde);



$pdf->Output();

//*/
?>
