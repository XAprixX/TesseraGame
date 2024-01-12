
// Propriedades de posse de carros e imóveis
let carOwned = false; // Indica se o jogador possui um carro
let propertyOwned = false; // Indica se o jogador possui uma propriedade

// Eventos
let events = {
  christmas: false // Controla se o evento de Natal está ativo
};

// Objeto para rastrear os itens comprados
var inventory = {
  "Camisa do seu time de coração": false,
  "Camisa de banda": false,
  "Camisa da Supreme": false,
  "Jordan S": false,
  "Bolsa da Balanciaga": false,
  "TvDeTubo": false,
  "Celular da ASUS": false,
  "Computador": false,
  "Playstation1": false,
  "Pc Gamer": false,
  "Apartamento longe da faculdade": false,
  "Apartamento próximo à faculdade": false,
  "Casa Propria": false,
  "Mansão": false,
  "Fiat Uno": false,
  "Lambreta": false,
  "Hornet": false,
  "Twitter": false,
  "Iphone": false,
};


// Conquistas
const achievements = {
  wisdom: {
    100: "Sábio Iniciante",
    500: "Estudioso",
    1000: "Mestre do Conhecimento"
  },
  money: {
    1000: "Economista Novato",
    5000: "Milionário",
    10000: "Magnata Financeiro"
  },
  happiness: {
    50: "Otimista",
    75: "Alegre",
    100: "Felicidade Suprema"
  }
};

let player = {
  carOwned: false,
  propertyOwned: false
};

// Level
const levels = {
  1: "Iniciante",
  5: "Intermediário",
  10: "Avançado"
};

const unlockedFeatures = {
  3: "Novo Trabalho Disponível",
  7: "Loja de Itens de Luxo"
};



// Elementos da interface (referências a elementos HTML) 
const wisdomDisplay = document.getElementById("wisdom"); // Exibe a sabedoria do jogador
const jobDisplay = document.getElementById("job"); //Trabalho atual
const jobSelect = document.getElementById("jobSelect"); //Trabalho a escolher
const moneyDisplay = document.getElementById("money"); //Dinheiro
const happinessDisplay = document.getElementById("happiness"); //Felicidade
const statusDisplay = document.getElementById("status"); // Exibe o estado de felicidade

const schoolCategory = document.getElementById("school-category"); //Botão Html
const workCategory = document.getElementById("work-category"); //Botão Html
const minigamesCategory = document.getElementById("minigames-category"); //Botão Html

const studyButton = document.getElementById("studyButton");
const changeJobSelectButton = document.getElementById("changeJobSelectButton");
const shopContainer = document.getElementById("shop-container");
const goToWorkButton = document.getElementById("goToWorkButton");

// Requisitos de emprego para exibição
const jobRequirementsElements = document.querySelectorAll(".job-requirement");

// Lista de empregos com requisitos, salários e impacto na felicidade
const jobs = [{
    name: "Desempregado",
    wisdomRequirement: 10,
    salary: 2,
    happinessImpact: -4
  },
  {
    name: "Líder de torcida organizada",
    wisdomRequirement: 30,
    salary: 20,
    happinessImpact: -5
  },
  {
    name: "Roadie",
    wisdomRequirement: 100,
    salary: 20,
    happinessImpact: -4
  },
  {
    name: "Motoboy",
    wisdomRequirement: 190,
    salary: 30,
    happinessImpact: -5
  },
  {
    name: "Mototáxi",
    wisdomRequirement: 200,
    salary: 35,
    happinessImpact: -4
  },
  {
    name: "Vendedor da Supreme",
    wisdomRequirement: 300,
    salary: 35,
    happinessImpact: -5
  },
  {
    name: "Instagrammer",
    wisdomRequirement: 40,
    salary: 50,
    happinessImpact: -10
  },
  {
    name: "YouTuber",
    wisdomRequirement: 40,
    salary: 50,
    happinessImpact: -10
  },
  {
    name: "Tiktoker",
    wisdomRequirement: 30,
    salary: 50,
    happinessImpact: -9
  },
  {
    name: "Assistente de Escritório",
    wisdomRequirement: 60,
    salary: 50,
    happinessImpact: -4
  },
  {
    name: "Programador",
    wisdomRequirement: 500,
    salary: 60,
    happinessImpact: -17
  },
  {
    name: "Atleta",
    wisdomRequirement: 150,
    salary: 75,
    happinessImpact: -10
  },
  {
    name: "Modelo da Balenciaga",
    wisdomRequirement: 250,
    salary: 90,
    happinessImpact: -10
  },
  {
    name: "Engenheiro de Software",
    wisdomRequirement: 750,
    salary: 150,
    happinessImpact: -20
  }

];


// Atualiza o emprego
function updateJob(newJob) {
  job = newJob;
  jobDisplay.textContent = job;
}

// Atualiza os requisitos de emprego exibidos
function updateJobRequirements() {
  jobRequirementsElements.forEach((element, index) => {
    element.textContent = `Requisito de Sabedoria: ${jobs[index].wisdomRequirement}`;
  });
}


// Inicializa os elementos da interface com valores iniciais
updateJob(job);
updateJobRequirements();

// Função para ir trabalhar
function goToWork() {
  const jobInfo = jobs.find(jobData => jobData.name === job);

  if (jobInfo) {
    // Verifique se o jogador atende aos requisitos de sabedoria do trabalho
    if (wisdom >= jobInfo.wisdomRequirement) {
      let salary = jobInfo.salary; // Salário padrão do trabalho

      // Se o trabalho for "Desempregado," gere um salário aleatório entre 1 e 10
      if (job === "Desempregado") {
        salary = Math.floor(Math.random() * 10) + 1;
      }

      money += salary;
      updateMoneyDisplay(); // Certifique-se de que esta função esteja corretamente definida para atualizar o dinheiro na interface do usuário.
      increaseHappiness(jobInfo.happinessImpact); // Certifique-se de que esta função esteja corretamente definida para atualizar a felicidade do jogador.
      showMessage(`Você trabalhou como ${job} e ganhou $${salary.toFixed(2)}!`);
    } else {
      alert("Você não atende aos requisitos de sabedoria para este trabalho.");
    }
  } else {
    alert("Você precisa de um emprego válido para trabalhar.");
  }
}

goToWorkButton.addEventListener("click", goToWork);




// Associa a função ao botão "Ir Trabalhar"
function showCategory(categoryId) {
  const categoriesContainer = document.getElementById("categories-container");
  const selectedCategory = document.getElementById(categoryId);
  const mainCategories = document.getElementsByClassName("action-button");

  // Exibe a categoria principal antes de exibir a categoria selecionada
  for (const mainCategory of mainCategories) {
    const mainCategoryId = mainCategory.dataset.action + "-category";
    const mainCategoryElement = document.getElementById(mainCategoryId);
    categoriesContainer.appendChild(mainCategoryElement);
  }

  // Move a categoria selecionada para baixo do botão clicado
  const actionButton = document.getElementById(`${categoryId.split('-')[0]}-button`);
  actionButton.insertAdjacentElement('afterend', selectedCategory);

  // Define a exibição das outras categorias como "none"
  const categories = document.getElementsByClassName("action-category");
  for (const category of categories) {
    if (category !== selectedCategory) {
      category.style.display = "none";
    }
  }

  // Exibe a categoria selecionada
  selectedCategory.style.display = "block";
}

document.getElementById("school-button").addEventListener("click", () => showCategory("school-category"));
document.getElementById("work-button").addEventListener("click", () => showCategory("work-category"));
document.getElementById("minigames-button").addEventListener("click", () => showCategory("minigames-category"));
document.getElementById("shop-button").addEventListener("click", () => showCategory("shop-category"));


// Lista de itens da loja
let items = [
  // roupas
  {
    name: 'Camisa do seu time de coração',
    cost: 20,
    increase: 40,
    type: 'roupa',
    purchased: false
  },
  {
    name: 'Camisa de banda',
    cost: 20,
    increase: 40,
    type: 'roupa',
    purchased: false
  },
  {
    name: 'Blusa da Supreme',
    cost: 600,
    increase: 60,
    type: 'roupa',
    purchased: false
  },
  {
    name: 'Bolsa Balenciaga',
    cost: 2000,
    increase: 80,
    type: 'roupa',
    purchased: false
  },
  {
    name: 'Jordan S',
    cost: 2000,
    increase: 90,
    type: 'roupa',
    purchased: false
  },
  // eletrônicos
  {
    name: 'TV de tubo',
    cost: 80,
    increase: 40,
    type: 'eletrônico',
    purchased: false
  },
  {
    name: 'Celular da ASUS',
    cost: 520,
    increase: 30,
    type: 'eletrônico',
    purchased: false
  },
  {
    name: 'IPhone',
    cost: 1400,
    increase: 9,
    type: 'eletrônico',
    purchased: false
  },
  {
    name: 'Computador',
    cost: 800,
    increase: 60,
    type: 'Computador',
    purchased: false
  },
  {
    name: 'Playstation 1',
    cost: 30,
    increase: 40,
    type: 'eletrônico',
    purchased: false
  },
  {
    name: 'PC Gamer',
    cost: 4000,
    increase: 90,
    type: 'Computador',
    purchased: false
  },
  // imóveis
  {
    name: 'Apartamento longe da faculdade',
    cost: 600,
    increase: 60,
    type: 'imóvel',
    purchased: false
  },
  {
    name: 'Apartamento próximo à faculdade',
    cost: 1000,
    increase: 80,
    type: 'imóvel',
    purchased: false
  },
  {
    name: 'Casa Própria',
    cost: 800,
    increase: 90,
    type: 'imóvel',
    purchased: false
  },
  {
    name: 'Mansão',
    cost: 5000,
    increase: 90,
    type: 'imóvel',
    purchased: false
  },
  // automóveis
  {
    name: 'Lambreta',
    cost: 300,
    increase: 70,
    type: 'automóvel',
    purchased: false
  },
  {
    name: 'Fiat Uno',
    cost: 500,
    increase: 90,
    type: 'automóvel',
    purchased: false
  },
  {
    name: 'Hornet',
    cost: 500,
    increase: 90,
    type: 'automóvel',
    purchased: false
  },
  // extras
  {
    name: 'Twitter',
    cost: 10050,
    increase: 100,
    type: 'extra',
    purchased: false
  }
];

