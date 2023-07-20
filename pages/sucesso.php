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

<body>
  <div class="container-fluid">
    <div class="row" style="height: 100%;" id="section-home">
      <div class="col-md-3 bg-secondary sidebar">
        <!-- Menu lateral -->
        <ul class="nav flex-column align-items-start" id="nav-homer">
          <li class="nav-item w-100">
            <a class="nav-link btn btn-dark w-100 text-white" href="consultar_denuncia.php">Minhas Denúncias</a>
          </li>
          <li class="nav-item w-100">
            <a class="nav-link btn btn-dark w-100 text-white" href="inserir_denuncia.php">Fazer Denúncia</a>
          </li>
          <li class="nav-item w-100 text-left">
            <a class="nav-link btn btn-dark w-100 text-white" href="#">Perfil</a>
          </li>
          <!-- Adicione mais opções de menu conforme necessário -->
        </ul>
      </div>
      <div class="col-md-9" id="section-info">
        <!-- Mapa -->
        <div id="map" class="sucesso">


          <h1>Denúncia enviada com sucesso!</h1>
          <p>Obrigado por contribuir para uma cidade melhor.</p>
          <p>A sua denúncia será analisada pela equipe de fiscalização e, se for confirmada, as medidas cabíveis serão tomadas.</p>
          <p>Agradecemos a sua colaboração!</p>
          <p>
            <img src="../public/img/sucesso.svg" alt="Thumbs up" />
          </p>
        </div>


      </div>
    </div>
  </div>
</body>

</html>