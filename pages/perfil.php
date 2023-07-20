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
  $email = $conn->real_escape_string($email);
  $celular = $conn->real_escape_string($celular);
  $senha = $conn->real_escape_string($senha);

  if ($conn) {
    // Use a função password_hash para armazenar a senha de forma segura
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "UPDATE usuarios SET email = '$email', celular = '$celular', senha = '$senha_hash' WHERE id = '$usuario_id'";
    $resultado = $conn->query($sql);

    return $resultado;
  }

  return false;
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
    <div class="row">
      <!-- Barra lateral esquerda -->
      <?php require_once '../modules/barra_lateral.php'; ?>

      <!-- Conteúdo principal (perfil do usuário) -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" style="height: 100vh;">
        <h3 class="text-center mt-3">Meu Perfil</h3>

        <!-- Dados do usuário -->
        <div class="row mb-4">
          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Dados Pessoais</h5>
                <?php
                $dadosUsuario = getUsuarioData();
                if (!empty($dadosUsuario)) {
                  echo '<p><strong>Nome:</strong> ' . $dadosUsuario['nome'] . '</p>';
                  // Exibir o formulário para editar os dados do usuário
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
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                  </form>';
                } else {
                  echo '<p>Dados não encontrados.</p>';
                }
                ?>
              </div>
            </div>
          </div>
        </div>

        <!-- Denúncias do usuário -->
        <h4 class="text-center mt-3">Minhas Denúncias</h4>
        <!-- Restante do código para exibir as denúncias do usuário... -->

      </main>
    </div>
  </div>

  <!-- Inclua aqui os scripts necessários para o serviço de mapa e notícias -->
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>