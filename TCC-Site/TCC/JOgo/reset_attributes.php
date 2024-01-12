<?php
include_once("Conexão.php");
session_start();

// Verifique se o método de requisição é POST

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['user_id'])) {
    // Obtenha o ID do usuário a ser atualizado
    $userId = $_SESSION['user_id'];

    // Defina os novos valores para os atributos
    $hunger = 100;
    $happiness = 100;
    $wisdom = 0;
    $money = 0;
    $job = 'Desempregado';

    // Atualize os atributos no banco de dados
    $sqlUpdate = "UPDATE usuario SET hunger = ?, happiness = ?, wisdom = ?, money = ?, Job = ? WHERE ID = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("iiissi", $hunger, $happiness, $wisdom, $money, $job, $userId);

    if ($stmtUpdate->execute()) {
        // Atualização bem-sucedida
        echo "Atributos resetados com sucesso!";
    } else {
        // Tratar erros, se houver
        echo "Erro ao resetar atributos: " . $stmtUpdate->error;
    }

    $stmtUpdate->close();
}
} else {
    // Se a requisição não for POST, retorne um erro
    http_response_code(400);
    echo "Erro: Método de requisição inválido.";
}
?>
