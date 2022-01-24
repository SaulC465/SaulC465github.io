<?php

    require "BDs.php";
    $con=conect();

    $id=$_REQUEST['id'];

    $sql="UPDATE banners
      SET status=0 AND eliminado=1
      WHERE id=$id";

    $res=$con->query($sql);
    
    echo 1;

    /*
      $sql="DELETE banners WHERE id=$id";
    */
?>