<?php
require_once '../validator/validador_acesso.php';
require_once 'db_connect.php';

// Função para obter todas as denúncias do banco de dados
function getAllDenuncias($categoriaSelecionada = null)
{
  global $conn;

  if (isset($_SESSION["autenticado"]) && $_SESSION["autenticado"] === "SIM") {
    // O usuário está autenticado
    $usuario_id = $_SESSION["usuarioId"];

    // Verifica se a conexão está estabelecida corretamente
    if ($conn) {
      // Monta a query para consultar as denúncias
      $sql = "SELECT id, titulo, descricao, foto FROM denuncias";

      // Se uma categoria foi selecionada, filtra as denúncias por categoria
      if ($categoriaSelecionada) {
        $categoriaSelecionada = $conn->real_escape_string($categoriaSelecionada); // Evita SQL injection
        $sql .= " WHERE categoria = '$categoriaSelecionada'";
      }

      $sql .= " ORDER BY id DESC";

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

  return array(); // Caso o usuário não esteja autenticado ou não haja denúncias, retorna um array vazio
}

// Função para obter todas as categorias do banco de dados
function getAllCategorias()
{
  global $conn;

  if ($conn) {
    // Use DISTINCT para obter apenas categorias únicas da tabela de denúncias
    $sql = "SELECT DISTINCT categoria FROM denuncias";
    $resultado = $conn->query($sql);

    $categorias = array();

    if ($resultado && $resultado->num_rows > 0) {
      while ($categoria = $resultado->fetch_assoc()) {
        $categorias[] = $categoria;
      }
    }

    return $categorias;
  } else {
    echo "Erro ao conectar ao banco de dados.";
  }

  return array();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Itaqua Alerta - Consultar Denúncias</title>
  <!-- Arquivo css -->
  <link rel="stylesheet" href="../public/css/home.css">
  <!-- Arquivos CSS do Bootstrap e Leaflet -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
  <!-- Biblioteca Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
  <?php require_once '../modules/header.php'; ?>

  <div class="container-fluid">
    <div class="row" style="height: 100vh;">
      <!-- Barra lateral esquerda -->
      <?php require_once '../modules/barra_lateral.php'; ?>

      <!-- Conteúdo principal (todas as denúncias) -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 h-100" style="height: 100vh;">
        <h3 class="text-center mt-3">Todas as Denúncias</h3>
        <form method="get" class="mb-4">
          <div class="form-group">
            <label for="categoria">Filtrar por Categoria:</label>
            <select name="categoria" id="categoria" class="form-control" onchange="this.form.submit()">
              <option value="">Todas as Categorias</option>
              <?php
              // Obter todas as categorias disponíveis do banco de dados
              $categorias = getAllCategorias();

              foreach ($categorias as $categoria) {
                $nomeCategoria = $categoria['categoria'];
                ?>
                <option value="<?php echo $nomeCategoria; ?>" <?php if (isset($_GET['categoria']) && $_GET['categoria'] === $nomeCategoria)
                     echo 'selected'; ?>>
                  <?php echo $nomeCategoria; ?>
                </option>
                <?php
              }
              ?>
            </select>
          </div>
        </form>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
          <?php
          // Obtém todas as denúncias do banco de dados com base na categoria selecionada (ou todas se nenhuma categoria for selecionada)
          $categoriaSelecionada = isset($_GET['categoria']) ? $_GET['categoria'] : null;
          $denuncias = getAllDenuncias($categoriaSelecionada);
          $numDenuncias = count($denuncias);

          if ($numDenuncias > 0) {
            foreach ($denuncias as $denuncia) {
              $titulo = $denuncia['titulo'];
              $descricao = $denuncia['descricao'];
              $imagem = $denuncia['foto'];
              $id = $denuncia['id'];

              ?>
              <div class="col">
                <div class="card shadow-sm custom-card flex-fill" style="height: 100%;">
                  <a href="#" data-bs-toggle="modal" data-bs-target="#modalDenuncia<?php echo $id; ?>">
                    <img src="../upload/<?php echo $imagem; ?>" class="card-img-top" alt="<?php echo $titulo; ?>" style="height: 225px; object-fit: cover;">
                    <div class="card-body card-body-fixed-height d-flex flex-column">
                      <h5 class="card-title">
                        <?php echo $titulo; ?>
                      </h5>
                      <p class="card-text flex-fill">
                        <?php echo $descricao; ?>
                      </p>
                    </div>
                  </a>
                </div>
              </div>
              <!-- Modal da denúncia -->
              <div class="modal fade" id="modalDenuncia<?php echo $id; ?>" tabindex="-1" aria-labelledby="modalDenuncia<?php echo $id; ?>" aria-hidden="true">

                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modalDenuncia<?php echo $id; ?>Label"><?php echo $titulo; ?></h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <img src="../upload/<?php echo $imagem; ?>" class="img-fluid mb-3" alt="<?php echo $titulo; ?>">
                      <p>
                        <?php echo $descricao; ?>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <?php
            }
          } else {
            echo '<div class="col-md-12 text-center"><p>Nenhuma denúncia encontrada.</p></div>';
          }
          ?>
        </div>
      </main>
    </div>
  </div>

  <!-- Inclua aqui os scripts necessários para o serviço de mapa e notícias -->
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>