<?php
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

$meses = array('enero','febrero','marzo','abril','mayo','junio','julio',
               'agosto','septiembre','octubre','noviembre','diciembre');



$solicitud = $_POST["solicitud"];
//echo $solicitud;
if (empty($_POST["simple"])) {
	$simple=1;
}
else{
	$simple = $_POST["simple"];
}
if (empty($_POST["urgente"])) {
	$urgente=1;
}
else{
	$urgente = $_POST["urgente"];
}

$busca = $_POST['busca'];
$para  = $_POST["para"];
$hoy = date('Y-m-d');
$nombre = $_POST["nombre"];
$apPaterno  = $_POST["apPaterno"];
$apMaterno  = $_POST["apMaterno"];
$vacia= trim($nombre).trim($apPaterno).trim($apMaterno);


if ($solicitud == 1) {
    $madrina = $_POST["madrina"];
}else{
    $madrina = "";
}
if ($solicitud == 3) {
    $esposo  = $_POST["esposo"];
    $esposa  = $_POST["esposa"];
    $vacia = $vacia.trim($esposo).trim($esposa);
}else{
    $esposo ="";
    $esposa ="";
}
if (!($solicitud == 3)) {
    $padre  = $_POST["padre"];
    $madre = $_POST["madre"];
    $padrino = $_POST["padrino"];
}else{
    $padre = "";
    $madre = "";
    $padrino = "";
}


$fecSacro = $_POST["fecSacr"];
$fecSacr = date($fecSacro);
$padres = $padre." y ".$madre;
$nom= $nombre." ".$apPaterno." ".$apMaterno;
$padrinos=$padrino." y ".$madrina;

    $pdfecSacr=substr($fecSacr,8,2);
    $pmfecSacr=substr($fecSacr,5,2);
    @$pmesfecSacr=$meses[$pmfecSacr-1];
    $pafecSacr=substr($fecSacr,0,4);
    $txfecSacr= $pdfecSacr . "  de  " . $pmesfecSacr . " de " . $pafecSacr;



    $fecNac = $_POST["fecNac"];
if (empty($fecNac)) {
    $txfecNac="";
}else{
    $pdfecNac=substr($fecNac,8,2);
    $pmfecNac=substr($fecNac,5,2);
    $pmesfecNac=$meses[$pmfecNac-1];
    $pafecNac=substr($fecNac,0,4);
    $txfecNac= $pdfecNac . "  de  " . $pmesfecNac . " de " . $pafecNac;
}

$fecAprox = $_POST["fecAprox"];
@$original = $_POST['original'];

if ($original == '1'){
    $poriginal="Original:  SI ";
}
else{
    $poriginal="Original:  NO";
    $original = 0;
    //$fecAprox ="";
}
//echo "<br>".$original;
//echo "<br>".$fecAprox;
if (empty($fecAprox)) {
    $pfecAprox="";
    $pdfecAprox="";
    $pmesfecAprox="";
    $pafecAprox="";
    $de="";
    $fechaaproximada=false;
}
else{
    $pfecAprox=" -- buscar hasta: ";
    $pfecAproxbau="- - BUSQUEDA DE UN AÑO - -";
    $pfecAproxcon=" - - BUSQUEDA DE UN MES - -";
    $pdfecAprox=substr($fecAprox,8,2);
    $pmfecAprox=substr($fecAprox,5,2);
    $pmesfecAprox=$meses[$pmfecAprox-1];
    $pafecAprox=substr($fecAprox,0,4);
    $de=" de ";
    $fechaaproximada=true;
}
//echo "<br>".$fechaaproximada;

$txOriginal= $poriginal . $pfecAprox . $pdfecAprox . $de . $pmesfecAprox . $de . $pafecAprox;

$fecEntrega = $_POST["fecEntrega"];
    $pdfecEntrega=substr($fecEntrega,8,2);
    $pmfecEntrega=substr($fecEntrega,5,2);
    $pmesfecEntrega=$meses[$pmfecEntrega-1];
    $pafecEntrega=substr($fecEntrega,0,4);
    $txfecEntrega= $pdfecEntrega . "  de  " . $pmesfecEntrega . " de " . $pafecEntrega. "  -   ";



