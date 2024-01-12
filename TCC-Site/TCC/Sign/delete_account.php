<?php

include_once("conexao.php");

if (isset($_GET['id'])) {
    $userIdToDelete = $_GET['id'];

    // Sua lógica para conexão com o banco de dados e exclusão do usuário
    $sql = "DELETE FROM usuario WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die('Erro na preparação da consulta: ' . $conexao->error);
    }

    $stmt->bind_param('i', $userIdToDelete);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "A conta foi excluída com sucesso.";
        header('Location: Login.php');
    } else {
        echo "Erro ao excluir a conta.";
    }

    $stmt->close();
} else {
    // Redireciona para a página de login se o ID do usuário não estiver definido
    header('Location: Login.php');
    exit();
}
?>
