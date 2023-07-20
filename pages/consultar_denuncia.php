<?php
require_once '../validator/validador_acesso.php';
?>


<!DOCTYPE html>
<html lang="pt-BR">
<style>
  /* Estilos para as denúncias */
  .d-flex.flex-wrap {
    justify-content: space-between;
  }

  .card-consultar-chamado .card {
    width: calc(50% - 1rem);
    /* Duas colunas, com 1rem de espaço entre elas */
    margin-bottom: 1rem;
  }

  @media (max-width: 768px) {
    .card-consultar-chamado .card {
      width: 100%;
      /* Uma coluna em telas menores */
    }
  }
</style>

<?php
require_once '../modules/head_home.php'
  ?>
<?php

require_once '../pages/db_connect.php'; // Certifique-se de incluir o arquivo de conexão com o banco de dados
if (isset($_SESSION["autenticado"]) && $_SESSION["autenticado"] === "SIM") {
  // O usuário está autenticado
  $usuario_id = $_SESSION["usuarioId"];
}

// Consultar as denúncias feitas pelo usuário
$sql = "SELECT * FROM denuncias WHERE usuario_id = '$usuario_id'";
$resultado = $conn->query($sql);

?>
<header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center gap-2" href="../pages/home.php" id="logo">
        <img src="../public/img/logo-index.png" height="60" alt="">
        Itaqua Alerta
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <!-- Exibir nome do usuário logado -->
            <span class="nav-link text-white">Bem-vindo(a),
              <?php echo $_SESSION["usuarioNome"]; ?>
            </span>

          </li>
          <li class="nav-item">
            <a class="nav-link text-danger" href="logout.php">Sair</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>

<body>
  <div class="container-fluid">
    <div class="row" style="height: 100%;" id="section-home">
      <div class="col-md-3 bg-secondary sidebar">
        <!-- Menu lateral -->
        <ul class="nav flex-column align-items-start" id="nav-homer">
          <li class="nav-item w-100">
            <a class="nav-link btn btn-dark w-100 text-white" href="consultar_denuncia.php">Minhas Denúncias</a>
          </li>
          <li class="nav-item w-100">
            <a class="nav-link btn btn-dark w-100 text-white" href="inserir_denuncia.php">Fazer Denúncia</a>
          </li>
          <li class="nav-item w-100 text-left">
            <a class="nav-link btn btn-dark w-100 text-white" href="#">Perfil</a>
          </li>
          <!-- Adicione mais opções de menu conforme necessário -->
        </ul>
      </div>
      <div class="col-md-9" id="section-info">
        <!-- Mapa -->
        <div id="map">
          <div class="container mt-4">
            <div class="row">
              <div class="card-consultar-chamado">
                <div class="card" style="width: 100%;">
                  <div class="card-header">
                    Consulta de denuncias
                  </div>
                  <div class="card-body">
                    <div class="d-flex flex-wrap">
                      <?php
                      // Verificar se há denúncias para exibir
                      if ($resultado->num_rows > 0) {
                        // Loop através das denúncias encontradas
                        while ($denuncia = $resultado->fetch_assoc()) {
                          ?>
                          <div class="card mb-3 bg-light mx-2" style="border:2px solid gray; max-width: 400px;">
                            <div class="card-body">
                              <h5 class="card-title">
                                <?php echo $denuncia["titulo"]; ?>
                              </h5>
                              <hr />
                              <h6 class="card-subtitle mb-2 text-muted border border-success p-1" style="max-width: max-content; border-radius:5px; background-color: green; color:#fff">
                                <?php echo $denuncia["categoria"]; ?>
                              </h6>
                              <hr />
                              <p class="card-text">
                                <?php echo $denuncia["descricao"]; ?>
                              </p>
                              <img class="denuncia-img" src="../upload/<?php echo $denuncia["foto"]; ?>" alt="<?php echo $denuncia["titulo"]; ?>" height="300" style="width: 100%; object-fit: contain;">
                            </div>
                          </div>
                          <?php
                        }
                      } else {
                        // Caso não haja denúncias para exibir
                        echo '<p>Nenhuma denúncia encontrada.</p>';
                      }
                      ?>
                    </div>
                    <div class="row mt-5">
                      <div class="col-6">
                        <a class="btn btn-lg btn-warning btn-block" href="pagina_anterior.php">Voltar</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>