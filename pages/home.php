<?php
require_once 'db_connect.php';
require_once '../validator/validador_acesso.php';
require_once '../modules/head.php';
?>
<style>
  .card-img-top {
    width: 100%;
    /* Definir a largura da imagem como 100% do contêiner pai */
    height: 350px;
    /* Definir uma altura fixa ou a altura desejada */
    object-fit: cover;
    /* Faz com que a imagem preencha o espaço sem perder a proporção */
  }
</style>

<body>
  <?php
  require_once '../modules/header.php'
    ?>

  <div class="container-fluid">
    <div class="row">
      <!-- Barra lateral esquerda (mapa) -->
      <?php
      require_once '../modules/barra_lateral.php'
        ?>

      <!-- Conteúdo principal (slide de denúncias) -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <!-- Mapa -->
        <div id="map" style="height: 300px;"></div>
        <h3 class="text-center mt-3">Últimas Denúncias</h3>
        <!-- Denúncias em cards responsivos -->
        <div class="row row-cols-1 row-cols-md-3 g-4">
          <?php
          $denuncias = getDenuncias();
          foreach ($denuncias as $denuncia) {
            $titulo = $denuncia['titulo'];
            $descricao = $denuncia['descricao'];
            $imagem = $denuncia['foto'];
            $categoria = $denuncia['categoria'];
            ?>
            <div class="col mb-4">
              <div class="card h-100">
                <img src="../upload/<?php echo $imagem; ?>" class="card-img-top" alt="<?php echo $titulo; ?>">
                <div class="card-body">
                  <span class="categoria bg-primary text-white rounded px-2 py-1" style="font-size: 12px;">
                    <?php echo $categoria; ?>
                  </span>
                  <h5 class="card-title" style="margin: 10px 0px;">
                    <?php echo $titulo; ?>
                  </h5>

                  <p class="card-text">
                    <?php echo $descricao; ?>
                  </p>
                </div>
              </div>
            </div>
            <?php
          }
          ?>
        </div>


      </main>
    </div>
  </div>

  <!-- Inclua aqui os scripts necessários para o serviço de mapa e notícias -->
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../public/js/home.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>