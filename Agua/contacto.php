<?php 
    include "menu-user.php"; 
      
?>
<html>
<head>

    <title>Contacto</title>
    <script src="js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="css/estilos-contact.css">

    <script>
        
        function regresar(){
            $('#mensaje').html('');
        }

        function validarDatos(){
            var nombre= document.forma01.nombre.value;
            var coment= document.forma01.coment.value;
            var correo= document.forma01.correo.value;             


            if(nombre && coment && correo){
                document.forma01.method='post';
                document.forma01.action='Funciones/envia-mail.php';
                document.forma01.submit();
            }else{
                
                $('#mensaje').html("Faltan campos por llenar.");
                setTimeout("regresar()",5000); 
            }
        }

    </script>

</head>

<body>

<header><img src="archivos/garra.png" alt="logo" id="logo"><img src="archivos/garra.png" alt="logo2" id="logo2"></header>
        <h1 style="padding-top: 10px;"><u><i>Contactanos!</i></u></h1>    
        <br>
        <br>
    <fieldset>
        <form name="forma01" enctype="multipart/form-data">

            <label>Nombre: </label>
            <input id="nombre" type="text" name="nombre" autocomplete="off" placeholder="Escribe tu nombre">
            <br>

            <label>Correo:</label>
            <input type="email" name="correo" id="correo" autocomplete="off" placeholder="fulanito@mail.com"></div>
            <br>

            <label><p style="padding-top: 5px;">Comentarios:</p> </label>
            <textarea name="coment" id="coment" cols="30" rows="4" autocomplete="off" placeholder="Comentarios..." maxlength="100"></textarea>
            <br>

            <input id="boton" type="submit" value="Enviar" onclick="validarDatos();  return false;">

                <div id="mensaje"></div>
                <div id="error"></div>
        </form>
    </fieldset>

    <div class="footer">
                <a href="facebook.com" class="social"><i class="fab fa-facebook-square">Facebook</i></a>
                <a href="twitter.com" class="social"><i class="fab fa-twitter-square">Twitter</i></a>
                <p class="copy"><i class="fas fa-copyright"></i> Saúl Calan Sánchez</p>
            </div>
</body>


</html>

