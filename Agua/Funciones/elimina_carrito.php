<?php

    require "BDs.php";
    $con=conect();
    $band=0;
    $id=$_REQUEST['id'];

    $sql="DELETE FROM pedidos_productos WHERE id=$id";

    $res=$con->query($sql);
    if($res){
        $band=1;
    }
    
    echo $band;

    
//    $id=$_REQUEST['id'];
/*
    $sql="UPDATE pedidos_producto
      SET eliminado=1 AND status=0
      WHERE id=$id";
      
    

*/
?>