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

    <title>Edición de Banners</title>
    <script src="js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="css/estilos-B5-banner.css">
    
    <script>
        

        function regresar(){
            $('#mensaje').html('');
        }

        function validarDatos(){
            var nombre= document.forma01.nombre.value;
            var id=document.forma01.id.value;
            var archivo=document.forma01.archivo.value;  
            
            if(nombre){
                document.forma01.method='post';
                document.forma01.action='Funciones/editar-banner.php';
                document.forma01.submit();
            }else{
                $('#mensaje').html("Faltan campos por llenar.");
                setTimeout("regresar()",3500); 
            }

        }

    </script>

</head>

<body>

    <?php 

        $id=$_REQUEST['id'];
        $con=conect();

        $sql="SELECT * FROM banners
            WHERE id=$id";

        $res=$con->query($sql);

        while($row=$res->fetch_array()){
            $nombre=$row["nombre"];
        }
        
    ?>

        <h1 style="padding-top: 10px;">Edición de Banners</h1>
            <div><a href="B2-banner.php" id="regresar">Regresar a listado</a></div>
        
        <br>
        <br>
<fieldset>
    <legend>Editar</legend>
    <form name="forma01" enctype="multipart/form-data">

        <label>Nombre: </label>
        <input id="nombre" type="text" name="nombre" value="<?php echo "$nombre"; ?>">
        <input id="id" type="hidden" name="id" value="<?php echo "$id"; ?>">
        <br>
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

