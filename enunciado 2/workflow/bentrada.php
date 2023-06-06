<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<title>Segundo Parcial_Pregunta 2</title>
</head>
<body>

<div class="text-right m-3 mr-5">
  <a href="cerrar_session.php" class="btn btn-danger"> SALIR </a>
</div>

<div class="card text-center">
  <div class="card-header">
    TRAMITE DE CERTIFICADO DE CULMINACION DE ESTUDIOS    
  </div style=" text-align: center;">
<div>

<div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5>EJECUCION DE TRAMITES</h5>
      <img src="img/tramites.png" style="width: 18rem;" class="mt-5 center-block" alt="..."> 
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
      <div class="card-body">
        <h5>FUNCIONALIDAD</h5>
    <?php
      include "conexion.inc.php";
      session_start();
      $usuario=$_SESSION["usuario"];
      $sql="select * from flujotramite ";
      $sql.="where usuario='".$usuario."' and fechafin is null and proceso <> ''";
      $resultado=mysqli_query($con, $sql);
      ?>
      <table class="table">
      <tr>
        <td>Flujo</td>
        <td>proceso</td>
        <td>No.tramite</td>
        <td>fecha inicial</td>
        <td>fecha final</td>
        <td>Continuar</td>
      </tr>
    <?php 
    while ($fila=mysqli_fetch_array($resultado))
      {
        echo "<tr>";
        echo "<td>".$fila["Flujo"]."</td>";
        echo "<td>".$fila["proceso"]."</td>";
        echo "<td>".$fila["nro_tramite"]."</td>";
        echo "<td>".$fila["fechaini"]."</td>";
        echo "<td>".$fila["fechafin"]."</td>";
        echo "<td><a href='flujo.php?flujo=".$fila["Flujo"]."&proceso=".$fila["proceso"]."&nro_tramite=".$fila["nro_tramite"]."'>Ir</td>";
        echo "</tr>";
      }
    ?>
    </table>
    </div> 
      </div>
    </div>
  </div>
</div>
<div class="card-footer text-muted">
    JAHUIRA SULLCA CARLOS MANUEL - LEGUA VILLEGAS JHOEL MAURICIO
  </div>
</body>
</html>