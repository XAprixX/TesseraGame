<?php


include_once("Conexão.php");
session_start(); // Inicie a sessão

if (isset($_SESSION['user_id'])) {
    // O usuário está autenticado, recupere o ID do usuário da sessão
    $userId = $_SESSION['user_id'];
} else {
    // Redirecione o usuário ou retorne uma mensagem de erro
    header("Location: login.php");
    exit();
}

// Consulta SQL para obter os valores de money, hunger, happiness e wisdom
$getStatsQuery = "SELECT money, hunger, happiness, wisdom, Job FROM usuario WHERE ID = ?";
$stmt = $conn->prepare($getStatsQuery);
$stmt->bind_param("i", $userId);
$stmt->execute();
$statsResult = $stmt->get_result();

if ($statsResult->num_rows > 0) {
  $statsRow = $statsResult->fetch_assoc();
  $money = $statsRow['money'];
  $hunger = $statsRow['hunger'];
  $happiness = $statsRow['happiness'];
  $wisdom = $statsRow['wisdom'];
  $job = $statsRow['Job'];

  // Após recuperar os valores do banco de dados
$_SESSION['hunger'] = $hunger;
$_SESSION['happiness'] = $happiness;
$_SESSION['job'] = $job;

echo "<script>var fome = " . (isset($_SESSION['hunger']) ? $_SESSION['hunger'] : 0) . ";</script>";
echo "<script>var happiness = " . (isset($_SESSION['happiness']) ? $_SESSION['happiness'] : 0) . ";</script>";
echo "<script>var job = '" . (isset($_SESSION['job']) ? $_SESSION['job'] : '') . "';</script>";

} else {
  echo "Erro ao obter os valores!";
}
if (!$statsResult) {
  echo "Erro ao executar a consulta: " . $conn->error;
}

echo "<script>var money = $money;</script>";
echo "<script>var happiness = $happiness;</script>";
echo "<script>var fome = $hunger;</script>";
echo "<script>var Job =  '$job' </script>";
echo "<script>var wisdom = $wisdom;</script>";

?>

<script>
  console.log("Essa e sua fome atual " + fome);
