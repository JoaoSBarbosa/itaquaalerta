<?php
require_once '../validator/validador_acesso.php';
require_once '../modules/header.php';


if (isset($_SESSION["autenticado"]) && $_SESSION["autenticado"] === "SIM") {
  // O usuário está autenticado
  $usuario_id = $_SESSION["usuarioId"];
}
?>

<body>

  <?php
  require_once '../modules/menu.php'
    ?>

  <div class="container">
    <div class="row">

      <div class="card-abrir-chamado">
        <div class="card">
          <div class="card-header">
            Abertura de chamado
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col">

                <form action="../validator/valida_denuncia.php" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="usuario_id" value="<?php echo $usuario_id; ?>">

                  <div class="form-group">
                    <label>Título</label>
                    <input type="text" class="form-control" placeholder="Título" name="titulo">
                  </div>

                  <div class="form-group">
                    <label>Categoria</label>
                    <select class="form-control" name="categoria">
                      <option value="Falta de energia">Falta de energia</option>
                      <option value="Vazamentos">Vazamentos</option>
                      <option value="Alagamento">Alagamento</option>
                      <option value="Violência e criminalidade">Violência e criminalidade</option>
                      <option value="Outros">Outros</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Descrição</label>
                    <textarea class="form-control" rows="3" name="descricao"></textarea>
                  </div>

                  <div class="form-group">
                    <label>Foto</label>
                    <input type="file" class="form-control-file" name="foto">
                  </div>

                  <div class="row mt-5">
                    <div class="col-6">
                      <button class="btn btn-lg btn-warning btn-block" type="submit">Voltar</button>
                    </div>

                    <div class="col-6">
                      <button class="btn btn-lg btn-info btn-block" type="submit" name="submit">Abrir</button>
                    </div>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>

</html>