/* Sistema de compra */


// Função para comprar um item da loja
let media = 0;
let mediaFinal = 0;
let possessions = 0;

function buyItem(item) {
  if (inventory[item.name]) {
    alert("Você já comprou este item.");
    return;
  }
  if (item && !item.purchased) {
    if (money >= item.cost) {
      money -= item.cost;
      inventory[item.name] = true;

      var buttonId = item.name.replace(/ /g, "-").toLowerCase() + "-button";
      document.getElementById(buttonId).style.display = "none";
    } else {
      // Exiba uma mensagem de erro se o jogador não tiver dinheiro suficiente
      alert("Você não tem dinheiro suficiente para comprar " + item.name + ".");
    }
  }

  updateMoneyDisplay(); // Atualize a exibição do dinheiro após a compra
}

//Lista de comidas do restaurante

let food = [{
    name: 'Pão',
    cost: 1,
    increase: 3,
    type: 'padaria',
    hunger: 5
  },
  {
    name: 'Omelete',
    cost: 10,
    increase: 5,
    type: 'lanchonete',
    hunger: 35
  },
  {
    name: 'Petit Gateau',
    cost: 130,
    increase: 30,
    type: 'restaurante fino',
    hunger: 17
  }
]



//Diminui a fome comendo
function increaseHunger(amount) {
  fome += amount
  if (fome > 100) {
    fome = 100;
  }
  updateHunger();
}

// Renderiza a loja na interface
function renderShop() {
  shopContainer.innerHTML = "<h2>Loja</h2>";
  items.forEach((item) => {
    const button = document.createElement("button");
    button.textContent = `${item.name} ($${item.cost.toFixed(2)})`;
    button.addEventListener("click", () => buyItem(item));
    shopContainer.appendChild(button);
  });

  // Botões para jogar minijogos
  const musicGameButton = document.createElement("button");
  musicGameButton.textContent = "Jogar Minijogo de Música (+Felicidade)";
  musicGameButton.addEventListener("click", playMusicGame);
  shopContainer.appendChild(musicGameButton);

  // Botão para ativar evento de Natal
  const christmasButton = document.createElement("button");
  christmasButton.textContent = "Ativar Evento de Natal (+Felicidade)";
  christmasButton.addEventListener("click", activateChristmasEvent);
  shopContainer.appendChild(christmasButton);
}



/* Sistema de Felicidade  */



// Aumenta ou diminui a felicidade e atualiza a exibição
function increaseHappiness(amount) {
  happiness += amount;
  if (happiness > 100) {
    happiness = 100;
  }
  updateHappinessDisplay();
  updateStatus();
  showNotification(`Felicidade aumentou: +${amount.toFixed(2)}`);
}

// Dimnui a felicidade ao passar do tempo e atualiza a exibição
function decreaseHappiness() {
  if (happiness > 0) {
    happiness -= 0.1; // Reduzindo um valor constante para testar
    if (happiness > 100) {
      happiness = 100
    }
    updateHappinessDisplay(); // Atualiza a exibição da felicidade
    updateStatus(); // Atualiza o status na interface
  }
}

// Função para diminuir a felicidade ao longo do tempo
function decreaseHappinessOverTime() {
  if (happiness > 0) {
    happiness -= 0.2; // Reduzindo um valor constante para testar
  }else if (happiness <= 0) {
      happiness = 0;
      alert("Você chegou ao fundo do poço >:(");
      location.reload(); // atualiza a página após apertar ok
    }
    updateHappinessDisplay(); // Atualiza a exibição da felicidade
    updateStatus(); // Atualiza o status na interface  
}


// Chama a função decreaseHappinessOverTime a cada segundo (1000 milissegundos)
setInterval(decreaseHappinessOverTime, 1000); // 1000 milissegundos = 1 segundo


// Atualiza a exibição da felicidade na interface
function updateHappinessDisplay() {
  happinessDisplay.textContent = happiness.toFixed(2);
}

// Atualiza o status (estado de felicidade) na interface
function updateStatus() {
  if (happiness >= 75) {
    statusDisplay.textContent = "Feliz";
  } else if (happiness > 25) {
    statusDisplay.textContent = "Triste";
  } else {
    statusDisplay.textContent = "Depressivo";
  }
}

/* Execução em interface/Função  e eventos */


// Executa uma ação
function executeAction(action) {
  let income = action.income * (1 + (currentDifficulty * 0.1));
  resources += income;
  happiness += action.happiness;
  if (resources >= resourceGoal) {
    goalAchieved = true;
  }
  updateStatus();
}
// Atualiza o status no painel
function updateStatus() {
  document.getElementById("happiness").textContent = happiness;
}
// Atualiza a exibição do dinheiro na interface
function updateMoneyDisplay() {
  moneyDisplay.textContent = money.toFixed(2);
}
// Ativa o evento de Natal
function activateChristmasEvent() {
  events.christmas = true;
  showMessage("É Natal! Aproveite o evento especial e ganhe mais felicidade!");

  setTimeout(() => {
    events.christmas = false;
    showMessage("O evento de Natal acabou. A felicidade voltou ao normal.");
  }, 30000); // 30 segundos
}



// Função para mostrar uma notificação
function showNotification(message) {
  const notification = document.createElement("div");
  notification.className = "notification";
  notification.textContent = message;
  document.body.appendChild(notification);

  setTimeout(() => {
    document.body.removeChild(notification);
  }, 3000); // 3 segundos
}


/* MiniJogos */

// Funções para jogar minijogos

//Musica
function playMusicGame() {
  const correctNote = Math.floor(Math.random() * 3); // Nota correta (0 a 2)
  const userGuess = prompt("Tente adivinhar a nota correta: 0, 1 ou 2");

  if (userGuess === null) {
    showMessage("Você cancelou o minijogo de música.");
    return;
  }

  if (parseInt(userGuess) === correctNote) {
    increaseHappiness(20); // Aumentar a felicidade em 20 pontos se adivinhar corretamente
    alert("Você acertou a nota e se sentiu animado!");
  } else {
    decreaseHappiness(10); // Diminuir a felicidade em 10 pontos se errar
    alert("Você errou a nota e ficou um pouco frustrado.");
  }
}


//Basquete
function playBasketballMinigame() {

  const playerScore = Math.floor(Math.random() * 11); // Pontuação do jogador (0 a 10)
  const opponentScore = Math.floor(Math.random() * 11); // Pontuação do oponente (0 a 10)

  const minigameResult = document.createElement("div");
  minigameResult.innerHTML = `
            <p>Você jogou uma partida de basquete!</p>
            <p>Sua pontuação: ${playerScore}</p>
            <p>Pontuação do oponente: ${opponentScore}</p>
        `;

  const minigameContainer = document.getElementById("minigame-container");


  if (playerScore > opponentScore) {
    alert("Pontuação: Você " + playerScore + " X " + opponentScore + " Oponente\nVocê venceu o jogo de basquete e se sentiu empolgado!");
    increaseHappiness(10); // Aumentar a felicidade em 10 pontos se ganhar
  }
  if (playerScore < opponentScore) {
    alert("Pontuação: Você " + playerScore + " X " + opponentScore + " Oponente\nVocê perdeu o jogo de basquete e ficou um pouco frustrado.");
    decreaseHappiness(8); // Diminuir a felicidade em 8 pontos se perder
  } else {
    alert("Pontuação: Você " + playerScore + " X " + opponentScore + " Oponente\nEmpate! Ninguém ganhou ou perdeu, mas se divertiu jogando.");
    increaseHappiness(5); // Aumentar a felicidade em 5 pontos se ganhar
  }
}

//Truco
function playTrucoMinigame() {
  const playerScore = Math.floor(Math.random() * 11); // Pontuação do jogador (0 a 10)
  const opponentScore = Math.floor(Math.random() * 11); // Pontuação do oponente (0 a 10)

  const minigameResult = document.createElement("div");
  minigameResult.innerHTML = `
        <p>Você jogou uma partida de truco!</p>
        <p>Sua pontuação: ${playerScore}</p>
        <p>Pontuação do oponente: ${opponentScore}</p>
    `;

  const minigameContainer = document.getElementById("minigame-container");

  if (playerScore > opponentScore) {
    increaseHappiness(10); // Aumentar a felicidade em 10 pontos se ganhar
    alert("Você venceu o jogo de truco e se sentiu empolgado!");
  } else if (playerScore < opponentScore) {
    decreaseHappiness(8); // Diminuir a felicidade em 8 pontos se perder
    alert("Você perdeu o jogo de truco e ficou um pouco frustrado.");
  } else {
    alert("Empate! Ninguém ganhou ou perdeu, mas se divertiu jogando.");
  }
}

