<?php
   include "menu-user.php"; require "Funciones/lista_prods.php";
   if(isset($_SESSION['correoC'])){
        $nombreC=$_SESSION['nombreC'];
   }
?>

<html>
    <head>
        <title>Purificadora FORTUNA</title>
        <link rel="stylesheet" href="css/estilos-welcome.css">
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
                                setTimeout("$('#mensaje_"+id+"').html('');", 3000);
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

        <div id="banner" style="margin-top: 0px;">
            <img class="img-banner" src="banners/1" alt="banner">
            <img class="img-banner" src="banners/2" alt="banner">
        </div>

        <div class="prods">
            <?php

                for($i=1;$i<5;$i++){
                    $idP=$i;
                }
    
                $sql="SELECT DISTINCT * FROM productos
                WHERE status=1 AND eliminado=0
                ORDER BY rand() LIMIT 4";

                $res=$con->query($sql);
                $cont=0;
      
                while($row=$res->fetch_array()){
                    $id=$row["id"];
                    $nombre=$row["nombre"];
                    $precio=$row["costo"];
                    $descrip=$row["descripcion"];
                    $fotoEnc=$row["archivo_n"];

                    $foto="archivos/".$fotoEnc;
            ?>

            <div class="producto">
            <div class="producto-imagen"><a href="detallesProd.php?id=<?php echo $id?>"><img class="img" src="<?php echo $foto?>" alt="prod"></a></div>
                <?php echo $nombre;?> <br>
                $<?php echo $precio ?> <br>
                <?php echo $descrip ?> <br>
                <select name="producto_<?php echo $id;?>" id="producto_<?php echo $id;?>">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>

                <input type="submit" id="boton" onclick="agregar(<?php echo $id ?>); return false;" value="Agregar">
                <br>

                <div class="mensaje" id="mensaje_<?php echo $id ?>"></div>
            </div>

            <?php
                }
            
            ?>
        </div>
            
            <div class="footer">
                <a href="facebook.com" class="social"><i class="fab fa-facebook-square">Facebook</i></a>
                <a href="twitter.com" class="social"><i class="fab fa-twitter-square">Twitter</i></a>
                <p class="copy"><i class="fas fa-copyright"></i> Saúl Calan Sánchez</p>
            </div>

            <script>
               
                var slideIndex = 0;
                banneres();

                function banneres() {
                    var i;
                    var slides = document.getElementsByClassName("img-banner");
                    for (i = 0; i < slides.length; i++) {
                        slides[i].style.display = "none";
                    }
                    slideIndex++;
                    if (slideIndex > slides.length) {slideIndex = 1}
                    slides[slideIndex-1].style.display = "block";
                    setTimeout(banneres, 1500);
                }
            
            </script>

    </body>
    
</html>