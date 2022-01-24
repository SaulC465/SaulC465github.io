<?php
    include "menu-user.php";
?>
<html>
    <head>
        <title>Log-in</title>
        <script src="js/jquery-3.3.1.min.js"></script>
        <link rel="stylesheet" href="css/estilos-ingreso.css">

        <script>

            function regresar(){
                $('#mensaje').html('');
            }

            function validarDatos(){
                var user= document.form.user.value;
                var pass= document.form.pass.value;
                
                if(user && pass){
                    $.ajax({
                    url: 'Funciones/validaCliente.php',
                    type: 'post',
                    dataType: 'text',
                    data: 'user='+user+'&pass='+pass,
                    success: function(res){
                        if(res==0){
                            $('#error').html('Usuario o contraseña incorrecta.');
                            setTimeout("$('#error').html('');",3000);
                        }else{
                            window.location.href = 'index.php';
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
        <h1 id="bienvenida"><u><i>Ingresa a tu cuenta!</i></u></h1>
        <a id="a" href="registro.php"><p class="link">Crea una cuenta</p></a>

        <fieldset style="margin-top: 100px;">
            <legend>Log-in</legend>

            <form name="form">

                <label>Usuario: </label>
                <input id="user" type="text" autocomplete="off" name="user"  placeholder="Ingresa tu correo">
                <br>

                <label>Contraseña: </label>
                <input id="pass" type="password" name="pass" placeholder="Ingresa tu contraseña">
                <br>

                <input type="submit" id="boton" value="Entrar" onclick="validarDatos();  return false;">
                
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