///Conquistas 
function checkAchievements() {
  for (const category in achievements) {
    const value = parseFloat(document.getElementById(category).textContent);
    for (const target in achievements[category]) {
      if (value >= parseFloat(target)) {
        const achievementName = achievements[category][target];
        alert(`Conquista desbloqueada: ${achievementName}`);
      }
    }
  }
}


function checkProgress() {
  const wisdom = parseFloat(document.getElementById("wisdom").textContent);
  const levelIndicator = document.getElementById("player-level");
  for (const level in levels) {
    if (wisdom >= parseFloat(level)) {
      levelIndicator.textContent = levels[level];
    }
  }

  for (const feature in unlockedFeatures) {
    if (wisdom >= parseFloat(feature)) {
      alert(`Novo recurso desbloqueado: ${unlockedFeatures[feature]}`);
    }
  }
}

// Função para exibir conquistas
function displayAchievements() {
  const achievementsList = document.getElementById("achievements-list");
  achievementsList.innerHTML = "";

  for (const category in achievements) {
    const value = parseFloat(document.getElementById(category).textContent);
    for (const target in achievements[category]) {
      if (value >= parseFloat(target)) {
        const achievementName = achievements[category][target];
        const achievementItem = document.createElement("li");
        achievementItem.textContent = achievementName;
        achievementsList.appendChild(achievementItem);
      }
    }
  }
}



/* Parte de exibição de interface */


// Chamando funções necessárias após o carregamento da página
document.addEventListener("DOMContentLoaded", () => {
  updateStatus();

  document.getElementById("school-button").addEventListener("click", function () {
    togglePopup("school-category", "school-button");
  });

  document.getElementById("work-button").addEventListener("click", function () {
    togglePopup("work-category", "work-button");
  });

  document.getElementById("minigames-button").addEventListener("click", function () {
    togglePopup("minigames-category", "minigames-button");
  });

  document.getElementById("school-button").addEventListener("click", () => {
    showCategory("school-category");
  });
  document.getElementById("work-button").addEventListener("click", () => {
    showCategory("work-category");
  });
  document.getElementById("minigames-button").addEventListener("click", () => {
    showCategory("minigames-category");
  });
  document.getElementById("shop-button").addEventListener("click", () => {
    showCategory("shop-category");
  });





});
// Chame showCategory assim que a página for carregada para exibir a categoria padrão
window.addEventListener("DOMContentLoaded", () => {
  showCategory("school-category");
});


/*
// Função para atualizar e exibir o nível do jogador
function updatePlayerLevel() {
  const wisdom = parseFloat(document.getElementById("wisdom").textContent);
  const levelIndicator = document.getElementById("player-level");
  for (const level in levels) {
    if (wisdom >= parseFloat(level)) {

    }
  }
}*/


//Serviço Pisicologo

function choosePath(choice) {
  const storyElement = document.getElementById('story');
  const choicesElement = document.getElementById('choices');

  if (choice === 1) {
    storyElement.innerHTML = "Você entra na floresta escura, onde criaturas misteriosas espreitam.";
    choicesElement.innerHTML = `
      <p>O que você faz a seguir?</p>
      <button onclick="continueStory(1)">Explorar mais fundo</button>
      <button onclick="continueStory(2)">Montar acampamento</button>
    `;
  } else if (choice === 2) {
    storyElement.innerHTML = "Você começa a subir a montanha íngreme, enfrentando ventos gelados.";
    choicesElement.innerHTML = `
      <p>Como você deseja proceder?</p>
      <button onclick="continueStory(3)">Escalar com cautela</button>
      <button onclick="continueStory(4)">Procurar outro caminho</button>
    `;
  }
}

function continueStory(choice) {
  const storyElement = document.getElementById('story');
  const choicesElement = document.getElementById('choices');

  if (choice === 1) {
    storyElement.innerHTML = "Enquanto explora, você encontra uma antiga relíquia perdida.";
    choicesElement.innerHTML = `
      <p>Sua descoberta desperta a atenção de caçadores de tesouros. O que você faz?</p>
      <button onclick="endGame('Derrota')">Lutar contra eles</button>
      <button onclick="endGame('Vitória')">Tentar negociar</button>
    `;
  } else if (choice === 2) {
    storyElement.innerHTML = "Você monta acampamento e passa uma noite tranquila na floresta.";
    choicesElement.innerHTML = `
      <p>Na manhã seguinte, você decide:</p>
      <button onclick="endGame('Derrota')">Continuar explorando</button>
      <button onclick="endGame('Vitória')">Retornar à cidade</button>
    `;
  }
  // E assim por diante...
}

function endGame(result) {
  const storyElement = document.getElementById('story');
  const choicesElement = document.getElementById('choices');

  storyElement.innerHTML = `Fim de jogo. Resultado: ${result}`;
  choicesElement.innerHTML = ''; // Remover os botões
}

// Função para atualizar os elementos na página com base nas variáveis
function updateStatusAndGoals() {
  document.getElementById("wisdom").textContent = wisdom;
  document.getElementById("job").textContent = job;
  document.getElementById("money").textContent = money.toFixed(2);
  document.getElementById("happiness").textContent = happiness.toFixed(2);
  document.getElementById("status").textContent = status;

}

// Chamando a função inicial para exibir os valores iniciais
updateStatusAndGoals();




/* Interface Avatar */

// Avatar
function toggleAvatarOptions() {
  const avatarOptions = document.getElementById("avatar-options");
  avatarOptions.style.display = avatarOptions.style.display === "block" ? "none" : "block";
}

function changeAvatar(newAvatar) {
  const avatarImage = document.getElementById("avatar-image");
  avatarImage.src = newAvatar;

  const avatarOptions = document.getElementById("avatar-options");
  avatarOptions.style.display = "none";
}

let activePopupId = null; // Variável para rastrear o pop-up ativo

// Função para mostrar um pop-up ao lado do botão clicado
function showPopup(popupId, buttonId) {
  const popup = document.getElementById(popupId);
  const button = document.getElementById(buttonId);

  // Posiciona o pop-up ao lado do botão
  const buttonRect = button.getBoundingClientRect();
  popup.style.left = buttonRect.right + "px";
  popup.style.top = buttonRect.top + "px";

  popup.style.display = "block";
}

// Função para esconder um pop-up
function hidePopup(popupId) {
  const popup = document.getElementById(popupId);
  popup.style.display = "none";
}

function togglePopup(popupId, buttonId) {
  var popup = document.getElementById(popupId);

  if (popup.style.display === "block") {
    popup.style.display = "none";
  } else {
    // Fecha o popup ativo, se houver um
    if (activePopupId !== null) {
      hidePopup(activePopupId);
    }

    popup.style.display = "block";

  }
}

document.addEventListener("DOMContentLoaded", function () {
  const popupButtons = document.querySelectorAll(".popup-button");

  popupButtons.forEach(button => {
    button.addEventListener("click", function () {
      const targetId = this.getAttribute("data-target");
      togglePopup(targetId);
    });
  });

  // Fecha o pop-up ativo quando se clica fora dele
  window.addEventListener("click", function (event) {
    if (activePopupId !== null && !event.target.closest(".popup")) {
      hidePopup(activePopupId);
    }
  });
});

function showSchoolPopup() {
  var button = document.getElementById("school-button");
  var popup = document.getElementById("school-category");

  var buttonRect = button.getBoundingClientRect();
  popup.style.top = buttonRect.top + "px";
  popup.style.left = buttonRect.right + "px";

  popup.style.display = "block";
}


document.getElementById("school-button").addEventListener("click", () => {
  showCategory("school-category");
  showStudyButton(); // Mostra o botão de estudar na categoria da faculdade
});

// Função para mostrar o botão de estudar na categoria da faculdade
function showStudyButton() {
  const studyButton = document.getElementById("studyButton");
  studyButton.style.display = "block";
}

// Função para esconder o botão de estudar
function hideStudyButton() {
  const studyButton = document.getElementById("studyButton");
  studyButton.style.display = "none";
}

// Associa a função ao botão "Ir para a Faculdade"
document.getElementById("school-button").addEventListener("click", () => {
  showCategory("school-category");
  showStudyButton(); // Mostra o botão de estudar na categoria da faculdade
});




// Aumenta a sabedoria
function increaseWisdom(amount) {
  wisdom += amount;
  wisdomDisplay.textContent = wisdom; // Update the wisdom display
}


// Função para mostrar o pop-up de estudar na faculdade
function showStudyPopup() {
  const studyPopup = document.getElementById("studyPopup");
  studyPopup.style.display = "block";

}

// Função para esconder o pop-up de estudar
function hideStudyPopup() {
  const studyPopup = document.getElementById("studyPopup");
  studyPopup.style.display = "none";
}

// Associa a função ao botão "Ir para a Faculdade"
document.getElementById("school-button").addEventListener("click", () => {
  showCategory("school-category");
  showStudyPopup(); // Mostra o pop-up de estudar
});


// Função para exibir os itens da loja de roupas
function showClothingItems() {
  var clothingCategory = document.getElementById('Roupa-category');
  clothingCategory.classList.add('show');
}

// Função para ocultar a categoria de roupas
function hideClothingItems() {
  var clothingCategory = document.getElementById('Roupa-category');
  clothingCategory.classList.remove('show');
}


setInterval(decreaseHappiness, 1000); // 1000 milissegundos = 1 segundo



const increaseWisdomButton = document.getElementById("increaseWisdomButton");




