<?php
include_once("Conexão.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
   
        // Recupere os dados do POST
        $happiness = $_POST['happiness'];
        $hunger = $_POST['hunger'];
        $wisdom = $_POST['wisdom'];
        $job = $_POST['job'];
        $money = $_POST['money'];

     
        $_SESSION['hunger'] = $hunger;
        $_SESSION['happiness'] = $happiness;
        $_SESSION['job'] = $job;
        
        // Verificando se a felicidade ultrapassou 100%
        if ($happiness >= 100) {
            // Se ultrapassou, definir a felicidade de volta para 100%
            $happiness = 100;
        } 
        // Verifica se a fome ultrapassou 100%
        if ($hunger >= 100) {
            // Se ultrapassou, definir a fome de volta para 100%
            $hunger = 100;
        } elseif ($hunger <= 0 || $happiness<=0) {
            // Se a fome atingiu zero, resete todos os atributos
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
        
            // Redirecione o jogador para a página de login ou outra ação necessária
            header("Location: login.php");
            exit();
        }
        

        // Atualize o banco de dados com os novos valores
        $updateStatsQuery = "UPDATE usuario SET happiness=?, hunger=?, wisdom=?, Job=?, money=? WHERE ID=?";
        $stmt = $conn->prepare($updateStatsQuery);
        $stmt->bind_param("iiissi", $happiness, $hunger, $wisdom, $job, $money, $userId);
       
       
        
        // Tente executar a atualização
        try {
            if ($stmt->execute()) {
                // Se a execução for bem-sucedida, retorne uma mensagem JSON de sucesso
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'message' => 'Dados atualizados com sucesso!']);
            } else {
                // Se houver um erro durante a execução, retorne uma mensagem JSON de erro
                throw new Exception("Erro ao atualizar os dados: " . $stmt->error);
            }
        } catch (Exception $e) {
            // Em caso de exceção, retorne uma mensagem JSON de erro
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }

        // Feche a declaração preparada
        $stmt->close();
    } else {
        // Se o usuário não estiver autenticado, retorne uma mensagem JSON de erro
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Usuário não autenticado.']);
    }
} else {
    // Se o método de requisição for inválido, retorne uma mensagem JSON de erro
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Método de requisição inválido.']);
}
?>