</script>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tessera</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
  

  <div id="blur-layer"></div> <!-- Uma camada de desfoque -->
  <div id="game-container">

    <!--Barra de congifuração-->
    <input type="checkbox" id="hamburger">
    <label class="hamburger-icon" for="hamburger">
      <span class="line"></span>
      <span class="line"></span>
      <span class="line"></span>
    </label>

    <nav class="menu" style="z-index: 1;">
      <ul>

          <!-- Elemento de áudio para a música -->
          <audio id="background-music" loop> <!-- Inclui um vídeo de fundo -->
            <!-- Deixe a tag <source> vazia por enquanto -->
          </audio>

          <!-- Barra de configuração -->
          <div class="toggle-switch">
            <input type="checkbox" id="music-toggle" class="toggle-checkbox">
            <label for="music-toggle" class="toggle-label"></label>
          </div>
          <li><a href="../Principal/TelaPrincipal.html">Home</a></li>
          
          <li><a href="/TCC/Tutorial/SobreOJogo.html">Tutorial</a></li>
          <li><a href="../Documentação/Documentação.html">Contact</a></li>
          <button id="pauseButton" style="display: block;">Pause</button>
      </ul>
  </nav>

    <!-- Actions -->
    <div id="action-container" class="animated-container">
      <!-- Avatar Display -->
      <div id="player-avatar" onclick="toggleAvatarOptions()" style="left: 175px; top: 25px;">
        <img id="avatar-image" src="../JOgo/Img-Jogo/man.png" alt="Avatar do Jogador" style="left: 50px;">
      </div>

      <!-- Botões de ação -->
      <div id="action-buttons">
        <button id="school-button" class="large-button"
          onclick="togglePopup('school-category', 'school-button')">Estudos</button>
        <button id="work-button" class="large-button"
          onclick="togglePopup('work-category', 'work-button')">Trabalho</button>
        <button id="minigames-button" class="large-button"
          onclick="togglePopup('minigames-category', 'minigames-button')">Minijogos</button>
        <button id="show-dialog-button" onclick="makeChoice()" style="display: none;" class="large-button">Mostrar Diálogo</button>


        <!--Dias-->
      </div>
      <div id="day-progress-container">
        <div id="day-progress-bar">
          <div id="day-progress"></div>
          <div id="day-counter">Dia 1</div>
        </div>
      </div>
    </div>

    <!-- Popup de diálogo (inicialmente oculto) -->
    <div id="dialog-popup"
      style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: black; padding: 20px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);">
      <p id="dialogue-text"></p>
      <button id="dialogue-choice-1" onclick="makeChoice(0)"></button>
      <button id="dialogue-choice-2" onclick="makeChoice(1)"></button>
      <button id="close-dialog-button" onclick="closeDialog()">Fechar</button>
    </div>
  </div>

  <!-- Popup de seleção de escola (inicialmente oculto) -->
  <div id="school-category" class="action-category animated-category popup-container show-popup"
    style="top: 35.0%; z-index: 1;left: 610px;">
    <span class="close-button" onclick="hidePopup('school-category')">X</span>
    <p>Escolha onde e como você deseja estudar:</p>
    <button id="studyCurso" onclick="studyCurso()">Estudar Curso</button>
    <button id="studySenai" onclick="studySenai()">Estudar Senai</button>
    <button id="study" onclick="study()">Ir para Faculdade</button>
    <button id="studyPos"  onclick="studyPos()">Fazer Pós Graduação</button>
  </div>
  </div>

  <!-- Opções de avatar -->
  <div id="avatar-options" class="avatar-options">
    <img src="../JOgo/Img-Jogo/man.png" alt="Avatar 1" onclick="changeAvatar('../JOgo/Img-Jogo/man.png')" />
    <img src="../JOgo/Img-Jogo/man2.png" alt="Avatar 2" onclick="changeAvatar('../JOgo/Img-Jogo/man2.png')" />
    <img src="../JOgo/Img-Jogo/MWoman.png" alt="Avatar 7" onclick="changeAvatar('../JOgo/Img-Jogo/MWoman.png')" />
    <img src="../JOgo/Img-Jogo/Woman.png" alt="Avatar 3" onclick="changeAvatar('../JOgo/Img-Jogo/Woman.png')" />
    <img src="../JOgo/Img-Jogo/woman2.png" alt="Avatar 4" onclick="changeAvatar('../JOgo/Img-Jogo/woman2.png')">
    <img src="../JOgo/Img-Jogo/woman3.png" alt="Avatar 5" onclick="changeAvatar('../JOgo/Img-Jogo/woman3.png')">
    <img src="../JOgo/Img-Jogo/Batman.png" alt="Avatar 6" onclick="changeAvatar('../JOgo/Img-Jogo/Batman.png')" />
    <img src="../JOgo/Img-Jogo/Astronauta.png" alt="Avatar 7"
      onclick="changeAvatar('../JOgo/Img-Jogo/Astronauta.png')" />
  </div>
  </div>

  <!-- Lista de opções de trabalho -->
  <div id="work-category" class="action-category animated-category popup-container show-popup"
    style="top: 31.25%; z-index: 1; left: 970px;">
    <span class="close-button" onclick="hidePopup('work-category')">X</span>
    <p>Selecione um novo emprego:</p>
    <select id="jobSelect">
    <option value="Desempregado">Desempregado</option>
      <option value="Assistente de Escritório">Assistente de Escritório</option>
      <option value="Programador" id="programmerOption" style="display: none;">Programador</option>
      <option value="Líder de torcida organizada" id="cheerleaderOption" style="display: none;">Líder de torcida
        organizada</option><!--Comprar camisa de time-->
      <option value="Uber" id="uberOption" style="display: none;">Uber</option> <!--Comprar fiat uno-->
      <option value="Motoboy" id="motoboyOP" style="display: none;">Motoboy</option><!--Comprar Hornet-->
      <option value="Roadie" id="roadieOption" style="display: none;">Roadie</option><!--Comprar camisa de banda-->
      <option value="Vendedor da Supreme" id="VendedorSupreme" style="display: none;">Vendedor da Supreme</option>
      <!--Comprar Supreme-->
      <option value="Modelo da Balenciaga" id="modelo" style="display: none;">Modelo da Balenciaga</option>
      <!--Comprar Jordan ou balc-->
      <option value="Atleta" id="atleta" style="display: none;">Atleta</option> <!--Comprar Jordan-->
      <option value="Instagrammer" id="Insta" style="display: none;">Instagrammer</option> <!--Comprar Iphone-->
      <option value="YouTuber" id="youtuber" style="display: none;">YouTuber</option> <!--Comprar Ps1-->
      <option value="TikToker" id="tiktoker" style="display: none;">Tiktoker</option> <!--Comprar Asus-->
      <option value="Mototáxi" id="MotoTaxi" style="display: none;">Mototáxi</option> <!--Comprar lambreta-->
      <option value="Engenheiro de Software" id="Engenheiro" style="display: none;"></option>>Engenheiro de Software
      </option>
    </select>
    <button id="changeJobSelectButton">Mudar de Emprego</button>
    <button id="goToWorkButton">Ir Trabalhar</button>
    <button id="startProgrammingJob" style="display: none;">Iniciar Trabalho de Programador</button>
  </div>


  <!-- Minigames -->
  <div id="minigames-category" class="action-category animated-category popup-container show-popup"
    style="top: 41.0%; z-index: 1;left: 1330px;">
    <span class="close-button" onclick="hidePopup('minigames-category'); ">X</span><!---->
    <p>Jogar um minigame: </p>
    <a href="../MiniGames/Basquete/basquete.php?user_id=<?php echo $_SESSION['user_id']; ?>"><button>Basquete</button></a>
    <a href="../MiniGames/Piano/index.html"><button>Piano</button></a>
    <a href="../MiniGames/Asteroides/Asteroides.php?user_id=<?php echo $_SESSION['user_id']; ?>"><button>Asteroides</button></a>
    <a href="../MiniGames/Color Blast/ColorBlast.php?user_id=<?php echo $_SESSION['user_id']; ?>"><button>Color Blast</button></a>
    <a href="../MiniGames/Frutninja/FrutNinja.php?user_id=<?php echo $_SESSION['user_id']; ?>"><button>Fruit Block</button></a>
    <a href="../MiniGames/Snake/Snake.php?user_id=<?php echo $_SESSION['user_id']; ?>"><button>Snake</button></a>
    <a href="../MiniGames/Copas/Copas.html"><button>Copas</button></a>
    <a href="../MiniGames/Mega-Sena/index.php?user_id=<?php echo $_SESSION['user_id']; ?>"><button>Mega-Sena</button></a>
    <?php
    if (isset($_GET['increase_happiness']) && $_GET['increase_happiness'] == 1) {
      // Atualize a felicidade do usuário
      $novaFelicidade = $felicidadeAtual + 1;  // ou qualquer lógica desejada
      $sqlUpdate = "UPDATE usuario SET Felicidade = ? WHERE ID = ?";
      $stmtUpdate = $conn->prepare($sqlUpdate);
      $stmtUpdate->bind_param("ii", $novaFelicidade, $userId);
      
      if ($stmtUpdate->execute()) {
          // Atualização bem-sucedida
          echo "Felicidade aumentada com sucesso!";
      } else {
          // Tratar erros, se houver
          echo "Erro ao aumentar a felicidade: " . $stmtUpdate->error;
      }
      
      $stmtUpdate->close();
  }
  ?>
    </button>
  </div>
  
  <style>
    /* Remove o sublinhado dos links <a> */
    a {
      text-decoration: none;
    }
  </style>
 
  </div>
