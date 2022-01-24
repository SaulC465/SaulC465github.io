<?php
    require "Funciones/BDs.php";
    $con=conect();
    session_start();
    $usuario=$_SESSION['nombreC'];

    
    if(!isset($_SESSION['correoC'])){
               
        header("Location: index.php");
                
    }else{
        $query="UPDATE pedidos
            SET status=1
            WHERE usuario='$usuario'"; 
            
    
        $res=$con->query($query);

        session_destroy();
        header("Location: index.php");
    }
   

?>