<?php 

    require "Funciones/lista_admins.php"; include "menu-user.php"; 

    //session_start();
    
    if(!isset($_SESSION['correoC'])){
        echo " 
            <script>
                window.location='index.php';
            </script>";   
              
    }
?>
<html>

<head>

    <title>Carrito</title>
    
    <script src="js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="css/estilos-carrito.css">
    
    <script>
        function eliminarFilas(x){
            if(confirm("Seguro de eliminar el registro?")){
                $.ajax({
                url: 'Funciones/elimina_carrito.php',
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
        
        function finaliza(x){
            var address = $('#address:checked').val();
            var diffAddress=document.form.diffAddress.value;
            
            if(confirm("Seguro de que lleva todo lo que quiere?")){
                $.ajax({
                url: 'Funciones/actualiza_carrito.php',
                type: 'post',
                dataType: 'text',
                data: 'id='+x+'&direccion='+address+'&direc='+diffAddress,
                success: function(res){
                    alert(res);
                    
                    if(res==1){
                        $('#finale').html('Pedido realizado con exito!');
                        setTimeout("window.location.href = 'index.php';", 3500);
                        
                    }else{
                        alert("error");
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

    <h1 style="padding-top: 10px;">Carrito de compra</h1>
        <div id="finale"></div>
    <table class="tabla">
        <tr>
            <td>&nbsp&nbspProducto&nbsp&nbsp</td>
            <td>Costo</td>
            <td style='max-width: 65px;'>Cantidad</td>
            <td>Subtotal</td>
        </tr>

        <?php
        
            $total=0;
            $usuario=$_SESSION['nombreC'];
            $con=conect();

            $address="SELECT * FROM clientes
            WHERE nombre='$usuario'";

            $calle=$con->query($address);

            while($row=$calle->fetch_array()){
                $direccion=$row["direccion"];
            }

            $obtener="SELECT * FROM pedidos
            WHERE usuario='$usuario'";

            $res=$con->query($obtener);

            while($row=$res->fetch_array()){
                $pedido=$row["id"];
            }

            $stmt="SELECT * FROM pedidos_productos
                WHERE id_pedido=$pedido";

            $a=$con->query($stmt);

            while($row=$a->fetch_array()){
                $id=$row["id"];
                $id_pedido=$row["id_pedido"];
                $id_prod=$row["id_prod"];
            }

            $sql="SELECT * FROM pedidos_productos
                WHERE id_pedido=$pedido";

            $res=$con->query($sql);

        while($row=$res->fetch_array()){
            $id=$row["id"];
            $id_pedido=$row["id_pedido"];
            $id_prod=$row["id_prod"];
            $cantidad=$row["cantidad"];
            $precio=$row["precio"];

            $subtotal=$cantidad*$precio;
            $total+=$subtotal;

            $query="SELECT * FROM productos
                WHERE id=$id_prod";

            $b=$con->query($query);

            while($row=$b->fetch_array()){
                $nombre=$row["nombre"];
            }

            echo "<tr id=\"row$cont\">
            
            <td class='datos'>$nombre</td>
            <td class='datos'> $precio</td>
            
            <td class='datos'>$cantidad</td>
            

            <td class='datos'> $subtotal</td>
            
            </tr>";
            $cont++;
        }
       ?>

        <?php
        
            echo     "<table style=' width: 50%; margin: auto; background-color:#62C1E6; margin-top: 5px;'>
                        <tr style='height: 50px;'>

                            <td class='no' style='text-align: center; font-size: 25px;'><b>Gran total</b></td>
                            <td class='no' style='text-align: center; font-size: 25px;'><b>$$total mxn.</b></td>
                        </tr>
                    </table>";
        
       ?>  
    </table>
    <form name="form">
        <label><input type="checkbox" id="address" name="address" value="1">Usar la dirección de mi perfil</label><br>
        <input type="text" name="diffAddress" id="diffAddress">
        <br>
    </form>

    <input id="finalizar" type="submit" value="Finalizar" onclick="finaliza();  return false;">
    

    <div class="footer">
            <p class="copy"><i class="fas fa-copyright"></i> Saúl Calan Sánchez</p>
            <a href="facebook.com" class="social" style="margin-left: 100px;"><i class="fab fa-facebook-square">Facebook</i></a>
            <a href="twitter.com" class="social"><i class="fab fa-twitter-square">Twitter</i></a>         
        </div>
</body>



</html>