$horario =  0;    //$_POST["horario"];
//$importe = $_POST["importe"];
//$iniciales = $_POST["iniciales"];

$tiempo=getdate(date("U"));

$idano = substr($tiempo['year'], -2, 2);
$idmes = $tiempo['mon'];
$iddia = $tiempo['mday'];
$idhora = $tiempo['hours'];
$idminuto = $tiempo['minutes'];
$idseg = $tiempo['seconds'];
//$numSolicitud= $idano*10000000000+$idmes*100000000+$iddia*1000000+($idhora+17)*10000+$idminuto*010+$idseg;

$con= new mysqli("localhost", "root", "", "sagrario");
if ($con->connect_errno){
    echo "conexion erronea";
    exit();
}

$sql= "SELECT * FROM last_solic";
$result= $con->query($sql);
$solic=$result->fetch_assoc();

if ($busca==1) {
    $txSolicitud= $solic['solicitud'];
}
else{
    $txSolicitud= $solic['solicitud']+1;
}


$result->free();
$con->close();


if ($simple == 1){
    $txSimple = " Simple";
}
else{
    $txSimple =  " Certificada";
}
if ($urgente==2) {
    $txUrgente = " Urgente";
}
else{
    $txUrgente = " ";
}

if ($para==1) {
    $txPara = "se solicita para Matrimonio - ";
    //$txdatosMat = $datosMat;
}
else{
    if ($para==2) {
        $txPara=" para Comunión";
    }
    elseif ($para==3) {
        $txPara=" para Confirmación";
    }
    elseif ($para==4) {
        $txPara=" para Padrino o Madrina";
    }
    else
    $txPara = " para otros";
    $txdatosMat = "";
}
if (empty($vacia)) {
  header('Location: cap_solicitudes.php');
}
//echo "<br>".$solicitud;
if ($solicitud=='1'){
// ******************************************************************
$pdf = new PDF();
// Primera página
$pdf->AddPage();
$pdf->SetFont('Arial','',18);
$pdf->SetX(35);
$pdf->Write(1, 'ASUNCION SAGRARIO METROPOLITANO');

$pdf->ln(8);
$pdf->SetFont('Arial','',10);
$pdf->SetX(80);
$pdf->Write(1, utf8_decode('CATEDRAL DE MÉXICO'));
$pdf->SetX(160);
$pdf->SetFont('Arial','',10);
$pdf->Write(1, 'Solicitud no.:     ');


$pdf->ln(5);
$pdf->SetFont('','',10);
$pdf->SetX(72);
$pdf->Write(1, 'Tel.: 55-12-94-67     FAX: 55-21-24-47');

$pdf->SetX(160);
$pdf->SetFont('','',16);
$pdf->Write(1, $txSolicitud);
$pdf->ln(10);
$pdf->SetX(120);
$pdf->SetFont('','',14);
$pdf->Write(1, 'Bautismo');
//$pdf->Write(1, $txSimple);
//$pdf->Write(1, ' - ');
//$pdf->Write(1, $txUrgente);

$pdf->ln(8);
$pdf->SetFont('','');
$pdf->Write(5, 'Nombre: ');
$pdf->SetFont('','', '');
$pdf->Write(5, utf8_decode($nom));

$pdf->ln(10);
$pdf->SetFont('','', '12');
$pdf->Write(5, 'Hijo de : ');
$pdf->SetFont('','');
$pdf->Write(5, utf8_decode($padres));
//$pdf->SetX(100);
//$pdf->SetFont('','');
//$pdf->Write(5, 'y   ');
//$pdf->SetFont('','');
//$pdf->Write(5, $madre);
$pdf->ln(10);
$pdf->SetFont('','');
$pdf->Write(5, 'Padrinos : ');
$pdf->SetFont('','');
$pdf->Write(5, utf8_decode($padrinos));
//$pdf->SetX(100);
//$pdf->SetFont('','');
//$pdf->Write(5, 'y   ');
//$pdf->SetFont('','');
//$pdf->Write(5, utf8_decode($madrina));
$pdf->ln(10);
$pdf->SetFont('','');
if ($fechaaproximada) {
    $pdf->Write(5, utf8_decode($pfecAproxbau));
}else{
    $pdf->Write(5, 'Bautizado el : ');
    $pdf->SetFont('','');
    $pdf->Write(5, $txfecSacr);
}
$pdf->SetX(100);
$pdf->SetFont('','');
$pdf->Write(5, '   nacio el :  ');
$pdf->SetFont('','');
$pdf->Write(5, $txfecNac);
$pdf->ln(10);
$pdf->SetFont('','','12');
$pdf->Write(5, 'Fecha de entrega:  ');
$pdf->SetFont('','');
$pdf->Write(5, $txfecEntrega);
$pdf->Write(5, 'de 12:00  a 6:30 pm - lunes a viernes' );
$pdf->ln(10);
$pdf->SetX(97);
$pdf->SetFont('', '', '12');
$pdf->Write(5, utf8_decode('y de 12:00  a 2:00 pm - sábados.'));
$pdf->SetFont('','','');
$pdf->ln(10);
$pdf->SetFont('','');
$pdf->Write(5, utf8_decode($txPara));
$pdf->SetX(120);
$pdf->SetFont('', '', '12');
$pdf->Write(5, 'EN DIAS HABILES');

$pdf->SetFont('','');
$pdf->ln(8);
$pdf->SetFont('','');
$pdf->Write(5, '------------------------------------------------------------------------------------------------------------');
if ($para==1) {

$pdf->ln(8);
$pdf->SetFont('','',8);
$pdf->SetX(50);
$pdf->Write(5, 'FAVOR DE LLENAR ESTOS DATOS DEL MATRIMONIO');
$pdf->ln(1);
$pdf->Write(5, '______________________________________________________________________________________________________________________');
$pdf->ln(2);
$pdf->Write(5, '|');
$pdf->SetX(195);
$pdf->Write(5, '|');
$pdf->ln(2);
$pdf->Write(5, '|');
$pdf->SetX(195);
$pdf->Write(5, '|');
$pdf->ln(2);
$pdf->Write(5, '|');
$pdf->SetX(195);
$pdf->Write(5, '|');
$pdf->ln(2);
$pdf->Write(5, '|');
$pdf->SetX(195);
$pdf->Write(5, '|');
$pdf->ln(2);
$pdf->Write(5, '|');
$pdf->Write(5, '  PERSONA CON QUIEN SE CASA:     _________________________________________________________________________________  ');
$pdf->SetX(195);
$pdf->Write(5, '|');

$pdf->ln(2);
$pdf->Write(5, '|');
$pdf->SetX(195);
$pdf->Write(5, '|');
$pdf->ln(2);
$pdf->Write(5, '|');
$pdf->SetX(195);
$pdf->Write(5, '|');

$pdf->ln(2);
$pdf->Write(5, '|');
$pdf->Write(5, '  NOMBRE DE LA PARROQUIA DONDE LE SOLICITAN ESTE DOCUMENTO:');
$pdf->ln(2);
$pdf->Write(5, '|');
$pdf->SetX(195);
$pdf->Write(5, '|');
$pdf->ln(2);
$pdf->Write(5, '|');
$pdf->SetX(195);
$pdf->Write(5, '|');
$pdf->ln(2);
$pdf->Write(5, '|');
$pdf->SetX(195);
$pdf->Write(5, '|');

$pdf->ln(2);
$pdf->Write(5, '|');
$pdf->Write(5, '  ________________________________________________________________________________________________________________ ');
$pdf->SetX(195);
$pdf->Write(5, '|');
$pdf->ln(2);
$pdf->Write(5, '|');
$pdf->SetX(195);
$pdf->Write(5, '|');
$pdf->ln(2);
$pdf->Write(5, '|');
$pdf->SetX(195);
$pdf->Write(5, '|');
$pdf->ln(2);
$pdf->Write(5, '|');
$pdf->SetX(195);
$pdf->Write(5, '|');
$pdf->ln(2);
$pdf->Write(5, '|');
$pdf->SetX(195);
$pdf->Write(5, '|');

$pdf->ln(2);
$pdf->Write(5, '|');
$pdf->Write(5, '  PARROQUIA DONDE SE CASARAN:     ________________________________________________________________________________ ');
$pdf->SetX(195);
$pdf->Write(5, '|');
$pdf->ln(2);
$pdf->Write(5, '|');
$pdf->SetX(195);
$pdf->Write(5, '|');
$pdf->ln(2);
$pdf->Write(5, '|');
$pdf->SetX(195);
$pdf->Write(5, '|');
$pdf->ln(2);
$pdf->Write(5, '|');
$pdf->SetX(195);
$pdf->Write(5, '|');
$pdf->ln(2);
$pdf->Write(5, '|');
$pdf->SetX(195);
$pdf->Write(5, '|');

$pdf->ln(2);
$pdf->Write(5, '|');
$pdf->Write(5, '  EL DIA  ______________  DE  ___________________________  DE _______________  A LAS ____________ HRS');
$pdf->ln(2);
$pdf->Write(5, '| _____________________________________________________________________________________________________________________');
$pdf->SetX(195);
$pdf->Write(5, '|');

$pdf->SetFont('','',10);
}
else{
$pdf->ln(30);


$pdf->Write(5, '.');

}
$pdf->ln(10);
$pdf->SetFont('','',10);

$pdf->Write(5, 'Solicitud de BAUTISMO  ');
$pdf->Write(5, $txSimple);
$pdf->Write(5, $txUrgente);
$pdf->Write(5, utf8_decode($txPara));

$pdf->SetX(140);
$pdf->Write(5, 'No.:  ');
$pdf->SetFont('','',16);
$pdf->Write(5, $txSolicitud);
$pdf->ln(7);
$pdf->SetFont('','',12);
$pdf->Write(5, 'Nombre: ');
$pdf->SetFont('','', '');
$pdf->Write(5, utf8_decode($nombre));
$pdf->Write(5, '      ');
$pdf->Write(5, utf8_decode($apPaterno));
$pdf->Write(5, '      ');
$pdf->Write(5, utf8_decode($apMaterno));

$pdf->ln(7);
$pdf->SetFont('','', '12');
$pdf->Write(5, 'Hijo de : ');
$pdf->SetFont('','');
$pdf->Write(5, utf8_decode($padres));
//$pdf->SetX(100);
//$pdf->SetFont('','');
//$pdf->Write(5, 'y   ');
//$pdf->SetFont('','');
//$pdf->Write(5, utf8_decode($madre));
$pdf->ln(7);
$pdf->SetFont('','');
$pdf->Write(5, 'Padrinos : ');
$pdf->SetFont('','');
$pdf->Write(5, utf8_decode($padrinos));
//$pdf->SetX(100);
//$pdf->SetFont('','');
//$pdf->Write(5, 'y   ');
//$pdf->SetFont('','');
//$pdf->Write(5, utf8_decode($madrina));
$pdf->ln(10);
$pdf->SetFont('','');
if (!$fechaaproximada) {
    $pdf->Write(5, 'Bautizado el : ');
$pdf->SetFont('','');
$pdf->Write(5, $txfecSacr);
}

$pdf->SetX(100);
$pdf->SetFont('','');
$pdf->Write(5, '   nacio el  : ');
$pdf->SetFont('','');
$pdf->Write(5, $txfecNac);
$pdf->ln(10);
$pdf->SetFont('','');
$pdf->Write(5, $txOriginal);
$pdf->SetFont('','');

$pdf->ln(10);
$pdf->SetFont('','','12');
$pdf->Write(5, 'Fecha de entrega:  ');
$pdf->SetFont('','');
$pdf->Write(5, $txfecEntrega);
$pdf->ln(10);
$pdf->SetFont('','','14');
$pdf->Write(5, '          R E V I S O  ');
$pdf->ln(16);
$pdf->SetFont('','','12');
$pdf->Write(5, '     ________________________________________');

$pdf->Output();
//************************************************************************


}
elseif ($solicitud=='2') {

$pdf = new PDF();
// Primera página
$pdf->AddPage();
$pdf->SetFont('Arial','',20);
$pdf->SetX(35);
$pdf->Write(1, 'ASUNCION SAGRARIO METROPOLITANO');

$pdf->ln(8);
$pdf->SetFont('Arial','',10);
$pdf->SetX(80);
$pdf->Write(1, utf8_decode('CATEDRAL DE MÉXICO'));
$pdf->SetX(160);
$pdf->SetFont('Arial','',10);
$pdf->Write(5, 'Solicitud no.: ');

$pdf->ln(8);
$pdf->SetFont('','',10);
$pdf->SetX(72);
$pdf->Write(1, 'Tel.: 55-12-94-67     FAX: 55-21-24-47');
$pdf->SetX(160);

$pdf->SetFont('','',18);
$pdf->Write(5, $txSolicitud);
$pdf->ln(10);
$pdf->SetX(120);

$pdf->SetFont('','','12');
$pdf->Write(5, utf8_decode('Confirmación'));
//$pdf->Write(5, $txSimple);
//$pdf->Write(5, ' - ');
//$pdf->Write(5, $txUrgente);
$pdf->ln(10);
$pdf->SetFont('','',12);
$pdf->Write(5, 'Nombre: ');
$pdf->SetFont('','', '');
$pdf->Write(5, utf8_decode($nom));
$pdf->ln(10);
$pdf->SetFont('','', '12');
$pdf->Write(5, 'Hijo de : ');
$pdf->SetFont('','');
$pdf->Write(5, utf8_decode($padres));
$pdf->ln(10);
$pdf->SetFont('','');
$pdf->Write(5, 'Padrino o Madrina : ');
$pdf->SetFont('','');
$pdf->Write(5, $padrino);
$pdf->ln(10);
$pdf->SetFont('','');
$pdf->Write(5, 'Confirmado el : ');
$pdf->SetFont('','');
$pdf->Write(5, $txfecSacr);
if ($fechaaproximada) {
    $pdf->Write(5, $pfecAproxcon);
}
$pdf->SetX(100);
$pdf->SetFont('','');
//$pdf->Write(5, '   nacio el  : ');
//$pdf->SetFont('','U');
//$pdf->Write(5, $txfecNac);
$pdf->ln(10);
$pdf->SetFont('','');
//$pdf->Write(5, $txOriginal);
$pdf->SetFont('','');
//$pdf->Write(5, $txfecAprox);
$pdf->ln(15);
$pdf->SetFont('Arial','','12');
$pdf->Write(5, 'Fecha de entrega:  ');
$pdf->SetFont('','','12');
$pdf->Write(5, $txfecEntrega);
$pdf->SetFont('','');

$pdf->Write(5, '    de 12:00 a 6:30 pm - lunes a viernes' );
$pdf->ln(10);
$pdf->SetX(97);
$pdf->SetFont('', '', '12');
$pdf->Write(5, utf8_decode('    y de 12:00 a 2:00 pm - sábados.'));
$pdf->SetFont('','','12');
$pdf->ln(10);
$pdf->SetFont('','');
//$pdf->Write(5, $txPara);
$pdf->SetX(120);
$pdf->SetFont('', '', '12');
$pdf->Write(5, 'EN DIAS HABILES');

$pdf->SetFont('','');
$pdf->ln(15);
$pdf->SetFont('','');
$pdf->Write(5, '------------------------------------------------------------------------------------------------------------');

$pdf->ln(15);
$pdf->SetFont('','','12');
$pdf->Write(5, utf8_decode('Solicitud de Confirmación'));
$pdf->Write(5, $txSimple);
$pdf->Write(5, $txUrgente);
$pdf->SetX(140);
$pdf->Write(5, 'no.:     ');
$pdf->SetFont('','','12');
$pdf->Write(5, $txSolicitud);
$pdf->ln(10);
$pdf->SetFont('','');
$pdf->Write(5, 'Nombre: ');
$pdf->SetFont('','', '12');
$pdf->Write(5, utf8_decode($nom));
$pdf->SetFont('','');
$pdf->ln(10);
$pdf->SetFont('','', '12');
$pdf->Write(5, 'Hijo de : ');
$pdf->SetFont('','');
$pdf->Write(5, utf8_decode($padres));
$pdf->ln(10);
$pdf->SetFont('','');
$pdf->Write(5, 'Padrino o Madrina : ');
$pdf->SetFont('','');
$pdf->Write(5, utf8_decode($padrino));
$pdf->ln(10);
$pdf->SetFont('','');
$pdf->Write(5, 'Confirmado el : ');
$pdf->SetFont('','');
$pdf->Write(5, $txfecSacr);
$pdf->ln(10);
$pdf->SetFont('','');
$pdf->Write(5, $txOriginal);
$pdf->SetFont('','');
$pdf->ln(15);
$pdf->SetFont('Arial','','12');
$pdf->Write(5, 'Fecha de entrega:  ');
$pdf->SetFont('','','12');
$pdf->Write(5, $txfecEntrega);
$pdf->SetFont('','');
$pdf->ln(10);
$pdf->SetFont('','','14');
$pdf->Write(5, '          R E V I S O  ');
$pdf->ln(16);
$pdf->SetFont('','','12');
$pdf->Write(5, '     ________________________________________');


$pdf->Output();


}

