<?php 
    require "Funciones/BDs.php"; include "menu-user.php";
    
    //session_start();
    if(!isset($_SESSION['correoC'])){
               
        header("Location: login.php");
        session_destroy();
        die();
    }
    
?>

<html>
<head>

    <title>Perfil</title>
    <script src="js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="css/estilos-editUser.css">
    
    <script>
        

        function regresar(){
            $('#mensaje').html('');
        }

        function validarDatos(){
            var nombre= document.forma01.nombre.value;
            var apellidos= document.forma01.apellidos.value;
            var correo= document.forma01.correo.value;         
            var rol= document.forma01.rol.value;
            var id=document.forma01.id.value;

            var archivo=document.forma01.archivo.value;
            var pass= document.forma01.pass.value;   
            

            $.ajax({
                url: 'Funciones/validarCorreo-admin.php',
                type: 'post',
                dataType: 'text',
                data: 'correo='+correo+'&id='+id,
                success: function(res){
                    if(res==1){
                        
                        $('#error').html('El correo '+correo+ ' está duplicado.');
                        setTimeout("$('#error').html('');",5000);
                    }else{
                        if(nombre && apellidos && correo && rol){
                            document.forma01.method='post';
                            document.forma01.action='Funciones/editar-admin.php';
                            document.forma01.submit();
                        }else{
                            
                            $('#mensaje').html("Faltan campos por llenar.");
                            setTimeout("regresar()",5000);
                            
                        }
                    }
                }, error: function(){
                    alert("Error, archivo no encontrado.");
                }
            });
        }

    </script>

</head>

<body>

    <?php 

        $id=$_SESSION['idC'];
        $con=conect();

        $sql="SELECT * FROM clientes
            WHERE ID=$id";

        $res=$con->query($sql);

        while($row=$res->fetch_array()){
            $nombre=$row["nombre"];
            $apellidos=$row["apellidos"];
            $correo=$row["correo"];
            $direc=$row["direccion"];
            $status=$row["status"];
        }
        
    ?>

        <h1 style="padding-top: 10px;">Edición de perfil</h1>
            
        <br>
        <br>
<fieldset>
    <legend>Editar</legend>
    <form name="forma01" enctype="multipart/form-data">

        <label>Nombre: </label>
            <input id="nombre" type="text" name="nombre" value="<?php echo "$nombre"; ?>">
            <input id="id" type="hidden" name="id" value="<?php echo "$id"; ?>">
            <br>

        <label>Apellidos: </label>
            <input id="apellidos" type="text" name="apellidos"value="<?php echo "$apellidos"; ?>">
            <br>

        <label>Correo:</label>
            <input type="email" name="correo" id="correo" value="<?php echo "$correo"; ?>">
            <br>

        <label for="pasw">Contraseña:</label>
            <input type="text" name="pass" id="pass">
            <br>

        <label for="rol">Dirección:</label>
            <input type="text" name="direc" id="direc" value="<?php echo "$direc"; ?>">
                <br>
                <br>
            <input type="submit" class="boton" value="Guardar" onclick="validarDatos();  return false;">

            <div id="mensaje"></div>
            <div id="error"></div>
    </form>
    </fieldset>
</body>


</html>

