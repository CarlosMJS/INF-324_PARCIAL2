<?php
include "conexion.inc.php";
$usuario=$_GET["usuario"];
$contrasenia=$_GET["contrasenia"];
$sql="select COUNT(*) as contador, nombre,rol from academico.persona p, academico.rol r where p.id_rol=r.id_rol and p.usuario='".$usuario."' and contrasenia='".$contrasenia."';";
$resultado=mysqli_query($con, $sql);
$fila=mysqli_fetch_array($resultado);

//echo $fila["rol"];

if ($fila["contador"]>0)
{
	session_start();
	$_SESSION["usuario"]=$usuario;
	$_SESSION["rol"]=$fila["rol"];
	header("Location: bentrada.php");
	exit;
}

header("Location: index.php");
?>