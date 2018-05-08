<?php 
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
$solicitud = $_POST["solicitud"];

    $clave=$_POST['clave'];



$con= new mysqli("localhost", "root", "", "sagrario");
if ($con->connect_errno){
    echo "conexion erronea";
    exit();
}
$clave="'".$clave."'";
$base= "confirma";
$solic="solic_local";

    $acta=$_POST['acta'];
    if (! empty($acta)) {
        $actualiza="UPDATE  $base SET acta='$acta' WHERE clave=$clave";
        $result = mysqli_query($con, $actualiza);
    }
    $actaab=$_POST['actaab'];
    if (! empty($actaab)) {
        $actualiza="UPDATE  $base SET actaab='$actaab' WHERE clave=$clave";
        $result = mysqli_query($con, $actualiza);
    }
    $confirmo=($_POST['ministro']);
    if (! empty($confirmo)) {
        $actualiza="UPDATE  $base SET ministro='$confirmo' WHERE clave=$clave";
        $result = mysqli_query($con, $actualiza);
    }
    $fechabau=$_POST['fechabau'];
    if (! empty($fechabau)) {
        $actualiza="UPDATE  $base SET fechabau='$fechabau' WHERE clave=$clave";
        $result = mysqli_query($con, $actualiza);
    }
    $fechaconf=$_POST['fecsacr'];
    if (! empty($fechaconf)) {
        $actualiza="UPDATE  $base SET fechaconf='$fechaconf' WHERE clave=$clave";
        $result = mysqli_query($con, $actualiza);
    }
    $fechanac=$_POST['fechanac'];
    if (! empty($fechanac)) {
        $actualiza="UPDATE  $base SET fechanac='$fechanac' WHERE clave=$clave";
        $result = mysqli_query($con, $actualiza);
    }
    $foja=$_POST['foja'];
    if (! empty($foja)) {
        $actualiza="UPDATE  $base SET foja='$foja' WHERE clave=$clave";
        $result = mysqli_query($con, $actualiza);
    }
    $fojac=$_POST['fojac'];
    if (! empty($fojac)) {
        $actualiza="UPDATE  $base SET fojac='$fojac' WHERE clave=$clave";
        $result = mysqli_query($con, $actualiza);
    }
    $libro=$_POST['libro'];
    if (! empty($libro)) {
        $actualiza="UPDATE  $base SET libro='$libro' WHERE clave=$clave";
        $result = mysqli_query($con, $actualiza);
    }
    $librobis=$_POST['librobis'];
    if (! empty($librobis)) {
        $actualiza="UPDATE  $base SET librobis='$librobis' WHERE clave=$clave";
        $result = mysqli_query($con, $actualiza);
    }
    $lugarbau=($_POST['lugarbau']);
    if (! empty($lugarbau)) {
        $actualiza="UPDATE  $base SET lugarbau='$lugarbau' WHERE clave=$clave";
        $result = mysqli_query($con, $actualiza);
    }
    $lugarnac=($_POST['lugarnac']);
    if (! empty($lugarnac)) {
        $actualiza="UPDATE  $base SET lugarnac='$lugarnac' WHERE clave=$clave";
        $result = mysqli_query($con, $actualiza);
    }
    $madre = ($_POST["madre"]);
    if (! empty($madre)) {
        $actualiza="UPDATE  $base SET madre='$madre' WHERE clave=$clave";
        $result = mysqli_query($con, $actualiza);
    }
    $materno  = ($_POST["materno"]);
    if (! empty($materno)) {
        $actualiza="UPDATE  $base SET materno='$materno' WHERE clave=$clave";
        $result = mysqli_query($con, $actualiza);
    }
    $nombre = ($_POST["nombre"]);
    if (! empty($nombre)) {
        $actualiza="UPDATE  $base SET nombre='$nombre' WHERE clave=$clave";
        $result = mysqli_query($con, $actualiza);
    }

    $oa=$_POST['hijo-a'];
    if (! empty($oa)) {
        $actualiza="UPDATE  $base SET hijoa='$oa' WHERE clave=$clave";
        $result = mysqli_query($con, $actualiza);
    }
    $padre  = ($_POST["padre"]);
    if (! empty($padre)) {
        $actualiza="UPDATE  $base SET padre='$padre' WHERE clave=$clave";
        $result = mysqli_query($con, $actualiza);
    }
    $padrino = ($_POST["padrino"]);
    if (! empty($padrino)) {
        $actualiza="UPDATE  $base SET padrino='$padrino' WHERE clave=$clave";
        $result = mysqli_query($con, $actualiza);
    }
    $parrbau  =($_POST["parrbau"]);
    if (! empty($parrbau)) {
        $actualiza="UPDATE  $base SET parrbau='$parrbau' WHERE clave=$clave";
        $result = mysqli_query($con, $actualiza);
    }    
    $paterno  =($_POST["paterno"]);
    if (! empty($paterno)) {
        $actualiza="UPDATE  $base SET paterno='$paterno' WHERE clave=$clave";
        $result = mysqli_query($con, $actualiza);
    }
    $reg  =$_POST["reg"];
    if (! empty($reg)) {
        $actualiza="UPDATE  $base SET reg='$reg' WHERE clave=$clave";
        $result = mysqli_query($con, $actualiza);
    }
    $xdiacon=$_POST["xdiacon"];
    if (! empty($xdiacon)) {
        $actualiza="UPDATE  $base SET xdiacon='$xdiacon' WHERE clave=$clave";
        $result = mysqli_query($con, $actualiza);
    }
    $xmescon=$_POST["xmescon"];
    if (! empty($xmescon)) {
        $actualiza="UPDATE  $base SET xmescon='$xmescon' WHERE clave=$clave";
        $result = mysqli_query($con, $actualiza);
    }
    $xanocon=$_POST["xanocon"];
    if (! empty($xanocon)) {
        $actualiza="UPDATE  $base SET xanocon='$xanocon' WHERE clave=$clave";
        $result = mysqli_query($con, $actualiza);
    }

