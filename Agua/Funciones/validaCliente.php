<?php
    session_start();
    require "BDs.php";
    $con=conect();

    $user=$_REQUEST['user']; //correo
    $pass=$_REQUEST['pass'];
    $passEnc=md5($pass);

    $sql="SELECT * FROM clientes 
           WHERE correo='$user' AND contra='$pass' AND status=1 AND eliminado=0";
        
    $res=$con->query($sql);
    /*
    while($row=$res->fetch_array()){
        $id=$row["id"];
        $nombre=$row["nombre"];
        $precio=$row["correo"];
    }

    $query="INSERT INTO pedidos
            (usuario)
            VALUES ('$nombre')"; 

    $pedid=$con->query($query);
    */
    $num=$res->num_rows;
    if($num){
        $row=$res->fetch_array();
        $idC=$row["id"];
//        $nombreC=$row["nombre"].' '.$row["apellidos"];
        $nombreC=$row["nombre"];
        $correoC=$row["correo"];
        $_SESSION['idC']=$idC;
        $_SESSION['nombreC']=$nombreC;
        $_SESSION['correoC']=$correoC;

    }
    
    echo $num;

?>