else{
$pdf = new PDF();
// Primera página
$pdf->AddPage();
$pdf->SetFont('Arial','',20);
$pdf->SetX(35);
$pdf->Write(1, 'ASUNCION SAGRARIO METROPOLITANO');

$pdf->ln(8);
$pdf->SetFont('Arial','',10);
$pdf->SetX(80);
$pdf->Write(1, utf8_decode('CATEDRAL DE MÉXICO'));
$pdf->SetX(160);
$pdf->SetFont('Arial','',12);
$pdf->Write(5, 'Solicitud no.: ');

$pdf->ln(8);
$pdf->SetFont('','',10);
$pdf->SetX(72);
$pdf->Write(1, 'Tel.: 55-12-94-67     FAX: 55-21-24-47');

$pdf->SetX(160);

$pdf->SetFont('','U',18);
$pdf->Write(5, $txSolicitud);

$pdf->ln(10);

$pdf->SetX(140);
$pdf->SetFont('','',12);
$pdf->Write(5, 'Matrimonio ');
$pdf->ln(8);

$pdf->SetX(140);

//$pdf->Write(5, $txSimple);

//$pdf->Write(5, $txUrgente);
$pdf->ln(10);
$pdf->SetFont('','',12);
$pdf->Write(5, 'Esposo: ');
$pdf->SetFont('','', '12');
$pdf->Write(5, utf8_decode($esposo));
$pdf->ln(10);
$pdf->SetFont('','', '12');
$pdf->Write(5, 'Esposa: ');
$pdf->SetFont('','', '12');
$pdf->Write(5, utf8_decode($esposa));
$pdf->ln(15);
$pdf->SetFont('','');
$pdf->Write(5, 'Fecha del Matrimonio : ');
$pdf->SetFont('','');
$pdf->Write(5, $txfecSacr);
$pdf->ln(10);
$pdf->ln(10);
$pdf->SetFont('','');
$pdf->Write(5, $txOriginal);
$pdf->ln(15);
$pdf->SetFont('Arial','','12');
$pdf->Write(5, 'Fecha de entrega:  ');
$pdf->SetFont('','','12');

$pdf->Write(5, $txfecEntrega);
$pdf->SetFont('','');

$pdf->Write(5, '    de 12:00 a 6:30 pm - lunes a viernes' );
$pdf->ln(10);
$pdf->SetX(97);
$pdf->SetFont('', '', '12');
$pdf->Write(5, utf8_decode('    y de 12:00 a 2:00 pm - sábados.'));
$pdf->SetFont('','','12');
$pdf->ln(10);
$pdf->SetX(120);
$pdf->SetFont('', '', '12');
$pdf->Write(5, 'EN DIAS HABILES');

$pdf->SetFont('','');
$pdf->ln(15);
$pdf->SetFont('','');
$pdf->Write(5, '------------------------------------------------------------------------------------------------------------');


$pdf->ln(15);
$pdf->SetFont('','',14);
$pdf->Write(5, 'Solicitud de Matrimonio - ');
$pdf->Write(5, $txSimple);
//$pdf->Write(' - ');
$pdf->Write(5, $txUrgente);
$pdf->SetX(140);
$pdf->SetFont('Arial','',12);
$pdf->Write(5, ' no.:  ');
$pdf->SetFont('','',14);
$pdf->Write(5, $txSolicitud);
$pdf->ln(15);
$pdf->SetFont('','',12);
$pdf->Write(5, 'Esposo: ');
$pdf->SetFont('','', '12');
$pdf->Write(5, utf8_decode($esposo));
$pdf->ln(10);
$pdf->SetFont('','', '12');
$pdf->Write(5, 'Esposa: ');
$pdf->SetFont('','', '12');
$pdf->Write(5, utf8_decode($esposa));
$pdf->ln(15);
$pdf->SetFont('','');
$pdf->Write(5, 'Fecha del Matrimonio : ');
$pdf->SetFont('','');
$pdf->Write(5, $txfecSacr);
$pdf->ln(15);
$pdf->SetFont('','');
$pdf->Write(5, $txOriginal);
$pdf->ln(15);

$pdf->SetFont('','','14');
$pdf->Write(5, '          R E V I S O  ');
$pdf->ln(16);
$pdf->SetFont('','','12');
$pdf->Write(5, '     ________________________________________');

$pdf->Output();
}

