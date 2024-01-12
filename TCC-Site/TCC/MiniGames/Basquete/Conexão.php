<?php
define('HOST','localhost:3307');
define('USER','root');
define('PASSWORD','');
define('BD','tcc');

$conn = new mysqli(HOST,USER,PASSWORD, BD);


// Verifique a conexão
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}else{

}

?>