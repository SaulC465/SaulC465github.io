<?php
  
    require "BDs.php";
    $con=conect();

    $correo=$_REQUEST['user'];
    $ban=0;

    //Verificar correo duplicado
    $consulta="SELECT * FROM clientes
                WHERE correo='$correo'";

    $verificar=$con->query($consulta);
        
    if(mysqli_num_rows($verificar) > 0){
        $ban=1;  
    }
    echo $ban;

?>