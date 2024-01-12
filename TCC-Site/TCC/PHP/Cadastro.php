<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Capturar dados do formulário
  $cardNumber = $_POST["cardNumber"];
  $cardName = $_POST["cardName"];
  $cardCvv = $_POST["cardCvv"];

  // Validar os dados do formulário (por exemplo, verificar se todos os campos foram preenchidos)
  if (empty($cardNumber) || empty($cardName) || empty($cardCvv)) {
    // Redirecionar de volta à página de cadastro com uma mensagem de erro
    header("Location: cadastro.php?error=Por favor, preencha todos os campos antes de prosseguir.");
    exit;
  } else {
    // Processar os dados do formulário (por exemplo, salvar no banco de dados ou realizar outras ações pertinentes)
    // ...

    // Exemplo simples de salvar os dados em um arquivo de texto (não recomendado para uso em produção):
    $data = "Card Number: " . $cardNumber . "\nCard Name: " . $cardName . "\nCard CVV: " . $cardCvv . "\n\n";
    $file = fopen("cadastro_data.txt", "a");
    fwrite($file, $data);
    fclose($file);

    // Redirecionar para a página de sucesso ou outra página relevante
    header("Location: sucesso.php");
    exit;
  }
}
?>

<!-- Formulário de cadastro -->
<!DOCTYPE html>
<html lang="pt_BR">
<head>
<meta charset="UTF-8">
  <title>Cadastro</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel="stylesheet" href="./StyleCadastro.css">
  <link rel="web icon" type="img" href="../Img/brasaodicria.png"> <!--Icone Web-->
</head>
<body>
  <!-- Your existing HTML content for the cadastro page -->

  <!-- Formulário de cadastro -->
  <form method="post" action="cadastro.php">
    <!-- Campos do formulário de cadastro -->
    <div class="card-input">
      <label for="cardNumber" class="card-input__label">Numero do player</label>
      <input type="text" id="cardNumber" name="cardNumber" class="card-input__input" v-mask="generateCardNumberMask"
        v-model="cardNumber" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardNumber" autocomplete="off">
    </div>
    <div class="card-input">
      <label for="cardName" class="card-input__label">Nickname</label>
      <input type="text" id="cardName" name="cardName" class="card-input__input" v-model="cardName" v-on:focus="focusInput"
        v-on:blur="blurInput" data-ref="cardName" autocomplete="off">
    </div>
    <div class="card-input">
      <label for="cardCvv" class="card-input__label">ID</label>
      <input type="text" class="card-input__input" id="cardCvv" v-mask="'####'" maxlength="5"
        v-model="cardCvv" v-on:focus="flipCard(true)" v-on:blur="flipCard(false)" autocomplete="off">
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
  <script src="./ScriptCadastro.js"></script>
</body>
</html>
