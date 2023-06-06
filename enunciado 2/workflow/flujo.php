
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<title>INF 324</title>
</head>
<body>
	

<?php
session_start();
$flujo = $_GET["flujo"];
$proceso = $_GET["proceso"];
$nro_tramite = $_GET["nro_tramite"];

include "conexion.inc.php";
$sql="select * from flujo ";
$sql.="where flujo='".$flujo."' and ";
$sql.="proceso='".$proceso."'";
$resultado=mysqli_query($con, $sql);
$fila=mysqli_fetch_array($resultado);
$pantalla=$fila["pantalla"];
$tipo=$fila["tipo"];
$pro=$fila["proceso_siguiente"];
$rol=$fila["rol"];
//echo $pro;
//echo $rol;
//echo $_SESSION["rol"];
include $pantalla.".datos.inc.php";

$sql="select count(*) as cantidad from flujotramite ";
$sql.="where flujo='".$flujo."' and ";
$sql.="proceso='".$proceso."' and ";
$sql.="nro_tramite='".$nro_tramite."'";
$resultado2=mysqli_query($con, $sql);
$fila2=mysqli_fetch_array($resultado2);
$cantidad=$fila2["cantidad"];

?>
<div class="text-center">
	<a href="cerrar_session.php"><button class="btn btn-danger text-left mt-3"> Cerrar Sesion</button></a>
</div>
<form method="GET" action="motor.php">
	<?php 
	//include $pantalla.".inc.php";
	?>
	<input type="hidden" value="<?php echo $pantalla;?>" name="pantalla"/>
	<input type="hidden" value="<?php echo $flujo;?>" name="flujo"/>
	<input type="hidden" value="<?php echo $proceso;?>" name="proceso"/>
	<input type="hidden" value="<?php echo $tipo;?>" name="tipo"/>
	<input type="hidden" value="<?php echo $nro_tramite;?>" name="nro_tramite"/>

	<br/>
	<?php
	if($rol==$_SESSION["rol"]){
		include $pantalla.".inc.php";
		if ($tipo=="C")
		{	
	?>
		<div style=" text-align: center;">
		<input type="submit" class="btn btn-primary" value="Si" name="Si"/>
		<input type="submit"  class="btn btn-primary" value="No" name="No"/>
		</div>	
	<?php
		}else{
	?>	

		<div style=" text-align: center;">
		<input type="submit" class="btn btn-primary" value="Siguiente" name="Siguiente"/>	
	<?php
		if($cantidad<1){
	?>
	<input type="submit" class="btn btn-primary" value="Anterior" name="Anterior"/>
	<?php
		}else{	
	?>
		<input type="submit" class="btn btn-primary" disabled value="Anterior" name="Anterior"/>
	</div>	
	
	<?php	
		}
	}
	?>
		
	<?php	
	}else{
		
	?>
		<div class="card text-white bg-dark mb-3 mx-auto text-center">
  <div class="card-header">--------------------------------------------------------------------</div>
  <div class="card-body d-flex justify-content-center align-items-center">
    <h5 class="card-title">PROCESANDO</h5>
    <img src="img/carga.gif" width="50" alt="" class="img-fluid">
    <p class="card-text">Se está ejecutando el proceso [cambie de rol].</p>
  </div>
</div>



	<?php
	}

	?>

	
	
	
	
	</form>
</body>
</html>