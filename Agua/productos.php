<?php
   include "menu-user.php"; require "Funciones/lista_prods.php";

   if(isset($_SESSION['correoC'])){
    $nombreC=$_SESSION['nombreC'];
}
?>

<html>
    <head>
        <title>Productos</title>
        <link rel="stylesheet" href="css/estilos-prods.css">
        <script src="js/jquery-3.3.1.min.js"></script>
        <script>

            function agregar(id){
                var cantidad=$('#producto_'+id).val();

                if(cantidad>0){
                    $.ajax({
                        url: 'Funciones/recibeProd.php',
                        type: 'post',
                        dataType: 'text',
                        data: 'id='+id+'&cantidad='+cantidad,
                        success: function(res){
                            if(res==1){
                                $('#mensaje_'+id).html('Agregado con exito.');
                                setTimeout("$('#mensaje_"+id+"').html('');", 3500);
                            }else if(res==0){
                                $('#mensaje_'+id).html('Debes iniciar sesión.');
                                setTimeout("$('#mensaje_"+id+"').html('');", 3000);
                            }
                        }, error: function(){
                            alert("Error al conectarse...");
                        }
                    });
                }else{
                    $('#mensaje_'+id).html('Cantidad invalida.');
                    setTimeout("$('#mensaje_"+id+"').html('');", 3000);
                }
            }

            

        </script>

    </head>

    <body>
        <header><img src="archivos/garra.png" alt="logo" id="logo"><img src="archivos/garra.png" alt="logo2" id="logo2"></header>
        <h1 id="puri"><u><i>Purificadora</i></u></h1>
        <h1 id="fortu"><u> <i>FORTUNA</i></u></h1>
    
        <div class="prods">
            <?php
                                
                $sql="SELECT * FROM productos
                WHERE status=1 AND eliminado=0";
                
                $res=$con->query($sql);
                $cont=0;
                $i=1;

                while($row=$res->fetch_array()){
                    $id=$row["id"];
                    $nombre=$row["nombre"];
                    $precio=$row["costo"];
                    $descrip=$row["descripcion"];
                    $fotoEnc=$row["archivo_n"];
                    $idP=$i;

                    $foto="archivos/".$fotoEnc;
            ?>

            <div class="producto">
                <div class="producto-imagen"><a href="detallesProd.php?id=<?php echo $id?>"><img class="img" src="<?php echo $foto?>" alt="prod"></a></div>
                <?php echo $nombre?> <br>
                $<?php echo $precio ?> <br>
                <?php echo $descrip ?> <br>
                <select name="producto_<?php echo $id;?>" id="producto_<?php echo $id;?>">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>

                <input type="submit" onclick="agregar(<?php echo $id ?>); return false;" value="Agregar">
                <br>

                <div class="mensaje" id="mensaje_<?php echo $id ?>"></div>
            </div>
                <?php
                $i++;
                }
            
                ?>
        </div>
            <!--
            <div class="footer">
                <p class="copy"><i class="fas fa-copyright"></i> Saúl Calan Sánchez</p>
                <a href="facebook.com" class="social" style="margin-left: 100px;"><i class="fab fa-facebook-square">Facebook</i></a>
                <a href="twitter.com" class="social"><i class="fab fa-twitter-square">Twitter</i></a>
            </div>
            -->
            <div class="footer">
                <a href="facebook.com" class="social"><i class="fab fa-facebook-square">Facebook</i></a>
                <a href="twitter.com" class="social"><i class="fab fa-twitter-square">Twitter</i></a>
                <p class="copy"><i class="fas fa-copyright"></i> Saúl Calan Sánchez</p>
            </div>

    </body>
    
</html>