// Atualiza a exibição da felicidade
function updateHappinessDisplay() {
  var happinessDisplay = document.getElementById("happiness");
  happinessDisplay.textContent = happiness.toFixed(2); // Formata para dois dígitos decimais
}

// Atualiza a exibição do status baseado no valor da felicidade
function updateStatus() {
  var statusDisplay = document.getElementById("status");
  if (happiness > 75) {
    statusDisplay.textContent = "Muito feliz!";
  } else if (happiness > 50) {
    statusDisplay.textContent = "Feliz";
  } else if (happiness > 25) {
    statusDisplay.textContent = "Infeliz";
  } else {
    statusDisplay.textContent = "Muito infeliz...";
  }
}

/* Musica Jogo */


//Musica
const musicToggle = document.getElementById("music-toggle");
const backgroundMusic = document.getElementById("background-music");

const musicSources = [
  "../JOgo/Musica/AudioTodo.mp3" // URL da primeira música
];

let currentMusicIndex = 0;

function playCurrentMusic() {
  backgroundMusic.src = musicSources[currentMusicIndex];
  backgroundMusic.play();
}

musicToggle.addEventListener("change", () => {
  if (musicToggle.checked) {
    playCurrentMusic();
  } else {
    backgroundMusic.pause();
  }
});

backgroundMusic.addEventListener("ended", () => {
  // Ao finalizar a música, alterna para a próxima música
  currentMusicIndex = (currentMusicIndex + 1) % musicSources.length;
  if (musicToggle.checked) {
    playCurrentMusic();
  }
});


const wisdomIncrement = 20; // Quanto a sabedoria aumenta quando a barra estiver cheia
const wisdomIncrementSenai = 10;
const wisdomIncrementCurso = 10;
const wisdomIncrementPos = 25;
let progressWidth = 0; // Largura inicial da barra de progresso
let canGainWisdom = false; // Variável para controlar se pode ganhar sabedoria
let canGainWisdomCurso = false;
let canGainWisdomPos = false;

function study() {

  if (wisdom >= 120 && wisdom < 300) {
    progressWidth += 10;
    updateProgressBar();
    happiness -= 1;

    if (progressWidth >= 100) {
      canGainWisdom = true;
      updateHappinessDisplay();
    }
  } else if (wisdom < 120) {
    alert("Você precisa se formar no Senai para fazer Faculdade");
  } else if (wisdom >= 300) {
    alert("Você já se formou na Faculdade");
    document.getElementById("study").style.display = "none"; // Oculta o botão com ID "study"
  }

  if (canGainWisdom) {
    gainWisdom();
  }
}

function studySenai() {
  if (wisdom >= 50 && wisdom < 120) {
    progressWidth += 20;
    updateProgressBar();
    happiness -= 0.7;

    if (progressWidth >= 100) {
      canGainWisdomSenai = true;
      updateHappinessDisplay();

      // Mostra o botão quando a sabedoria atinge o nível necessário
      document.getElementById("studySenai").style.display = "block";
    }
  } else if (wisdom < 50) {
    alert("Você precisa se formar no Curso para fazer Senai");
  } else if (wisdom >= 120) {
    alert("Você já se formou no Senai");
    document.getElementById("studySenai").style.display = "none"; // Oculta o botão com ID "studySenai"
  }

  if (canGainWisdomSenai) {
    gainWisdomSenai();
  }
}


function studyCurso() {
  if (wisdom < 50) {
    progressWidth += 25;
    updateProgressBar();
    happiness -= 0.3;

    if (progressWidth >= 100) {
      canGainWisdomCurso = true;
      updateHappinessDisplay();

      // Mostra o botão quando a sabedoria atinge o nível necessário
      document.getElementById("studyCurso").style.display = "block";
    }
  } else {
    alert("Você já se formou no Curso");
    document.getElementById("studyCurso").style.display = "none"; // Oculta o botão com ID "studyCurso"
  }

  if (canGainWisdomCurso) {
    gainWisdomCurso();
  }
}


function studyPos() {
  if (wisdom >= 300 && wisdom < 750) {
    progressWidth += 5;
    updateProgressBar();
    happiness -= 0.6;

    if (progressWidth >= 100) {
      canGainWisdomPos = true;
      updateHappinessDisplay();

      // Mostra o botão quando a sabedoria atinge o nível necessário
      document.getElementById("studyPos").style.display = "block";
    }
  } else if (wisdom < 300) {
    alert("Você precisa se formar na Faculdade para fazer Pós Graduação");
  } else if (wisdom >= 750) {
    alert("Você já terminou sua Pós Graduação");
    document.getElementById("studyPos").style.display = "none"; // Oculta o botão com ID "studyPos"
  }

  if (canGainWisdomPos) {
    gainWisdomPos();
  }
}


// Função para ganhar sabedoria
function gainWisdom() {
  if (canGainWisdom) {
    wisdom += wisdomIncrement; // Ganha sabedoria quando a barra estiver cheia
    progressWidth = 0; // Resseta a largura da barra
    canGainWisdom = false;
    updateProgressBar();
    updateWisdomDisplay();
  }
}

function gainWisdomSenai() {
  if (canGainWisdomSenai) {
    wisdom += wisdomIncrementSenai; // Ganha sabedoria quando a barra estiver cheia
    progressWidth = 0; // Resseta a largura da barra
    canGainWisdomSenai = false;
    updateProgressBar();
    updateWisdomDisplay();
  }
}

function gainWisdomCurso() {
  if (canGainWisdomCurso) {
    wisdom += wisdomIncrementCurso; // Ganha sabedoria quando a barra estiver cheia
    progressWidth = 0; // Resseta a largura da barra
    canGainWisdomCurso = false;
    updateProgressBar();
    updateWisdomDisplay();
  }
}

function gainWisdomPos() {
  if (canGainWisdomPos) {
    wisdom += wisdomIncrementPos; // Ganha sabedoria quando a barra estiver cheia
    if (wisdom > 750) {
      wisdom = 750;
    }
    progressWidth = 0; // Resseta a largura da barra
    canGainWisdomPos = false;
    updateProgressBar();
    updateWisdomDisplay();
  }
}


// Função para atualizar a barra de progresso de sabedoria
function updateProgressBar() {
  const progressBar = document.getElementById('wisdom-bar');
  progressBar.style.width = progressWidth + '%'; // Define a largura da barra de progresso
}

// Função para atualizar o valor da sabedoria na página
function updateWisdomDisplay() {
  const wisdomSpan = document.getElementById('wisdom');
  wisdomSpan.textContent = wisdom; // Atualiza o valor da sabedoria na página
}

// Chamada inicial para atualizar a barra de progresso
updateProgressBar();
updateWisdomDisplay();

//Historia 
const dialogues = [{
  text: "Você encontrou um livro interessante",
  choices: [{
    text: "Ótimo!",
    wisdomChange: 10
  },
  {
    text: "Legal!",
    wisdomChange: 10
  },
  ],
},   

{
  text: "Você teve um dia estressante no trabalho",
  choices: [{
    text: "Que pena.",
    happinessChange: -5
  },
  {
    text: "Vai passar.",
    happinessChange: -5
  },
  ],
},

{
  text: "Você está em um café tomando um cafézinho, o que deseja fazer agora?",
  choices: [{
    text: "Continuar trabalhando em casa.",
    happinessChange: 5,
    wisdomChange: 5
  },
  {
    text: "Voltar ao escritório.",
    happinessChange: -5,
    wisdomChange: 15
  }
  ]
}
];
   
  let currentDialogueIndex = 0;

  function handleChoice(choiceIndex) {
  const choice = dialogues[currentDialogueIndex].choices[choiceIndex];
   
    // Atualize o estado do jogador com base nas mudanças de bem-estar e sabedoria
    player.happiness += choice.happinessChange;
    increaseHappiness(happinessChange); 
    player.wisdom += choice.wisdomChange;
    increaseWisdom(wisdomChange);

    updateHappiness();
    updateHappinessDisplay();
    updateProgressBar();
    updateWisdomDisplay();
   
    // Verifique se há um próximo diálogo e, se sim, atualize o índice atual do diálogo
    if (currentDialogueIndex < dialogues.length - 1) {
       currentDialogueIndex++;
    }
   
    // Retorne o próximo diálogo
    return dialogues[currentDialogueIndex];
   }
   
   const dialogPopup = document.getElementById("dialog-popup");
   const dialogueText = document.getElementById("dialogue-text");
   const choice1Button = document.getElementById("dialogue-choice-1");
   const choice2Button = document.getElementById("dialogue-choice-2");
   const closeDialogButton = document.getElementById("close-dialog-button");
   
   function getRandomDialogue() {
    const randomIndex = Math.floor(Math.random() * dialogues.length);
    return dialogues[randomIndex];
   }
   
   function displayDialogue(dialogue) {
    dialogueText.textContent = dialogue.text;
    choice1Button.textContent = dialogue.choices[0].text;
    choice2Button.textContent = dialogue.choices[1].text;
    dialogPopup.style.display = "block";
   }
   
   function makeChoice(choiceIndex) {
    const dialogue = handleChoice(choiceIndex);
    // Lógica para aplicar as mudanças com base na escolha
    // Atualize os atributos do jogador aqui
    displayDialogue(dialogue);
   }
   
   function closeDialog() {
    dialogPopup.style.display = "none";
   }
   
   choice1Button.addEventListener("click", () => makeChoice(0));
   choice2Button.addEventListener("click", () => makeChoice(1));
   closeDialogButton.addEventListener("click", closeDialog);
   
   const showDialogButton = document.getElementById("show-dialog-button");
   showDialogButton.addEventListener("click", () => {
    const initialDialogue = getRandomDialogue();
    displayDialogue(initialDialogue);
   });






