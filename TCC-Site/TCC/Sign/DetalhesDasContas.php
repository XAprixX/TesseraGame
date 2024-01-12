
<?php
  include("Conexão.php");

  if (isset($_GET['user_id'])) {
      $userId = $_GET['user_id'];
    
  } 

    // Verifique a conexão com o banco de dados
    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }
    
    // Consulta SQL para obter os detalhes do usuário com base no ID
    $sql = "SELECT Nickname, Senha, Player_Number, Criacao, Descricao FROM usuario WHERE ID = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId); // 'i' indica que o parâmetro é um inteiro
    
    if ($stmt->execute()) {
      // Obtenha o resultado da consulta
      $result = $stmt->get_result();
      
      if ($result->num_rows > 0) {
          // Recupere os dados do usuário
          $row = $result->fetch_assoc();
          $nickname = $row['Nickname'];
          $senha = $row['Senha'];
          $playerNumber = $row['Player_Number'];
          $dataCriacao = $row['Criacao'];
          $descricao = $row['Descricao'];
          
          // Declare a variável $senha aqui
          $senha = $row['Senha'];
          
          error_reporting(E_ALL);
          ini_set('display_errors', 1);
          
      } else {
          echo "Nenhum usuário encontrado com o ID fornecido.";
      }
  } else {
      echo "Erro na execução da consulta SQL: " . $stmt->error;
  }
  
  // Feche a conexão com o banco de dados
  $conn->close();
 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Detalhes da sua conta</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../Img/Logo2.PNG" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">


  <style>
  /* Estilo para remover o contorno do botão */
  #mostrarSenhaButton {
    border: none;
    background: transparent; /* Adiciona um fundo transparente para remover qualquer aparência de botão */
    cursor: pointer; /* Altera o cursor para uma mão quando o mouse passar sobre o botão */
  }
</style>

</head>

<body>


<script> 

// Função para configurar o avatar a partir do localStorage
function setAvatarFromLocalStorage() {
    var avatarImage = document.getElementById('avatar-image');
    var avatarSrc = localStorage.getItem('selectedAvatar');
    
    if (avatarSrc) {
        avatarImage.src = avatarSrc;
    }
}

// Função para exibir o popup
function mostrarAvatarPopup() {
    var avatarPopup = document.getElementById('avatar-popup');
    avatarPopup.style.display = 'block';
}

// Função para fechar o popup
function fecharAvatarPopup() {
    var avatarPopup = document.getElementById('avatar-popup');
    avatarPopup.style.display = 'none';
}

// Função para mudar o avatar
function changeAvatar(avatarSrc) {
    var avatarImage = document.getElementById('avatar-image');
    avatarImage.src = avatarSrc;

    // Armazena a seleção do avatar no localStorage
    localStorage.setItem('selectedAvatar', avatarSrc);

    // Fecha o popup após selecionar um avatar (opcional)
    fecharAvatarPopup();
}

// Configure o avatar a partir do localStorage ao carregar a página
window.onload = setAvatarFromLocalStorage;



