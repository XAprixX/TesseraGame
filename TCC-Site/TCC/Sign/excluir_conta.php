<?php

include_once("conexao.php");



session_start();

// Verifique se o parâmetro 'user_id' está presente na URL
if (isset($_GET['user_id'])) {
    // Recupere o ID do usuário da URL
    $userId = $_GET['user_id'];
 
} else {
    echo "Você não está logado.";
    exit; // Adicione um exit para interromper a execução se o usuário não estiver logado.
}

// consulta a tabela para excluir a conta que foi passada o ID
?>
    
    <!DOCTYPE html>
    <html>
    <head>
        <title>Confirmação</title>
        <link rel="stylesheet" type="text/css" href="styleexcluir.css">
      
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    </head>
    <body>
        <h1>Deseja confirmar?</h1>
        <button id="confirm" class="button green">Confirmar</button>
        <button id="cancel" class="button red">Cancelar</button>
    </body>


    <script>
    document.getElementById('confirm').addEventListener('click', function () {
        var userId = <?php echo $userId; ?>;
        window.location.href = 'delete_account.php?id=' + userId;
    }
 
    );
 

    document.getElementById('cancel').addEventListener('click', function () {
        window.location.href = 'Login.php';
    });

</script>

    </html>
    