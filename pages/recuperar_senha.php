<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Itaquá Alerta - Recuperar Senha</title>
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous">
  <link rel="stylesheet" href="../public/css/recupera_senha.css">
</head>

<body>
  <div class="container-recupera-senha">
    <div class="formulario-recupera-senha">
      <h2>Perdeu a senha?</h2>
      <form id="recuperar-senha" method="post" action="validator/valida_recuperacao_senha.php">
        <div class="formulario-inputs-recupera-senha">
          <div class="col">
            <input type="email" name="email" placeholder="E-mail">
          </div>
          <div class="btn-container">
            <div class="col" id="btn">
              <button type="submit">Recuperar Senha</button>
            </div>
            <div class="col" id="btn-retornar">
              <a href="../index.php">Retornar para Home</a>
            </div>
          </div>
        </div>
        <?php
        if (isset($_GET['recuperacao']) && $_GET['recuperacao'] == 'erro') {
          echo '<span class="error">Ocorreu um erro ao processar sua solicitação de recuperação de senha. Por favor, tente novamente mais tarde.</span>';
        }
        ?>
      </form>
    </div>
    <div class="imagem-lateral-recupera-senha">
      <img src="../public/img/lateral.svg" alt="Imagem Lateral">
    </div>
  </div>
</body>

</html>