<!-- Status -->
<div id="status-container" class="animated-container">
    <h2>Status</h2>
    <p>Sabedoria: <span id="wisdom"><?php echo $wisdom;?></span></p>
    <div class="progress">
        <div id="wisdom-bar" class="progress-bar" style="width: 0;"></div>
    </div>

   
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Variável para representar o valor atual da fome
var currentHunger = <?php  echo $hunger ?>; // Valor inicial da fome

// Função para atualizar a barra de fome
function updateHunger() {
  var hungerBar = document.getElementById("hunger-bar");
  hungerBar.style.width = currentHunger + "%";

  // Reduzir o valor da fome (por exemplo, 1% a cada segundo)
  var decreaseRate = 0.8; // Você deve diminuir a fome, então use um valor positivo
  currentHunger -= decreaseRate;

  console.log(currentHunger);
  
    if (currentHunger < 0) {
       alert("Você morreu de fome!!!");
       resetAttributes();
       location.reload(); // atualiza a página após apertar ok
    }
   
  // Atualize a barra de fome
  updateHungerBar();

  // Chame a função novamente após um intervalo de tempo (por exemplo, 1 segundo)
  setTimeout(updateHunger, 1000); // Atualize a cada segundo

}

// Função para atualizar a barra de fome na interface do usuário
function updateHungerBar() {
  var hungerBar = document.getElementById("hunger-bar");
  hungerBar.style.width = currentHunger + "%";
}


   // Chame a função para iniciar a atualização da fome
   updateHunger();
});
</script>


