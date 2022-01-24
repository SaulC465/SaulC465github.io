<?php
    session_start();
    if(isset($_SESSION['correo'])){
               
        header("Location: B2-admin.php");
        
        die();
    }
?>
<html>
    <head>
        <title>Log-in</title>
        <script src="js/jquery-3.3.1.min.js"></script>
        <link rel="stylesheet" href="css/estilos-login.css">

        <script>
            
            function regresar(){
                $('#mensaje').html('');
            }

            function validarDatos(){
                var user= document.form.user.value;
                var pass= document.form.pass.value;
                
                if(user && pass){
                    $.ajax({
                    url: 'Funciones/validaUsuario.php',
                    type: 'post',
                    dataType: 'text',
                    data: 'user='+user+'&pass='+pass,
                    success: function(res){
                        if(res==0){
                            $('#error').html('Usuario o contraseña incorrecta.');
                            setTimeout("$('#error').html('');",3000);
                        }else{
                            window.location.href = 'B2-admin.php';
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
        <h1><u>Log-in de administradores</u></h1>
        <fieldset>

            <form name="form">

                <label>Usuario: </label>
                <input id="user" type="text" autocomplete="off" name="user">
                <br>

                <label>Contraseña: </label>
                <input id="pass" type="password" name="pass">
                <br>

                <input type="submit" id="boton" value="Entrar" onclick="validarDatos();  return false;">
                
                <div id="mensaje"></div>
                <div id="error"></div>
            </form>
        </fieldset>

    </body>
    
</html>


