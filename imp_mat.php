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
$solicitud = $_POST["solicitud"];

$clave=$_POST['clave'];
$numSolicitud=$_POST['numSolicitud'];



$con= new mysqli("localhost", "root", "", "sagrario");
if ($con->connect_errno){
    echo "conexion erronea";
    exit();
}
$clave="'".$clave."'";
$base= "matrimonios";
$solic="solic_local";


    $ministro=$_POST['ministro'];
    
        $actualiza="UPDATE  $base SET ministro='$ministro' WHERE clave=$clave";
        $result = mysqli_query($con, $actualiza) or die("n actualizo ministro");
    
    $fechasacr=$_POST['fecsacr'];
    
        $actualiza="UPDATE  $base SET fecSacr='$fechasacr' WHERE clave=$clave";
        $result = mysqli_query($con, $actualiza);
  
    
       
    $entidad=$_POST['entidadParrPresenta'];
    
        $actualiza="UPDATE  $base SET entidadParrPresenta='$entidad' WHERE clave=$clave";
        $result = mysqli_query($con, $actualiza) or die("n0 actualizo entidad");;
  

    $testigo1 = utf8_decode($_POST["testigo1"]);
    
        $actualiza="UPDATE  $base SET testigo1='$testigo1' WHERE clave=$clave";
        $result = mysqli_query($con, $actualiza);
   
    $testigo2 = utf8_decode($_POST["testigo2"]);
   
        $actualiza="UPDATE  $base SET testigo2='$testigo2' WHERE clave=$clave";
        $result = mysqli_query($con, $actualiza);
    
    $novio  = utf8_decode($_POST["esposo"]);
    
        $actualiza="UPDATE  $base SET novio='$novio' WHERE clave=$clave";
        $result = mysqli_query($con, $actualiza);
  
    
    $novia = utf8_decode($_POST["esposa"]);
        $actualiza="UPDATE  $base SET novia='$novia' WHERE clave=$clave";
        $result = mysqli_query($con, $actualiza);
      
    
    $parrPresento  = utf8_decode($_POST["parrPresento"]);
    
        $actualiza="UPDATE  $base SET parrPresento='$parrPresento' WHERE clave=$clave";
        $result = mysqli_query($con, $actualiza);

  
    $colParrPresenta  = utf8_decode($_POST["colParrPresenta"]);
        $actualiza="UPDATE  $base SET colParrPresenta='$colParrPresenta' WHERE clave=$clave";
        $result = mysqli_query($con, $actualiza);
 
        $actualiza="UPDATE  $base SET numSolicitud='$numSolicitud' WHERE clave=$clave";
        $result = mysqli_query($con, $actualiza) or die("n0 actualizo entidad");


        
        
/////////////////////////////////////////////////////////////////////////

    
$sql = "SELECT * FROM $base WHERE clave = $clave";
$result = mysqli_query($con, $sql) or die ("no consulto $base");
$reg_bau=mysqli_fetch_assoc($result);
$regs=mysqli_num_rows(mysqli_query($con, $sql));

    $diasacr=substr($reg_bau['fecSacr'], 8, 2);
    if (substr($diasacr,0,1)=='0') {
        $diasacr=substr($diasacr,1,1);
    }
    $messacr=substr($reg_bau['fecSacr'], 5, 2);
    @$txmessacr=$meses[$messacr-1];
    $anosacr=substr($reg_bau['fecSacr'], 0, 4);
//    $fechabau=$diabau." de ".$txmesbau." de ".$anobau;

    


$tiempo=getdate(date("U"));

$idano = substr($tiempo['year'], -4, 4);
$idmes = $tiempo['mon'];
$txmes=$meses[$idmes-1];
$iddia = $tiempo['mday'];
if (substr($iddia,0,1)=='0') {
        $iddia=substr($iddia,1,1);
    }
$libro=$reg_bau['libro'];
$foja=$reg_bau['foja'];
$fojac=$reg_bau['fojac'];
$partidan=$reg_bau['partida'];

$novio=utf8_encode($reg_bau['novio']);
$novia=utf8_encode($reg_bau['novia']);
$testigo1=utf8_encode($reg_bau['testigo1']);
$testigo2=utf8_encode($reg_bau['testigo2']);
$parrPresento=utf8_encode($reg_bau['parrPresento']);
$colParrPresenta=utf8_encode($reg_bau['colParrPresenta']);
$entidadParrPresenta=utf8_encode($reg_bau['entidadParrPresenta']);
$ministro=utf8_encode($reg_bau['ministro']);


$pdf = new PDF();
// Primera página
$pdf->AddPage();

$pdf->ln(45);
$pdf->SetFont('Arial','',18);
//$pdf->SetX(75);
$pdf->cell(0,0,"ACTA DE MATRIMONIO",0,0,"C");


$pdf->ln(10);
$pdf->SetFont('Arial','',11);
//$pdf->SetX(65);
$pdf->cell(0,0,"EL DIA $diasacr DEL MES DE $txmessacr DE $anosacr.",0,0,"C");

$pdf->ln(10);
$pdf->SetFont('Arial','',11);
$pdf->SetX(20);
$pdf->multicell(170,5,utf8_decode("EN ESTA PARROQUIA DE LA ASUNCION, SAGRARIO METROPOLITANO DE MEXICO, PREVIAS LAS DILIGENCIAS CANÓNICAS REALIZADAS EN ").utf8_decode(trim($parrPresento)).", ".utf8_decode(trim($colParrPresenta)).", ".utf8_decode(trim($entidadParrPresenta)));

$pdf->ln(10);
$pdf->SetFont('Arial','',11);
$pdf->SetX(20);
$pdf->Write(1,"ASISTIDOS POR EL ".utf8_decode($ministro).".");

$pdf->ln(15);
$pdf->Cell(0,0,utf8_decode("CONTRAJERON MATRIMONIO ECLESIASTICO"),0,0,'C');

$pdf->ln(15);
$pdf->SetFont('Helvetica','B',12);
$pdf->Cell(0,0,utf8_decode("$novio  Y  $novia"),0,0,'C');

$pdf->ln(20);
$pdf->SetFont('Arial','',11);
$pdf->Cell(0,0,utf8_decode("TESTIGOS DEL ACTO"),0,0,'C');

$pdf->ln(10);
$pdf->Cell(0,0,utf8_decode("$testigo1   Y   $testigo2"),0,0,'C');

$pdf->ln(15);
$pdf->SetX(20);
$pdf->multicell(170,5, utf8_decode("Son datos tomados del original que se encuentra en el      Libro $libro     Foja $foja $fojac     Partida $partidan"));

$pdf->ln(8);
$pdf->SetX(20);
$pdf->SetFont('','B',11);
$pdf->Write(1, utf8_decode("Copia  "));
$pdf->SetFont('','',11);
$pdf->Write(1, utf8_decode("expedida en la Ciudad de México, el $iddia de $txmes de $idano."));

$pdf->ln(20);
//$pdf->SetX(65);
$pdf->cell(0,0, utf8_decode("DOY FE"),0,0,"C");


$pdf->ln(30);
//$pdf->SetX(105);
$pdf->SetFont('','',11);
$pdf->cell(0,0, 'M.I.SR. CANGO. ERNESTO REYNOSO Y VALLE',0,0,"C");

$pdf->ln(5);
//$pdf->SetX(65);
$pdf->cell(0,0, utf8_decode("PARROCO"),0,0,"C");


$pdf->Output();


?>

