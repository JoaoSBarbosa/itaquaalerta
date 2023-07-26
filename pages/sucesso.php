<?php
require_once 'db_connect.php';
require_once '../validator/validador_acesso.php';
require_once '../modules/all_head.php';

?>
</head>

<body>
  <?php
  require_once '../modules/header.php'
    ?>
  <div class="main">
    <?php
    require_once '../modules/aside.php'
      ?>
    <div class="content" style="padding: 0;">
      <section class="overview">
        <div class="container_denuncias">
          <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 d-flex align-items-center justify-content-center" style="height: 100%;">
            <div class="">
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
        <div id="grafico"></div>
      </section>
    </div>
  </div>
</body>

</html>