</script>


  <!-- ======= Mobile nav toggle button ======= -->
  <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

  <!-- ======= Header ======= -->
  <header id="header">
    <div class="d-flex flex-column">

      <div class="profile">
        <img src="../JOgo/Img-Jogo/Astronauta.png" alt="Avatar" id="avatar" class="img-fluid rounded-circle">
        <input type="file" id="avatarInput" style="display: none;">
        <h1 class="text-light"><span><?php echo $nickname; ?></span></h1> <!--Nickname-->
        <div class="social-links mt-3 text-center">


        <a href="../Principal/TelaPrincipal.php?user_id=<?php echo $userId; ?>" class="Home"><i class="bx bx-home"></i></a>


          <a href="../JOgo/jogo.php?user_id=<?php echo $userId;?>" class="Game">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-controller" viewBox="0 0 16 16">
            <path d="M11.5 6.027a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-1.5 1.5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zm2.5-.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-1.5 1.5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zm-6.5-3h1v1h1v1h-1v1h-1v-1h-1v-1h1v-1z"/>
            <path d="M3.051 3.26a.5.5 0 0 1 .354-.613l1.932-.518a.5.5 0 0 1 .62.39c.655-.079 1.35-.117 2.043-.117.72 0 1.443.041 2.12.126a.5.5 0 0 1 .622-.399l1.932.518a.5.5 0 0 1 .306.729c.14.09.266.19.373.297.408.408.78 1.05 1.095 1.772.32.733.599 1.591.805 2.466.206.875.34 1.78.364 2.606.024.816-.059 1.602-.328 2.21a1.42 1.42 0 0 1-1.445.83c-.636-.067-1.115-.394-1.513-.773-.245-.232-.496-.526-.739-.808-.126-.148-.25-.292-.368-.423-.728-.804-1.597-1.527-3.224-1.527-1.627 0-2.496.723-3.224 1.527-.119.131-.242.275-.368.423-.243.282-.494.575-.739.808-.398.38-.877.706-1.513.773a1.42 1.42 0 0 1-1.445-.83c-.27-.608-.352-1.395-.329-2.21.024-.826.16-1.73.365-2.606.206-.875.486-1.733.805-2.466.315-.722.687-1.364 1.094-1.772a2.34 2.34 0 0 1 .433-.335.504.504 0 0 1-.028-.079zm2.036.412c-.877.185-1.469.443-1.733.708-.276.276-.587.783-.885 1.465a13.748 13.748 0 0 0-.748 2.295 12.351 12.351 0 0 0-.339 2.406c-.022.755.062 1.368.243 1.776a.42.42 0 0 0 .426.24c.327-.034.61-.199.929-.502.212-.202.4-.423.615-.674.133-.156.276-.323.44-.504C4.861 9.969 5.978 9.027 8 9.027s3.139.942 3.965 1.855c.164.181.307.348.44.504.214.251.403.472.615.674.318.303.601.468.929.503a.42.42 0 0 0 .426-.241c.18-.408.265-1.02.243-1.776a12.354 12.354 0 0 0-.339-2.406 13.753 13.753 0 0 0-.748-2.295c-.298-.682-.61-1.19-.885-1.465-.264-.265-.856-.523-1.733-.708-.85-.179-1.877-.27-2.913-.27-1.036 0-2.063.091-2.913.27z"/>
          </svg>
        </a> <!--Icone de jogo-->
      
          <a href="../Documentação/Documentação.html" class="Documentação">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
              <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
            </svg>
          </a> <!--Icone de Documentação -->

          <a href="https://instagram.com/tesseragame?igshid=MzRlODBiNWFlZA==" class="instagram"><i class="bx bxl-instagram"></i></a> <!--Icone de -->

        </div>
      </div>

      <nav id="navbar" class="nav-menu navbar">
        <ul>
          <li><a href="#hero" class="nav-link scrollto active"><i class="bx bx-home"></i> <span>Home</span></a></li>
          <li><a href="#about" class="nav-link scrollto"><i class="bx bx-user"></i> <span>Sobre Sua Conta</span></a></li>
          <li><a href="#portfolio" class="nav-link scrollto"><i class="bx bx-book-content"></i> <span>Portfolio</span></a></li>
          <li><a href="#contact" class="nav-link scrollto"><i class="bx bx-envelope"></i> <span>Contate-nos</span></a></li>
        </ul>
      </nav><!-- .nav-menu -->
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
    <div class="hero-container" data-aos="fade-in">
      <h1><span><?php echo $nickname; ?></span></h1>
      <p>Eu sou <span class="typed" data-typed-items="Lider de Torcida Organizada, Progamador, Tiktoker, Instragramer"></span></p>
    </div>
  </section><!-- End Hero -->

  <main id="main">

  
       

          </div>
        </div>
       
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">
    
        <div class="section-title">
          <h2>Sobre Sua Conta</h2>
          <p>Aqui aparecem as informações da sua conta</p>
        </div>
    
        <div class="row">
        <div class="col-lg-4" data-aos="fade-right">
<!-- Avatar Display -->

<div id="player-avatar" onclick="mostrarAvatarPopup()" style="left: 200px; top: 25px;">
    <img id="avatar-image" src="../JOgo/Img-Jogo/man.png" alt="Avatar do Jogador" style="left: 100px; width: 300px  ;">
</div>

