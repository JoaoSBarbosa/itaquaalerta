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

    <div class="content" style="padding: 10px;">
      <section class="overview">

        <div class="row max-width-form">
          <div class="col-lg-4 col-md-6 col-12">
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
          </div>

          <div class="col-lg-8 col-md-6 col-12">
            <div class="imagem-lateral-recupera-senha">
              <img src="../public/img/lateral.svg" alt="Imagem Lateral" class="img-fluid" style="max-width: 50%;">
            </div>
          </div>
        </div>

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