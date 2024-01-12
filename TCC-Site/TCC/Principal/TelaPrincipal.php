<?php
session_start();
include_once("conexao.php");
  // Verifique se o parâmetro 'user_id' está presente na URL
if (isset($_GET['user_id'])) {

    // Recupere o ID do usuário da URL
    $userId = $_GET['user_id'];
    } else {
        echo "Você não está logado.";
    }
    // Consulta SQL para obter os detalhes do usuário com base no ID
    $sql = "SELECT Nickname FROM usuario WHERE ID = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId); // 'i' indica que o parâmetro é um inteiro
    
    if ($stmt->execute()) {
      // Obtenha o resultado da consulta
      $result = $stmt->get_result();
      
      if ($result->num_rows > 0) {
          // Recupere os dados do usuário
          $row = $result->fetch_assoc();
          $nickname = $row['Nickname'];
      }
    }
    ?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--<link rel="stylesheet" href="PrincipalCSS.css">-->
  <link rel="web icon" type="img" href="../Img/brasaodicria.png">

  <title>Tessera Game</title>

  <!-- Vendor Styles -->
  <link rel="stylesheet" media="screen" href="assets/vendor/boxicons/css/boxicons.min.css" />
  <link rel="stylesheet" media="screen" href="assets/vendor/swiper/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    integrity="sha512-YDbZyAziwlJQi3IiVowenC8fN06S1mJpOHKu5/KFShgnvDxKv+Cc0U+qWqJxM+3pkzH1q8ed/JzxcSRo3NhnqA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    
  <!-- Main Theme Styles + Bootstrap -->
  <link rel="stylesheet" media="screen" href="assets/css/theme.min.css">



  <script>
    let mode = window.localStorage.getItem('mode'),
      root = document.getElementsByTagName('html')[0];
    if (mode !== null && mode === 'dark') {
      root.classList.add('dark-mode');
    } else {
      root.classList.remove('dark-mode');
    }
  </script>

  <style>
    /* Estilos para a tela de carregamento */
    .page-loading-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: white;
      /* Defina a cor de fundo como branca */
      opacity: 1;
      /* Defina a opacidade para bloquear a interação */
      z-index: 9999;
    }
  </style>

  <!-- Page loading scripts-->
  <script>
    (function () {
      window.onload = function () {
        const preloader = document.querySelector('.page-loading');
        preloader.classList.remove('active');
        setTimeout(function () {
          preloader.remove();
        }, 1000);
      };
    })();
  </script> 

  <!-- Google Tag Manager -->
  <script>
    (function (w, d, s, l, i) {
      w[l] = w[l] || []; w[l].push({
        'gtm.start':
          new Date().getTime(), event: 'gtm.js'
      }); var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
          'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-WKV3GT5');
  </script>

  <style>
    .page-spinner {
      display: inline-block;
      width: 2.75rem;
      height: 2.75rem;
      margin-bottom: .75rem;
      vertical-align: text-bottom;
      border: .15em solid #b4b7c9;
      border-right-color: transparent;
      border-radius: 50%;
      -webkit-animation: spinner .75s linear infinite;
      animation: spinner .75s linear infinite;
      position: fixed;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 100%;
      -webkit-transition: all .4s .2s ease-in-out;
      transition: all .4s .2s ease-in-out;
      background-color: #fff;
      opacity: 0;
      visibility: hidden;
      z-index: 9999;
    }

    .dark-mode .page-loading {
      background-color: #0b0f19;
    }

    .page-loading.active {
      opacity: 1;
      visibility: visible;
    }

    .dark-mode .page-spinner {
      border-color: rgba(255, 255, 255, .4);
      border-right-color: transparent;
    }

    .page-loading {
      position: fixed;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 100%;
      -webkit-transition: all .4s .2s ease-in-out;
      transition: all .4s .2s ease-in-out;
      background-color: #fff;
      opacity: 0;
      visibility: hidden;
      z-index: 9999;
    }

    .dark-mode .page-loading {
      background-color: #0b0f19;
    }

    .page-loading.active {
      opacity: 1;
      visibility: visible;
    }

    .page-loading-inner {
      position: absolute;
      top: 50%;
      left: 0;
      width: 100%;
      text-align: center;
      -webkit-transform: translateY(-50%);
      transform: translateY(-50%);
      -webkit-transition: opacity .2s ease-in-out;
      transition: opacity .2s ease-in-out;
      opacity: 0;
    }

    .page-loading.active>.page-loading-inner {
      opacity: 1;
    }

    .page-spinner {
      display: inline-block;
      width: 2.75rem;
      height: 2.75rem;
      margin-bottom: .75rem;
      vertical-align: text-bottom;
      border: .15em solid #b4b7c9;
      border-right-color: transparent;
      border-radius: 50%;
      -webkit-animation: spinner .75s linear infinite;
      animation: spinner .75s linear infinite;
    }

    .dark-mode .page-spinner {
      border-color: rgba(255, 255, 255, .4);
      border-right-color: transparent;
    }

    @-webkit-keyframes spinner {
      100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
      }
    }

    @keyframes spinner {
      100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
      }
    }

    div.arrow {
      width: 6vmin;
      height: 6vmin;
      box-sizing: border-box;
      position: absolute;
      left: 50%;
      top: 50%;
      transform: rotate(-45deg);
    }

    div.arrow::before {
      content: "";
      width: 100%;
      height: 100%;
      border-width: 0.8vmin 0.8vmin 0 0;
      border-style: solid;
      border-color: #fafafa;
      transition: 0.2s ease;
      display: block;
      transform-origin: 100% 0;
    }

    div.arrow::after {
      content: "";
      float: left;
      position: relative;
      top: -100%;
      width: 100%;
      height: 100%;
      border-width: 0 0.8vmin 0 0;
      border-style: solid;
      border-color: #fafafa;
      transform-origin: 100% 0;
      transition: 0.2s ease;
    }

    div.arrow:hover::after {
      transform: rotate(45deg);
      border-color: orange;
      height: 120%;
    }

    div.arrow:hover::before {
      border-color: orange;
      transform: scale(0.8);
    }

    .navbar-nav .dropdown-menu::before {
      content: "";
      position: absolute;
      top: -15px;
      /* Ajuste para posicionar a seta corretamente */
      left: 11%;
      transform: translateX(-50%);
      border-width: 0 10px 10px 10px;
      border-style: solid;
      border-color: transparent transparent #f3f6ff transparent;
    }

    .nav-item.dropdown .nav-link::after {
      display: none;
    }

    /* Defina a animação para revelar o texto letra por letra */
    @keyframes revealText {
      0% {
        width: 0;
      }

      100% {
        width: 100%;
      }
    }

    /* Aplique a animação e centralize o texto no meio da página */
    h1.display-1 {
      position: absolute;
      /* Posicione o elemento de forma absoluta */
      top: 50%;
      /* Alinhe o topo do elemento ao centro vertical */
      left: 50%;
      /* Alinhe a esquerda do elemento ao centro horizontal */
      transform: translate(-50%, -50%);
      /* Centralize o elemento */
      overflow: hidden;
      /* Certifique-se de que o texto oculto seja cortado */
      white-space: nowrap;
      /* Certifique-se de que o texto não quebre em várias linhas */
      animation: revealText 2s linear forwards;
      /* Reduzi o número de etapas e usei uma animação linear */
      padding-right: 4px;
      /* Ajuste o espaçamento à direita da borda */
    }

    .imagem-circular {
      border-radius: 10px;
      /* Define um raio de borda de 50% para criar um círculo */

    }

    .imagem-container {
      display: flex;
      /* Torna os elementos filhos flexíveis */
      justify-content: flex-start;
      /* Alinha os elementos à esquerda */
      align-items: center;
      /* Centraliza verticalmente os elementos (opcional) */
      gap: 10px;
      /* Espaço entre as imagens (opcional) */
    }
  </style>

