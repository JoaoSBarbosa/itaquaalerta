<?php
session_start();
require_once '../modules/all_head.php'
  ?>

<body>
  <div class="content-index">
    <div class="container-grid">
      <div class="banner">
        <div class="banner-info">
          <div class="communicationItem">
            <i class="fas fa-hands fa-2x mr-3"></i>
            Junte-se a nós na busca por um futuro melhor! Sua participação é fundamental para construirmos um país mais ético e igualitário.

          </div>
          <div class="communicationItem">
            <i class="fas fa-hands-helping fa-2x mr-3"></i>
            Seja parte da mudança que você deseja ver!
          </div>
          <div class="communicationItem">
            <i class="fas fa-landmark fa-2x mr-3"></i>
            Venha fazer história conosco! Ao se cadastrar, você se torna parte de uma comunidade dedicada a construir um futuro melhor para todos
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row justify-content-center mt-5">
          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-center">
                  <img src="../public/img/inscreva-se.svg" class="img-fluid" style="max-width: 400px;" />
                </div>
                <h2 class="text-center mt-3">Crie sua conta</h2>
                <form action="../validator/valida_registro.php" method="post">
                  <div class="form-group">
                    <input name="nome" type="text" class="form-control" placeholder="Nome" autocomplete="true">
                  </div>
                  <?php
                  if (isset($_GET['login']) && $_GET['login'] == 'erroemail') {
                    ?>
                    <span class="text-ganger">Formato de email inválido</span>
                  <?php } ?>
                  <?php
                  if (isset($_GET['registro']) && $_GET['registro'] == 'usuariocadastrado') {
                    ?>
                    <span class="text-danger">O e-mail informado já está cadastrado em nosso sistema. Caso tenha esquecido sua senha, você pode <a href="recuperar_senha.php">recuperá-la aqui</a>.</span>

                  <?php } ?>
                  <div class="form-group">
                    <input name="email" type="text" class="form-control" placeholder="E-mail">
                  </div>
                  <div class="form-group">
                    <input type="date" name="dt_nascimento" class="form-control" placeholder="Data de Nascimento">
                  </div>
                  <div class="form-group">
                    <input name="celular" type="text" class="form-control" placeholder="Celular" data-inputmask="'mask': '(99) 99999-9999'" required>
                  </div>
                  <div class="form-group">
                    <input type="password" name="senha" class="form-control" placeholder="Senha">
                  </div>
                  <div class="mt-4 mb-4">
                    <small class="form-text">
                      Ao inscrever-se, você concorda com os Termos de Serviço e com as Políticas de Privacidade, incluindo o Uso de Cookies. Outras pessoas poderão encontrar você pelo e-mail ou número de telefone fornecido · Opções de Privacidade
                    </small>
                  </div>
                  <button type="submit" class="btn btn-primary btn-block">Inscrever-se</button>
                  <?php
                  if (isset($_GET['login']) && $_GET['login'] == 'errocampos') {
                    ?>
                    <span class="text-ganger">Todos os campos são obrigatórios</span>
                  <?php } ?>
                  <?php
                  if (isset($_GET['login']) && $_GET['login'] == 'erroinserir') {
                    ?>
                    <span class="text-ganger">Erro ao inserir os dados:
                      <?php echo $conn->error ?>
                    </span>
                  <?php } ?>
                  <div class="text-center mt-3">
                    <small>Já tem uma conta? <a href="../index.php">Faça login</a></small>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>