//Serviços 

// Variável para controlar se o usuário assinou o serviço de psicólogo
let assinouPsicologo = false;
// Variável para controlar se a assinatura está ativa
let assinaturaAtiva = false;


// Função para assinar o serviço de psicólogo
function subscribePsicologo() {
  if (!assinouPsicologo) {
    if (money >= 50) {
      // Verifica se o usuário já assinou e tem saldo suficiente
      assinouPsicologo = true;
      money -= 50; // Deduz o valor da assinatura do saldo
      alert("Você assinou o serviço de Psicólogo.");
      assinaturaAtiva = true;
      // Mostrar o botão "Mostrar Diálogo" após a assinatura
      document.getElementById("show-dialog-button").style.display = "block";
      // Atualiza o saldo exibido na página
      updateMoneyDisplay();
    } else {
      alert("Você não tem saldo suficiente para assinar o serviço de Psicólogo.");
    }
  } else {
    alert("Você já assinou o serviço de Psicólogo.");
  }
}

// Chame a função para exibir o saldo inicial
updateMoneyDisplay();

//Barras


function buyFood(index) {
  if (money >= food[index].cost) {
    // Reduza o dinheiro do jogador
    money -= food[index].cost;
    document.getElementById("money").textContent = money.toFixed(2);

    // Aumente o valor da fome com o aumento específico do item
    currentHunger += food[index].hunger;

    // Certifique-se de que a fome não ultrapasse 100%
    if (currentHunger > 100) {
      currentHunger = 100;
    }

    // Aumente a felicidade com base na comida comprada
    happiness += food[index].increase;

    // Certifique-se de que a felicidade não ultrapasse 100%
    if (happiness > 100) {
      happiness = 100;
    }

    // Atualize a barra de fome
    updateHungerBar();

    // Atualize a barra de felicidade
    updateHappinessBar();
  } else { 
    alert("Você não tem dinheiro suficiente para comprar comida.");
  }
}

// Função para atualizar a barra de felicidade
function updateHappiness() {
  var happinessBar = document.getElementById("happiness-bar");
  var happinessPercentage = parseFloat(document.getElementById("happiness").textContent); // Porcentagem de felicidade

  // Definir a largura da barra de felicidade de acordo com a porcentagem
  happinessBar.style.width = happinessPercentage + "%";
  // Chamar a função novamente após um intervalo de tempo (por exemplo, 1 segundo)
  setTimeout(updateHappiness, 1000); // Atualize a cada segundo
}

// Chame a função para iniciar a atualização da felicidade
updateHappiness();



//DAY

let currentDay = 1;
const progressBar = document.getElementById("day-progress");
const dayCounter = document.getElementById("day-counter");
const maxProgressWidth = progressBar.parentElement.clientWidth; // Largura máxima da barra de progresso

// Função para atualizar a barra de progresso
function updateProgressBarDay() {
  progressBar.style.width = "0";
  const interval = 10000; // Intervalo em milissegundos (45 segundos por dia)
  const progressIncrement = (maxProgressWidth / interval) * 1000; // Incremento de progresso por milissegundo

  let currentProgress = 0;
  let intervalId;

  function update() {
    currentProgress += progressIncrement;
    progressBar.style.width = currentProgress + "px";

    if (currentProgress >= maxProgressWidth) {
      clearInterval(intervalId); // Pare o intervalo quando a barra estiver cheia
      currentProgress = 0; // Reinicie o progresso
      passDay(); // Avance para o próximo dia
      updateDay(); // Atualize a exibição do dia
      setTimeout(() => {
        intervalId = setInterval(update, 1000); // Reinicie o intervalo após 1 segundo
      }, 1000);
    }
  }
  if (currentDay % 7 === 0) {
    // A cada 7 dias, aplique o desconto no aluguel
    applyRentDiscount();
  }

  intervalId = setInterval(update, 1000); // Inicie o intervalo com intervalo de 1 segundo
}

// Função para avançar para o próximo dia
function passDay() {
  currentDay++; // Incrementa o dia atual
  // Adicione aqui a lógica adicional para o início de um novo dia


}

// Função para atualizar o contador de dias
function updateDay() {
  dayCounter.textContent = "Dia " + currentDay;

}

// Chame a função para iniciar a barra de progresso
updateProgressBarDay();


// Variável para rastrear a felicidade diária do jogador
let dailyHappiness = [];
//Decrementa o dinheiro e seta a fecilidade semanalmente
function weeklyDecrease() {
  if (currentDay % 3 == 0) {
    mediaFinal = media / possessions;
    happiness = mediaFinal;
    updateHappinessDisplay();
  }
}

// Se passaram 7 dias, recalcule a felicidade média e atualize a felicidade do jogador
if (currentDay % 7 === 0) {
  const averageHappiness = calculateAverageHappiness();
  Happiness = averageHappiness; // Atualize a felicidade atual do jogador
  dailyHappiness = []; // Limpe a lista de felicidade diária para os próximos 7 dias
}


// Função para calcular a média da felicidade
function calculateAverageHappiness() {
  const sum = dailyHappiness.reduce((total, happiness) => total + happiness, 0);
  const average = sum / dailyHappiness.length;
  return average;
}

//MAnutençãp

function makeWeeklyPayments() {
  if (player.propertyOwned) {
    // Fazer o pagamento do imóvel a cada 7 dias
    player.money -= items.find(item => item.type === 'imóvel').cost;
  }
  if (player.carOwned) {
    // Fazer o pagamento do automóvel a cada 7 dias
    player.money -= items.find(item => item.type === 'automóvel').cost;
  }
  updatePlayerStatus();
}

function enableProgrammingJob() {
  const computerItem = items.find(item => item.name === 'Computador');
  if (computerItem && computerItem.purchased) {
    // Mostrar o botão do trabalho de programador
    const programmerOption = document.getElementById('programmerOption');
    const startProgrammingJobButton = document.getElementById('startProgrammingJob');

    if (programmerOption && startProgrammingJobButton) {
      programmerOption.style.display = 'block';
      startProgrammingJobButton.style.display = 'block';
    }
  }
}

const computerItem = items.find(item => item.type === 'Computador');
if (computerItem && computerItem.purchased) {
  // Mostrar o botão do trabalho de programador
  const programmerOption = document.getElementById('programmerOption');
  const startProgrammingJobButton = document.getElementById('startProgrammingJob');

  if (programmerOption && startProgrammingJobButton) {
    programmerOption.style.display = 'block';
    startProgrammingJobButton.style.display = 'block';
  }
}

function buyComputer() {
  var itemName = "Computador";
  // Verifique se o jogador tem dinheiro suficiente para comprar o computador
  var money = parseFloat(document.getElementById("money").textContent);
  var computerCost = 800; // O custo do computador
  const happinessIncrease = 60; // Aumento na felicidade ao comprar um Computador

  if (inventory[itemName]) {
    alert("Você já comprou este item.");
    return;
  }

  if (money >= computerCost) {
    // Reduza o dinheiro do jogador
    money -= computerCost;
    document.getElementById("money").textContent = money.toFixed(2);

    // Aumente a felicidade do jogador
    increaseHappiness(happinessIncrease);

    // Libere o trabalho de programador
    document.getElementById("programmerOption").style.display = "block";

    // Exiba uma mensagem de sucesso
    alert("Você comprou um computador e agora pode trabalhar como programador!");
    inventory[itemName] = true;
    document.getElementById("buy-computer-button").style.display = "none";
  } else {
    // Exiba uma mensagem de erro se o jogador não tiver dinheiro suficiente
    alert("Você não tem dinheiro suficiente para comprar este item!");
  }
}

// Função para comprar um carro
function buyCar() {
  var itemName = "Fiat Uno";
  // Verifique se o jogador tem dinheiro suficiente para comprar um carro
  var money = parseFloat(document.getElementById("money").textContent);
  var carCost = 1000; // O custo de um carro
  const happinessIncrease = 90; // Aumento na felicidade ao comprar um Fiat Uno

  if (inventory[itemName]) {
    alert("Você já comprou este item.");
    return;
  }

  if (money >= carCost) {
    // Reduza o dinheiro do jogador
    money -= carCost;
    document.getElementById("money").textContent = money.toFixed(2);

    // Aumente a felicidade do jogador
    increaseHappiness(happinessIncrease);

    // Libere a opção de se tornar um motorista Uber
    document.getElementById("uberOption").style.display = "block";

    // Exiba uma mensagem de sucesso
    alert("Você comprou um carro e agora pode trabalhar como motorista Uber!");
    inventory[itemName] = true;
    document.getElementById("buy-fiatUno-button").style.display = "none";
  } else {
    // Exiba uma mensagem de erro se o jogador não tiver dinheiro suficiente
    alert("Você não tem dinheiro suficiente para comprar este item!");
  }
}


