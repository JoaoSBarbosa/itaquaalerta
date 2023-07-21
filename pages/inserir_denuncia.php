<?php
require_once '../validator/validador_acesso.php';
// echo $_SESSION["usuarioId"];
require_once '../modules/head.php'
  ?>
<style>
  .custom-form {
    border: 2px solid #cfe2f3;
    /* Cor da borda azul quase branca */
    padding: 20px;
    border-radius: 5px;
  }
</style>

<body>
  <?php
  require_once '../modules/header.php'
    ?>

  <div class="container-fluid">
    <div class="row">
      <!-- Barra lateral esquerda -->
      <?php require_once '../modules/barra_lateral.php'; ?>
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 d-flex align-items-center justify-content-center" style="height:100vh;">
        <div class="container">
          <div class="row">
            <div class="col-md-6 <?php echo (isset($_SESSION['mobile']) && $_SESSION['mobile']) ? 'order-md-last' : 'order-md-first'; ?>">
              <figure>
                <img src="../public/img/denuncia.svg" alt="Figura denuncia">
              </figure>
            </div>
            <div class="col-md-6 <?php echo (isset($_SESSION['mobile']) && $_SESSION['mobile']) ? 'order-md-first' : 'order-md-last'; ?>">
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
                  <select class="form-select" id="categoria" name="categoria" required>
                    <option value="">Selecione uma categoria</option>
                    <option value="rua_degradada">Rua Degradada</option>
                    <option value="violencia">Violência e Roubo</option>
                    <option value="poluição">Poluição Ambiental</option>
                    <option value="serviços_publicos">Serviços Públicos</option>
                    <option value="Categoria 5">Alagamento</option>
                    <option value="agua_energia 5">Agua e Energia</option>
                    <option value="outros">Outros</option>
                  </select>
                </div>

                <button type="submit" class="btn btn-primary">Enviar Denúncia</button>
              </form>
            </div>
          </div>
        </div>

      </main>
    </div>
  </div>
</body>

</html>