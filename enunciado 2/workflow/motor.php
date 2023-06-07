<?php
session_start();
$flujo = $_GET["flujo"];
$proceso = $_GET["proceso"];
$pantalla = $_GET["pantalla"];
$nro_tramite = $_GET["nro_tramite"];

include "conexion.inc.php";


$fecha=date("Y-m-d H:i:s",time()-3600);
$sql2="update flujotramite  SET fechafin='".$fecha."' ";
$sql2.="where Flujo='".$flujo."' and ";
$sql2.="proceso='".$proceso."' and ";
$sql2.="nro_tramite=".$nro_tramite." ";
$resultado2=mysqli_query($con, $sql2);
//echo $sql2;


include $pantalla.".grabar.inc.php";


if (isset($_GET["Siguiente"]))
{
	$sql="select flujo, proceso, proceso_siguiente as procesoselect, tipo, rol, pantalla ";
	$sql.="from flujo ";
	$sql.="where flujo='".$flujo."' and ";
	$sql.="proceso='".$proceso."'";
	
}
if (isset($_GET["Anterior"]))
{
	$sql="select flujo, proceso as procesoselect, proceso_siguiente, tipo, rol, pantalla ";
	$sql.="from flujo ";
	$sql.="where flujo='".$flujo."' and ";
	$sql.="proceso_siguiente='".$proceso."'";
	

}

if (isset($_GET["Si"]))
{
	$sql="select flujo, procesoSI as procesoselect ";
	$sql.="from flujocondicion ";
	$sql.="where flujo='".$flujo."' and ";
	$sql.="proceso='".$proceso."'";

}
if (isset($_GET["No"]))
{
	$sql="select flujo, procesoNO as procesoselect ";
	$sql.="from flujocondicion ";
	$sql.="where flujo='".$flujo."' and ";
	$sql.="proceso='".$proceso."'";
	
}

$resultado=mysqli_query($con, $sql);
$fila=mysqli_fetch_array($resultado);
$proceso = $fila["procesoselect"];

if($flujo=='F1' && $proceso=='P6'){$_SESSION["usuario"]='jhoel';}
if($flujo=='F1' && $proceso=='P5'){$_SESSION["usuario"]='jhoel';}
if($flujo=='F1' && $proceso=='P7'){$_SESSION["usuario"]='carlos';
	
	$fecha=date("Y-m-d H:i:s",time()-3600);
	$sql2="update flujotramite  SET fechafin='".$fecha."' ";
	$sql2.="where Flujo='".$flujo."' and ";
	$sql2.="proceso='".$proceso."' and ";
	$sql2.="nro_tramite=".$nro_tramite." ";
	//echo $sql2;
	$resultado2=mysqli_query($con, $sql2);	
}

if($proceso!=''){
$sql2="insert into flujotramite(flujo, proceso, nro_tramite, fechaini, usuario) ";
$sql2.="values('".$flujo."','".$proceso."','";
$sql2.=$nro_tramite."','".$fecha."','".$_SESSION["usuario"]."')";
$resultado2=mysqli_query($con, $sql2);
}

$parametros="?flujo=".$flujo;
if($proceso!=''){
	$parametros.="&proceso=".$proceso;
	$parametros.="&nro_tramite=".$nro_tramite;
	header("Location: flujo.php".$parametros);
}else if($proceso==''){	
	header("Location: index.php");
}else if($proceso!='' && $flujo='F1'){

	$parametros.="&proceso=".'P8';
	$parametros.="&nro_tramite=".$nro_tramite;
	header("Location: flujo.php".$parametros);
}

?>