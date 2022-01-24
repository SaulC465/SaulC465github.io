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

    
    <title>Alta de productos</title>
    <script src="js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="css/estilos-B3-prods.css">

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
          

            if(nombre && codigo && descrip && costo && stock && archivo){
                $.ajax({
                    url: 'Funciones/validarCodigo-prods.php',
                    type: 'post',
                    dataType: 'text',
                    data: 'codigo='+codigo,
                    success: function(res){
                        if(res==1){
                            
                            $('#error').html('Código duplicado');
                            setTimeout("$('#error').html('');",3000);
                        }else{
                            document.forma01.method='post';
                            document.forma01.action='Funciones/salva-prods.php';
                            document.forma01.submit();
                        }
                    }, error: function(){
                        alert("Error, archivo no encontrado.");
                    }
                });
            }else{
                $('#mensaje').html("Faltan campos por llenar.");
                setTimeout("regresar()",5000);
            }

        }

    </script>

</head>

<body>
        <h1 style="padding-top: 10px;">Alta de productos</h1>
        <div><a href="B2-prods.php" id="regresar">Regresar a listado</a></div>
        
        <br>
        <br>
<fieldset>
    <legend>Nuevo producto</legend>
    <form name="forma01" enctype="multipart/form-data">

        <label>Nombre: </label>
        <input id="nombre" type="text" name="nombre" autocomplete="off" placeholder="Escribe el nombre">
        <br>

        <label>Código: </label>
        <input id="codigo" type="text" name="codigo" autocomplete="off" placeholder="Escribe el código">
        <br>

        <label>Descripción:</label>
        <input type="text" name="descrip" id="descrip" autocomplete="off" placeholder="Smartphone"></div>
        <br>

        <label>Costo:</label>
            <input type="text" name="costo" id="costo" autocomplete="off" placeholder="$9999">
        <br>

        <label>Stock:</label>
            <input type="text" name="stock" autocomplete="off" id="stock" placeholder="999">
        <br>

        <label for="archivo">Subir foto</label>
            <input type="file" id="archivo" name="archivo"  accept="image/png, .jpeg, .jpg">

            <br>
            <input id="boton" type="submit" value="Guardar" onclick="validarDatos();  return false;">

            <div id="mensaje"></div>
            <div id="error"></div>
    </form>
    </fieldset>
</body>


</html>

