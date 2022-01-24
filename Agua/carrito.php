<?php 

    require "Funciones/lista_admins.php"; include "menu-user.php"; 

    //session_start();
    
    if(!isset($_SESSION['correoC'])){
        echo " 
            <script>
                window.location='login.php';
            </script>";   
              
    }

error_reporting(0);
?>
<html>

<head>

    <title>Carrito</title>
    
    <script src="js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="css/estilos-carrito.css">
    
    <script>
        function eliminarFilas(x, y){
            if(confirm("Seguro de eliminar el producto?")){
                $.ajax({
                url: 'Funciones/elimina_carrito.php',
                type: 'post',
                dataType: 'text',
                data: 'id='+x,
                success: function(res){
                    if(res==1){
                        $('#row'+y).hide();
                        window.location.href = 'carrito.php';
                       
                    }
                }, error: function(){
                    alert("Error, archivo no encontrado");
                }
            });
            }
        }

        function avanzar(total){
            if(total<1){
                alert("No tienes ningun producto en el carrito.");
            }else{
                window.location.href = 'carrito2.php';
            }
        }


    </script>

</head>
    
<body>

    <h1 style="padding-top: 10px;">Carrito</h1>
        
    <table class="tabla">
        <tr>

            <td>&nbsp&nbspProducto &nbsp&nbsp</td>
            <td>Costo</td>
            <td style='max-width: 65px;'>Cantidad</td>
            <td>Subtotal</td>
            <td>Acción</td>
        </tr>

        <?php
            $total=0;
            $usuario=$_SESSION['nombreC'];
            $con=conect();

            $obtener="SELECT * FROM pedidos
            WHERE usuario='$usuario' AND status=0";

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

            $query="SELECT * FROM productos
                WHERE id=$id_prod";

            $b=$con->query($query);

            while($row=$b->fetch_array()){
                $nombre=$row["nombre"];
            }

            $sql="SELECT * FROM pedidos_productos
                WHERE id_pedido=$pedido";

            $res=$con->query($sql);
//
            
 //
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

            <input type='hidden' class='pid' value=$id>
            <td class='datos'>$nombre</td>
            <td class='datos'> $precio</td>
            <input type='hidden' class='Pprecio' value=$precio>
            <td class='datos'><input class='cantidad' type='number' style='max-width: 50px; text-align: center' min=1 name='cantidad' id='cantidad' value=$cantidad></td>
            

            <td class='datos'> $subtotal</td>
            
            <td class='datos'>
                <button onclick=\"eliminarFilas($id, $cont);\">Eliminar producto</button>
            </td>

            </tr>";
            $cont++;
        }
        ?> 
        <?php

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
    <?php
    echo "<input id='continuar' type='submit' value='Continuar' onclick='avanzar($total);  return false;'>";
    ?>

        <script>
            $(document).ready(function(){
                $(".cantidad").on("change", function(){
                    var $x=$(this).closest("tr");
                    var pid=$x.find(".pid").val();
                    var pprecio=$x.find(".Pprecio").val();
                    var canti=$x.find(".cantidad").val();

                    $.ajax({
                        url: "Funciones/actualiza_precio.php",
                        type: "post",
                        data: {canti:canti, pid:pid, pprecio:pprecio},
                        success: function(res){
                            if(res==1){
                                window.location.href = 'carrito.php';
                            }
                        }, error: function(){
                            alert("Error, archivo no encontrado");
                        }

                    });
                });
            });
        </script>
        
        <div class="footer">
            <p class="copy"><i class="fas fa-copyright"></i> Saúl Calan Sánchez</p>
            <a href="facebook.com" class="social" style="margin-left: 100px;"><i class="fab fa-facebook-square">Facebook</i></a>
            <a href="twitter.com" class="social"><i class="fab fa-twitter-square">Twitter</i></a>         
        </div>
</body>



</html>