</head>

<body>

  


  <!-- Page loading spinner -->
  <div class="page-loading active">
    <div class="page-loading-inner">
      <div class="page-spinner"></div><span>Loading...</span>
    </div>
  </div>

  

  <!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page -->
  <header class="header navbar navbar-expand-lg navbar-dark position-absolute navbar-sticky">
    <div class="container px-3">
      <a href="TelaPrincipal.html" class="navbar-brand pe-3">
        TESSERA GAME

      </a>
      <div id="navbarNav" class="offcanvas offcanvas-end bg-dark">
        <div class="offcanvas-header border-bottom border-light">
          <h5 class="offcanvas-title text-white">Menu</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
        </div>

        <div class="offcanvas-body">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown" aria-current="page"
                id="dropdownMenuLink">
                Landings &nbsp; <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down" viewBox="0 0 16 16">
                  <path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z"/>
                </svg>
                <span class="dropdown-arrow"><i class="fas fa-chevron-down"></i></span>
              </a>
              <div class="dropdown-menu dropdown-menu-dark p-0" aria-labelledby="dropdownMenuLink">
                <div class="d-lg-flex">
                  <div
                    class="mega-dropdown-column d-flex justify-content-center align-items-center rounded-3 rounded-end-0 px-0"
                    style="margin: -1px; background-color: #f3f6ff;">
                    <img class="imagem-circular" src="../Img/CofAdnCat.gif" alt="Landings">
                  </div>
                  <div class="mega-dropdown-column pt-lg-3 pb-lg-4">
                    <ul class="list-unstyled mb-0">
                      <li><a href="TelaPrincipal.html" class="dropdown-item"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
  <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
</svg> &nbsp; Template Intro Page</a></li>
                      <!--<li><a href="landing-mobile-app-showcase-v1.html" class="dropdown-item">Mobile App Showcase v.1</a></li>  EXemplo-->
                    </ul>
                  </div>
                </div>
              </div>
            </li>

            <li class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                Páginas &nbsp; <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down" viewBox="0 0 16 16">
                  <path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z"/>
                </svg>
              </a>
              <div class="dropdown-menu dropdown-menu-dark">
                <div class="d-lg-flex pt-lg-3">
                  <div class="mega-dropdown-column">
                    <h6 class="text-light px-3 mb-2">Sobre</h6>
                    <ul class="list-unstyled mb-3">
                      <li><a href="../Documentação/Documentação.html" class="dropdown-item py-1">Desenvolvedores</a>
                      </li>
                    </ul>

                    <h6 class="text-light px-3 mb-2">Atualização</h6>
                    <ul class="list-unstyled mb-3">
                      <li><a href="../Atualizaçaõ/Atualizaçoes.html" class="dropdown-item py-1">Veja nossas Atualização</a>
                      </li> <!--Lista das atts-->
                    </ul>


                  </div>
                   <div class="mega-dropdown-column">

                    <h6 class="text-light px-3 mb-2">Serviços</h6>
                    <ul class="list-unstyled mb-3">

                    <?php
                    
                    
                    ?>
                    <li><a href="../JOgo/jogo.php?user_id=<?php echo $_SESSION['user_id']; ?>" class="dropdown-item py-1">LifeGame<img src="./img-icon/controle-de-video-game.png" style="width: 23px;"></a></li>
                    </ul>
                  </div>



                </div>
              </div>

            </li>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                Conta &nbsp;<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down" viewBox="0 0 16 16">
                  <path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z"/>
                </svg>
              </a>
              <div class="dropdown-menu dropdown-menu-dark">
                <div class="d-lg-flex pt-lg-3">
                  <div class="mega-dropdown-column">
                    <h6 class="text-white px-3 mb-2">Conta</h6>
                    <ul class="list-unstyled mb-3">
                      <li><a href="../Sign/DetalhesDasContas.php?user_id=<?php echo $_SESSION['user_id']; ?>" class="dropdown-item py-1">Detalhes da Conta</a>
                      </li>
                    </ul>

                    <h6 class="text-white px-3 mb-2">Log out</h6>
                    <ul class="list-unstyled mb-3">
                      <li><a href="..\Principal\sessionDestroy.php" class="dropdown-item py-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/>
  <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
</svg>
Logoff
</a>
                      </li>
                    </ul>


                  </div>
                </div>
              </div>
            </li>
            
          </ul>
        </div>
      </div>
 

      <div class="dark-mode pe-lg-1 ms-auto me-4">
        <div class="form-check form-switch mode-switch" data-bs-toggle="mode">
          <input type="checkbox" class="form-check-input" id="theme-mode">
          <label class="form-check-label d-none d-sm-block" for="theme-mode">Light</label>
          <label class="form-check-label d-none d-sm-block" for="theme-mode">Dark</label>
        </div>
      </div>
    </div>
  </header>



  <section class="jarallax dark-mode bg-dark min-vh-100" data-jarallax data-speed="0.4">
    <span class="position-absolute top-0 start-0 w-100 h-100"
      style="background: radial-gradient(116.18% 118% at 50% 100%, rgba(99, 102, 241, 0.1) 0%, rgba(218, 70, 239, 0.05) 41.83%, rgba(241, 244, 253, 0.07) 82.52%);"></span>
    <div class="jarallax-img" style="background-image: url(assets/img/landing/software-agency-2/hero-bg.png);"></div>
    <div class="min-vh-100 d-flex flex-column py-5">

      <div class="container position-relative text-center zindex-5 pt-4 pt-md-5 pb-5 mt-auto">
        <div class="row mt-5">
          <div class="col-xl-10 mx-auto">
            <h1 class="display-1 mb-md-4 pb-3">
              TESSERA GAME
            </h1><!--Animação aq de letra por letra-->
           
          </div>
        </div>
      </div>

      <style>
  .bem-vindo {
    text-align: center; /* Centraliza horizontalmente */
    position: absolute;
    top: 50%; /* Distância a partir do topo em pixels */
    left: 50%; /* Centraliza horizontalmente */
    transform: translateX(-50%); /* Centraliza horizontalmente */
  }
