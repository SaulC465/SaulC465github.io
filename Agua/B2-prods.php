<?php 

    require "Funciones/lista_prods.php"; include "menu.php"; 

    session_start();
    if(!isset($_SESSION['correo'])){
        echo " 
            <script>
                window.location='login.php';
            </script>";        
    }

?>
<html>

<head>

    <title>Lista de productos</title>
    
    <script src="js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="css/estilos-B2-prods.css">
    
    <script>
        function eliminarFilas(x){
            if(confirm("Seguro de eliminar el registro?")){
                $.ajax({
                url: 'Funciones/elimina_prods.php',
                type: 'post',
                dataType: 'text',
                data: 'id='+x,
                success: function(res){
                    if(res==1){
                        $('#row'+x).hide();
                    }
                }, error: function(){
                    alert("Error, archivo no encontrado");
                }
            });
            }
        }

    </script>

</head>
    
<body>

    <h1 style="padding-top: 10px;">Listado de productos</h1>
    <div id="nuevo" style="width: 220px; margin: auto;"><a href="B3-prods.php"><p style="padding: 20px;">Crear nuevo registro</p></a></div>
    
    <table>
        <tr>
            <td>&nbsp&nbspId &nbsp&nbsp</td>
            <td>Nombre</td>
            <td>Código</td>
            <td>Costo</td>
            <td>Eliminar</td>
            <td>Detalles</td>
            <td>Editar</td>
        </tr>

        <?php
        
            $sql="SELECT * FROM productos
                WHERE status=1 AND eliminado=0";

            $res=$con->query($sql);
            $cont=0;
            
            while($row=$res->fetch_array()){
                $id=$row["id"];
                $nombre=$row["nombre"];
                $codigo=$row["codigo"];
                $descripcion=$row["descripcion"];
                $costo=$row["costo"];          
        
            echo "<tr id=\"row$cont\">
            
            <td class='datos'>$id</td>
            <td class='datos'> $nombre</td>

            <td class='datos'>$codigo </td>

            <td class='datos'> $costo</td>
            
            <td class='datos'>
                <button onclick=\"eliminarFilas($cont);\">Eliminar producto</button>
            </td>

            <td class='datos'>
            <a href='Funciones/detalles-prods.php?id=$id'><p class='link'>Ver detalles</p></a>
            </td>

            <td class='datos'>
            <a href='B5-prods.php?id=$id'><p class='link'>Editar</p></a>
            </td>
            

            </tr>";
        
            $cont++;
        }
       ?>

    </table>

</body>



</html>