$sql = "SELECT * FROM $base WHERE clave = $clave";
$result = mysqli_query($con, $sql);
$reg_con=mysqli_fetch_assoc($result);
            
    $diacon=substr($reg_con['fechaconf'], 8, 2);
    $mescon=substr($reg_con['fechaconf'], 5, 2);
    @$txmescon=$meses[$mescon-1];
    $anocon=substr($reg_con['fechaconf'], 0, 4);

    $diabau=substr($reg_con['fechabau'], 8, 2);
    $mesbau=substr($reg_con['fechabau'], 5, 2);
    @$txmesbau=$meses[$mesbau-1];
    $anobau=substr($reg_con['fechabau'], 0, 4);
    if ($anobau=="0000") {
        $diabau=trim($reg_con['xdiacon']);
        $txmesbau=trim($reg_con['xmescon']);
        $anobau=trim($reg_con['xanocon']);
    }
//    $fecbau=$diabau." de ".$txmesbau." de ".$anobau;

    $dianac=substr($reg_con['fechanac'], 8, 2);
    $mesnac=substr($reg_con['fechanac'], 5, 2);
    @$txmesnac=$meses[$mesnac-1];
    $anonac=substr($reg_con['fechanac'], 0, 4);
//    $fechanac=$dianac." de ".$txmesnac." de ".$anonac;


$tiempo=getdate(date("U"));

$idano = substr($tiempo['year'], -4, 4);
$idmes = $tiempo['mon'];
$txmes=$meses[$idmes-1];
$iddia = $tiempo['mday'];

