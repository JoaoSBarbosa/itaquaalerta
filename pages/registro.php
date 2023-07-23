<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Itaquá Alerta</title>
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous">
  <link rel="stylesheet" href="../public/css/styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

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

      <div class="formulario">




        <div class="d-flex justify-content-center">
          <img src="../public/img/inscreva-se.svg" class="img-fluid" style="max-width: 40%;" />
        </div>
        <h2 class="text-center mt-3">Crie sua conta</h2>

        <form action="../validator/valida_registro.php" method="post">
          <div class="form-group col-md-12">
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
          <div class="form-group col-md-12">
            <input name="email" type="text" class="form-control" placeholder="E-mail">
          </div>
          <div class="form-group col-md-12">
            <input type="date" name="dt_nascimento" class="form-control" placeholder="Data de Nascimento">
          </div>
          <div class="form-group col-md-12">
            <input name="celular" type="text" class="form-control" placeholder="Celular" data-inputmask="'mask': '(99) 99999-9999'" required>
          </div>
          <select class="form-select form-select-lg mb-3 col-md-12" id="sexo" name="sexo" style="width: 100%;">
            <option selected>Sexo</option>
            <option value="Masculino">Masculino</option>
            <option value="Feminino">Feminino</option>
          </select>

          <div class="form-group col-md-12">
            <input type="password" name="senha" class="form-control" placeholder="Senha">
          </div>
          <?php
          if (isset($_GET['registro']) && $_GET['registro'] == 'errosenha') {
            ?>
            <span class="text-danger">As senhas não coincidem.</span>

          <?php } ?>
          <div class="form-group col-md-12">
            <input type="password" name="confirmar_senha" class="form-control" placeholder="Confirmar Senha">
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


</body>

</html>