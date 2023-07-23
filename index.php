<?php
session_start();

if (isset($_SESSION["autenticado"]) && $_SESSION["autenticado"] == 'SIM') {
  header("Location: ./pages/home.php");
  exit;
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Itaquá Alerta</title>
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous">
  <link rel="stylesheet" href="./public/css/styles.css">
</head>

<body>
  <div class="content-index">
    <div class="container-grid">
      <div class="banner">
        <div class="banner-info">
          <div class="communicationItem">
            <i class="fas fa-handshake fa-2x mr-3"></i>
            Faça a diferença! Sua denúncia é poderosa para garantir uma sociedade mais justa.
          </div>
          <div class="communicationItem">
            <i class="fas fa-comments fa-2x mr-3"></i> Não fique calado! Denuncie irregularidades na gestão pública e contribua para a construção de um futuro melhor para todos.
          </div>
          <div class="communicationItem">
            <i class="fas fa-bullhorn fa-2x mr-3"></i>
            Sua voz importa! Ao denunciar falhas na gestão pública, você se torna um agente de mudança e ajuda a construir um país mais transparente e eficiente.
          </div>
        </div>
      </div>

      <div class="formulario">
        <form id="entrar" method="post" action="validator/valida_login.php">
          <div class="formulario-inputs">
            <div class="col">
              <input type="text" name="email" placeholder="E-mail">
            </div>
            <div class="col">
              <input type="password" name="senha" placeholder="Senha">
            </div>
            <div class="col" id="btn">
              <button type="submit">Entrar</button>
            </div>
            <div class="col" id="senha-perdida">
              <a href="./pages/recuperar_senha.php">Esqueceu sua senha?</a>
            </div>
          </div>
          <?php

          if (isset($_GET['login']) && $_GET['login'] == 'erro') {


            ?>
            <span class="text-ganger">E-mail ou senha incorreto(s). Por favor, tente novamente</span>

          <?php } ?>

          <?php

          if (isset($_GET['login']) && $_GET['login'] == 'erro2') {


            ?>
            <span class="text-ganger">Faça login antes de acessar as páginas protegidas</span>

          <?php } ?>
        </form>

        <div class="descricao">
          <div>
            <img src="./public/img/painel.png" height="250" />
            <h1 class="title">Sua denúncia é o primeiro passo para transformar buracos em asfalto e iluminar o caminho para um futuro melhor</h1>
            <h2 class="mt-5 subtitle">Junte-se a nós na luta por ruas seguras e bem cuidadas.</h2>
            <a href="./pages/registro.php" class="btn-inscreva-se" style="max-width: max-content;">Inscrever-se</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>