$nombre=utf8_encode($reg_con['nombre']);
$paterno=utf8_encode($reg_con['paterno']);
$materno=utf8_encode($reg_con['materno']);
$padre=utf8_encode($reg_con['padre']);
$madre=utf8_encode($reg_con['madre']);
$padrino=utf8_encode($reg_con['padrino']);
$oa=$reg_con['hijoa'];
$parrbau=utf8_encode($reg_con['parrbau']);
$lugarbau=utf8_encode($reg_con['lugarbau']);
$parlug1=trim(substr(trim($parrbau)." - ".trim($lugarbau),0,45));
$parlug2=trim(substr(trim($parrbau)." - ".trim($lugarbau),46,90));
//$parrbau=$reg_con['parrbau'];

//$madrina=$reg_con['madrina'];
//$nortamar=$reg_con['notamar'];
//$txnotamar=$_POST['txnotamar'];



$libron=$reg_con['libro'];
$librobis=$reg_con['librobis'];
$foja=$reg_con['foja'];
$fojac=$reg_con['fojac'];
$partidan=$reg_con['acta'];
if ($partidan==0) {
    $partidan="";
}
$partidaab=$reg_con['actaab'];
$reg=$reg_con['reg'];
if ($reg==0) {
    $reg="";
}

$txlib=$libron." ".$librobis;
$txfoja=$foja." ".$fojac;
$txpart=$partidan." ".$partidaab.$reg;
$nomaps=utf8_decode($nombre)." ".utf8_decode($paterno)." ".utf8_decode($materno);


$pdf = new PDF();
// Primera página
$pdf->AddPage();

$pdf->ln(54);
$pdf->SetFont('Arial','',11);
$pdf->SetX(57);

$pdf->Write(1,$diacon);
$pdf->SetX(93);
//$pdf->Write(1,$txmesbau);
$pdf->Write(1,$txmescon);
$pdf->SetX(158);
//$pdf->Write(1,$anobau);
$pdf->Write(1,$anocon);

$pdf->ln(17);
$pdf->SetFont('Arial','',11);
$pdf->SetX(78);
$pdf->Write(1, utf8_decode($nomaps));
//$pdf->Cell(0,0,$nomaps,0,0,'C');

$pdf->ln(10);
$pdf->SetX(48);
$pdf->Write(1, $oa);

$pdf->SetX(68);
$pdf->Write(1, utf8_decode($padre));

$pdf->ln(8);
$pdf->SetX(68);
$pdf->Write(1, utf8_decode($madre));

$pdf->ln(9);
$pdf->SetX(88);

$pdf->Write(1, utf8_decode($padrino));


$pdf->ln(12);
$pdf->SetX(59);
$pdf->Write(1, $oa);
$pdf->SetX(83);
$pdf->Write(1,$diabau);
$pdf->SetX(118);
$pdf->Write(1,$txmesbau);
$pdf->SetX(155);
$pdf->Write(1,$anobau);

$pdf->ln(10);
$pdf->SetX(83);
$pdf->Write(1, utf8_decode($parlug1));
$pdf->SetX(83);
$pdf->Write(8, utf8_decode($parlug2));

//$pdf->Write(1, utf8_decode($parrbau)."-".utf8_decode($lugarbau));
//$pdf->SetX(65);
//$pdf->Write(1, $lugarbau);


$pdf->ln(8);
$pdf->SetX(88);
$pdf->Write(1, $iddia);
$pdf->SetX(118);
$pdf->Write(1, $txmes);
$pdf->SetX(158);
$pdf->Write(1, $idano);



$pdf->ln(22);
$pdf->SetX(45);
$pdf->Write(1, $txlib);

$pdf->SetX(55);
$pdf->Write(1, $txfoja);

$pdf->SetX(70);
$pdf->Write(1, $txpart);


$pdf->ln(36);
$pdf->SetX(103);
$pdf->SetFont('','',9);
$pdf->Write(1, 'M.I.SR. CANGO. ERNESTO REYNOSO Y VALLE');



$pdf->Output();


?>"