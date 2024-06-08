<?php
require_once '../validator/validador_acesso.php';
require_once 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recuperação de Senha</title>
  <!-- Inclua a folha de estilo do Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body,
    html {
      height: 100%;
      margin: 0;

    }

    .container_senha {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100%;
      background-color: #b2d9f7;

    }

    .imagem {
      background-color: #487aa1;

      width: 50%;
      height: 100%;
      position: absolute;
    }

    .card {
      background-color: #fff;
      max-width: 400px;
      padding: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      z-index: 1;
    }
  </style>
</head>

<body>
  <div class="container_senha">
    <div class="imagem"></div>
    <div class="card m-2">
      <h4 class="card-title">Perdeu sua senha?</h4>
      <p class="card-text">Insira seu endereço de e-mail cadastrado e enviaremos um link para você resetar sua senha.</p>
      <form action="enviar_email.php" method="post">
        <div class="form-group">
          <label for="email">E-mail</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="d-flex justify-content-between flex-wrap">
          <button type="submit" class="btn btn-primary btn-lg">Resetar Senha</button>
          <a href="home.php" class="btn btn-secondary btn-lg mt-2 mt-lg-0">Voltar</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Inclua os scripts do Bootstrap -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>