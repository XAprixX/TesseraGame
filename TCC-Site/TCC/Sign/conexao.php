<?php
    define('HOST', 'localhost:3307');
    define('USER', 'root');
    define('PASSWORD', '');
    define('BD', 'tcc');

    $conn = new mysqli(HOST, USER, PASSWORD, BD);
    if($conn->connect_error){
        die("Falha na conexão" . $conn->connect_error);
    }else{
        //echo('conexão realizada com sucesso');
    }
?>