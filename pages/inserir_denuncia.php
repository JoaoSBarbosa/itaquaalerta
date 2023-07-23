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
        <!-- Div no topo da página -->
        <!-- <div id="map" class="map-container"></div> -->

        <div class="container_denuncias">
          <div class="row">
            <div class="col-md-6 <?php echo (isset($_SESSION['mobile']) && $_SESSION['mobile']) ? 'order-md-last' : 'order-md-first'; ?>">
              <figure>
                <img src="../public/img/denuncia.svg" alt="Figura denuncia">
              </figure>
            </div>
            <div class="col-md-6 <?php echo (isset($_SESSION['mobile']) && $_SESSION['mobile']) ? 'order-md-last' : 'order-md-first'; ?>">
              <h3 class="mb-4">Formulário de Denúncia</h3>
              <form action="../validator/valida_denuncia.php" method="post" enctype="multipart/form-data" class="custom-form">
                <input type="hidden" name="usuario_id" value="<?php echo $_SESSION["usuarioId"]; ?>">
                <div class="mb-3">
                  <label for="titulo" class="form-label">Título</label>
                  <input type="text" class="form-control" id="titulo" name="titulo" required>
                </div>

                <div class="mb-3">
                  <label for="descricao" class="form-label">Descrição</label>
                  <textarea class="form-control" id="descricao" name="descricao" rows="4" required></textarea>
                </div>

                <div class="mb-3">
                  <label for="arquivo" class="form-label">Arquivo</label>
                  <input type="file" class="form-control" id="arquivo" name="foto" required>
                </div>

                <div class="mb-3">
                  <label for="categoria" class="form-label">Categoria</label>
                  <select class="form-select p-1" id="categoria" name="categoria" required>
                    <option value="">Selecione uma categoria</option>
                    <option value="rua_degradada">Rua degradada</option>
                    <option value="violencia">Violência e Roubo</option>
                    <option value="poluição">Poluição Ambiental</option>
                    <option value="serviços_publicos">Serviços Públicos</option>
                    <option value="alagamento">Alagamento</option>
                    <option value="agua_energia">Agua e Energia</option>
                    <option value="outros">Outros</option>
                  </select>
                </div>

                <!-- Campos adicionais -->
                <div class="mb-3">
                  <label for="bairro_da_ocorrencia" class="form-label">Bairro da Ocorrência</label>
                  <input type="text" class="form-control" id="bairro_da_ocorrencia" name="bairro_da_ocorrencia" required>
                </div>

                <div class="mb-3">
                  <label for="rua_da_ocorrencia" class="form-label">Rua da Ocorrência</label>
                  <input type="text" class="form-control" id="rua_da_ocorrencia" name="rua_da_ocorrencia" required>
                </div>

                <div class="mb-3">
                  <label for="numero_aproximado" class="form-label">Número Aproximado</label>
                  <input type="number" class="form-control" id="numero_aproximado" name="numero_aproximado" required>
                </div>

                <div class="mb-3">
                  <label for="data_da_ocorrencia" class="form-label">Data da Ocorrência</label>
                  <input type="date" class="form-control" id="data_da_ocorrencia" name="data_da_ocorrencia" required>
                </div>

                <button type="submit" class="btn btn-primary">Enviar Denúncia</button>
              </form>
            </div>
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