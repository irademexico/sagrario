<?php
class miSistema
{
  public function __construct()
    {
      $_POST["nombreformulario"]."<br>";
      $_POST["edad"]."<br>";

      //"Inicia archivo recibir";
    }
  public function segundometodo()
    {
      $_POST["nombreformulario"]."<br>";
      $_POST["edad"]."<br>";
    }
}
$miObejeto= new miSistema();
echo "<br>Miles de lineas de codigo adicional<br>";
$miObejeto->segundometodo();
