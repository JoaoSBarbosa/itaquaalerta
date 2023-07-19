<?php
require_once '../validator/validador_acesso.php';
?>


<!DOCTYPE html>
<html lang="pt-BR">

<?php
require_once '../modules/head_home.php'
  ?>

<header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center gap-2" href="#" id="logo">
        <img src="../public/img/logo-index.png" height="60" alt="">
        Itaqua Alerta
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <!-- Exibir nome do usuário logado -->
            <span class="nav-link">Bem-vindo(a),
              <?php echo $_SESSION["usuarioNome"]; ?>
            </span>

          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Sair</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>

<body>
  <div class="container-fluid">
    <div class="row" style="height: 100%;">
      <div class="col-md-3 bg-light sidebar">
        <!-- Menu lateral -->
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link btn btn-light" href="#">Minhas Denúncias</a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn btn-light" href="#">Fazer Denúncia</a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn btn-light" href="#">Perfil</a>
          </li>
          <!-- Adicione mais opções de menu conforme necessário -->
        </ul>
      </div>
      <div class="col-md-9">
        <!-- Mapa -->
        <div id="map"></div>

        <!-- Notícias -->
        <div class="col-md-3">
          <!-- Notícias -->
          <div id="news">
            <h3>Últimas Notícias</h3>
            <ul id="news-list"></ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Inclua aqui os scripts necessários para o serviço de mapa e notícias -->
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    // Inicializar o mapa
    var latitude = -23.543;
    var longitude = -46.736;
    var zoom = 12;

    var map = L.map('map').setView([latitude, longitude], zoom);

    // Adicionar camada de mapa
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
      maxZoom: 18,
    }).addTo(map);

    // Adicionar marcador
    L.marker([latitude, longitude]).addTo(map);

    // Função para buscar as notícias
    function getNews() {
      var url = 'https://newsapi.org/v2/everything?' +
        'q=ruas+esburacadas&' + // Termo de busca relacionado às ruas esburacadas
        'from=2023-07-19&' + // Data de início da busca
        'sortBy=popularity&' + // Ordenar por popularidade
        'apiKey=d447be91488848cdb8d316bfa1f27e16'; // Insira sua chave de API do NewsAPI aqui

      fetch(url)
        .then(function (response) {
          return response.json();
        })
        .then(function (data) {
          var newsList = document.getElementById('news-list');
          data.articles.forEach(function (article) {
            var li = document.createElement('li');
            var link = document.createElement('a');
            link.href = article.url;
            link.textContent = article.title;
            li.appendChild(link);
            newsList.appendChild(li);
          });
        })
        .catch(function (error) {
          console.log('Erro ao buscar notícias:', error);
        });
    }

    // Chamar a função para obter a localização do usuário e exibir o mapa
    getLocation();

    // Chamar a função para buscar as notícias
    getNews();
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>