<?php 
    require "Funciones/BDs.php"; include "menu.php";
    
    session_start();
    if(!isset($_SESSION['correo'])){
               
        header("Location: login.php");
        session_destroy();
        die();
    }
    
?>

<html>
<head>

    <title>Edición de Administradores</title>
    <script src="js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="css/estilos-B5-admin.css">
    
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

        $id=$_REQUEST['id'];
        $con=conect();

        $sql="SELECT * FROM Administradores
            WHERE ID=$id";

        $res=$con->query($sql);

        while($row=$res->fetch_array()){
            $nombre=$row["Nombre"];
            $apellidos=$row["Apellidos"];
            $correo=$row["Correo"];
            $rol=$row["rol"];
            $status=$row["status"];
            $rol_txt=($rol==1)?'Gerente':'Ejecutivo';
            $status_txt=($status==1)?'Activo':'Inactivo';
        }
        
    ?>

        <h1 style="padding-top: 10px;">Edición de Administradores</h1>
            <div><a href="B2-admin.php" id="regresar">Regresar a listado</a></div>
        
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

        <label for="rol">Rol:</label>
                <select name="rol" id="rol">
                    <option value="<?php echo "$rol"; ?>" ><?php echo"$rol_txt"; ?></option>
                    
                    <option value="1">Gerente</option>
                    <option value="2">Ejecutivo</option>			
                </select>
                <br>
        
        <label for="archivo">Subir foto</label>
            <input type="file" id="archivo" name="archivo"  accept="image/png, .jpeg, .jpg">
        <br>

            <input type="submit" class="boton" value="Guardar" onclick="validarDatos();  return false;">

            <div id="mensaje"></div>
            <div id="error"></div>
    </form>
    </fieldset>
</body>


</html>

