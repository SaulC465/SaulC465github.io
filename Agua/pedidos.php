<?php 

    require "Funciones/lista_pedido.php"; include "menu.php"; 

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

    <title>Lista de pedidos</title>
    
    <script src="js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="css/pedido.css">
    
    <script>
        function eliminarFilas(x){
            if(confirm("Seguro de eliminar el registro?")){
                $.ajax({
                url: 'Funciones/elimina_admin.php',
                type: 'post',
                dataType: 'text',
                data: 'ID='+x,
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

    <h1 style="padding-top: 10px;">Listado de Pedidos</h1>
    
    <table style="margin-top: 70px;">
        <tr>
            <td id="col"><b>&nbsp&nbspId cliente &nbsp&nbsp</b></td>
            <td><b>Fecha</b></td>
            <td><b>Status</b></td>
            <td><b>Detalles</b></td>
        </tr>

        <?php
        
            $sql="SELECT * FROM pedidos
                  WHERE status=1";

            $res=$con->query($sql);
            $cont=0;
            
            while($row=$res->fetch_array()){
                $id=$row["id"];
                $fecha=$row["fecha"];
                $status=$row["status"];
                $status_txt=($status==1)?'Cerrado':'Activo';
        
            echo "<tr id=\"row$cont\">
            
            <td class='datos'>$id</td>
            <td class='datos'> $fecha</td>

            <td class='datos'>$status_txt</td>

            
            <td class='datos'>
            <a href='detalles-pedido.php?id=$id'><p class='link'>Ver detalles</p></a>
            </td>          

            </tr>";
        
            $cont++;
        }
       ?>

    </table>

</body>



</html>