<?php

    require "BDs.php";
    $con=conect();

    $id=$_REQUEST['id'];

    $sql="UPDATE productos
      SET eliminado=1 AND status=0
      WHERE id=$id";

    $res=$con->query($sql);
    
    echo 1;

    /*
      $sql="DELETE productos WHERE id=$id";
    */
?>