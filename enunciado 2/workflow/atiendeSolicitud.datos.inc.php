<?php
    $sql="SELECT * FROM academico.persona ";
    $sql.="WHERE id=1";
    $resultadofi=mysqli_query($con, $sql);
    $filafi=mysqli_fetch_array($resultadofi);
    $id=$filafi["id"];
    $nombre=$filafi["nombre"];
    $paterno=$filafi["apaterno"];
    $materno=$filafi["amaterno"];
    $ci=$filafi["ci"];
    $celular=$filafi["celular"];
?>
<br>