</style>

     <p class="bem-vindo">Bem-Vindo: <?php echo $nickname; ?></p>

     
      <!--Vantagens do jogo-->
      <div class="container mt-auto pb-lg-2 pb-xl-3">
    
        <ul
          class="list-unstyled d-flex align-items-start justify-content-center flex-wrap text-nowrap mt-xl-0 mt-md-n4 mt-sm-n3 mt-n2 ms-md-n4 ms-n3 mb-0 pt-lg-5 pt-md-4">
          <li class="d-flex align-items-center mt-md-4 mt-sm-3 mt-2 ms-md-4 ms-3">
            <img src="./img-icon/controle-de-video-game.png" style="width: 25px;">
            &nbsp; Extensive Game Experience
          </li>

          <li class="d-flex align-items-center mt-md-4 mt-sm-3 mt-2 ms-md-4 ms-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-laptop" viewBox="0 0 16 16">
              <path d="M13.5 3a.5.5 0 0 1 .5.5V11H2V3.5a.5.5 0 0 1 .5-.5h11zm-11-1A1.5 1.5 0 0 0 1 3.5V12h14V3.5A1.5 1.5 0 0 0 13.5 2h-11zM0 12.5h16a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 12.5z"/>
            </svg>
            &nbsp; Web Game
          </li>

          <li class="d-flex align-items-center mt-md-4 mt-sm-3 mt-2 ms-md-4 ms-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cursor" viewBox="0 0 16 16">
              <path d="M14.082 2.182a.5.5 0 0 1 .103.557L8.528 15.467a.5.5 0 0 1-.917-.007L5.57 10.694.803 8.652a.5.5 0 0 1-.006-.916l12.728-5.657a.5.5 0 0 1 .556.103zM2.25 8.184l3.897 1.67a.5.5 0 0 1 .262.263l1.67 3.897L12.743 3.52 2.25 8.184z"/>
            </svg>
           &nbsp; Make your own way
          </li>
        </ul>
      </div>
    </div>
  </section>


 