// Função para comprar uma camisa de time
function buyShirt() {
  var itemName = "Camisa do seu time de coração";
  // Verifique se o jogador tem dinheiro suficiente para comprar uma camisa de time
  var money = parseFloat(document.getElementById("money").textContent);
  var shirtCost = 50; // O custo de uma camisa de time
  const happinessIncrease = 40; // Aumento na felicidade ao comprar uma camisa de time

  if (inventory[itemName]) {
    alert("Você já comprou este item.");
    return;
  }

  if (money >= shirtCost) {
    // Reduza o dinheiro do jogador
    money -= shirtCost;
    document.getElementById("money").textContent = money.toFixed(2);

    // Aumente a felicidade do jogador
    increaseHappiness(happinessIncrease);

    // Libere a opção de se tornar líder de torcida organizada
    document.getElementById("cheerleaderOption").style.display = "block";


    // Exiba uma mensagem de sucesso
    alert("Você comprou uma camisa de time e agora pode se tornar líder de torcida organizada!");
    inventory[itemName] = true;
    document.getElementById("buy-shirt-button").style.display = "none";
  } else {
    // Exiba uma mensagem de erro se o jogador não tiver dinheiro suficiente
    alert("Você não tem dinheiro suficiente para comprar este item!");
  }
}

// Função para comprar uma camisa de banda
function buyBandShirt() {
  var itemName = "Camisa de banda";
  // Verifique se o jogador tem dinheiro suficiente para comprar uma camisa de banda
  var money = parseFloat(document.getElementById("money").textContent);
  var bandShirtCost = 60; // O custo de uma camisa de banda
  const happinessIncrease = 40; // Aumento na felicidade ao comprar uma camisa de banda

  if (inventory[itemName]) {
    alert("Você já comprou este item.");
    return;
  }

  if (money >= bandShirtCost) {
    // Reduza o dinheiro do jogador
    money -= bandShirtCost;
    document.getElementById("money").textContent = money.toFixed(2);

    // Aumente a felicidade do jogador
    increaseHappiness(happinessIncrease);

    // Libere a opção de se tornar roadie
    document.getElementById("roadieOption").style.display = "block";

    // Exiba uma mensagem de sucesso
    alert("Você comprou uma camisa de banda e agora pode se tornar roadie de banda!");
    inventory[itemName] = true;
    document.getElementById("buy-band-shirt-button").style.display = "none";
  } else {
    // Exiba uma mensagem de erro se o jogador não tiver dinheiro suficiente
    alert("Você não tem dinheiro suficiente para comprar este item!");
  }
}

// Função para comprar uma camisa da Supreme
function buySupremeShirt() {
  var itemName = "Camisa da Supreme";
  // Verifique se o jogador tem dinheiro suficiente para comprar uma camisa de banda
  var money = parseFloat(document.getElementById("money").textContent);
  var SupremeShirt = 600; // O custo de uma camisa de banda
  const happinessIncrease = 60; // Aumento na felicidade ao comprar a blusa da supremee

  if (inventory[itemName]) {
    alert("Você já comprou este item.");
    return;
  }

  if (money >= SupremeShirt) {
    // Reduza o dinheiro do jogador
    money -= SupremeShirt;
    document.getElementById("money").textContent = money.toFixed(2);

    // Aumente a felicidade do jogador
    increaseHappiness(happinessIncrease);

    // Libere a opção de se tornar roadie
    document.getElementById("VendedorSupreme").style.display = "block";

    // Exiba uma mensagem de sucesso
    alert("Você comprou uma blusa da supreme e agora pode se tornar vendedor(a) da Supreme Outlet!");
    inventory[itemName] = true;
    document.getElementById("buy-Supreme-shirt-button").style.display = "none";
  } else {
    // Exiba uma mensagem de erro se o jogador não tiver dinheiro suficiente
    alert("Você não tem dinheiro suficiente para comprar este item!");
  }
}

// Função para comprar uma Jordan S
function buyJordan() {
  var itemName = "Jordan S";
  // Verifique se o jogador tem dinheiro suficiente para comprar uma camisa de banda
  var money = parseFloat(document.getElementById("money").textContent);
  var Jordan = 2000; // O custo de uma camisa de banda
  const happinessIncrease = 90; // Aumento na felicidade ao comprar o Jordan S


  if (inventory[itemName]) {
    alert("Você já comprou este item.");
    return;
  }

  if (money >= Jordan) {
    // Reduza o dinheiro do jogador
    money -= Jordan;
    document.getElementById("money").textContent = money.toFixed(2);

    // Aumente a felicidade do jogador
    increaseHappiness(happinessIncrease);

    // Libere a opção de se tornar roadie
    document.getElementById("atleta").style.display = "block";

    // Exiba uma mensagem de sucesso
    alert("Você comprou um tenis Jordan e agora pode se tornar atleta!");
    inventory[itemName] = true;
    document.getElementById("buy-JordanS-button").style.display = "none";
  } else {
    // Exiba uma mensagem de erro se o jogador não tiver dinheiro suficiente
    alert("Você não tem dinheiro suficiente para comprar este item!");
  }
}

// Função para comprar uma bolsa da balenciaga
function buyBalenciaga() {
  var itemName = "Bolsa da Balenciaga";
  // Verifique se o jogador tem dinheiro suficiente para comprar uma camisa de banda
  var money = parseFloat(document.getElementById("money").textContent);
  var Balenciaga = 2000; // O custo de uma camisa de banda
  const happinessIncrease = 80; // Aumento na felicidade ao comprar a Bolsa da Balenciaga


  if (inventory[itemName]) {
    alert("Você já comprou este item.");
    return;
  }

  if (money >= Balenciaga) {
    // Reduza o dinheiro do jogador
    money -= Balenciaga;
    document.getElementById("money").textContent = money.toFixed(2);

    // Aumente a felicidade do jogador
    increaseHappiness(happinessIncrease);

    // Libere a opção de se tornar roadie
    document.getElementById("modelo").style.display = "block";

    // Exiba uma mensagem de sucesso
    alert("Você comprou uma Bolsa da Balenciaga e agora pode se tornar modelo!");
    inventory[itemName] = true;
    document.getElementById("buy-Balenciaga-button").style.display = "none";
  } else {
    // Exiba uma mensagem de erro se o jogador não tiver dinheiro suficiente
    alert("Você não tem dinheiro suficiente para comprar este item!");
  }
}
// Função para comprar um carro
function buyMoto() {
  var itemName = "Lambreta";
  // Verifique se o jogador tem dinheiro suficiente para comprar um carro
  var money = parseFloat(document.getElementById("money").textContent);
  var MotoLCost = 299; // O custo de uma Lambreta
  const happinessIncrease = 70; // Aumento na felicidade ao comprar a Lambreta

  if (inventory[itemName]) {
    alert("Você já comprou este item.");
    return;
  }

  if (money >= MotoLCost) {
    // Reduza o dinheiro do jogador
    money -= MotoLCost;
    document.getElementById("money").textContent = money.toFixed(2);

    // Aumente a felicidade do jogador
    increaseHappiness(happinessIncrease);

    // Libere a opção de se tornar um motorista Uber
    document.getElementById("motoboyOP").style.display = "block";

    // Exiba uma mensagem de sucesso
    alert("Você comprou uma lambreta e agora pode se tornar motoboy!");
    inventory[itemName] = true;
    document.getElementById("buy-Lambreta-button").style.display = "none";
  } else {
    // Exiba uma mensagem de erro se o jogador não tiver dinheiro suficiente
    alert("Você não tem dinheiro suficiente para comprar este item!");
  }
}


// Função para comprar um iphone
function buyIphone() {
  var itemName = "IPhone";
  // Verifique se o jogador tem dinheiro suficiente para comprar uma camisa de banda
  var money = parseFloat(document.getElementById("money").textContent);
  var IPhone = 920; // O custo de uma camisa de banda
  const happinessIncrease = 90; // Aumento na felicidade ao comprar o Iphone

  if (inventory[itemName]) {
    alert("Você já comprou este item.");
    return;
  }

  if (money >= IPhone) {
    // Reduza o dinheiro do jogador
    money -= IPhone;
    document.getElementById("money").textContent = money.toFixed(2);

    // Aumente a felicidade do jogador
    increaseHappiness(happinessIncrease);

    // Libere a opção de se tornar roadie
    document.getElementById("Insta").style.display = "block";

    // Exiba uma mensagem de sucesso
    alert("Você comprou um iphone e agora pode se tornar instagrammer!");
    inventory[itemName] = true;
    document.getElementById("buy-IPhone-button").style.display = "none";
  } else {
    // Exiba uma mensagem de erro se o jogador não tiver dinheiro suficiente
    alert("Você não tem dinheiro suficiente para comprar este item!");
  }
}


// Função para comprar um ps1
function buyPS1() {
  var itemName = "Playstation1";
  // Verifique se o jogador tem dinheiro suficiente para comprar uma camisa de banda
  var money = parseFloat(document.getElementById("money").textContent);
  var Playstation = 350; // O custo de uma camisa de banda
  const happinessIncrease = 40; // Aumento na felicidade ao comprar o PS1

  if (inventory[itemName]) {
    alert("Você já comprou este item.");
    return;
  }

  if (money >= Playstation) {
    // Reduza o dinheiro do jogador
    money -= Playstation;
    document.getElementById("money").textContent = money.toFixed(2);

    // Aumente a felicidade do jogador
    increaseHappiness(happinessIncrease);

    // Libere a opção de se tornar roadie
    document.getElementById("youtuber").style.display = "block";

    // Exiba uma mensagem de sucesso
    alert("Você comprou um playstation 1 e agora pode se tornar youtuber!");
    inventory[itemName] = true;
    document.getElementById("buy-Playstation1-button").style.display = "none";
  } else {
    // Exiba uma mensagem de erro se o jogador não tiver dinheiro suficiente
    alert("Você não tem dinheiro suficiente para comprar este item!");
  }
}

