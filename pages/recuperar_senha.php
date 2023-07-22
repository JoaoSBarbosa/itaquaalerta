<?php
require_once 'db_connect.php';
require_once '../validator/validador_acesso.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Seu Título Aqui</title>
  <!-- Link para o Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="../public/css/main.css">

  <style>
    html,
    body {
      height: 100%;
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    header {
      background-color: #333;
      color: #fff;
      padding: 10px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .logo {
      font-size: 20px;
      font-weight: bold;
    }

    #logo_link {
      transition: all ease-in-out .3s;
    }

    #logo_link:hover {
      color: #007BFF !important;
    }

    .hamburger {
      font-size: 24px;
      cursor: pointer;
      display: none;
    }

    nav {
      display: flex;
      align-items: center;
    }

    nav ul {
      list-style: none;
      padding: 0;
      margin: 0;
      display: flex;
    }

    nav li {
      padding: 10px;
    }

    .main {
      display: flex;
      flex-wrap: wrap;
    }

    .sidebar {
      background-color: #f2f2f2;
      /* padding: 20px; */
      position: sticky;
      top: 60px;
      bottom: 0;
      min-height: calc(100vh - 60px);
      /* Definindo altura mínima para ocupar toda a tela */
      width: 250px;
    }

    .content {
      flex: 1;
      padding: 20px;
    }

    /* MAPA */
    .map-container {
      position: relative;
    }

    #map {
      width: 100%;
      height: 30vh;
    }

    /* DENUNCIAS */
    .ultimas_denuncias {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
      padding: 5px;
      border: 2px solid red;
    }

    .container_denuncias {
      margin: 10px;
    }

    .denuncia_item {
      padding: 10px;
      border: 2px solid #cccccc;
      border-radius: 8px;
      -webkit-box-shadow: -8px 0px 17px -16px rgba(0, 0, 0, 0.75);
      -moz-box-shadow: -8px 0px 17px -16px rgba(0, 0, 0, 0.75);
      box-shadow: -8px 0px 17px -16px rgba(0, 0, 0, 0.75);
    }

    .denuncia_conteudo {
      display: flex;
      flex-direction: column;
      gap: 10px;
      justify-content: space-between;
    }

    .img {
      position: relative;
    }

    .card-img-top {
      object-fit: cover;
      height: 300px;
      border-radius: 8px;
    }

    .categoria {
      font-size: 12px;
      max-width: max-content;
      position: absolute;
      right: 10px;
      bottom: 5px;
    }

    @media (max-width: 992px) {
      .denuncia_item {
        flex-basis: 100%;
        max-width: 100%;
      }
    }

    @media (max-width: 1330px) {
      .ultimas_denuncias {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 890px) {
      .ultimas_denuncias {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
      }
    }

    /* FOOTER */
    footer {
      background-color: #333;
      color: #fff;
      text-align: center;
      padding: 10px;
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
    }

    /* Estilos para tornar o layout responsivo */

    @media (max-width: 768px) {
      header {
        flex-direction: column;
        align-items: center;
      }

      .hamburger {
        display: block;
      }

      nav {
        display: none;
        width: 100%;
        background-color: #333;
        color: #fff;
        text-align: center;
      }

      nav ul {
        flex-direction: column;
      }

      nav li:first-child {
        margin-top: 10px;
      }

      nav li:last-child {
        margin-bottom: 10px;
      }

      .main {
        flex-direction: column;
      }

      .sidebar {
        width: 100%;
        position: static;
        top: 0;
        min-height: auto;
      }

      .content {
        order: 1;
      }

      .sidebar.collapsed {
        display: none;
      }

      .header-mobile-visible {
        display: flex;
      }
    }
  </style>
</head>

<body>
  <header>
    <div class="logo">
      <a class="navbar-brand text-white hover:text-black" href="./home.php" id="logo_link">Itaquá Alerta <i class="fas fa-bullhorn"></i></a>
    </div>
    <div class="hamburger" onclick="toggleSidebar()">&#9776;</div>
    <nav class="d-none d-md-flex">
      <ul class="d-flex flex-row align-items-center justify-content-between">
        <li class="nav-link text-center">Bem-vindo(a),
          <?php echo $_SESSION["usuarioNome"]; ?>
        </li>
        <li class="nav-item">
          <a class="btn btn-danger" href="logout.php">Sair</a>
        </li>
      </ul>
    </nav>
  </header>

  <!-- Menu do header para dispositivos móveis -->
  <nav class="mobile-menu d-md-none">
    <ul class="d-flex flex-column w-100 align-items-center">
      <li>Bem-vindo, Usuário</li>
      <li>Menu Sair</li>
    </ul>
  </nav>

  <div class="main">
    <aside class="sidebar">
      <!-- Conteúdo da Sidebar -->
      <ul class="list-group">
        <a href="#" class="list-group-item list-group-item-action active">
          <i class="fas fa-home"></i>
          Home
        </a>
        <a href="#" class="list-group-item list-group-item-action">
          <i class="fas fa-user"></i>
          Perfil
        </a>
        <a href="#" class="list-group-item list-group-item-action">
          <i class="fas fa-search"></i>
          Todas as Denuncias
        </a>
        <a href="#" class="list-group-item list-group-item-action">
          <i class="fas fa-exclamation-circle"></i>
          Fazer Denuncia
        </a>
      </ul>
    </aside>

    <div class="content" style="padding: 0;">
      <section class="overview">
        <!-- Div no topo da página -->
        <!-- <div id="map" class="map-container"></div> -->

        <div class="container_denuncias">

          <div class="col-lg-4 col-md-6 col-12 max-width-form">

            <div class="card text-center mt-5">
              <div class="card-body">
                <h4 class="card-title">Perdeu sua senha?</h4>
                <p class="card-text">Insira seu endereço de e-mail cadastrado e enviaremos um link para você resetar sua senha.</p>
                <form action="enviar_link.php" method="post">
                  <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                  </div>
                  <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary btn-lg">Resetar Senha</button>
                    <a href="home.php" class="btn btn-secondary btn-lg mt-2 mt-lg-0">Voltar</a>
                  </div>
                </form>
              </div>
            </div>

            <div class="imagem-lateral-recupera-senha">
              <img src="../public/img/lateral.svg" alt="Imagem Lateral">
            </div>

          </div>

        </div>
        <div id="grafico"></div>
      </section>
    </div>
  </div>



  <!-- Link para o Bootstrap JS (popper.js e bootstrap.js) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



  <!-- Link para o Bootstrap JS (popper.js e bootstrap.js) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- Link para o Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

  <!-- Script personalizado para alternar os modos de tema e inicializar o mapa -->
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
  <script>
    function toggleSidebar() {
      const sidebar = document.querySelector('.sidebar');
      sidebar.classList.toggle('collapsed');

      // Oculta ou exibe o menu do header para dispositivos móveis
      const headerMobile = document.querySelector('.mobile-menu');
      headerMobile.classList.toggle('header-mobile-visible');
    }

    function initMap(latitude, longitude) {
      const map = L.map("map").setView([latitude, longitude], 12);

      L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution:
          'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
        maxZoom: 18,
      }).addTo(map);

      L.marker([latitude, longitude]).addTo(map);
    }

    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
          function (position) {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;
            initMap(latitude, longitude);
          },
          function (error) {
            console.error("Erro ao obter a localização do usuário:", error);
            const defaultLatitude = -23.543;
            const defaultLongitude = -46.736;
            initMap(defaultLatitude, defaultLongitude);
          }
        );
      } else {
        console.error("Geolocalização não é suportada neste navegador.");
        const defaultLatitude = -23.543;
        const defaultLongitude = -46.736;
        initMap(defaultLatitude, defaultLongitude);
      }
    }

    // Chamar a função getLocation() assim que o DOM estiver pronto
    document.addEventListener('DOMContentLoaded', function () {
      getLocation();
    });

  </script>
</body>

</html>