<!-- Popup de seleção de avatar -->
<div id="avatar-popup" class="avatar-popup" style="display: none;">
    <span class="fechar" onclick="fecharAvatarPopup()">&times;</span>
    <h2>Selecione um Avatar</h2>
    <img src="../JOgo/Img-Jogo/man.png" alt="Avatar 1" onclick="changeAvatar('../JOgo/Img-Jogo/man.png')" style="height: 50px; width:50px ;" />
    <img src="../JOgo/Img-Jogo/man2.png" alt="Avatar 2" onclick="changeAvatar('../JOgo/Img-Jogo/man2.png')" style="height: 50px; width:50px ;"/>
    <img src="../JOgo/Img-Jogo/MWoman.png" alt="Avatar 7" onclick="changeAvatar('../JOgo/Img-Jogo/MWoman.png')"style="height: 50px; width:50px ;" />
    <img src="../JOgo/Img-Jogo/Woman.png" alt="Avatar 3" onclick="changeAvatar('../JOgo/Img-Jogo/Woman.png')" style="height: 50px; width:50px ;"/>
    <img src="../JOgo/Img-Jogo/woman2.png" alt="Avatar 4" onclick="changeAvatar('../JOgo/Img-Jogo/woman2.png')" style="height: 50px; width:50px ;"/>
    <img src="../JOgo/Img-Jogo/woman3.png" alt="Avatar 5" onclick="changeAvatar('../JOgo/Img-Jogo/woman3.png')" style="height: 50px; width:50px ;"/>
    <img src="../JOgo/Img-Jogo/Batman.png" alt="Avatar 6" onclick="changeAvatar('../JOgo/Img-Jogo/Batman.png')"  style="height: 50px; width:50px ;"/>
    <img src="../JOgo/Img-Jogo/Astronauta.png" alt="Avatar 7" onclick="changeAvatar('../JOgo/Img-Jogo/Astronauta.png')" style="height: 50px; width:50px ;" />
</div>
        </div>

    

          <div class="col-lg-8 pt-4 pt-lg-0 content" data-aos="fade-left">
            <h3>Informações:</h3>

            <div class="row">
  <div class="col-lg-6">
  <ul>
  <li><i class="bi bi-chevron-right"></i> <strong>Nickname:</strong> <span><?php echo $nickname; ?></span></li>
 
  <li>
  <i class="bi bi-chevron-right"></i> <strong>Senha:</strong>
  <span>
    <span id="senhaExibida">••••••••</span>
    <button id="mostrarSenhaButton" onclick="mostrarOcultarSenha()">
      <img src="olhoFechado.png" alt="Mostrar Senha" id="mostrarSenhaIcon" style="height: 50px; width: 50px;">
    </button>
  </span>
</li>

<script>
  var senhaVisivel = false;
  var senhaSpan = document.getElementById('senhaExibida');
  var mostrarSenhaButton = document.getElementById('mostrarSenhaButton');
  var mostrarSenhaIcon = document.getElementById('mostrarSenhaIcon');

  function mostrarOcultarSenha() {
    if (!senhaVisivel) {
      // Se a senha estiver oculta, mostre-a
      senhaSpan.textContent = '<?php echo $senha; ?>';
      mostrarSenhaIcon.src = 'olho.png';
      senhaVisivel = true;
    } else {
      // Se a senha estiver visível, oculte-a
      senhaSpan.textContent = '••••••••';
      mostrarSenhaIcon.src = 'olhoFechado.png';
      senhaVisivel = false;
    }
  }
</script>





  <li><i class="bi bi-chevron-right"></i> <strong>ID: </strong><span><?php echo $userId; ?></span></li>
  <li><i class="bi bi-chevron-right"></i> <strong>Número do card:</strong> <span><?php echo $playerNumber; ?></span></li>
  <li><i class="bi bi-chevron-right"></i> <strong>Data de Criação:</strong> <span><?php echo $dataCriacao; ?></span></li>
  <li><i class="bi bi-chevron-right"></i> <strong>Descrição:</strong> <span><?php echo $descricao; ?></span></li>
  <li>
  <a href="excluir_conta.php?user_id=<?php echo $userId; ?>"><button class="btn btn-danger" id="btnExcluirConta">Excluir Conta</button></a>
  </li>
</ul>

<a href="editar.php?id=<?php echo $userId; ?>" class="btn btn-primary">Editar Conta</a>



  </div>
</div>
                
          </div>
        </div>
    
      </div>
    </section>
    <!-- End About Section -->




    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Cards</h2>
          
        </div>

        <div class="row" data-aos="fade-up">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">All</li>
              <li data-filter=".filter-app">Dark</li>
              <li data-filter=".filter-card">Light</li>
              <li data-filter=".filter-web">City</li>
            </ul>
          </div>
        </div>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="100">
