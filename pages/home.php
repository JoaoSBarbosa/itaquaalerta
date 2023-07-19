<?php
session_start();

if (!isset($_SESSION["autenticado"]) || $_SESSION["autenticado"] != 'SIM') {
  header('Location: ../index.php?login=erro2');
}


?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Itaqua Alerta - Home</title>

  <!-- Inclua aqui os links para os arquivos CSS do Bootstrap e Leaflet -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">

  <style>
    /* Estilos personalizados */
    html,
    body {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    #map {
      height: calc(100vh - 200px);
    }

    .sidebar {
      background-color: #f8f9fa;
      height: 100vh;
      padding: 10px;
    }

    .navbar-brand {
      font-weight: bold;
    }

    .nav-link {
      color: #000;
    }

    .news {
      margin-top: 20px;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">Itaqua Alerta</a>
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