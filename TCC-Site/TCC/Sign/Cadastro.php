<!DOCTYPE html>
<html lang="pt_BR">
<head>
  <meta charset="UTF-8">
  <title>Cadastro</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel="stylesheet" type="text/css" href="StyleCadastro.css"> 
  <link rel="web icon" type="img" href="../Img/brasaodicria.png"> <!--Icone Web-->
</head>
<body>


<form action="Cadastro.php" method="post">
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
                </div> <!--Logo da empresa-->
              </div>

              <label for="cardNumber" class="card-item__number" ref="cardNumber">
                <template v-if="getCardType === 'amex'">
                  <span v-for="(n, $index) in amexCardMask" :key="$index">
                    <transition name="slide-fade-up">
                      <div class="card-item__numberItem" v-if="n.trim() === '#'">{{cardNumber[$index]}}</div>
                      <div class="card-item__numberItem" v-else>{{n}}</div>
                    </transition>
                  </span>
                </template>

                <template v-else>
                  <span v-for="(n, $index) in otherCardMask" :key="$index">
                    <transition name="slide-fade-up">
                      <div class="card-item__numberItem" v-if="n.trim() === '#'">{{cardNumber[$index]}}</div>
                      <div class="card-item__numberItem" v-else>{{n}}</div>
                    </transition>
                  </span>
                </template>
              </label>


              <div class="card-item__content">
                <label for="cardName" class="card-item__info" ref="cardName">
                  <div class="card-item__nickname">Nickname</div>
                  <transition name="slide-fade-up">
                    <div class="card-item__name" v-if="cardName.length" key="1">
                      <transition-group name="slide-fade-right">
                        <span class="card-item__nameItem" v-for="(n, $index) in cardName.replace(/\s\s+/g, ' ')"
                          v-if="$index === $index" v-bind:key="$index + 1">{{n}}</span>
                      </transition-group>
                    </div>
                    <div class="card-item__name" v-else key="2">Nickname</div> <!--Mudar Nickname-->
                  </transition>
                </label>

                <div class="card-item__date" ref="cardDate">
                  <label for="cardDay" class="card-item__dateTitle">&nbsp Criação</label>
                  <label for="cardDay" class="card-item__dateItem">
                    <transition name="slide-fade-up">
                      <span>{{ new Date().toLocaleString('pt-BR', {month: 'numeric', year:'numeric' }) }}</span>
                    </transition>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="card-item__side -back">
            <div class="card-item__cover">
              <img
                src="../Img/CofAdnCat.gif"
                class="card-item__bg">
            </div>

            <!--  Parte de tras do cartão   -->

            <div class="card-item__band"></div>
            <div class="card-item__cvv">
              <div class="card-item__cvvTitle">ID</div>
              <div class="card-item__cvvBand">
                <span v-for="(n, $index) in cardCvv" :key="$index" class="card-item__cvvDigit">
                  {{ n }}
                </span>
              </div>
              <div class="card-item__type">
                <img
                  src="../img/CNO.png"
                  v-if="getCardType" class="card-item__typeImg">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="card-form__inner">
      <div class="card-input">
        <label for="cardNumber" class="card-input__label">Numero do player</label>
        <input type="text" name="cardNumber" id="cardNumber" class="card-input__input" v-mask="generateCardNumberMask" v-model="cardNumber" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardNumber" autocomplete="off">
    </div>
    <div class="card-input">
        <label for="cardName" class="card-input__label">Nickname</label>
        <input type="text" name="cardName" id="cardName" class="card-input__input" v-model="cardName" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardName" autocomplete="off">
    </div>
    <div class="card-input">
        <label for="cardPassword" class="card-input__label">Senha</label>
        <input type="password" name="cardPassword" id="cardPassword" class="card-input__input" v-model="cardPassword" v-on:focus="focusInput" v-on:blur="blurInput" v-on:click="cardPassword = '' " data-ref="cardPassword" autocomplete="off">
    </div>
    <div class="card-form__row">
        <div class="card-form__col">
            <div class="card-form__group">
                <div class="card-input">
                    <label for="cardCvv" class="card-input__label">ID</label>
                    <input type="text" name="cardCvv" class="card-input__input" id="cardCvv" v-mask="'####'" maxlength="5" v-model="cardCvv" v-on:focus="flipCard(true)" v-on:blur="flipCard(false)" autocomplete="off">
                </div>
            </div>
        </div>
    </div>
    <button class="card-form__button" type="submit"> Concluído </button>
</form>

        <div style="text-align: center;">
          Já possui conta? <a href="Login.php">Login</a>
        </div>
      </div>
    </div>
  </div>
  <?php
$conn = null; // Inicialize a variável $conn

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coletar os dados do formulário
    $cardNumber = $_POST["cardNumber"];
    $cardName = $_POST["cardName"];
    $cardPassword = $_POST["cardPassword"];
    $cardCvv = $_POST["cardCvv"];
    $creationDate = date("m/Y"); // Mês e ano atuais no formato MM/YYYY
    $description = null; // Se a descrição não for fornecida, será nula no banco de dados

    // Validação dos dados (você pode adicionar suas próprias regras de validação)
    $errors = array();

    if (empty($cardNumber)) {
        $errors[] = "O número do player é obrigatório.";
        echo("numero");
    }

    if (empty($cardName)) {
        $errors[] = "O nickname é obrigatório.";
        echo("name");
    }

    if (empty($cardPassword)) {
        $errors[] = "A senha é obrigatória.";
        echo("senha");
    }

    if (empty($cardCvv) || !is_numeric($cardCvv) || strlen($cardCvv) > 4) {
        $errors[] = "O ID deve conter no máximo 4 dígitos numéricos.";
        echo("id");
    }

    // Se não houver erros, você pode processar os dados e inseri-los no banco de dados
    if (empty($errors)) {

        include_once("Conexão.php");

        // Verifique se a conexão foi bem-sucedida
        if ($conn->connect_error) {
            die("Erro na conexão com o banco de dados: " . $conn->connect_error);
        }

        // Preparar a consulta SQL (incluindo descrição como campo opcional)
        $sql = "INSERT INTO usuario (Nickname, Senha, Player_Number, ID, Criacao, Descricao)
        VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        // Verificar a preparação da consulta
        if (!$stmt) {
            die("Erro na consulta SQL: " . $conn->error);
        }

        // Vincular os parâmetros
        $stmt->bind_param("ssssss", $cardName, $cardPassword, $cardNumber, $cardCvv, $creationDate, $description);

        if ($stmt->execute()) {
            // Sucesso na execução da consulta
            echo "Dados inseridos com sucesso no banco de dados.";
        } else {
            // Erro na execução da consulta
            echo "Erro na execução da consulta SQL: " . $stmt->error;
        }

        // Fechar a conexão com o banco de dados
        $conn->close();
    } else {
        // Erro na inserção
        echo "Erro na inserção no banco de dados.";
    }
}
?>


 <<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="https://unpkg.com/vue-the-mask@0.11.1/dist/vue-the-mask.js"></script>
  <script src="ScriptCadastro.js"></script>
</body>
</html>
