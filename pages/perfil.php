<?php
// Incluir o arquivo de validação de acesso e a conexão com o banco de dados
require_once '../validator/validador_acesso.php';
require_once 'db_connect.php';

// Função para obter os dados do usuário do banco de dados
function getUsuarioData()
{
  global $conn;
  $usuario_id = $_SESSION["usuarioId"];

  if ($conn) {
    $sql = "SELECT nome, email, senha, data_nascimento, celular FROM usuarios WHERE id = '$usuario_id'";
    $resultado = $conn->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
      return $resultado->fetch_assoc();
    }
  }

  return array();
}

// Função para atualizar os dados do usuário no banco de dados
function atualizarUsuario($email, $celular, $senha)
{
  global $conn;
  $usuario_id = $_SESSION["usuarioId"];

  if ($conn) {
    // Realiza a atualização dos dados do usuário
    $sql = "UPDATE usuarios SET email = '$email', celular = '$celular'";

    if (!empty($senha)) {
      // Se o campo Nova Senha estiver preenchido, atualizamos também a senha
      $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
      $sql .= ", senha = '$senha_hash'";
    }

    $sql .= " WHERE id = '$usuario_id'";

    if ($conn->query($sql) === TRUE) {
      return true; // Dados do usuário atualizados com sucesso
    } else {
      return false; // Erro ao atualizar os dados do usuário
    }
  }

  return false; // Erro ao conectar ao banco de dados
}

require_once '../modules/head.php';

// Processar o formulário de atualização de dados quando for enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
  $celular = $_POST["celular"];
  $senha = $_POST["senha"];

  // Atualizar os dados do usuário
  if (atualizarUsuario($email, $celular, $senha)) {
    echo '<div class="alert alert-success">Dados atualizados com sucesso!</div>';
  } else {
    echo '<div class="alert alert-danger">Erro ao atualizar os dados.</div>';
  }
}
?>

<body>
  <?php require_once '../modules/header.php'; ?>

  <div class="container-fluid">
    <div class="row" style="height: 100vh;">
      <!-- Barra lateral esquerda -->
      <?php require_once '../modules/barra_lateral.php'; ?>

      <!-- Conteúdo principal (perfil do usuário) -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 h-100" style="height: 100vh;">
        <h3 class="text-center mt-3">Meu Perfil</h3>

        <!-- Guia para alternar entre Dados Pessoais e Minhas Denúncias -->
        <ul class="nav nav-tabs mt-4">
          <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#dados-pessoais">Dados Pessoais</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#minhas-denuncias">Minhas Denúncias</a>
          </li>
        </ul>

        <div class="tab-content mt-4">
          <!-- Dados Pessoais -->
          <div class="tab-pane fade show active" id="dados-pessoais">
            <div class="row mb-4">
              <div class="col-md-6">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Dados Pessoais</h5>
                    <?php
                    $dadosUsuario = getUsuarioData();
                    if (!empty($dadosUsuario)) {
                      echo '<p><strong>Nome:</strong> ' . $dadosUsuario['nome'] . '</p>';
                      echo '
                                            <form method="post">
                                                <div class="form-group">
                                                    <label for="email">Email:</label>
                                                    <input type="email" class="form-control" id="email" name="email" value="' . $dadosUsuario['email'] . '">
                                                </div>
                                                <div class="form-group">
                                                    <label for="celular">Celular:</label>
                                                    <input type="text" class="form-control" id="celular" name="celular" value="' . $dadosUsuario['celular'] . '">
                                                </div>
                                                <div class="form-group">
                                                    <label for="senha">Nova Senha:</label>
                                                    <input type="password" class="form-control" id="senha" name="senha" value="">
                                                </div>
                                                <button type="submit" class="btn btn-primary my-4">Salvar Alterações</button>
                                            </form>';
                    } else {
                      echo '<p>Dados não encontrados.</p>';
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Minhas Denúncias -->
          <div class="tab-pane fade" id="minhas-denuncias">
            <h4 class="text-center mt-3">Minhas Denúncias</h4>
            <div class="row row-cols-1 row-cols-md-3 g-4">
              <?php
              $denuncias = getDenuncias();
              foreach ($denuncias as $denuncia) {
                $titulo = $denuncia['titulo'];
                $descricao = $denuncia['descricao'];
                $imagem = $denuncia['foto'];
                ?>
                <div class="col mb-4">
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
          </div>
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