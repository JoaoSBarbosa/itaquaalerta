<?php
require_once '../validator/validador_acesso.php'
  ?>

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

    #section-home {
      display: grid;
      grid-template-columns: 200px 1fr;
    }

    #section-info {
      width: 100%;
      padding: 0;

    }

    #map {
      height: calc(100vh - 200px);
      width: 100%;
    }

    .sidebar {
      height: 100vh;
      padding: 10px 5px;
      width: 100%;
      text-align: left;
    }

    #nav-homer a {
      text-align: left;
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

    .sucesso {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
    }
  </style>
</head>
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
            <span class="nav-link text-white">Bem-vindo(a),
              <?php echo $_SESSION["usuarioNome"]; ?>
            </span>

          </li>
          <li class="nav-item">
            <a class="nav-link text-danger" href="logout.php">Sair</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>