<p>Fome: <span id="hunger-value"></span> <i class="fas fa-utensils"></i></p>

<div class="progress">
    <div id="hunger-bar" class="progress-bar" style="width: <?php echo $hunger; ?>%; background-color: rgb(75, 75, 245);"></div>
</div>


    <p>Emprego: <span id="job"><?php echo $job; ?></span></p>
    <p>Dinheiro: $<span id="money"><?php echo $money; ?></span></p>
 
    <?php
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
    $sqlUpdate = "UPDATE usuario SET Fome = ?, Felicidade = ?, Sabedoria = ?, Dinheiro = ?, Job = ? WHERE ID = ?";
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
?>

 
<p>Felicidade: <span id="happiness" ><?php echo $happiness; ?>%</span> <i class="fas fa-heart"></i></p>


    <div class="progress" style="top: -60px">
    <div id="happiness-bar" class="progress-bar" style="width: <?php echo $happiness; ?>%; background-color: rgb(240, 236, 30);top: -10.5px;"><span id="status">Feliz</span></div>

    </div>
</div>




  <!-- Shop -->
  <button id="shop-button" onclick="togglePopup('shop-items')" class="shop-button" style="top: 70px; right: 30px;">
    <i class="fas fa-shopping-cart"></i> <!-- Ícone de um carrinho de compras -->
  </button>
  <div id="shop-category" class="action-category animated-category shop-container show-popup"
    style="height: 300px; width: 300px; top: 35%;">
    <span class="close-button" onclick="hidePopup('shop-category')">X</span>
    <button onclick="togglePopup('Roupa-category')">Loja de Roupas</button>
    <button onclick="togglePopup('shopEletronico-category')">Loja de Eletrônicos</button>
    <button onclick="togglePopup('shopImovel-category')">Loja de Imóveis</button>
    <button onclick="togglePopup('shopAutomovel-category')">Loja de Automóveis</button>
    <button onclick="togglePopup('Supremos-category')">Loja Extras </button>
    <button onclick="togglePopup('servicos-category')">Loja de Serviços</button>
    <button onclick="togglePopup('restaurante-category')">Restaurantes</button>

  </div>

  <div id="Roupa-category" class="action-category animated-category shop-container show-popup"
    style="left: 73.8%; top: 69%;">
    <span class="close-button" onclick="hidePopup('Roupa-category')">X</span>
    <p>Itens da Loja de Roupas:</p>


    <!--Camisas-->
    <button id="buy-shirt-button" onclick="buyShirt()" class="aligned-button">
      <img src="../JOgo/Img-Jogo/camisaCoracao.png" alt="Item-Roupa 1" style="width: 50px;" />
      Camisa de Time ($20)
    </button>

    <button id="buy-band-shirt-button" onclick="buyBandShirt()" class="aligned-button">
      <img src="../JOgo/Img-Jogo/camisaBanda.png" alt="Item-Roupa 2" style="width: 50px;">
      Camisa de Banda ($20)
    </button>

    <button id="buy-Supreme-shirt-button" onclick="buySupremeShirt()" class="aligned-button">
      <img src="../JOgo/Img-Jogo/blusaSupreme.png" alt="Item-Roupa 3" style="width: 50px;">
      Camisa da Supreme ($600)
    </button>

    <button id="buy-JordanS-button" onclick="buyJordan()" class="aligned-button">
      <img src="../JOgo/Img-Jogo/jordanS.png" alt="Item-Roupa 4" style="width: 50px;">
      Jordan S($2000)
    </button>

    <button id="buy-Balenciaga-button" onclick="buyBalenciaga()" class="aligned-button">
      <img src="../JOgo/Img-Jogo/bolsaBalenciaga.png" alt="Item-Roupa 5" style="width: 50px;">
      Bolsa Balenciaga($2000)
    </button>
  </div>


  <!-- Categorias de Itens - Loja de Eletrônicos -->
  <div id="shopEletronico-category" class="action-category animated-category shop-container show-popup "
    style="left: 73.8%; top: 69%;">
    <span class="close-button" onclick="hidePopup('shopEletronico-category')">X</span>
    <p>Itens da Loja de Eletrônicos:</p>

    <!--Televisão-->

    <button id="buy-Tv-button" onclick="buyTV()" class="aligned-button">
      <img src="../JOgo/Img-Jogo/tvTubo.png" alt="Item-Eletronico 1" style="width: 50px;">
      TV de tubo ($80)
    </button>


    <!--Celular-->
    <button id="buy-Asus-button" onclick="buyAsus()" class="aligned-button">
      <img src="../JOgo/Img-Jogo/celularAsus.png" alt="Item-Eletronico 2" style="width: 50px;">
      Celular da ASUS($120)
    </button>

    <button id="buy-IPhone-button" onclick="buyIphone()" class="aligned-button">
      <img src="../JOgo/Img-Jogo/iphone.png" alt="Item-Eletronico 3" style="width: 50px;">
      IPhone($920)
    </button>

    <!--Computadores-->
    <button id="buy-computer-button" onclick="buyComputer()" class="aligned-button">
      <img src="../JOgo/Img-Jogo/computador.png" alt="Item-Eletronico 4" style="width: 50px;">
      Comprar Computador ($800)
    </button>

    <button id="buy-Playstation1-button" onclick="buyPS1()" class="aligned-button">
      <img src="../JOgo/Img-Jogo/ps1.png" alt="Item-Eletronico 5" style="width: 50px;">
      Playstation 1($350)
    </button>

    <button id="buy-PCGamer-button" onclick="buyPCGamer()" class="aligned-button">
      <img src="../JOgo/Img-Jogo/pcGamer.png" alt="Item-Eletronico 6" style="width: 50px;">
      PC Gamer($4000)
    </button>
  </div>


  <!-- Categorias de Itens - Loja de Imovel -->
  <div id="shopImovel-category" class="action-category animated-category shop-container show-popup"
    style="left: 73.8%; top: 69%;">
    <span class="close-button" onclick="hidePopup('shopImovel-category')">X</span>
    <p>Itens da Loja de Imoveis:</p>

    <!--Apartamento e Casas-->
    <button id="buy-Apartamento-Longe-button" onclick="buyApLonge()" class="aligned-button">
      <img src="../JOgo/Img-Jogo/apartamentoLonge.png" alt="Item-Imovel 1" style="width: 50px;">
      Apartamento longe da faculdade ($400)
    </button>

    <button id="buy-Apartamento-button" onclick="buyApPerto()" class="aligned-button">
      <img src="../JOgo/Img-Jogo/apartamentoPerto.png" alt="Item-Imovel 2" style="width: 50px;">
      Apartamento próximo à faculdade ($990)
    </button>

    <button id="buy-Casa-button" onclick="buyCasaPropria()" class="aligned-button">
      <img src="../JOgo/Img-Jogo/casaPropria.png" alt="Item-Imovel 3" style="width: 50px;">
      Casa Própria ($10.000)
    </button>

    <button id="buy-mansao-button" onclick="buyMansao()" class="aligned-button">
      <img src="../JOgo/Img-Jogo/mansao.png" alt="Item-Imovel 4" style="width: 50px;">
      Mansão ($500.000)
    </button>
  </div>


  <!-- Categorias de Itens - Loja de Automovel -->
  <div id="shopAutomovel-category" class="action-category animated-category shop-container show-popup"
    style="left: 73.8%; top: 69%;">
    <span class="close-button" onclick="hidePopup('shopAutomovel-category')">X</span>
    <p>Itens da Loja de Automóveis:</p>

    
    <!--Carros/Motos-->
    <button id="buy-fiatUno-button" onclick="buyCar()" class="aligned-button">
      <img src="../JOgo/Img-Jogo/fiatUno.png" alt="Item-Automovel 1" style="width: 50px;">
      Fiat Uno ($800)
    </button>

    <button id="buy-Lambreta-button" onclick="buyMoto()" class="aligned-button">
      <img src="../JOgo/Img-Jogo/lambreta.png" alt="Item-Automovel 2" style="width: 50px;">
      Lambreta ($299)
    </button>

    <button id="buy-Hornet-button" onclick="buyHornet()" class="aligned-button">
      <img src="../JOgo/Img-Jogo/hornet.png" alt="Item-Automovel 3" style="width: 50px;">
      Hornet ($1.000)
    </button>

  </div>

  <!--Extras-->
  <div id="Supremos-category" class="action-category animated-category shop-container show-popup"
    style=" left: 73.8%; top: 69%;">
    <span class="close-button" onclick="hidePopup('Supremos-category')">X</span>
    <p>Itens Supremos-category:</p>

    <button id="buy-twitter-button" onclick="buyTwitter()" class="aligned-button">
      <img src="../JOgo/Img-Jogo/twitter.png" alt="Item-Supremos 1" style="width: 50px;">
      Twitter ($100.000)
    </button>

  </div>
  <div id="servicos-category" class="action-category animated-category shop-container show-popup"
    style="left: 73.8%; top: 69%; display: none;">
    <span class="close-button" onclick="hidePopup('servicos-category')">X</span>
    <p>Serviços:</p>
    <button onclick="subscribePsicologo()">Assinar Psicólogo ($50/mês)</button>
  </div>

  <!--Restaurantes-->
  <div id="restaurante-category" class="action-category animated-category shop-container show-popup"
    style="left: 73.8%; top: 69%;">
    <span class="close-button" onclick="hidePopup('restaurante-category')">X</span>
    <p>Padarias:</p>
    <button onclick="buyFood(0)">
      <img src="../JOgo/Img-Jogo/pao.png" alt="padaria1" style="width: 50px;">
      Pão ($1)
    </button>

    <p>Lanchonetes:</p>
    <button onclick="buyFood(1)">
      <img src="../JOgo/Img-Jogo/Omelete.png" alt="lanchonete1" style="width: 50px;">
      Omelete ($10)
    </button>

    <p>Restaurantes Finos:</p>
    <button onclick="buyFood(2)">
      <img src="../JOgo/Img-Jogo/petit_gateau.png" alt="fino1" style="width: 50px;">
      Petit Gateau ($130)
    </button>

  </div>

  <!-- Botão para mostrar o diálogo (inicialmente oculto) -->
  <button id="show-dialog-button" onclick="makeChoice()" style="display: none;width: 200px; height: 50px;">Mostrar
    Diálogo</button>

  <!-- Botão para renovar a assinatura (simulado) -->
  <button onclick="renewSubscription()">Renovar Assinatura</button>

  <script src="./Script2.js"></script>


