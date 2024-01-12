<?php
session_start();
include("conexao.php");

  if (isset($_GET['user_id'])) {
      $userId = $_GET['user_id'];
    
  } 
// Destruir todas as variáveis de sessão
session_destroy();

// Redirecionar para a página de login
header("Location: ../Sign/Login.php");
exit;
?>

<button id="logoutBtn" class="button blue">Logout</button>

<script>
    // Adicione este script JavaScript para lidar com o logout
    document.getElementById('logoutBtn').addEventListener('click', function () {
        window.location.href = 'logout.php';
    });
</script>
