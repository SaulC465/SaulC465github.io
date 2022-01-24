<?php 
    include "menu.php"; 
    
    session_start();
    if(!isset($_SESSION['correo'])){
               
        header("Location: login.php");
        session_destroy();
        die();
    }    
?>
<html>
<head>

    <title>Alta de Banners</title>
    <script src="js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="css/estilos-B3-banner.css">

    <script>
        
        function regresar(){
            $('#mensaje').html('');
        }

        function validarDatos(){
            var nombre= document.forma01.nombre.value;
            var archivo=document.forma01.archivo.value;

            if(nombre && archivo){
                document.forma01.method='post';
                document.forma01.action='Funciones/salva-banner.php';
                document.forma01.submit();
            }else{
                $('#mensaje').html("Faltan campos por llenar.");
                setTimeout("regresar()",3500); 
            }

        }

    </script>

</head>

<body>
        <h1 style="padding-top: 10px;">Alta de Banners</h1>
        <div><a href="B2-banner.php" id="regresar">Regresar a listado</a></div>
        
        <br>
        <br>
<fieldset>
    <legend>Nuevo banner</legend>
    <form name="forma01" enctype="multipart/form-data">

        <label>Nombre: </label>
        <input id="nombre" type="text" name="nombre" autocomplete="off" placeholder="Nombre del banner">
        <br>
        <br>
        <label for="archivo">Subir foto</label>
            <input type="file" id="archivo" name="archivo"  accept="image/png, .jpeg, .jpg">
            <p id="size">(200px x 600px)</p>
            
            <input id="boton" type="submit" value="Guardar" onclick="validarDatos();  return false;">

            <div id="mensaje"></div>
            <div id="error"></div>
    </form>
    </fieldset>
</body>


</html>

