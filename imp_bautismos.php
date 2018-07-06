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

$con= new mysqli("localhost", "root", "", "sagrario");
if ($con->connect_errno){
    echo "conexion erronea";
    exit();
}
$sql= "SELECT * FROM nuevosbautismo ORDER BY clave";
$result= $con->query($sql);


$pdf = new PDF();
// Primera página



while ($actas=$result->fetch_assoc()) {

    $nom=$actas['nombre'];
    //si solo es uno programar
    //********************************************************************
    $padres=$actas['padre']." y ".$actas['madre'];
    $padrinos=$actas['padrino']." y ".$actas['madrina'];

    if ($actas['partidaab']=='A'){
    // ******************************************************************
        $pdf->AddPage();
        $pdf->ln(10);
    }
   else{
    $pdf->AddPage();
    $pdf->ln(60);
   } 
        $pdf->SetFont('Arial','',18);
        $pdf->SetX(35);

        $pdf->Write(1, 'ASUNCION SAGRARIO METROPOLITANO');

        $pdf->ln(8);
        $pdf->SetFont('Arial','',10);
        $pdf->SetX(80);
        $pdf->Write(1, utf8_decode('CATEDRAL DE MÉXICO'));

        $pdf->ln(5);
        $pdf->SetFont('','',10);
        $pdf->SetX(72);
        $pdf->Write(1, 'Tel.: 55-12-94-67     FAX: 55-21-24-47');

        $pdf->ln(20);
        $pdf->SetFont('','', 14);
        $pdf->Write(5, utf8_decode($nom));

        $pdf->ln(20);
        $pdf->SetFont('','', '12');
        $pdf->Write(5, 'Hijo de : ');
        $pdf->SetFont('','');
        $pdf->Write(5, utf8_decode($padres));
        $pdf->ln(20);
        $pdf->SetFont('','');
        $pdf->Write(5, 'Padrinos : ');
        $pdf->SetFont('','');
        $pdf->Write(5, utf8_decode($padrinos));
}

$pdf->Output();


?>
