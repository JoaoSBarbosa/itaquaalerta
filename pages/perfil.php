<?php
require_once 'db_connect.php';
require_once '../validator/validador_acesso.php';
require_once '../modules/all_head.php';

// Tratar o upload da imagem
if (isset($_FILES['foto_perfil']) && !empty($_FILES['foto_perfil']['name'])) {
  $foto_perfil = $_FILES['foto_perfil'];
  $upload_dir = '../upload/';
  $foto_path = $upload_dir . basename($foto_perfil['name']);

  if (move_uploaded_file($foto_perfil['tmp_name'], $foto_path)) {
    // Atualizar o caminho da foto na tabela de usuários
    $userId = $_SESSION["usuarioId"];
    $sql = "UPDATE usuarios SET foto_path = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $foto_path, $userId);
    $stmt->execute();
    $stmt->close();
  }
}

// Obtém os dados do usuário
$dadosUsuario = getUsuarioData();

?>

<body>
  <?php require_once '../modules/header.php' ?>
  <div class="main">
    <?php require_once '../modules/aside.php' ?>
    <div class="content" style="padding: 0;">
      <section class="overview" style="overflow: hidden;">
        <div class="container_denuncias">
          <ul class="nav nav-tabs mt-4">
            <li class="nav-item">
              <a class="nav-link active" data-bs-toggle="tab" href="#dados-pessoais">Dados Pessoais</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" href="#minhas-denuncias">Minhas Denúncias</a>
            </li>
          </ul>

          <div class="tab-content m-4">
            <!-- Dados Pessoais -->
            <div class="tab-pane fade show active" id="dados-pessoais">
              <div class="row mb-4">
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Dados Pessoais</h5>
                      <?php
                      if (!empty($dadosUsuario)) {
                        // Exibe a foto de perfil, se existir
                        echo '<div class="mb-3">';
                        if (isset($dadosUsuario['foto_path'])) {
                          $foto_path_card = '../upload/' . $dadosUsuario['foto_path'];
                          echo '<img src="' . $foto_path_card . '" alt="Foto de Perfil" style="max-width: 200px;">';
                        } else {
                          echo '<img src="../upload/user.jpg" alt="Foto de Perfil Padrão" style="max-width: 200px;">';
                        }
                        echo '</div>';

                        // Formulário para editar os dados textuais
                        echo '<form method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                  <label for="foto_perfil" class="form-label">Escolha uma nova foto de perfil:</label>
                                  <input type="file" class="form-control" id="foto_perfil" name="foto_perfil" accept="image/*">
                                </div>
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
          </div>

          <!-- Minhas Denúncias -->
          <div class="tab-pane fade" id="minhas-denuncias">
            <h4 class="text-center mt-3">Minhas Denúncias</h4>
            <?php
            $denuncias = getDenunciasById();

            if (empty($denuncias)) {
              echo '<p class="text-center mt-3">Você ainda não realizou nenhuma denúncia.</p>';
            } else {
              echo '<div class="row row-cols-1 row-cols-md-3 g-4">';
              foreach ($denuncias as $denuncia) {
                $titulo = $denuncia['titulo'];
                $descricao = $denuncia['descricao'];
                $imagem = $denuncia['foto'];
                $categoria = $denuncia['categoria'];
                ?>
                <div class="col mb-4">
                  <div class="card h-100">
                    <img src="../upload/<?php echo $imagem; ?>" class="card-img-top" alt="<?php echo $titulo; ?>">
                    <div class="card-body">
                      <span class="categoria bg-primary text-white rounded px-2 py-1" style="font-size: 12px;">
                        <?php echo $categoria; ?>
                      </span>
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
              echo '</div>';
            }
            ?>
          </div>
        </div>

      </section>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>