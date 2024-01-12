
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel="stylesheet" href="./style.css">
  <link rel="icon" type="image/png" href="../Img/brasaodicria.png">
</head>
<body>
<form action="Login.php" method="post"> 
  <div class="wrapper" id="app">
    <div class="card-form">
      <div class="card-list">
        <div class="card-item" v-bind:class="{ '-active' : isCardFlipped }">
          <div class="card-item__side -front">
            <div class="card-item__focus" v-bind:class="{'-active' : focusElementStyle }"
              v-bind:style="focusElementStyle" ref="focusElement"></div>
            <div class="card-item__cover">
              <img :src="currentBackgroundImage" class="card-item__bg">
            </div>

            <div class="card-item__wrapper">
              <div class="card-item__top">
                <div class="card-item__type">
                  <transition name="slide-fade-up">
                    <img
                      src="../img/CNO.png" 
                      v-if="getCardType" v-bind:key="getCardType" alt="" class="card-item__typeImg">
                  </transition>
                </div> <!--  Logo da nossa empresa    -->
              </div>

              <label for="cardNumber" class="card-item__number" ref="cardNumber">
                <template v-for="(n, $index) in formattedCardNumber">
                  <div class="card-item__numberItem" :class="{ '-active' : n === '*' }" :key="$index">{{ n }}</div>
                </template>
              </label>

              <div class="card-item__content">
                <label for="cardName" class="card-item__info" ref="cardName">
                  <div class="card-item__nickname" style="text-align: start;">Nickname</div>
                  <transition name="slide-fade-up">
                    <div class="card-item__name" v-if="cardName.length" key="1" style="text-align: start;">
                      <transition-group name="slide-fade-right">
                        <span class="card-item__nameItem" v-for="(n, $index) in cardName.replace(/\s\s+/g, ' ')"
                          v-if="$index === $index" v-bind:key="$index + 1">{{n}}</span>
                      </transition-group>
                    </div>
                    <div class="card-item__name" v-else key="2" style="text-align: start;">Nickname</div>
                  </transition>
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-form__inner">
      <div class="card-input">
    <label for="nickname" class="card-input__label">Nickname</label>
    <input type="text" id="nickname" name="nickname" class="card-input__input" v-model="cardName" v-on:focus="focusInput"
      v-on:blur="blurInput" data-ref="cardName" autocomplete="off">
  </div>
  <div class="card-input">
    <label for="password" class="card-input__label">Senha</label>
    <input type="password" id="password" name="password" class="card-input__input" v-model="cardPassword"
      v-on:focus="focusInput" v-on:blur="blurInput" v-on:click="cardPassword = '' " data-ref="cardPassword"
      autocomplete="off">
  </div>

  <button class="card-form__button" type="submit"> Concluído </button>
    </form>
       
        <div style="text-align: center;">
          Não possui conta? <a href="Cadastro.php">Cadastrar</a><br>
          Esqueceu sua senha? <a href="SignOutraSenha.html">Alterar</a>
        </div>
      </div>
    </div>
  </div>

</form>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js'></script>
  <script src='https://unpkg.com/vue-the-mask@0.11.1/dist/vue-the-mask.js'></script>
  <script src="./script.js"></script>

  <?php
session_start(); // Inicie a sessão

include_once("Conexão.php");

if (isset($_POST["nickname"]) && isset($_POST["password"])) {
    $nickname = $_POST["nickname"];
    $password = $_POST["password"];

    // Validar as entradas (por exemplo, verificar se não estão vazias)
    if (!empty($nickname) && !empty($password)) {
        // Consulta SQL usando uma instrução preparada
        $sql = "SELECT id FROM usuario WHERE Nickname = ? AND Senha = ?";
    
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $nickname, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
          // A conta existe e as credenciais estão corretas
          $row = $result->fetch_assoc();
          $userId = $row['id'];
       

          // Armazene o ID do usuário e o nome na sessão
          $_SESSION['user_id'] = $userId;
     
      

    // Redirecione para a página de boas-vindas com o ID como parâmetro na URL
    echo "<script>window.location.href = 'http://localhost/TCC-Site/TCC/Principal/TelaPrincipal.php?user_id=$userId';</script>";
    exit; // Certifique-se de que o código PHP não continue executando após o redirecionamento
} else {
    echo "<script>alert('Login inválido!');</script>";
}
  
        // Fechar a instrução preparada
        $stmt->close();
    } else {
        echo "<script>alert('Campos de nome de usuário e senha são obrigatórios!');</script>";
    }
}

// Fechar a conexão com o banco de dados
$conn->close();
?>


</body>
</html>
