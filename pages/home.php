<?php
require_once 'db_connect.php';
require_once '../validator/validador_acesso.php';
require_once '../modules/all_head.php';

// Obter os dados do banco de dados
$dadosCategorias = getCategoriasMaisOcorrencias();
$dadosBairros = getBairrosMaisOcorrencias();
$dadosRuas = getRuasMaisOcorrencias();
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
            <!-- GRAFICOS> -->
          </div>
        </div>
        <div id="grafico" class="container-fluid">
          <h1 class="text-center my-5">Dashboard de Ocorrências</h1>
          <div class="row">
            <div class="grafico-container col-lg-4 col-md-6 col-12 d-flex flex-column align-items-center">
              <h2>Setores</h2>
              <canvas id="grafico-categorias"></canvas>
            </div>

            <div class="grafico-container col-lg-4 col-md-6 col-12 d-flex flex-column align-items-center">
              <h2>Bairros</h2>
              <canvas id="grafico-bairros"></canvas>
            </div>

            <div class="grafico-container col-lg-4 col-md-6 col-12 d-flex flex-column align-items-center">
              <h2>Ruas</h2>
              <canvas id="grafico-ruas"></canvas>
            </div>
          </div>
        </div>

      </section>
    </div>
  </div>
  <!-- Script para o mapa -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
  <script>
    // Função para criar um gráfico circular (donut chart)
    function criarDonutChart(elementId, data, labels) {
      var ctx = document.getElementById(elementId).getContext('2d');

      new Chart(ctx, {
        type: 'doughnut',
        data: {
          datasets: [{
            data: data,
            backgroundColor: [
              '#ff6384',
              '#36a2eb',
              '#ffce56',
              '#4bc0c0',
              '#9966ff',
              '#ff9f40'
            ]
          }],
          labels: labels
        },
        options: {
          cutout: '75%',
          plugins: {
            legend: {
              display: true,
              position: 'bottom'
            }
          }
        }
      });
    }

    // Chamar a função para criar os gráficos quando o DOM estiver pronto
    document.addEventListener('DOMContentLoaded', function () {
      var dadosCategorias = <?php echo json_encode($dadosCategorias); ?>;
      var categorias = Object.keys(dadosCategorias);
      var totalOcorrenciasCategorias = Object.values(dadosCategorias);

      var dadosBairros = <?php echo json_encode($dadosBairros); ?>;
      var bairros = Object.keys(dadosBairros);
      var totalOcorrenciasBairros = Object.values(dadosBairros);

      var dadosRuas = <?php echo json_encode($dadosRuas); ?>;
      var ruas = Object.keys(dadosRuas);
      var totalOcorrenciasRuas = Object.values(dadosRuas);

      criarDonutChart('grafico-categorias', totalOcorrenciasCategorias, categorias);
      criarDonutChart('grafico-bairros', totalOcorrenciasBairros, bairros);
      criarDonutChart('grafico-ruas', totalOcorrenciasRuas, ruas);
    });


  </script>


</body>

</html>