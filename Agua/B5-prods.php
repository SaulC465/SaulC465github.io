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

    <title>Edición de productos</title>
    <script src="js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="css/estilos-B5-prods.css">
    
    <script>
        
        function regresar(){
            $('#mensaje').html('');
        }

        function validarDatos(){
            var nombre= document.forma01.nombre.value;
            var codigo= document.forma01.codigo.value;
            var descrip= document.forma01.descrip.value;
            var costo= document.forma01.costo.value;
            var stock= document.forma01.stock.value;

            var archivo=document.forma01.archivo.value;
            var id=document.forma01.id.value;
            
            $.ajax({
                url: 'Funciones/validarProds.php',
                type: 'post',
                dataType: 'text',
                data: 'codigo='+codigo+'&id='+id,
                success: function(res){
                    if(res==1){
                        $('#error').html('El codigo '+codigo+ ' está duplicado.');
                        setTimeout("$('#error').html('');",5000);
                    }else{
                        if(nombre && descrip && codigo && costo && stock){
                            document.forma01.method='post';
                            document.forma01.action='Funciones/editar-prods.php';
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

        $sql="SELECT * FROM productos
            WHERE id=$id";

        $res=$con->query($sql);

        while($row=$res->fetch_array()){
            $nombre=$row["nombre"];
            $codigo=$row["codigo"];
            $descripcion=$row["descripcion"];
            $costo=$row["costo"];
            $stock=$row["stock"];
            
        }
        
    ?>

        <h1 style="padding-top: 10px;">Edición de productos</h1>
            <div><a href="B2-prods.php" id="regresar">Regresar a listado</a></div>
        
        <br>
        <br>
<fieldset>
    <legend>Editar</legend>
    <form name="forma01" enctype="multipart/form-data">

        <label>Nombre: </label>
        <input id="nombre" type="text" name="nombre" value="<?php echo "$nombre"; ?>">
        <input id="id" type="hidden" name="id" value="<?php echo "$id"; ?>">
        <br>

        <label>Código: </label>
        <input id="codigo" type="text" name="codigo"value="<?php echo "$codigo"; ?>">
        <br>

        <label>Descripción:</label>
        <input type="text" name="descrip" id="descrip" value="<?php echo "$descripcion"; ?>">
        <br>

        <label>Costo: </label>
        <input id="costo" type="text" name="costo" value="<?php echo "$costo"; ?>">
        <br>

        <label>Stock: </label>
        <input id="stock" type="text" name="stock" value="<?php echo "$stock"; ?>">
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

