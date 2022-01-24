<?php 
    require "lista_prods.php"; include "../menu.php";

    session_start();
    if(!isset($_SESSION['correo'])){
               
        header("Location: ../login.php");
        session_destroy();
        die();
    }

?>

<html>

<head>

    <title>Detalles del producto</title>
    <script src="js/jquery-3.3.1.min.js"></script>
    <style type="text/css">
        a:link, a:visited, a:active {
            text-decoration:none;
        }
    </style>

</head>
    
<body style="background-color: lightgrey; text-align: center">

    <h1 style="text-align: center; background-color: #EDEBE8; padding-top: 10px">Detalles del Producto</h1>
    <a href="../B2-prods.php" style="font-size: 20px; color: blue;">Regresar a listado</a>
    
    
    <table style="border: solid 1px; width: 50%; margin: auto; background-color:#F4F0DE; margin-top: 70px;">
        <tr style="height: 50px;">
            <td style="text-align: center; font-size: 30px; border: solid 1px">Nombre</td>
            <td style="text-align: center; font-size: 30px; border: solid 1px">Código</td>
            <td style="text-align: center; font-size: 30px; border: solid 1px">Descripción</td>
            <td style="text-align: center; font-size: 30px; border: solid 1px">Status</td>
            <td style="text-align: center; font-size: 30px; border: solid 1px">Stock</td>
            <td style="text-align: center; font-size: 30px; border: solid 1px">Foto</td>
        </tr>

        <?php
            
            
            $id=$_REQUEST['id'];
            $con=conect();

            $sql="SELECT * FROM productos
                WHERE id=$id";

            $res=$con->query($sql);

        while($row=$res->fetch_array()){
            $id=$row["id"];
            $nombre=$row["nombre"];
            $codigo=$row["codigo"];
            $descripcion=$row["descripcion"];
            $status=$row["status"];
            $fotoEnc=$row["archivo"];
            $stock=$row["stock"];
            $status_txt=($status==1)?'Activo':'Inactivo';
        }
        $foto="archivos/".$fotoEnc;
        echo "<tr>
            
            <td style='text-align: center; border: solid 1px;'>$nombre</td>
            <td style='text-align: center; border: solid 1px;'>$codigo</td>

            <td style='text-align: center; border: solid 1px;'>$descripcion</td>

            <td style='text-align: center; border: solid 1px;'>$status_txt</td>

            <td style='text-align: center; border: solid 1px;'>$stock</td>
            
            <td style='text-align: center; border: solid 1px;'><img src=$foto style='max-width: 100px'></td>
            
            </td>
            

            </tr>";
        
        
       ?>

    </table>

</body>



</html>