<!-- Our Services -->
<section class="container my-5 py-lg-5 py-md-4 pt-2 pb-3 mb-5"> <!-- Adicione a classe mb-5 aqui -->
  <h2 class="h1 mb-md-5 mb-4 py-xl-3 pb-lg-2 pb-md-0 pb-sm-2 text-center">Sobre o Jogo</h2>

      <!-- Main features (Slider on narrow scrreens) -->
      <section class="container pt-5">
        <div class="swiper mt-n3 mt-md-0 pt-md-4 pt-lg-5 mx-n2" data-swiper-options='{
          "slidesPerView": 1,
          "spaceBetween": 8,
          "pagination": {
            "el": ".swiper-pagination",
            "clickable": true
          },
          "navigation": {
            "prevEl": "#prev-news",
            "nextEl": "#next-news"
          },
          "breakpoints": {
            "500": {
              "slidesPerView": 2
            },
            "700": {
              "slidesPerView": 3
            },
            "1000": {
              "slidesPerView": 4
            }
          }
        }'>
          <div class="swiper-wrapper">

            <!-- Item -->
            <div class="swiper-slide h-auto pb-3">
              <div class="card card-hover bg-light border-0 animation-on-hover h-100 mx-2">
                <lottie-player class="d-dark-mode-none mx-auto mt-4 mb-2" src="assets/json/animation-feature-1-light.json" background="transparent" speed="1.25" loop style="width: 180px;"></lottie-player>
                <lottie-player class="d-none d-dark-mode-block mx-auto mt-4 mb-2" src="assets/json/animation-feature-1-dark.json" background="transparent" speed="1.25" loop style="width: 180px; height: 180px;"></lottie-player>
                <div class="card-body fs-lg fw-semibold text-center">Light / Dark Mode</div>
              </div>
            </div>

            <!-- Item -->
            <div class="swiper-slide h-auto pb-3">
              <div class="card card-hover bg-light border-0 animation-on-hover h-100 mx-2">
                <lottie-player class="d-dark-mode-none mx-auto mt-4 mb-2" src="assets/json/animation-feature-2-light.json" background="transparent" speed="1.25" loop style="width: 180px;"></lottie-player>
                <lottie-player class="d-none d-dark-mode-block mx-auto mt-4 mb-2" src="assets/json/animation-feature-2-dark.json" background="transparent" speed="1.25" loop style="width: 180px; height: 180px;"></lottie-player>
                <div class="card-body fs-lg fw-semibold text-center">Illustrative images</div>
              </div>
            </div>

            <!-- Item -->
            <div class="swiper-slide h-auto pb-3">
              <div class="card card-hover bg-light border-0 animation-on-hover h-100 mx-2">
                <lottie-player class="d-dark-mode-none mx-auto mt-4 mb-2" src="assets/json/animation-feature-3-light.json" background="transparent" speed="1.25" loop style="width: 180px;"></lottie-player>
                <lottie-player class="d-none d-dark-mode-block mx-auto mt-4 mb-2" src="assets/json/animation-feature-3-dark.json" background="transparent" speed="1.25" loop style="width: 180px; height: 180px;"></lottie-player>
                <div class="card-body fs-lg fw-semibold text-center">Extensive Game </div>
              </div>
            </div>

            <!-- Item -->
            <div class="swiper-slide h-auto pb-3">
              <div class="card card-hover bg-light border-0 animation-on-hover h-100 mx-2">
                <lottie-player class="d-dark-mode-none mx-auto mt-4 mb-2" src="assets/json/animation-feature-4-light.json" background="transparent" speed="1.25" loop style="width: 180px;"></lottie-player>
                <lottie-player class="d-none d-dark-mode-block mx-auto mt-4 mb-2" src="assets/json/animation-feature-4-dark.json" background="transparent" speed="1.25" loop style="width: 180px; height: 180px;"></lottie-player>
                <div class="card-body fs-lg fw-semibold text-center">Mechanics Game</div>
              </div>
            </div>
          </div>
      
          <!-- Pagination (bullets) -->
          <div class="swiper-pagination position-relative bottom-0 mt-2"></div>
        </div>
      </section>

 

    <!-- Service item -->
    <div class="row gy-4 mb-5 pb-xl-5 pb-md-4 pb-3 mt-5 mt-lg-5">
      <div class="col-lg-5 col-md-6 order-md-1 order-2 d-flex rellax" data-rellax-percentage="0.5"
        data-rellax-speed="-0.5" data-disable-parallax-down="md">
        <div class="align-self-center pe-lg-0 pe-md-4">
          <h3 class="mb-md-4">O Jogo</h3>
          <!--Sobre o jogo aqui-->
          <p class="mb-md-4 mb-3 fs-lg">Nesse Jogo voce pode seguir diferentes profissões.</p>
          <hr class="my-md-4 my-3">
          <ul class="list-unstyled d-flex flex-wrap mt-md-n3 mt-n2 ms-md-n4 ms-n3 mb-0 pb-lg-4 pb-md-2 fw-bold">
            <li class="mt-md-3 mt-2 ms-md-4 ms-3">Progamador</li>
            <li class="mt-md-3 mt-2 ms-md-4 ms-3">Engenheiro de Software</li>
            <li class="mt-md-3 mt-2 ms-md-4 ms-3">Uber</li>
            <li class="mt-md-3 mt-2 ms-md-4 ms-3">Lider de Torcida</li>
          </ul>
          <a href="../JOgo/jogo.html" class="btn btn-lg btn-outline-primary w-sm-auto w-100 mt-4">Jogue Agora</a>
        </div>
      </div>
      <div class="col-md-6 offset-lg-1 order-md-2 order-1 rellax" data-rellax-percentage="0.5" data-rellax-speed="0.5"
        data-disable-parallax-down="md">
        <div class="bg-secondary rounded-3">
          <!--Imagem do jogo em modo claro exemplo--> <img
            src="Jogo.PNG" alt="Image"
            class="d-dark-mode-none d-block">
          <!--Imagem do jogo em modo escuro exemplo--> <img
            src="Jogo.PNG" alt="Image"
            class="d-dark-mode-block d-none"style="width: 1000px; height: 330px;">
        </div>
      </div>
    </div>

    <!-- Service item -->
    <div class="row gy-4 mb-5 pb-xl-5 pb-md-4 pb-3">
      <div class="col-lg-5 col-md-6 order-md-1 order-2 d-flex rellax" data-rellax-percentage="0.5"
        data-rellax-speed="-0.5" data-disable-parallax-down="md">
        <div class="align-self-center pe-lg-0 pe-md-4">
          <h3 class="mb-md-4">Desenvolvimento do Jogo</h3>
          <p class="mb-md-4 mb-3 fs-lg">O jogo foi desenvolvido para um Trabalho de Conclusão de Curso, explica aqui
            como desenvolvemos</p>
          <hr class="my-md-4 my-3">
          <div class="d-flex align-items-center mt-n3 ms-n4 pb-lg-4 pb-md-2">
            <div class="mt-3 ms-4 pe-md-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filetype-html" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M14 4.5V11h-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5Zm-9.736 7.35v3.999h-.791v-1.714H1.79v1.714H1V11.85h.791v1.626h1.682V11.85h.79Zm2.251.662v3.337h-.794v-3.337H4.588v-.662h3.064v.662H6.515Zm2.176 3.337v-2.66h.038l.952 2.159h.516l.946-2.16h.038v2.661h.715V11.85h-.8l-1.14 2.596H9.93L8.79 11.85h-.805v3.999h.706Zm4.71-.674h1.696v.674H12.61V11.85h.79v3.325Z"/>
              </svg>  HTML
           
            </div>
            <div class="mt-3 ms-4 pe-md-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-database" viewBox="0 0 16 16">
                <path d="M4.318 2.687C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4c0-.374.356-.875 1.318-1.313ZM13 5.698V7c0 .374-.356.875-1.318 1.313C10.766 8.729 9.464 9 8 9s-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777A4.92 4.92 0 0 0 13 5.698ZM14 4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16s3.022-.289 4.096-.777C13.125 14.755 14 14.007 14 13V4Zm-1 4.698V10c0 .374-.356.875-1.318 1.313C10.766 11.729 9.464 12 8 12s-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10s3.022-.289 4.096-.777A4.92 4.92 0 0 0 13 8.698Zm0 3V13c0 .374-.356.875-1.318 1.313C10.766 14.729 9.464 15 8 15s-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13s3.022-.289 4.096-.777c.324-.147.633-.323.904-.525Z"/>
              </svg> PgAdmin
            </div>
            <div class="mt-3 ms-4 pe-md-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filetype-js" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2H8v-1h4a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM3.186 15.29a1.176 1.176 0 0 1-.111-.449h.765a.578.578 0 0 0 .255.384c.07.049.153.087.249.114.095.028.202.041.319.041.164 0 .302-.023.413-.07a.559.559 0 0 0 .255-.193.507.507 0 0 0 .085-.29.387.387 0 0 0-.153-.326c-.101-.08-.255-.144-.462-.193l-.619-.143a1.72 1.72 0 0 1-.539-.214 1.001 1.001 0 0 1-.351-.367 1.068 1.068 0 0 1-.123-.524c0-.244.063-.457.19-.639.127-.181.303-.322.528-.422.224-.1.483-.149.776-.149.305 0 .564.05.78.152.216.102.383.239.5.41.12.17.186.359.2.566h-.75a.56.56 0 0 0-.12-.258.624.624 0 0 0-.247-.181.923.923 0 0 0-.369-.068c-.217 0-.388.05-.513.152a.472.472 0 0 0-.184.384c0 .121.048.22.143.3a.97.97 0 0 0 .405.175l.62.143c.218.05.406.12.566.211.16.09.285.21.375.358.09.148.135.335.135.56 0 .247-.063.466-.188.656a1.216 1.216 0 0 1-.539.439c-.234.105-.52.158-.858.158-.254 0-.476-.03-.665-.09a1.404 1.404 0 0 1-.478-.252 1.13 1.13 0 0 1-.29-.375Zm-3.104-.033A1.32 1.32 0 0 1 0 14.791h.765a.576.576 0 0 0 .073.27.499.499 0 0 0 .454.246c.19 0 .33-.055.422-.164.092-.11.138-.265.138-.466v-2.745h.79v2.725c0 .44-.119.774-.357 1.005-.236.23-.564.345-.984.345a1.59 1.59 0 0 1-.569-.094 1.145 1.145 0 0 1-.407-.266 1.14 1.14 0 0 1-.243-.39Z"/>
              </svg>  Java Script
            </div>
            <div class="mt-3 ms-4 pe-md-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filetype-css" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM3.397 14.841a1.13 1.13 0 0 0 .401.823c.13.108.289.192.478.252.19.061.411.091.665.091.338 0 .624-.053.859-.158.236-.105.416-.252.539-.44.125-.189.187-.408.187-.656 0-.224-.045-.41-.134-.56a1.001 1.001 0 0 0-.375-.357 2.027 2.027 0 0 0-.566-.21l-.621-.144a.97.97 0 0 1-.404-.176.37.37 0 0 1-.144-.299c0-.156.062-.284.185-.384.125-.101.296-.152.512-.152.143 0 .266.023.37.068a.624.624 0 0 1 .246.181.56.56 0 0 1 .12.258h.75a1.092 1.092 0 0 0-.2-.566 1.21 1.21 0 0 0-.5-.41 1.813 1.813 0 0 0-.78-.152c-.293 0-.551.05-.776.15-.225.099-.4.24-.527.421-.127.182-.19.395-.19.639 0 .201.04.376.122.524.082.149.2.27.352.367.152.095.332.167.539.213l.618.144c.207.049.361.113.463.193a.387.387 0 0 1 .152.326.505.505 0 0 1-.085.29.559.559 0 0 1-.255.193c-.111.047-.249.07-.413.07-.117 0-.223-.013-.32-.04a.838.838 0 0 1-.248-.115.578.578 0 0 1-.255-.384h-.765ZM.806 13.693c0-.248.034-.46.102-.633a.868.868 0 0 1 .302-.399.814.814 0 0 1 .475-.137c.15 0 .283.032.398.097a.7.7 0 0 1 .272.26.85.85 0 0 1 .12.381h.765v-.072a1.33 1.33 0 0 0-.466-.964 1.441 1.441 0 0 0-.489-.272 1.838 1.838 0 0 0-.606-.097c-.356 0-.66.074-.911.223-.25.148-.44.359-.572.632-.13.274-.196.6-.196.979v.498c0 .379.064.704.193.976.131.271.322.48.572.626.25.145.554.217.914.217.293 0 .554-.055.785-.164.23-.11.414-.26.55-.454a1.27 1.27 0 0 0 .226-.674v-.076h-.764a.799.799 0 0 1-.118.363.7.7 0 0 1-.272.25.874.874 0 0 1-.401.087.845.845 0 0 1-.478-.132.833.833 0 0 1-.299-.392 1.699 1.699 0 0 1-.102-.627v-.495ZM6.78 15.29a1.176 1.176 0 0 1-.111-.449h.764a.578.578 0 0 0 .255.384c.07.049.154.087.25.114.095.028.201.041.319.041.164 0 .301-.023.413-.07a.559.559 0 0 0 .255-.193.507.507 0 0 0 .085-.29.387.387 0 0 0-.153-.326c-.101-.08-.256-.144-.463-.193l-.618-.143a1.72 1.72 0 0 1-.539-.214 1 1 0 0 1-.351-.367 1.068 1.068 0 0 1-.123-.524c0-.244.063-.457.19-.639.127-.181.303-.322.527-.422.225-.1.484-.149.777-.149.304 0 .564.05.779.152.217.102.384.239.5.41.12.17.187.359.2.566h-.75a.56.56 0 0 0-.12-.258.624.624 0 0 0-.246-.181.923.923 0 0 0-.37-.068c-.216 0-.387.05-.512.152a.472.472 0 0 0-.184.384c0 .121.047.22.143.3a.97.97 0 0 0 .404.175l.621.143c.217.05.406.12.566.211.16.09.285.21.375.358.09.148.135.335.135.56 0 .247-.063.466-.188.656a1.216 1.216 0 0 1-.539.439c-.234.105-.52.158-.858.158-.254 0-.476-.03-.665-.09a1.404 1.404 0 0 1-.478-.252 1.13 1.13 0 0 1-.29-.375Z"/>
              </svg> CSS
            </div>
          </div>
          <a href="#" class="btn btn-lg btn-outline-primary w-sm-auto w-100 mt-4">Ler mais</a>
          <!--Redireciona para uma previa sobre o jogo imagens por exemplo de passos que nos demos-->
        </div>
      </div>
      <div class="col-md-6 offset-lg-1 order-md-2 order-1 rellax" data-rellax-percentage="0.5" data-rellax-speed="0.5"
        data-disable-parallax-down="md">
        <div class="bg-secondary rounded-3">
          <!--Imagem em tema claro--> <img src="./Desenvolvimento.png" alt="IMG"
            class="d-dark-mode-none d-block">
          <!--Imagem tema escuro--> <img src="./Desenvolvimento.png" alt="IMG"
            class="d-dark-mode-block d-none" style="width: 1000px; height: 390px;">
        </div>
      </div>
    </div>
  </section>


  <!-- Our awards -->
  <section class="position-relative py-5 bg-dark">
    <span class="position-absolute top-0 start-0 d-dark-mode-block d-none w-100 h-100 bg-secondary"></span>
    <div class="position-relative dark-mode container my-lg-5 my-md-4 my-3 py-xl-3">
      <h2 class="h1 mb-md-4 mb-3 text-center">Our Awards</h2>
      <p class="mb-md-5 mb-4 pb-xl-3 pb-lg-2 pb-md-0 pb-sm-2 mx-auto text-center" style="max-width: 32.875rem;">
        Informações</p>

      <!-- Swiper slider -->
      <div class="swiper mt-n1" data-swiper-options='{
      "spaceBetween": 24,
      "breakpoints": {
        "0": {
          "slidesPerView": 1
        },
        "500": {
          "slidesPerView": 2
        },
        "768": {
          "slidesPerView": 3
        },
        "1200": {
          "slidesPerView": 4
        }
      },
      "pagination": {
        "el": ".swiper-pagination",
        "clickable": true
      }
    }'>
        <div class="swiper-wrapper">

          <!-- Swiper item -->
          <div class="swiper-slide h-auto pt-1">
            <div class="card shadow-sm card-hover position-relative h-100 py-md-1 px-md-2">
              <div class="card-body">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"  fill="currentColor" class="bi bi-file-text-fill" viewBox="0 0 16 16">
                  <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM5 4h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1zm0 2h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1z"/>
                </svg> Documentação
                <div class="mt-5 pt-lg-5 pt-md-4 pt-sm-3">
                  <h3 class="h5 mt-xl-4 mb-2 pt-lg-2 pb-1 d-flex align-items-center text-nowrap">
                    <a href="../Documentação/Documentação.html" class="stretched-link">Ver mais
                       <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                      <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                    </svg>
                  </a>
                   
                  </h3>
                  <p class="mb-0">Sobre nós</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Swiper item -->
          <div class="swiper-slide h-auto pt-1">
            <div class="card shadow-sm card-hover position-relative h-100 py-md-1 px-md-2">
              <div class="card-body">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dpad" viewBox="0 0 16 16">
                  <path d="m7.788 2.34-.799 1.278A.25.25 0 0 0 7.201 4h1.598a.25.25 0 0 0 .212-.382l-.799-1.279a.25.25 0 0 0-.424 0Zm0 11.32-.799-1.277A.25.25 0 0 1 7.201 12h1.598a.25.25 0 0 1 .212.383l-.799 1.278a.25.25 0 0 1-.424 0ZM3.617 9.01 2.34 8.213a.25.25 0 0 1 0-.424l1.278-.799A.25.25 0 0 1 4 7.201V8.8a.25.25 0 0 1-.383.212Zm10.043-.798-1.277.799A.25.25 0 0 1 12 8.799V7.2a.25.25 0 0 1 .383-.212l1.278.799a.25.25 0 0 1 0 .424Z"/>
                  <path d="M6.5 0A1.5 1.5 0 0 0 5 1.5v3a.5.5 0 0 1-.5.5h-3A1.5 1.5 0 0 0 0 6.5v3A1.5 1.5 0 0 0 1.5 11h3a.5.5 0 0 1 .5.5v3A1.5 1.5 0 0 0 6.5 16h3a1.5 1.5 0 0 0 1.5-1.5v-3a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 0 16 9.5v-3A1.5 1.5 0 0 0 14.5 5h-3a.5.5 0 0 1-.5-.5v-3A1.5 1.5 0 0 0 9.5 0h-3ZM6 1.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3A1.5 1.5 0 0 0 11.5 6h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a1.5 1.5 0 0 0-1.5 1.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-3A1.5 1.5 0 0 0 4.5 10h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 0 6 4.5v-3Z"/>
                </svg> Tutorial
                <div class="mt-5 pt-lg-5 pt-md-4 pt-sm-3">
                  <h3 class="h5 mt-xl-4 mb-2 pt-lg-2 pb-1 d-flex align-items-center text-nowrap">
                    <a href="../Tutorial/SobreOJogo.html" class="stretched-link"> Ver mais 
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                      <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                    </svg>
                  </a>
          
                  </h3>
                  <p class="mb-0">Sobre o Jogo </p> 
                </div>
              </div>
            </div>
          </div>

          <!-- Swiper item -->
          <div class="swiper-slide h-auto pt-1">
            <div class="card shadow-sm card-hover position-relative h-100 py-md-1 px-md-2">
              <div class="card-body">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1h-2z"/>
                  <path fill-rule="evenodd" d="M7.646.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 1.707V10.5a.5.5 0 0 1-1 0V1.707L5.354 3.854a.5.5 0 1 1-.708-.708l3-3z"/>
                </svg> Cadastrar
                <div class="mt-5 pt-lg-5 pt-md-4 pt-sm-3">
                  <h3 class="h5 mt-xl-4 mb-2 pt-lg-2 pb-1 d-flex align-items-center text-nowrap">
                    <a href="../Sign/Cadastro.html" class="stretched-link">Ver mais
                       <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                      <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                    </svg>
                  </a>
                  </h3>
                  <p class="mb-0">Tenha uma conta</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Swiper item -->
          <div class="swiper-slide h-auto pt-1">
            <div class="card shadow-sm card-hover position-relative h-100 py-md-1 px-md-2">
              <div class="card-body">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                  <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                </svg> Entrar
                <div class="mt-5 pt-lg-5 pt-md-4 pt-sm-3">
                  <h3 class="h5 mt-xl-4 mb-2 pt-lg-2 pb-1 d-flex align-items-center text-nowrap">
                    <a href="../Sign/Login.html" class="stretched-link">
                      Ver mais 
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                      <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                    </svg>
                  </a>
                  
                  </h3>
                  <p class="mb-0">Logar</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Swiper pagination -->
        <div class="swiper-pagination position-static mt-4 pt-lg-3 pt-2"></div>
      </div>
    </div>
  </section>


  <!-- Case Studies 
