<?php
    session_start();
    include_once("conexao.php");

    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];

        // Atualize a felicidade no banco de dados
        $updateQuery = "UPDATE usuario SET happiness = happiness + 1 WHERE ID = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->close();
    }
?>
