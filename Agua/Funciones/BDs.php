<?php

//  conecta con BDs
    define("HOST", 'localhost');
    define("BD", 'agua');
    define("USER_BD", 'root');
    define("PASS_BD", '');

    function conect(){
        $con= new mysqli (HOST, USER_BD, PASS_BD, BD);
        return $con;
    }

?>