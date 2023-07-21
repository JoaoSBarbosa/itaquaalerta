<?php
require_once '../validator/validador_acesso.php';
require_once '../modules/head.php';
?>

<body>
  <?php
  require_once '../modules/header.php';
  ?>

  <div class="container-fluid" style="height: 100vh;">
    <div class="row" style="height: 100%;">
      <!-- Barra lateral esquerda -->
      <?php
      require_once '../modules/barra_lateral.php';
      ?>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 d-flex align-items-center justify-content-center" style="height: 100%;">
        <div class="" style="width: max-content;">
          <h1>Denúncia enviada com sucesso!</h1>
          <p>Obrigado por contribuir para uma cidade melhor.</p>
          <p>A sua denúncia será analisada pela equipe de fiscalização e, se for confirmada, as medidas cabíveis serão tomadas.</p>
          <p>Agradecemos a sua colaboração!</p>

          <p>
            <img src="../public/img/sucesso.svg" alt="Thumbs up" class="img-fluid" />
          </p>
          <a href="home.php" class="btn btn-outline-success py-2 px-5">Voltar</a>
        </div>
      </main>
    </div>
  </div>

</body>

</html>