<?php

$id=$_GET["id"];
$nombre=$_GET["nombre"];
$paterno=$_GET["paterno"];
$materno=$_GET["materno"];
$ci=$_GET["ci"];
$celular=$_GET["celular"];
$sql="UPDATE academico.persona ";
$sql.="SET nombre='".$nombre."', ";
$sql.=" apaterno='".$paterno."', ";
$sql.=" amaterno='".$materno."', ";
$sql.=" ci='".$ci."', ";
$sql.=" celular='".$celular."' ";
$sql.="WHERE id=".$id;
$resultadofi=mysqli_query($con, $sql);

?>