<!--Ampliar cada imgagem e mostrar o nick dele com o card-->

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-wrap">
              <img src="../Img/Camp.png" class="img-fluid" alt=""><!--Mudar Aqui a imagem-->
              <div class="portfolio-links">
                <a href="../Img/Camp.png" data-gallery="portfolioGallery" class="portfolio-lightbox" ><i class="bx bx-plus"></i></a><!--Mudar Aqui a imagem-->
                
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="../Img/Laleira.jpg" class="img-fluid" alt=""><!--Mudar Aqui a imagem-->
              <div class="portfolio-links">
                <a href="../Img/Laleira.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" ><i class="bx bx-plus"></i></a><!--Mudar Aqui a imagem-->
   
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-wrap">
              <img src="../Img/Cidade_Fundo.png" class="img-fluid" alt=""><!--Mudar Aqui a imagem-->
              <div class="portfolio-links">
                <a href="../Img/Cidade_Fundo.png" data-gallery="portfolioGallery" class="portfolio-lightbox" ><i class="bx bx-plus"></i></a><!--Mudar Aqui a imagem-->
             
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="../Img/Espaço.jpg" class="img-fluid" alt=""><!--Mudar Aqui a imagem-->
              <div class="portfolio-links">
                <a href="../Img/Espaço.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" ><i class="bx bx-plus"></i></a><!--Mudar Aqui a imagem-->

              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-wrap">
              <img src="../Img/fundoCard.jpeg" class="img-fluid" alt=""><!--Mudar Aqui a imagem-->
              <div class="portfolio-links">
                <a href="../Img/fundoCard.jpeg" data-gallery="portfolioGallery" class="portfolio-lightbox" ><i class="bx bx-plus"></i></a><!--Mudar Aqui a imagem-->
   
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-wrap">
              <img src="../Img/montanhafundo.jpg" class="img-fluid" alt=""><!--Mudar Aqui a imagem-->
              <div class="portfolio-links">
                <a href="../Img/montanhafundo.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox"><i class="bx bx-plus"></i></a><!--Mudar Aqui a imagem-->
          
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-wrap">
              <img src="../Img/TelaBalão.png" class="img-fluid" alt=""><!--Mudar Aqui a imagem-->
              <div class="portfolio-links">
                <a href="../Img/TelaBalão.png" data-gallery="portfolioGallery" class="portfolio-lightbox"><i class="bx bx-plus"></i></a><!--Mudar Aqui a imagem-->
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="../Img/CaindoPixel.jpg" class="img-fluid" alt=""><!--Mudar Aqui a imagem-->
              <div class="portfolio-links">
                <a href="../Img/CaindoPixel.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" ><i class="bx bx-plus"></i></a><!--Mudar Aqui a imagem-->
      
              </div>
            </div>
          </div>

        
                
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Section -->


          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Contato</h2>
          
        </div>

        <div class="row" data-aos="fade-in">

          <div class="col-lg-5 d-flex align-items-stretch">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Location:</h4>
                <p>R. Afonso Sardinha, 90 - Bairro Minas Talco, Ouro Branco - MG</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>tesseragame001@gmail.com</p>
              </div>

        
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3736.817661871551!2d-43.7157805883046!3d-20.513699680930667!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xa3e4a98f14d819%3A0xe019c5fcdb31b181!2sInstituto%20Federal%20de%20Minas%20Gerais%20-%20Campus%20Ouro%20Branco!5e0!3m2!1spt-BR!2sus!4v1696943832310!5m2!1spt-BR!2sus" width="450" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

          </div>

          <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="name">Seu Nickname/Nome</label>
                  <input type="text" name="name" class="form-control" id="name" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="name">Seu E-mail</label>
                  <input type="email" class="form-control" name="email" id="email" required>
                </div>
              </div>
              <div class="form-group">
                <label for="name">Titulo</label>
                <input type="text" class="form-control" name="subject" id="subject" required>
              </div>
              <div class="form-group">
                <label for="name">Mensagem</label>
                <textarea class="form-control" name="message" rows="10" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Sua mensagem foi enviada. Obrigado!</div>
              </div>
              <div class="text-center"><button type="submit">Envie</button></div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->


    
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Tessera Game</span></strong>
      </div>
      <div class="credits">
        Designed by Tessera Game
      </div>
    </div>
  </footer><!-- End  Footer -->


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/typed.js/typed.umd.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>

