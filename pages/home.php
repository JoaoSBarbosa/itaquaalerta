<?php
require_once '../validator/validador_acesso.php';
require_once 'db_connect.php';

// Função para obter as denúncias do banco de dados
function getDenuncias()
{
  global $conn; // Torna a variável $conn globalmente acessível dentro da função

  if (isset($_SESSION["autenticado"]) && $_SESSION["autenticado"] === "SIM") {
    // O usuário está autenticado
    $usuario_id = $_SESSION["usuarioId"];

    // Verifica se a conexão está estabelecida corretamente
    if ($conn) {
      // Consultar as denúncias feitas pelo usuário
      $sql = "SELECT titulo, descricao, foto FROM denuncias WHERE usuario_id = '$usuario_id' ORDER BY id DESC";
      $resultado = $conn->query($sql);

      $denuncias = array();

      if ($resultado && $resultado->num_rows > 0) {
        while ($denuncia = $resultado->fetch_assoc()) {
          $denuncias[] = $denuncia;
        }
      }

      return $denuncias;
    } else {
      echo "Erro ao conectar ao banco de dados.";
    }
  }

  return array(); // Caso o usuário não esteja autenticado ou não tenha denúncias, retorna um array vazio
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Itaqua Alerta - Home</title>
  <!-- Arquivos CSS do Bootstrap e Leaflet -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
</head>

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
        <div id="denuncias-slider" class="carousel slide d-md-none" data-bs-ride="carousel">
          <div class="carousel-inner">
            <?php
            $denuncias = getDenuncias();
            $numDenuncias = count($denuncias);

            for ($i = 0; $i < $numDenuncias; $i++) {
              $active = $i === 0 ? 'active' : '';
              $denuncia = $denuncias[$i];
              $titulo = $denuncia['titulo'];
              $descricao = $denuncia['descricao'];
              $imagem = $denuncia['foto'];
              ?>
              <div class="carousel-item <?php echo $active; ?>">
                <div class="row" style="border:2px solid red">
                  <div class="col-md-12 mb-4">
                    <div class="card h-90" style="border:2px solid red">
                      <img src="../upload/<?php echo $imagem; ?>" class="card-img-top" alt="<?php echo $titulo; ?>" width="300">
                      <div class="card-body">
                        <h5 class="card-title">
                          <?php echo $titulo; ?>
                        </h5>
                        <p class="card-text">
                          <?php echo $descricao; ?>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php
            }
            ?>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#denuncias-slider" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#denuncias-slider" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>

        <!-- Denúncias em cards lado a lado na versão desktop -->
        <div class="row d-none d-md-flex">
          <?php
          for ($i = 0; $i < $numDenuncias; $i++) {
            $denuncia = $denuncias[$i];
            $titulo = $denuncia['titulo'];
            $descricao = $denuncia['descricao'];
            $imagem = $denuncia['foto'];
            ?>
            <div class="col-md-6 mb-4">
              <div class="card h-100">
                <img src="../upload/<?php echo $imagem; ?>" class="card-img-top" alt="<?php echo $titulo; ?>">
                <div class="card-body">
                  <h5 class="card-title">
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