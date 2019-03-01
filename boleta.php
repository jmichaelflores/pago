<?php 
require("conexion.php");

$fecha_emision= date("Y-m-d", time() );
$diaensegundos=24*60*60;
$fecha_limite=date("Y-m-d", time() + $diaensegundos);
$NPE = 6;
$estado=0;
$idinscripciones=1;

$consulta =$con->prepare("INSERT INTO boleta(fecha_emision,fecha_limite,NPE,estado,inscripciones_idinscripciones) VALUES(:fecha_emision,:fecha_limite,:NPE,:estado,:idinscripciones)");
$consulta->bindParam(':fecha_emision',$fecha_emision);
$consulta->bindParam(':fecha_limite',$fecha_limite);
$consulta->bindParam(':NPE',$NPE);
$consulta->bindParam(':estado',$estado);
$consulta->bindParam(':idinscripciones',$idinscripciones);
$consulta->execute();



include 'mpdf/mpdf.php';
$content=$fecha_emision." ".$fecha_limite." ".$NPE." ".$estado." ".$idinscripciones;
$mpdf = new mPDF('utf-8', 'A4',0,'',5,5,10,0,0,0,'P');
$mpdf ->WriteHTML($content,2);
$mpdf ->Output();
exit;
?>