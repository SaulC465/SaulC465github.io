<?php
   
    session_start();
     
    if(!isset($_SESSION['correoC'])){
               
        header("Location: index.php");
                
    }else{
        session_destroy();
        header("Location: index.php");
    }
   

?>