<?php
    session_start();
    if(isset($_SESSION['correoC'])){
        echo "<style>
            .hide{
                display: none;
            }
        </style>";
    }
    if(!isset($_SESSION['correoC'])){
        echo "<style>
            .cerrar{
                display: none;
            }
        </style>";
    }
    /*AGUA*/
?>

<html>
    <head>
        
        <script src="https://kit.fontawesome.com/075f7bd8d2.js" crossorigin="anonymous"></script>

        <script>
            function cerrar(){
                if(confirm("¿Seguro que quieres salir?")){
                    if(confirm("Quieres que se cierre la orden de compra?")){
                        window.location.href = 'cerrar_sesion-cliente.php';
                    }else{
                        window.location.href = 'cerrar_sin-carrito.php';
                    }
                }                
            }

        </script>

        <style type="text/css">
            *{
                padding: 0px;
                margin: 0px;
            }

            #barra{
                width: 100%;
                background-color: #62C1E6;
            }

            #normal{
                list-style-type: none;
                text-align: center;
            }

            li{
                display: inline-block;
                padding: 10px;
            }

            a{
                color: #000;
            }
        </style>
    </head>

    <body> 
        <header>
            <div id="barra">
                <ul id="normal">
                    <li><a href="index.php" style="margin-left: 150px;"> <i class="fas fa-home">Inicio</i></a></li>
                    <li><a href="productos.php"><i class="fab fa-product-hunt"><b> Productos</b></i></a></li>
                    <li><a href="contacto.php"> <i class="fas fa-question-circle">Contacto</i></a></li>
                    <li class="hide"><a href="ingreso.php"> <i class="fas fa-sign-in-alt">Login</i></a></li>
                    <li class="hide"><a href="registro.php"> <i class="fas fa-registered">Registrarse</i></a></li>
                    <li class="cerrar"><a href="editUser.php"><i class="fas fa-user">Perfil</i></a></li>
                    <li class="cerrar"><a href="javascript:void(0);" onclick="cerrar();"><i class="fas fa-times-circle">Cerrar Sesión</i></a></li>
                    <li class="cerrar"><a href="carrito.php" style="margin-left: 430px;"><i class="fas fa-shopping-cart"></i></a></li>
                </ul>
            </div>
        </header>
    </body>
    
</html>


