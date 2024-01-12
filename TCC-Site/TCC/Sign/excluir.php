<?php
    include_once("conexao.php");

    if(isset($_GET["ID"])){
        $id = $_GET["ID"];
        $sql = "DELETE FROM usuario where ID = $id";

        if($conn->query($sql) === true){
            ?>
            <script>
                alert("Operação concluída.")
                window.location = "listar.php";
            </script>
            <?php
        }
    }
?>