<div class="container my-5 py-lg-5 py-md-4 py-3">
  <h2 class="h1 mb-md-4 mb-3 pt-xl-3">Our Services</h2>
  <div class="row gy-sm-4 gy-3 mb-md-5 mb-4 pb-xl-2 pb-md-0 pb-sm-2">
    <div class="col-md-6 col-12">
      <p class="mb-0 fs-lg">We bring real solutions to each client&apos;s problems through a deep understanding of their market, solution, and vision.</p>
    </div>
    <div class="col text-md-end">
      <a href="#" class="btn btn-lg btn-outline-primary">See all case studies</a>
    </div>
  </div>

  Swiper slider 
  <div class="swiper mb-xl-3" data-swiper-options='{
    "spaceBetween": 24,
    "breakpoints": {
      "0": {
        "slidesPerView": 1
      },
      "768": {
        "slidesPerView": 2
      }
    },
    "pagination": {
      "el": ".swiper-pagination",
      "clickable": true
    }
  }'>
    <div class="swiper-wrapper">

 Swiper item 
      <div class="swiper-slide h-auto pt-1">
        <div class="card h-100">
          <img src="assets/img/landing/software-agency-2/case-studies/01.jpg" class="card-img-top" alt="Card image">
          <div class="card-body">
            <h5 class="card-title mb-3">Travelers Portal with Smart Search</h5>
            <p class="card-text mb-4 pb-md-3 fs-lg">Aenean sed mi ut erat venenatis imperdiet. Mauris sed turpis ac elit ultricies rhoncus id et magna donec euismod interdum risus.</p>
            <a href="#" class="btn btn-lg btn-outline-primary">See all case studies</a>
          </div>
        </div>
      </div>

      Swiper item 
      <div class="swiper-slide h-auto pt-1">
        <div class="card h-100">
          <img src="assets/img/landing/software-agency-2/case-studies/02.jpg" class="card-img-top" alt="Card image">
          <div class="card-body">
            <h5 class="card-title mb-3">Fintech App for Financial Management</h5>
            <p class="card-text mb-4 pb-md-3 fs-lg">Nullam semper enim quis vulputate mollis. Donec ultrices elementum mauris, ac porttitor mi cursus eget vestibulum tellus sodales.</p>
            <a href="#" class="btn btn-lg btn-outline-primary">See all case studies</a>
          </div>
        </div>
      </div>
    </div>

     Swiper pagination 
    <div class="swiper-pagination position-static mt-4 pt-lg-3 pt-2"></div>
  </div>