$status = 1;
// 1 impreso
$con= new mysqli("localhost", "root", "", "sagrario");
if ($con->connect_errno){
    echo "conexion erronea";
    exit();
}
//echo $hoy;

if ($busca==1) {

    $base='solicitudes';
    $sql="UPDATE $base SET solicitud='$solicitud', simple='$simple', urgente='$urgente', para='$para', nombre='$nombre', apPaterno='$apPaterno', apMaterno='$apMaterno', esposo='$esposo', esposa='$esposa', padrino='$padrino', madrina='$madrina', fecSacr='$fecSacr', fecNac='$fecNac', original='$original', fecAprox='$fecAprox', fecEntrega='$fecEntrega', status='$status', madre='$madre', padre='$padre', fecaSolicitud='$hoy'   WHERE numSolicitud=$txSolicitud";

     $result = mysqli_query($con, $sql);

}else{

    $con->real_query( "INSERT INTO solicitudes (numSolicitud, solicitud, simple, urgente, para, nombre, apPaterno, apMaterno, esposo, esposa, padrino, madrina, fecSacr, fecNac, original, fecAprox, fecEntrega, status, madre, padre, fecaSolicitud)
          VALUES ('$txSolicitud', '$solicitud', '$simple', '$urgente', '$para', '$nombre', '$apPaterno', '$apMaterno', '$esposo', '$esposa', '$padrino', '$madrina', '$fecSacr', '$fecNac', '$original', '$fecAprox', '$fecEntrega', '$status', '$madre', '$padre', '$hoy')");


    if ($con) {
        $con->close();
    $nSol=$txSolicitud;
    $con= new mysqli("localhost", "root", "", "sagrario");
    if ($con->connect_errno){
        echo "conexion erronea";
        exit();
    }
    $con->real_query("UPDATE last_solic SET solicitud = '$nSol'");
    $con->close();

}


}

?>
