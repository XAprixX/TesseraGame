<?php
session_start();
include_once("conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['userId']) && isset($_GET['novoMoney'])) {
        $userId = $_GET['userId'];
        $novoMoney = $_GET['novoMoney'];

        // Atualizar o valor de 'money' no banco de dados usando uma declaração preparada
        $atualizarMoneyQuery = "UPDATE usuario SET money = money + ? WHERE ID = ?";
        $stmt = $conn->prepare($atualizarMoneyQuery);
        $stmt->bind_param("ii", $novoMoney, $userId);
        $stmt->execute();

        // Exemplo de resposta para o JavaScript indicando o sucesso da atualização
        echo "Atualização bem-sucedida";
    } else {
        // Tratar caso os parâmetros não estejam presentes na requisição POST
        echo "Parâmetros ausentes";
    }
} else {
    // Tratar caso a requisição não seja do tipo POST
    echo "Requisição inválida";
}
?>