</div>
-->


  <!-- What Our Clients Say About Us -->
  <section class="container mb-5 pb-lg-5 pb-md-4 pb-3">
    <div class="mb-xl-3">
      <h2 class="h1 mb-md-5 mb-4 pb-xl-3 pb-lg-2 pb-md-0 pb-sm-2">O que nossos clientes falam sobre nós</h2>

      <!-- Tabs -->
      <div class="row gy-4 gx-md-4 gx-3">

        <!-- Nav tabs -->
        <div class="col-lg-4 col-sm-5 order-sm-1 order-2">
          <ul class="nav nav-tabs flex-column" role="tablist">
            <li class="nav-item mb-3">
              <a href="#testimonial-1"
                class="nav-link flex-md-row flex-sm-column align-items-md-center align-items-sm-start align-items-center p-md-4 p-3 rounded-3 fw-normal active"
                data-bs-toggle="tab" role="tab">
                <img src="assets/img/avatar/48.jpg" width="56" alt="Avatar"
                  class="rounded-circle me-md-3 me-sm-0 me-3 mb-md-0 mb-sm-2">
                <div>
                  <span class="d-block mb-0 fs-lg fw-semibold">Jorge</span>
                  Vendedor
                </div>
              </a>
            </li>
            <li class="nav-item mb-3">
              <a href="#testimonial-2"
                class="nav-link flex-md-row flex-sm-column align-items-md-center align-items-sm-start align-items-center p-md-4 p-3 rounded-3 fw-normal"
                data-bs-toggle="tab" role="tab">
                <img src="assets/img/avatar/49.jpg" width="56" alt="Avatar"
                  class="rounded-circle me-md-3 me-sm-0 me-3 mb-md-0 mb-sm-2">
                <div>
                  <span class="d-block mb-0 fs-lg fw-semibold">Jusara</span>
                  Estagiária do INSS
                </div>
              </a>
            </li>
            <li class="nav-item mb-0">
              <a href="#testimonial-3"
                class="nav-link flex-md-row flex-sm-column align-items-md-center align-items-sm-start align-items-center p-md-4 p-3 rounded-3 fw-normal"
                data-bs-toggle="tab" role="tab">
                <img src="assets/img/avatar/50.png" width="56" alt="Avatar"
                  class="rounded-circle me-md-3 me-sm-0 me-3 mb-md-0 mb-sm-2">
                <div>
                  <span class="d-block mb-0 fs-lg fw-semibold">Mel Gibson</span>
                  Founder & amp; CEO, Uber
                </div>
              </a>
            </li>
          </ul>
        </div>

        <!-- Tabs content -->
        <div class="col-sm-7 offset-lg-1 order-sm-2 order-1">
          <div class="tab-content ps-lg-0 ps-md-4">
            <div class="tab-pane fade show active" id="testimonial-1" role="tabpanel">
              <h4 class="mb-3" style="max-width: 22.875rem;">“APP MASSA”</h4>
              <div class="fs-sm text-nowrap">
                
                <!--Tema claro-->
                <div class="imagem-container">
                  <img src="../Principal/img-icon/starFill.png" alt="starFill" class="d-dark-mode-none d-block"
                    style="width: 3.5%; height: 4%;"> 
                  <img src="../Principal/img-icon/starFill.png" alt="starFill" class="d-dark-mode-none d-block"
                    style="width: 3.5%; height: 4%;">
                  <img src="../Principal/img-icon/starFill.png" alt="starFill" class="d-dark-mode-none d-block"
                    style="width: 3.5%;">
                  <img src="../Principal/img-icon/starFill.png" alt="starFill" class="d-dark-mode-none d-block"
                    style="width: 3.5%; height: 4%;">
                  <img src="../Principal/img-icon/star.png" alt="star" class="d-dark-mode-none d-block"
                    style="width: 3.5%; height: 4%;">

                  <!-- Tema Escuro -->
                  <img src="../Principal/img-icon/starGreyFill.png" alt="starGreyFill" class="d-dark-mode-block d-none"
                    style="width: 4%;height: 4%;">
                  <img src="../Principal/img-icon/starGreyFill.png" alt="starGreyFill" class="d-dark-mode-block d-none"
                    style="width: 4%;height: 4%;">
                  <img src="../Principal/img-icon/starGreyFill.png" alt="starGreyFill" class="d-dark-mode-block d-none"
                    style="width: 4%; height: 4%;">
                  <img src="../Principal/img-icon/starGreyFill.png" alt="starGreyFill" class="d-dark-mode-block d-none"
                    style="width: 4%; height: 4%;">
                  <img src="../Principal/img-icon/starGrey.png" alt="starGrey" class="d-dark-mode-block d-none"
                    style="width: 4%; height: 4%;">
                </div>
              </div>
                <p class="mt-md-4 mt-3 pt-lg-3 pt-md-2 mb-0 fs-lg">Fui em uma torcida organizada</p>
              </div>



              <div class="tab-pane fade" id="testimonial-2" role="tabpanel">
                <h4 class="mb-3" style="max-width: 22.875rem;">“Efetivo gostei like”</h4>
                <div class="fs-sm text-nowrap">
                  
                  <!--Tema claro-->
                  <div class="imagem-container">
                    <img src="../Principal/img-icon/starFill.png" alt="starFill" class="d-dark-mode-none d-block"
                      style="width: 3.5%;height: 4%;">
                    <img src="../Principal/img-icon/starFill.png" alt="starFill" class="d-dark-mode-none d-block"
                      style="width: 3.5%;height: 4%;">
                    <img src="../Principal/img-icon/starFill.png" alt="starFill" class="d-dark-mode-none d-block"
                      style="width: 3.5%;height: 4%;">
                    <img src="../Principal/img-icon/starFill.png" alt="starFill" class="d-dark-mode-none d-block"
                      style="width: 3.5%;height: 4%;">
                    <img src="../Principal/img-icon/starHalf.png" alt="starHalf" class="d-dark-mode-none d-block"
                      style="width: 3.5%;height: 4%;">

                    <!--Tema Escuro-->
                    <img src="../Principal/img-icon/starGreyFill.png" alt="starGreyFill"
                      class="d-dark-mode-block d-none" style="width: 4%; height: 4%;">
                    <img src="../Principal/img-icon/starGreyFill.png" alt="starGreyFill"
                      class="d-dark-mode-block d-none" style="width: 4%; height: 4%;">
                    <img src="../Principal/img-icon/starGreyFill.png" alt="starGreyFill"
                      class="d-dark-mode-block d-none" style="width: 4%; height: 4%;">
                    <img src="../Principal/img-icon/starGreyFill.png" alt="starGreyFill"
                      class="d-dark-mode-block d-none" style="width: 4%; height: 4%;">
                    <img src="../Principal/img-icon/starGreyHalf.png" alt="starGreyHalf"
                      class="d-dark-mode-block d-none" style="width: 4%; height: 4%;">
                  </div>
                </div>
                  <p class="mt-md-4 mt-3 pt-lg-3 pt-md-2 mb-0 fs-lg">Joguin hype</p>
                </div>



                <div class="tab-pane fade" id="testimonial-3" role="tabpanel">
                  <h4 class="mb-3" style="max-width: 22.875rem;">“Ruim d+”</h4>
                  <div class="fs-sm text-nowrap">

                    <!--Tema claro-->
                    <div class="imagem-container">
                    <img src="../Principal/img-icon/starFill.png" alt="starFill"
                      class="d-dark-mode-none d-block" style="width: 3.5%;height: 4%;">
                    <img src="../Principal/img-icon/starFill.png" alt="starFill" class="d-dark-mode-none d-block"
                      style="width: 3.5%;height: 4%;">
                    <img src="../Principal/img-icon/starHalf.png" alt="starHalf" class="d-dark-mode-none d-block"
                      style="width: 3.5%;height: 4%;">
                    <img src="../Principal/img-icon/star.png" alt="star" class="d-dark-mode-none d-block"
                      style="width: 3.5%;height: 4%;">
                    <img src="../Principal/img-icon/star.png" alt="star" class="d-dark-mode-none d-block"
                      style="width: 3.5%;height: 4%;">

                    <!--Tema Escuro-->
                    <img src="../Principal/img-icon/starGreyFill.png" alt="starGreyFill"
                      class="d-dark-mode-block d-none" style="width: 4%; height: 4%;">
                    <img src="../Principal/img-icon/starGreyFill.png" alt="starGreyFill"
                      class="d-dark-mode-block d-none" style="width: 4%; height: 4%;">
                    <img src="../Principal/img-icon/starGreyHalf.png" alt="starGreyHalf"
                      class="d-dark-mode-block d-none" style="width: 4%; height: 4%;">
                    <img src="../Principal/img-icon/starGrey.png" alt="starGrey" class="d-dark-mode-block d-none"
                      style="width: 4%; height: 4%;">
                    <img src="../Principal/img-icon/starGrey.png" alt="starGrey" class="d-dark-mode-block d-none"
                      style="width: 4%; height: 4%;">
                  </div>

                  <p class="mt-md-4 mt-3 pt-lg-3 pt-md-2 mb-0 fs-lg">Tão ruim q chega a ser bom.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
  </section>

  <style>
