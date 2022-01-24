<?php

//  Muestra productos
require "BDs.php";

$con=conect();

$sql="SELECT * FROM productos
      WHERE status=1 AND eliminado=0";

$res=$con->query($sql);
$cont=1;

?>