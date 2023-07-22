<?php
require_once 'db_connect.php';
require_once '../validator/validador_acesso.php';
require_once '../modules/all_head.php';
?>

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
          <!-- Div no topo da página -->
          <div id="map" class="map-container"></div>

          <div class="container_denuncias">
            <h1>Útimas Denuncias</h1>
            <div class="ultimas_denuncias">

              <?php
              $denuncias = getDenuncias();
              foreach ($denuncias as $denuncia) {
                $titulo = $denuncia['titulo'];
                $descricao = $denuncia['descricao'];
                $imagem = $denuncia['foto'];
                $categoria = $denuncia['categoria'];
                ?>

                <div class="denuncia_item" id="">
                  <div class="">
                    <div class="denuncia_conteudo">
                      <figure class="img">
                        <img src="../upload/<?php echo $imagem; ?>" class="card-img-top" alt="<?php echo $titulo; ?>" style="height: 225px; object-fit: cover;">
                        <span class="categoria bg-primary text-white rounded px-2 py-1" style="font-size: 12px;">
                          <?php echo $categoria; ?>
                        </span>
                      </figure>
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
              <!-- </div> -->
            </div>
          </div>
          <div id="grafico"></div>
        </section>
      </div>
    </div>

    <!-- <footer>
    &copy;
    <?php echo date("Y"); ?> Seu Site Aqui
  </footer> -->

    <!-- Link para o Bootstrap JS (popper.js e bootstrap.js) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


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