/* Ícone preto para o tema claro */
.form-control {
  background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16"><path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/></svg>');
  background-repeat: no-repeat;
  background-position: left 10px center;
  background-size: 16px 16px;
  padding-left: 32px;
  color: black; /* Define a cor do texto como preta */
}
/* Ícone branco para o tema escuro */
.form-control-black {
  background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16"><path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/></svg>');
  background-repeat: no-repeat;
  background-position: left 10px center;
  background-size: 16px 16px;
  padding-left: 32px;
  color: white; /* Define a cor do texto como branca */
}
.d-dark-mode-block {
height: 55px;
width: 510px;
}

  </style>

  <!-- Sign up CTA -->
  <section class="container">
    <div class="position-relative bg-dark rounded-3 overflow-hidden py-5 px-4 px-sm-0">
      <span class="position-absolute top-0 start-0 d-block w-100 h-100"
        style="background: radial-gradient(116.18% 118% at 50% 100%, rgba(99, 102, 241, 0.1) 0%, rgba(218, 70, 239, 0.05) 41.83%, rgba(241, 244, 253, 0.07) 82.52%);"></span>
      <div class="position-relative row justify-content-center py-sm-2 py-lg-5">
        <div class="col-xl-6 col-lg-7 col-md-8 col-sm-10 text-center">
          <h2 class="h1 text-light mb-4">Pronto para jogar?</h2>
          <p class="fs-lg text-light opacity-70 pb-4 mb-3">Insira seu e-mail para jogar</p>

  <!-- Desktop form -->
  <form class="input-group input-group-lg d-none d-sm-flex needs-validation mb-3" method="post" name="meu-form"
            action="send-mail.php" novalidate>
            <input type="email" class="d-dark-mode-none d-block form-control rounded-start ps-5" name="email"
              id="email1" placeholder="Your email" required>
            <input style="width: 499px ; "type="email" class="d-dark-mode-block d-none form-control-black rounded-start ps-5" name="email2"
              id="email2" placeholder="Your email" required>
            <div class="invalid-tooltip position-absolute top-100 start-0">Por favor, insira um e-mail válido.</div>
            <button type="submit" class="btn btn-primary">Em um clique</button>
          </form>


          <!-- Mobile form -->
          <form class="needs-validation d-sm-none mb-3" novalidate>
            <div class="position-relative mb-3">
              <input type="email" class="d-dark-mode-none d-block form-control rounded-start ps-5" placeholder="Your email" required> 
              <input type="email" class="d-dark-mode-block d-none form-control-black rounded-start ps-5" placeholder="Your email" required> 
                <i class="bi bi-envelope"></i>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                  <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
                </svg>
              <div class="invalid-tooltip position-absolute top-0 start-0 mt-n4">Por favor ensira um email</div>
            </div>
            <button type="submit" class="btn btn-primary btn-lg w-100">Em um click</button>
          </form>
          <p class="fs-sm text-light opacity-50 mb-0">No Stop Play</p>
        </div>
      </div>
    </div>
  </section>

  </main>


  <!-- Footer -->
  <footer class="footer pt-5 pb-4 pb-lg-5">
    <div class="container pt-lg-4">
      <div class="row pb-5">
        <div class="col-lg-4 col-md-6">
          <div class="navbar-brand text-dark p-0 me-0 mb-3 mb-lg-4">
            <img src="../Img/Logo2.PNG" width="85px" style="border-radius: 10px;" alt="Tessera">
            Tessera Game
          </div>
          <p class="fs-sm pb-lg-3 mb-4" style="font-style: italic;">Aut inveniam viam aut faciam</p>
          <form class="needs-validation" novalidate>
            <label for="subscr-email" class="form-label">Se inscreva para mais novidades</label>
            <div class="input-group">
              <input type="email" class="d-dark-mode-none d-block form-control rounded-start ps-5"
                placeholder="Your email" required>
              <input style="height: 45px; width: 275px;" type="email" class="d-dark-mode-block d-none form-control-black rounded-start ps-5"
                placeholder="Your email" required>
              <div class="invalid-tooltip position-absolute top-100 start-0">Por Favor insira um e-mail valido</div>
              <button type="submit" class="btn btn-primary">Inscrever</button>
            
            </div>
          </form>
        </div>

        <div class="col-xl-6 col-lg-7 col-md-5 offset-xl-2 offset-md-1 pt-4 pt-md-1 pt-lg-0">
          <div id="footer-links" class="row">
            <div class="col-lg-4">
              <h6 class="mb-2">
                <a href="#useful-links" class="d-block text-dark dropdown-toggle d-lg-none py-2"
                  data-bs-toggle="collapse">Useful Links</a>
              </h6>
              <div id="useful-links" class="collapse d-lg-block" data-bs-parent="#footer-links">
                <ul class="nav flex-column pb-lg-1 mb-lg-3">
                  <li class="nav-item"><a href="" class="nav-link d-inline-block px-0 pt-1 pb-2">Home</a></li>
                  <li class="nav-item"><a href="#" class="nav-link d-inline-block px-0 pt-1 pb-2">About</a></li>
                </ul>
                <ul class="nav flex-column mb-2 mb-lg-0">
                  <li class="nav-item"><a href="#" class="nav-link d-inline-block px-0 pt-1 pb-2">Terms &amp;
                      Conditions</a></li>
                  <li class="nav-item"><a href="#" class="nav-link d-inline-block px-0 pt-1 pb-2">Privacy Policy</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-xl-4 col-lg-3">
              <h6 class="mb-2">
                <a href="#social-links" class="d-block text-dark dropdown-toggle d-lg-none py-2"
                  data-bs-toggle="collapse">Socials</a>
              </h6>
              <div id="social-links" class="collapse d-lg-block" data-bs-parent="#footer-links">
                <ul class="nav flex-column mb-2 mb-lg-0">
                  <li class="nav-item"><a href="#" class="nav-link d-inline-block px-0 pt-1 pb-2">Twitter</a></li>
                  <li class="nav-item"><a href="https://www.instagram.com/tesseragame/" class="nav-link d-inline-block px-0 pt-1 pb-2">Instagram</a></li>
                </ul>
              </div>
            </div>
            <div class="col-xl-4 col-lg-5 pt-2 pt-lg-0">
              <h6 class="mb-2">Contate-nos</h6>
              <a href="mailto:tesseragame001@gmail.com" class="fw-medium">tesseragame001@gmail.com</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>

<a href="TelaPrincipal.html" class="homeButton" style="left: 950px;"></a>
<div id="gifContainer"></div>

  <!-- Back to top button -->
  <a href="#top" class="btn-scroll-top" data-scroll>
    <span class="btn-scroll-top-tooltip text-muted fs-sm me-2">Top</span>
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"/>
    </svg>
<i class="bi bi-arrow-up"></i>
  </a>

  <!-- Vendor Scripts -->
  <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
  <script src="assets/vendor/rellax/rellax.min.js"></script>
  <script src="assets/vendor/@lottiefiles/lottie-player/dist/lottie-player.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main Theme Script -->
  <script src="assets/js/theme.min.js"></script>
  <script src="JSPrincipal.js"></script>

</body>

</html>
