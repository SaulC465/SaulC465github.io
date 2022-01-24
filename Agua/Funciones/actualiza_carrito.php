<?php
    session_start();
    require "BDs.php";
    $con=conect();

    $usuario=$_SESSION['nombreC'];
    $direcA=$_REQUEST['direccion'];
    $direcB=$_REQUEST['direc'];
    $band=0;

    $con=conect();

    $address="SELECT * FROM clientes
    WHERE nombre='$usuario'";

    $calle=$con->query($address);

    while($row=$calle->fetch_array()){
        $A=$row["direccion"];
    }

    if($direcA==1 && $direcB!=null){
      $direccion=$direcB;
    }else if($direcA==1){
      $direccion=$direcA;
    }else{
      $direccion=$direcB;
    }
    echo $direccion;
    die;
    $obtener="SELECT * FROM pedidos
    WHERE usuario='$usuario'";

    $res=$con->query($obtener);

    while($row=$res->fetch_array()){
        $pedido=$row["id"];
    }

    $sql="UPDATE pedidos
      SET status=1, direccion=$direccion
      WHERE id=$pedido";

    $res=$con->query($sql);

    if($res){
      $band=1;
    }

    echo $band;

?>