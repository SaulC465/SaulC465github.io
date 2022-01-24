<?php
    session_start();
    require "BDs.php";
    $con=conect();

    $user=$_REQUEST['user']; //correo
    $pass=$_REQUEST['pass'];
    $passEnc=md5($pass);

    $sql="SELECT * FROM admins
           WHERE correo='$user' AND contra='$pass' AND status=1 AND eliminado=0";
        
    $res=$con->query($sql);
    $num=$res->num_rows;

    if($num){
        $row=$res->fetch_array();
        $idU=$row["id"];
        $nombre=$row["nombre"].' '.$row["apellidos"];
        $correo=$row["correo"];
        $_SESSION['idU']=$idU;
        $_SESSION['nombre']=$nombre;
        $_SESSION['correo']=$correo;

    }
    
    echo $num;
    error_reporting(-1);

?>