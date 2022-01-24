<?php

    session_start();
    require "BDs.php";  
    $con=conect();

    if(!isset($_SESSION['nombreC'])){
        echo 0;
        die;
    }

    $id=$_REQUEST['id'];
    $cantidad=$_REQUEST['cantidad'];
    $usuario=$_SESSION['nombreC'];

    //Se saca el precio correspondiente de id

    $sql="SELECT * FROM productos
         WHERE id=$id";

    $res=$con->query($sql);

    while($row=$res->fetch_array()){
        $id=$row["id"];
        $nombre=$row["nombre"];
        $codigo=$row["codigo"];
        $precio=$row["costo"];
        $descrip=$row["descripcion"];
    }

    //echo "id: ".$id." nombre: ".$nombre." codigo: ".$codigo." precio: ".$precio." descrip: ".$descrip;

    $obtener="SELECT * FROM pedidos
    WHERE usuario='$usuario' AND status=0";

    $res=$con->query($obtener);

    while($row=$res->fetch_array()){
        $pedido=$row["id"];
        
    }


    $query="INSERT INTO pedidos_productos
            (id_prod, id_pedido, cantidad, precio)
            VALUES ($id, $pedido, $cantidad, $precio)";

    $res=$con->query($query);
    
    echo 1;

?>