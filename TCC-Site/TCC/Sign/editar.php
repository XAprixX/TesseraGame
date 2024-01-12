<!DOCTYPE html>
<html lang="pt_BR">
<head>
  <meta charset="UTF-8">
  <title>Editar</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel="stylesheet" type="text/css" href="StyleCadastro.css"> 
  <link rel="web icon" type="img" href="../Img/brasaodicria.png"> <!--Icone Web-->
</head>
<body>

<?php
include_once("conexao.php");

// Verificar se o ID está definido na URL e é um número válido
if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
  $id = $_GET["id"];
  
  // Verificar se o formulário foi submetido para atualização
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cardName"], $_POST["cardPassword"], $_POST["cardNumber"], $_POST["cardCvv"])) {
    $Nickname = $_POST["cardName"];
    $Senha = $_POST["cardPassword"];
    $player_number = $_POST["cardNumber"];
    $ID = $_POST["cardCvv"];

    // New field: Description
    $Descricao = $_POST["cardDescription"];

    // Construa a consulta de atualização usando instruções preparadas para evitar SQL injection
    $sql = "UPDATE usuario SET Nickname=?, Senha=?, Player_Number=?, ID=?, Descricao=? WHERE ID=?";
    
    // Preparar a consulta
    $stmt = $conn->prepare($sql);
    
    // Vincular os parâmetros
    $stmt->bind_param("sssssi", $Nickname, $Senha, $player_number, $ID, $Descricao, $id);

    if ($stmt->execute()) {
      echo "Registro atualizado com sucesso!";
      // Redirecionar para a página de visualização do usuário após a atualização
      header("Location: editar.php?id=$id");
      exit();
    } else {
      echo "Erro ao atualizar registro: " . $stmt->error;
    }
  }

  // Consultar o usuário com base no ID
  $sql = "SELECT * FROM usuario WHERE ID = ?";
  
  // Preparar a consulta
  $stmt = $conn->prepare($sql);
  
  // Vincular o parâmetro
  $stmt->bind_param("i", $id);

  // Executar a consulta
  $stmt->execute();
  
  // Obter o resultado
  $result = $stmt->get_result();
  
  // Obter o usuário
  $usuario = $result->fetch_assoc();

  // Fechar a consulta
  $stmt->close();
} else {
  echo "ID inválido.";
}
?>


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
              <?php echo $usuario["Player_Number"]; ?>
                <template v-if="getCardType === 'amex'">
                  <span v-for="(n, $index) in amexCardMask" :key="$index">
                    <transition name="slide-fade-up">
                      <div class="card-item__numberItem" v-if="n.trim() === '#'"></div>
                      <div class="card-item__numberItem" v-else>{{n}}</div>
                    </transition>
                  </span>
                </template>

                <template v-else>
                  <span v-for="(n, $index) in otherCardMask" :key="$index">
                    <transition name="slide-fade-up">
                      <div class="card-item__numberItem" v-if="n.trim() === '#'"></div>
                      <div class="card-item__numberItem" v-else>{{n}}</div>
                    </transition>
                  </span>
                </template>
              </label>


              <div class="card-item__content">
                <label for="cardName" class="card-item__info" ref="cardName">
                  <div class="card-item__nickname"  style="margin-top: -20px;">Nickname</div>
                  <transition name="slide-fade-up">
                    <div class="card-item__name" v-if="cardName.length" key="1">
                      <transition-group name="slide-fade-right">
                        <span class="card-item__nameItem" v-for="(n, $index) in cardName.replace(/\s\s+/g, ' ')"
                          v-if="$index === $index" v-bind:key="$index + 1">{{n}}</span>
                      </transition-group>
                    </div>
                    <div class="card-item__name" v-else key="2"  style="margin-top: 10px;" > <?php echo $usuario["Nickname"]; ?></div> <!--Mudar Nickname-->
                  </transition>
                </label>

                <div class="card-item__date" ref="cardDate">
                  <label for="cardDay" class="card-item__dateTitle" style="margin-top: -20px;" >&nbsp Criação</label>
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
    <?php echo $usuario["ID"]; ?>
  </div>
  <div class="card-item__type">
    <img src="../img/CNO.png" v-if="getCardType" class="card-item__typeImg">
  </div>
</div>
          </div>
        </div>
      </div>



      <form action="editar.php?id=<?php echo $usuario["ID"]?>" method="post">
      <div class="card-form__inner">
  <div class="card-input">
    <label for="cardNumber" class="card-input__label">Numero do player</label>
    <input type="text" name="cardNumber" value="<?php echo $usuario["Player_Number"] ?>" class="card-input__input"   v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardNumber" autocomplete="off">
  </div>
  <div class="card-input">
    <label for="cardName" class="card-input__label">Nickname</label>
    <input type="text" name="cardName" value="<?php echo $usuario ["Nickname"]?>" id="cardName" class="card-input__input" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardName" autocomplete="off">
  </div>
  <div class="card-input">
    <label for="cardPassword" class="card-input__label">Senha</label>
    <input type="password" name="cardPassword" value="<?php echo $usuario ["Senha"] ?>" id="cardPassword" class="card-input__input"  v-on:focus="focusInput" v-on:blur="blurInput" v-on:click="cardPassword = '' " data-ref="cardPassword" autocomplete="off">
  </div>
  <div class="card-input">
  <label for="cardDescription" class="card-input__label">Descrição </label>
  <textarea name="cardDescription" id="cardDescription" class="card-input__input" maxlength="500" rows="4"><?php echo $usuario["Descricao"]; ?></textarea>
</div>
  <div class="card-form__row">
    <div class="card-form__col">
      <div class="card-form__group">
        <div class="card-input">
        <label for="cardCvv" class="card-input__label">ID</label>
<input type="text" name="cardCvv" value="<?php echo $usuario["ID"]; ?>" class="card-input__input" id="cardCvv" v-mask="'####'" maxlength="5" v-on:focus="flipCard(true)" v-on:blur="flipCard(false)" autocomplete="off" readonly>

        </div>
      </div>
    </div>
      </div>
      <button class="card-form__button" type="submit">
  <a href="http://localhost/TCC-Site/TCC/Principal/TelaPrincipal.php?user_id=<?php echo $usuario["ID"]; ?>">Atualizar Dados</a>
</button>

    </form>
  
    
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="https://unpkg.com/vue-the-mask@0.11.1/dist/vue-the-mask.js"></script>
  <script src="ScriptCadastro.js"></script>
</body>
</html>
