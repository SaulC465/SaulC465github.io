<?php
require "BDs.php";
$con=conect();

$nombre=$_REQUEST['nombre'];
$apellidos=$_REQUEST['apellido'];
$correo=$_REQUEST['user'];
$pass=$_REQUEST['pass'];
$passEnc=md5($pass);


    $sql="INSERT INTO clientes
        (nombre, apellidos, correo, contra)
        VALUES ('$nombre', '$apellidos', '$correo', '$passEnc')";

    $res=$con->query($sql);

    $query="INSERT INTO pedidos
            (usuario)
            VALUES ('$nombre')"; 
    
    $pedid=$con->query($query);


header("Location: ../index.php");


?>