// Função para comprar um celular da ASUS
function buyAsus() {
  const itemName = "Celular da ASUS";
  const asusCost = 120; // Custo de um celular da ASUS
  const happinessIncrease = 20; // Aumento na felicidade ao comprar o celular da ASUS

  if (inventory[itemName]) {
    alert("Você já comprou este item.");
    return;
  }

  if (money >= asusCost) {
    money -= asusCost; // Reduz o dinheiro do jogador pelo custo do celular da ASUS
    document.getElementById("money").textContent = money.toFixed(2);

    // Aumente a felicidade do jogador
    increaseHappiness(happinessIncrease);

    // Libere a opção de se tornar tiktoker
    document.getElementById("tiktoker").style.display = "block";

    // Exiba uma mensagem de sucesso
    alert("Você comprou um celular da ASUS e agora pode se tornar um tiktoker!");
    inventory[itemName] = true;

    // Oculte o botão de compra do celular da ASUS, se necessário
    document.getElementById("buy-Asus-button").style.display = "none";

    // Adicione um evento de clique ao botão do tiktoker
    document.getElementById("tiktoker").addEventListener("click", () => {
      changeJob("Tiktoker");
    });
  } else {
    // Exiba uma mensagem de erro se o jogador não tiver dinheiro suficiente
    alert("Você não tem dinheiro suficiente para comprar este item.");
  }
}

// Evento de mudança no select de trabalho
document.getElementById("jobSelect").addEventListener("change", function () {

  const selectedJob = this.value;
});





// Função para comprar uma hornet
function buyHornet() {
  var itemName = "Hornet";
  // Verifique se o jogador tem dinheiro suficiente para comprar uma hornet
  var money = parseFloat(document.getElementById("money").textContent);
  var Hornet = 1000; // O custo de uma hornet
  const happinessIncrease = 90; // Aumento na felicidade ao comprar uma hornet

  if (inventory[itemName]) {
    alert("Você já comprou este item.");
    return;
  }

  if (money >= Hornet) {
    // Reduza o dinheiro do jogador
    money -= Hornet;
    document.getElementById("money").textContent = money.toFixed(2);

    // Aumente a felicidade do jogador
    increaseHappiness(happinessIncrease);

    // Libere a opção de se tornar roadie
    document.getElementById("MotoTaxi").style.display = "block";

    // Exiba uma mensagem de sucesso
    alert("Você comprou uma moto Hornet e agora pode se tornar moto taxi!");
    inventory[itemName] = true;
    document.getElementById("buy-Hornet-button").style.display = "none";
  } else {
    // Exiba uma mensagem de erro se o jogador não tiver dinheiro suficiente
    alert("Você não tem dinheiro suficiente para comprar este item!");
  }
}


// Função para comprar uma PC Gamer
function buyPCGamer() {
  var itemName = "Pc Gamer";
  // Verifique se o jogador tem dinheiro suficiente para comprar uma camisa de banda
  var money = parseFloat(document.getElementById("money").textContent);
  var PCGamer = 4000; // O custo de uma camisa de banda
  const happinessIncrease = 90;

  if (inventory[itemName]) {
    alert("Você já comprou este item.");
    return;
  }

  if (money >= PCGamer) {
    // Reduza o dinheiro do jogador
    money -= PCGamer;
    document.getElementById("money").textContent = money.toFixed(2);

    increaseHappiness(happinessIncrease);

    // Libere a opção de se tornar roadie
    document.getElementById("Engenheiro").style.display = "block";

    // Exiba uma mensagem de sucesso
    alert("Você comprou um PC Gamer e agora pode se tornar engenheiro de software!");
    inventory[itemName] = true;
    document.getElementById("buy-PCGamer-button").style.display = "none";
  } else {
    // Exiba uma mensagem de erro se o jogador não tiver dinheiro suficiente
    alert("Você não tem dinheiro suficiente para comprar este item!");
  }
}

// Função para comprar um apartamento longe da faculdade
function buyApLonge() {
  var itemName = "Apartamento longe da faculdade";
  // Verifique se o jogador tem dinheiro suficiente para comprar um apartamento longe da faculdade
  var money = parseFloat(document.getElementById("money").textContent);
  var ApartamentoLongeDaFaculdade = 400; // O custo de um apartamento longe da faculdade
  const happinessIncrease = 60;

  if (inventory[itemName]) {
    alert("Você já comprou este item.");
    return;
  }

  if (money >= ApartamentoLongeDaFaculdade) {
    // Reduza o dinheiro do jogador
    money -= ApartamentoLongeDaFaculdade;
    document.getElementById("money").textContent = money.toFixed(2);

    increaseHappiness(happinessIncrease);

    // Exiba uma mensagem de sucesso
    alert("Você acabou de adquirir um apartamento Longe da Faculdade!");
    inventory[itemName] = true;
    document.getElementById("buy-Apartamento-Longe-button").style.display = "none";
  } else {
    // Exiba uma mensagem de erro se o jogador não tiver dinheiro suficiente
    alert("Você não tem dinheiro suficiente para comprar este item!");
  }
}

function buyApPerto() {
  var itemName = "Apartamento próximo à faculdade";
  // Verifique se o jogador tem dinheiro suficiente para comprar uma camisa de banda
  var money = parseFloat(document.getElementById("money").textContent);
  var ApLonge = 990; // O custo do ap perto
  const happinessIncrease = 70;

  if (inventory[itemName]) {
    alert("Você já comprou este item.");
    return;
  }

  if (money >= ApLonge) {
    // Reduza o dinheiro do jogador
    money -= ApLonge;
    document.getElementById("money").textContent = money.toFixed(2);

    increaseHappiness(happinessIncrease);

    // Exiba uma mensagem de sucesso
    alert("Você comprou um apartamento perto da faculdade!");
    inventory[itemName] = true;
    document.getElementById("buy-Apartamento-button").style.display = "none";
  } else {
    // Exiba uma mensagem de erro se o jogador não tiver dinheiro suficiente
    alert("Você não tem dinheiro suficiente para comprar este item!");
  }
}

function buyCasaPropria() {
  var itemName = "Casa Propria";
  // Verifique se o jogador tem dinheiro suficiente para comprar uma casa propria
  var money = parseFloat(document.getElementById("money").textContent);
  var CasaProp = 10000; // O custo da casa propria
  const happinessIncrease = 80;

  if (inventory[itemName]) {
    alert("Você já comprou este item.");
    return;
  }

  if (money >= CasaProp) {
    // Reduza o dinheiro do jogador
    money -= CasaProp;
    document.getElementById("money").textContent = money.toFixed(2);

    increaseHappiness(happinessIncrease);

    // Exiba uma mensagem de sucesso
    alert("Você comprou sua Casa Propria!!");
    inventory[itemName] = true;
    document.getElementById("buy-Casa-button").style.display = "none";
  } else {
    // Exiba uma mensagem de erro se o jogador não tiver dinheiro suficiente
    alert("Você não tem dinheiro suficiente para comprar este item!");
  }
}


function buyMansao() {
  var itemName = "Mansão";
  // Verifique se o jogador tem dinheiro suficiente para comprar
  var money = parseFloat(document.getElementById("money").textContent);
  var mansao = 500000; // O custo
  const happinessIncrease = 90;
  
  if (inventory[itemName]) {
    alert("Você já comprou este item.");
    return;
  }

  if (money >= mansao) {
    // Reduza o dinheiro do jogador
    money -= mansao;
    document.getElementById("money").textContent = money.toFixed(2);

    increaseHappiness(happinessIncrease);

    // Exiba uma mensagem de sucesso
    alert("Você comprou uma mansão!");
    inventory[itemName] = true;
    document.getElementById("buy-mansao-button").style.display = "none";
  } else {
    // Exiba uma mensagem de erro se o jogador não tiver dinheiro suficiente
    alert("Você não tem dinheiro suficiente para comprar este item!");
  }
}

function buyTwitter() {
  var itemName = "Twitter";
  // Verifique se o jogador tem dinheiro suficiente
  var money = parseFloat(document.getElementById("money").textContent);
  var twitter = 100000; // O custo do ap perto
  const happinessIncrease = 100;
  
  if (inventory[itemName]) {
    alert("Você já comprou este item.");
    return;
  }

  if (money >= twitter) {
    // Reduza o dinheiro do jogador
    money -= twitter;
    document.getElementById("money").textContent = money.toFixed(2);

    increaseHappiness(happinessIncrease);

    // Libere a opção de se tornar roadie
    //document.getElementById("Engenheiro").style.display = "block";

    // Exiba uma mensagem de sucesso
    alert("Você agora é dono do Twitter!");
    inventory[itemName] = true;
    document.getElementById("buy-twitter-button").style.display = "none";
  } else {
    // Exiba uma mensagem de erro se o jogador não tiver dinheiro suficiente
    alert("Você não tem dinheiro suficiente para comprar este item!");
  }
}

// Função para comprar uma TV
function buyTV() {
  const tvCost = 80; // Custo da TV
  const happinessIncrease = 40;
  if (money >= tvCost) {
    increaseHappiness(happinessIncrease);
    money -= tvCost; // Reduz o dinheiro do jogador pelo custo da TV
    inventory["TV de tubo"] = true; // Define que o jogador possui uma TV de tubo
    updateMoneyDisplay(); // Atualiza a exibição do dinheiro
    // Adicione aqui qualquer outra ação que você deseja executar ao comprar a TV
    alert("Você comprou uma TV de tubo!");
    // Oculte o botão de compra da TV, se necessário
    document.getElementById("buy-Tv-button").style.display = "none";
  } else {
    alert("Você não tem dinheiro suficiente para comprar a TV de tubo.");
  }
}




