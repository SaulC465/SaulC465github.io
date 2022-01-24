<?php 
    require "lista_banner.php"; include "../menu.php";

    session_start();
    if(!isset($_SESSION['correo'])){
               
        header("Location: ../login.php");
        session_destroy();
        die();
    }

?>

<html>

<head>

    <title>Detalles del Banner</title>
    <script src="js/jquery-3.3.1.min.js"></script>
    <style type="text/css">
        a:link, a:visited, a:active {
            text-decoration:none;
        }
    </style>

</head>
    
<body style="background-color: lightgrey; text-align: center">

    <h1 style="text-align: center; background-color: #EDEBE8; padding-top: 10px">Detalles del Banner</h1>
    <a href="B2-banner.php" style="font-size: 20px; color: blue;">Regresar a listado</a>
    
    
    <table style="border: solid 1px; width: 50%; margin: auto; background-color:#F4F0DE; margin-top: 70px;">
        <tr style="height: 50px;">
            <td style="text-align: center; font-size: 30px; border: solid 1px">Nombre del banner</td>
            <td style="text-align: center; font-size: 30px; border: solid 1px">Foto</td>
        </tr>

        <?php
            
            
            $id=$_REQUEST['id'];
            $con=conect();

            $sql="SELECT * FROM banners
                WHERE id=$id";

            $res=$con->query($sql);

        while($row=$res->fetch_array()){
            $nombre=$row["nombre"];
            $fotoEnc=$row["archivo"];
        }

        $foto="archivos/".$fotoEnc;
        echo "<tr>
            
            <td style='text-align: center; border: solid 1px; font-size: 25px'>$nombre</td>
            <td style='text-align: center; border: solid 1px;'><img src=$foto style='max-width: 100px'></td>
            
            </td>
            
            </tr>";
        
       ?>

    </table>

</body>



</html>