</body>
<!-- Adicione esta biblioteca para o exemplo -->

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
// Supondo que você esteja usando jQuery
function resetAttributes(userId) {
    // Chame o script PHP via Ajax
    $.ajax({
        type: "POST",
        url: "reset_attributes.php", // Atualize com o caminho correto para seu script PHP
        data: { userId: userId },
        success: function (response) {
            // A resposta do servidor será manipulada aqui
            alert(response); // Exiba a mensagem de sucesso ou erro
            location.reload(); // Recarregue a página após o alerta (você pode querer ajustar isso conforme necessário)
        },
        error: function (error) {
            // Se houver um erro na requisição Ajax
            alert("Erro ao redefinir atributos: " + error.responseText);
        }
    });
}


// Função para salvar as informações no servidor
function saveStats() {
    // Recupere as variáveis do PHP para JavaScript
    let wisdom = parseInt(document.getElementById("wisdom").textContent);
    let hunger = parseInt(document.getElementById("hunger-bar").style.width.replace('%', ''));
    let job = document.getElementById("job").textContent;
    let money = parseInt(document.getElementById("money").textContent);
    let happiness = parseInt(document.getElementById("happiness").textContent);

    // Objeto com os dados a serem enviados para o servidor
    let data = {
        wisdom: wisdom,
        hunger: hunger,
        job: job,
        money: money,
        happiness: happiness
    };

    // Faça uma requisição AJAX para o arquivo de atualização no servidor
    $.post("update_stats.php", data, function(response) {
        // Verifique se a chave 'success' está definida e é verdadeira
        if (response && response.success) {
            console.log("Dados salvos com sucesso!");
        } else {
            // Se 'success' não estiver definido ou for falso, exiba a mensagem de erro
            console.error("Erro ao salvar dados: " + response.message);
        }
    }, 'json').fail(function(error) {
        console.error("Erro ao salvar dados: " + error.responseText);
    });
}

// Chame a função a cada 1 minuto (60.000 milissegundos)
setInterval(saveStats, 60000); // multiplicado por 1000 para converter para milissegundos

</script>



</html>
