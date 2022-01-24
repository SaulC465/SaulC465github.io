<?php
    include "menu-user.php";

?>
<html>
    <head>
        <title>Registro</title>
        <script src="js/jquery-3.3.1.min.js"></script>
        <link rel="stylesheet" href="css/estilos-ingreso.css">

        <script>
            
            function regresar(){
                $('#mensaje').html('');
            }

            function validarDatos(){
                var nombre= document.form.nombre.value;
                var apellido= document.form.apellido.value;
                var user= document.form.user.value;
                var pass= document.form.pass.value;
                var address=document.form.address.value;
                
                if(nombre && apellido && user && pass){
                    $.ajax({
                    url: 'Funciones/validarCorreo-cliente.php',
                    type: 'post',
                    dataType: 'text',
                    data: 'user='+user,
                    success: function(res){
                        if(res==1){
                            $('#error').html('El correo '+correo+ ' está duplicado.');
                            setTimeout("$('#error').html('');",3000);
                        }else{
                            document.form.method='post';
                            document.form.action='Funciones/salva-cliente.php';
                            document.form.submit();
                            
                        }
                    }, error: function(){
                        alert("Error, archivo no encontrado.");
                    }
                });
                
                
            }else{
                $('#mensaje').html("Faltan campos por llenar.");
                setTimeout("regresar()",3000);
                
            }
            }

        </script>

    </head>

    <body>

        <header><img src="archivos/garra.png" alt="logo" id="logo"><img src="archivos/garra.png" alt="logo2" id="logo2"></header>
        <h1 id="bienvenida"><u><i>&nbspRegistrate!</i></u></h1>

        <fieldset class="registro" style="margin-top: 100px;">
           
            <form name="form">

            <label>Nombre: </label>
                <input id="nombre" type="text" autocomplete="off" name="nombre" placeholder="Fulanito">
                <br>
                
            <label>Apellidos: </label>
                <input id="apellido" type="text" autocomplete="off" name="apellido" placeholder="Pérez">
            <br>
            
            <label>Correo: </label>
                <input id="user" type="text" autocomplete="off" name="user" placeholder="fulanito@perez.com">
                <br>

            <label>Dirección de envío: </label>
                <input id="address" type="text" autocomplete="off" name="address" placeholder="Calle #1, Col colonia">
                <br>

            <label>Contraseña: </label>
                <input id="pass" type="password" name="pass" placeholder="Crea tu contraseña">
            <br>

                <input type="submit" id="boton" value="Registrar" onclick="validarDatos();  return false;">
                
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


