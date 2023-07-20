<?php
require_once '../validator/validador_acesso.php';
require_once 'db_connect.php';

// Função para obter todas as denúncias do banco de dados
function getAllDenuncias($categoriaSelecionada = null)
{
  global $conn; // Torna a variável $conn globalmente acessível dentro da função

  if (isset($_SESSION["autenticado"]) && $_SESSION["autenticado"] === "SIM") {
    // O usuário está autenticado
    $usuario_id = $_SESSION["usuarioId"];

    // Verifica se a conexão está estabelecida corretamente
    if ($conn) {
      // Monta a query para consultar as denúncias
      $sql = "SELECT titulo, descricao, foto FROM denuncias";

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
require_once '../modules/head.php'
  ?>

<body>
  <?php
  require_once '../modules/header.php'

    ?>

  <div class="container-fluid">
    <div class="row">
      <!-- Barra lateral esquerda -->
      <?php
      require_once '../modules/barra_lateral.php'
        ?>

      <!-- Conteúdo principal (todas as denúncias) -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
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
        <div class="row">
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
              ?>
              <div class="col-md-4 mb-4">
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