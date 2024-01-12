<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Capturar dados do formulário
  $nickname = $_POST["cardName"];
  $senha = $_POST["cardPassword"];

  // Validar os dados do formulário (Exemplo: verificar se o nickname e a senha estão preenchidos)
  if (empty($nickname) || empty($senha)) {
    // Redirecionar de volta à página de login com uma mensagem de erro
    header("Location: login.php?error=Por favor, preencha o nickname e senha antes de prosseguir.");
    exit;
  } else {
    // Processar os dados do formulário (por exemplo, autenticar o usuário e redirecionar para a página de perfil)
    // ...

    // Exemplo simples de autenticação (não recomendado para uso em produção):
    if ($nickname === "usuario" && $senha === "senha123") {
      // Redirecionar para a página de perfil
      header("Location: perfil.php");
      exit;
    } else {
      // Credenciais inválidas, redirecionar para a página de login com mensagem de erro
      header("Location: login.php?error=Credenciais inválidas. Por favor, tente novamente.");
      exit;
    }
  }
}
?>

<!-- Formulário de login -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel="stylesheet" href="">
  <link rel="web icon"type="img" href="../Img/brasaodicria.png">
</head>
<body>
  <!-- Your existing HTML content for the login page -->

  <!-- Formulário de login -->
  <form method="post" action="login.php">
    <!-- Campos do formulário de login -->
    <div class="card-input">
      <label for="cardName" class="card-input__label">Nickname</label>
      <input type="text" id="cardName" name="cardName" class="card-input__input" v-model="cardName" v-on:focus="focusInput"
        v-on:blur="blurInput" data-ref="cardName" autocomplete="off">
    </div>
    <div class="card-input">
      <label for="cardPassword" class="card-input__label">Senha</label>
      <input type="password" id="cardPassword" name="cardPassword" class="card-input__input" v-model="cardPassword"
        v-on:focus="focusInput" v-on:blur="blurInput" v-on:click="cardPassword = ''" data-ref="cardPassword"
        autocomplete="off">
    </div>

    <!-- Botão de envio -->
    <button type="submit" class="card-form__button" v-on:click="submitForm">Concluído</button>
  </form>

  <!-- PHP code to display error messages (if any) -->
  <?php
  if (isset($_GET["error"])) {
    echo '<div style="text-align: center; color: red;">' . $_GET["error"] . '</div>';
  }
  ?>

  <!-- Include the Vue.js script -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>
  <script src="https://unpkg.com/vue-the-mask@0.11.1/dist/vue-the-mask.js"></script>
  
  <!-- Include your custom script -->
  <script src="./script.js"></script>
</body>
</html>
