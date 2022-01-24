<?php 

    require "Funciones/lista_admins.php"; include "menu.php"; 

    session_start();
    
    if(!isset($_SESSION['correo'])){
        echo " 
            <script>
                window.location='login.php';
            </script>";   
              
    }
?>
<html>

<head>

    <title>Lista de administradores</title>
    
    <script src="js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="css/estilos-B2-admin.css">
    
    <script>
        function eliminarFilas(x){
            if(confirm("Seguro de eliminar el registro?")){
                $.ajax({
                url: 'Funciones/elimina_admin.php',
                type: 'post',
                dataType: 'text',
                data: 'id='+x,
                success: function(res){
                    alert(res);
                    if(res==1){
                        
                        $('#row'+x).hide();
                    }
                }, error: function(){
                    alert("Error, archivo no encontrado");
                }
            });
            }
        }

    </script>

</head>
    
<body>

    <h1 style="padding-top: 10px;">Listado de Administradores</h1>
    <div id="nuevo" style="width: 220px; margin: auto;"><a href="B3-admin.php"><p style="padding: 20px;">Crear nuevo registro</p></a></div>
    
    <table>
        <tr>
            <td>&nbsp&nbspId &nbsp&nbsp</td>
            <td>Nombre completo</td>
            <td>Correo</td>
            <td>Rol</td>
            <td>Eliminar</td>
            <td>Detalles</td>
            <td>Editar</td>
        </tr>

        <?php
        
            $sql="SELECT * FROM admins
                WHERE status=1 AND eliminado=0";

            $res=$con->query($sql);
            $cont=0;
            
            while($row=$res->fetch_array()){
                $id=$row["id"];
                $nombre=$row["nombre"];
                $apellidos=$row["apellidos"];
                $correo=$row["correo"];
                $rol=$row["rol"];
                $rol_txt=($rol==1)?'Dueño':'Administrador';
            
        

        
            echo "<tr id=\"row$cont\">
            
            <td class='datos'>$id</td>
            <td class='datos'> $nombre $apellidos</td>

            <td class='datos'>$correo</td>

            <td class='datos'> $rol_txt</td>
            
            <td class='datos'>
                <button onclick=\"eliminarFilas($cont);\">Eliminar admin</button>
            </td>

            <td class='datos'>
            <a href='detalles-admin.php?id=$id'><p class='link'>Ver detalles</p></a>
            </td>

            <td class='datos'>
            <a href='B5-admin.php?id=$id'><p class='link'>Editar</p></a>
            </td>
            

            </tr>";
        
            $cont++;
        }
       ?>

    </table>

</body>



</html>