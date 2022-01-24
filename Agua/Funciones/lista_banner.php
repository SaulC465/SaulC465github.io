<?php

//  Muestra admins
require "BDs.php";

$con=conect();

$sql="SELECT * FROM banners
      WHERE status=1 AND eliminado=0";

$res=$con->query($sql);
$cont=1;

/*
while($row=$res->fetch_array()){
    $id=$row["ID"];
    $nombre=$row["Nombre"];
    $apellidos=$row["Apellidos"];
    echo "$cont $nombre $apellidos";
    echo "------";
    echo "<a href=\"Eliminar.php?ID=$id\">";
    echo "Eliminar Administrador";
    echo "</a><br>";
    $cont++;
}
*/

?>