//IPVA ALUGEL
function applyRentDiscount() {
  // Verifique se o jogador possui carros, lambretas, hornet ou apartamentos
  var carOwned = inventory["Fiat Uno"] || inventory["Hornet"];
  var lambrettaOwned = inventory["Lambreta"];
  var apartmentNearOwned = inventory["Apartamento próximo à faculdade"];
  var apartmentFarOwned = inventory["Apartamento longe da faculdade"];

  // Valor base do aluguel
  var baseRent = 500; // Defina o valor base do aluguel

  // Desconto para carros, lambretas ou hornet
  var vehicleDiscount = carOwned ? 100 : (lambrettaOwned || hornetOwned ? 50 : 0);

  // Desconto para apartamentos
  var apartmentDiscount = apartmentNearOwned ? 200 : (apartmentFarOwned ? 100 : 0);

  // Total de descontos aplicados
  var totalDiscount = vehicleDiscount + apartmentDiscount;

  // Calcule o novo valor do aluguel com desconto
  var rentWithDiscount = baseRent - totalDiscount;

  // Atualize o dinheiro do jogador e exiba uma mensagem
  var money = parseFloat(document.getElementById("money").textContent);
  money -= rentWithDiscount;
  document.getElementById("money").textContent = money.toFixed(2);

  alert("Desconto no aluguel aplicado: $" + totalDiscount.toFixed(2));
}


function showAlert() {
  var alertElement = document.getElementById("alert");
  alertElement.classList.add("alert");
}

// Evento de clique no botão "Mudar de Emprego"
document.getElementById("changeJobSelectButton").addEventListener("click", () => {
  const selectedJob = document.getElementById("jobSelect").value;

  // Adicione aqui a lógica para verificar se o jogador pode mudar para o novo emprego
  if (selectedJob === "Desempregado" && wisdom >= 10) {
    if (job === desempregado) {
      alert("Você já é desempregado!");
    } else {
      alert("Você atende aos requisitos para ser um Desempregado.");
      job = "Desempregado"; // Atualize o emprego do jogador
    }
    jobDisplay.textContent = job;
  } else if (selectedJob === "Desempregado" && wisdom < 10) {
    alert("Você não pode mudar para este emprego devido a requisitos não atendidos.");
  }

  if (selectedJob === "Líder de torcida organizada" && wisdom >= 30) {
    if (job == "Líder de torcida organizada") {
      alert("Você já é Líder de torcida organizada!");
    } else {
      alert("Você atende aos requisitos para ser um Líder de torcida organizada.");
      job = "Líder de torcida organizada"; // Atualize o emprego do jogador
      jobDisplay.textContent = job;
    }

  } else if (selectedJob === "Líder de torcida organizada" && wisdom < 30) {
    alert("Você não pode mudar para este emprego devido a requisitos não atendidos.");
  }

  if (selectedJob === "Roadie" && wisdom >= 100) {
    if (job == "Roadie") {
      alert("Você já é Roadie!");
    } else {
      alert("Você atende aos requisitos para ser um Roadie!");
      job = "Roadie"; // Atualize o emprego do jogador
      jobDisplay.textContent = job;
    }
  } else if (selectedJob === "Roadie" && wisdom < 100) {
    alert("Você não pode mudar para este emprego devido a requisitos não atendidos.");
  }

  if (selectedJob === "Motoboy" && wisdom >= 190) {
    if (job == "Motoboy") {
      alert("Você já é Motoboy!");
    } else {
      alert("Você atende aos requisitos para ser um Motoboy.");
      job = "Motoboy"; // Atualize o emprego do jogador
      jobDisplay.textContent = job;
    }
  } else if (selectedJob === "Motoboy" && wisdom < 190) {
    alert("Você não pode mudar para este emprego devido a requisitos não atendidos.");
  }

  if (selectedJob === "Mototáxi" && wisdom >= 200) {
    if (job == "Mototáxi") {
      alert("Você já é Mototáxi");
    } else {
      alert("Você atende aos requisitos para ser um Mototáxi");
      job = "Mototáxi"; // Atualize o emprego do jogador
      jobDisplay.textContent = job;
    }
  } else if (selectedJob === "Mototáxi" && wisdom < 200) {
    alert("Você não pode mudar para este emprego devido a requisitos não atendidos.");
  }

  if (selectedJob === "Vendedor da Supreme" && wisdom >= 300) {
    if (job == "Vendedor da Supreme") {
      alert("Você já é Vendedor da Supreme!");
    } else {
      alert("Você atende aos requisitos para ser Vendedor da Supreme.");
      job = "Vendedor da Supreme"; // Atualize o emprego do jogador
      jobDisplay.textContent = job;
    }
  } else if (selectedJob === "Vendedor da Supreme" && wisdom < 300) {
    alert("Você não pode mudar para este emprego devido a requisitos não atendidos.");
  }

  if (selectedJob === "Instagrammer" && wisdom >= 40) {
    if (job == "Instagrammer") {
      alert("Você já é Instagrammer!");
    } else {
      alert("Você atende aos requisitos para ser Instagrammer.");
      job = "Instagrammer"; // Atualize o emprego do jogador
      jobDisplay.textContent = job;
    }
  } else if (selectedJob === "Instagrammer" && wisdom < 40) {
    alert("Você não pode mudar para este emprego devido a requisitos não atendidos.");
  }

  if (selectedJob === "YouTuber" && wisdom >= 40) {
    if (job == "YouTuber") {
      alert("Você já é YouTuber!");
    } else {
      alert("Você atende aos requisitos para ser YouTuber.");
      job = "YouTuber"; // Atualize o emprego do jogador
      jobDisplay.textContent = job;
    }
  } else if (selectedJob === "YouTuber" && wisdom < 40) {
    alert("Você não pode mudar para este emprego devido a requisitos não atendidos.");
  }

  if (selectedJob === "Tiktoker" && wisdom >= 30) {
    if (job == "Tiktoker") {
      alert("Você já é Tiktoker!");
    } else {
      alert("Você atende aos requisitos para ser Tiktoker.");
      job = "Tiktoker"; // Atualize o emprego do jogador
      jobDisplay.textContent = job;
    }
  } else if (selectedJob === "Tiktoker" && wisdom < 30) {
    alert("Você não pode mudar para este emprego devido a requisitos não atendidos.");
  }

  if (selectedJob === "Assistente de Escritório" && wisdom >= 60) {
    if (job == "Assistente de Escritório") {
      alert("Você já é Assistente de Escritório!");
    } else {
      alert("Você atende aos requisitos para ser Assistente de Escritório.");
      job = "Assistente de Escritório"; // Atualize o emprego do jogador
      jobDisplay.textContent = job;
    }
  } else if (selectedJob === "Assistente de Escritório" && wisdom < 60) {
    alert("Você não pode mudar para este emprego devido a requisitos não atendidos.");
  }

  if (selectedJob === "Atleta" && wisdom >= 150) {
    if (job == "Atleta") {
      alert("Você já é Atleta!");
    } else {
      alert("Você atende aos requisitos para ser Atleta.");
      job = "Atleta"; // Atualize o emprego do jogador
      jobDisplay.textContent = job;
    }
  } else if (selectedJob === "Atleta" && wisdom < 150) {
    alert("Você não pode mudar para este emprego devido a requisitos não atendidos.");
  }

  if (selectedJob === "Modelo da Balenciaga" && wisdom >= 250) {
    if (job == "Modelo da Balenciaga") {
      alert("Você já é Modelo da Balenciaga!");
    } else {
      alert("Você atende aos requisitos para ser Modelo da Balenciaga.");
      job = "Modelo da Balenciaga"; // Atualize o emprego do jogador
      jobDisplay.textContent = job;
    }
  } else if (selectedJob === "Modelo da Balenciaga" && wisdom < 250) {
    alert("Você não pode mudar para este emprego devido a requisitos não atendidos.");
  }

  if (selectedJob === "Programador" && wisdom >= 500) {
    if (job == "Programador") {
      alert("Você já é Programador!");
    } else {
      alert("Você atende aos requisitos para ser Programador.");
      job = "Programador"; // Atualize o emprego do jogador
      jobDisplay.textContent = job;
    }
  } else if (selectedJob === "Programador" && wisdom < 500) {
    alert("Você não pode mudar para este emprego devido a requisitos não atendidos.");
  }

  if (selectedJob === "Engenheiro de Software" && wisdom >= 750) {
    if (job == "Engenheiro de Software") {
      alert("Você já é Engenheiro de Software!");
    } else {
      alert("Você atende aos requisitos para ser Engenheiro de Software.");
      job = "Engenheiro de Software"; // Atualize o emprego do jogador
      jobDisplay.textContent = job;
    }
  } else if (selectedJob === "Engenheiro de Software" && wisdom < 750) {
    alert("Você não pode mudar para este emprego devido a requisitos não atendidos.");
  }

});



let isPaused = false;

function pauseGame() {
    if (isPaused) {
        // Adicione seu código aqui para continuar o jogo
        console.log('Continuar o jogo');
        document.getElementById('pauseButton').style.display = 'none';
        document.body.style.filter = 'blur(0px)';
        isPaused = false;
    } else {
        // Caso contrário, pause o jogo
        console.log('Pausar o jogo');
        document.getElementById('pauseButton').style.display = 'block';
        document.body.style.filter = 'blur(5px)';
        isPaused = true;
    }
}

document.getElementById('pauseButton').addEventListener('click', pauseGame);


