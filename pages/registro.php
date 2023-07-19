<html>

<head>
  <meta charset="utf-8" />
  <title>Itaquá Alerta</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="./public/css/style.css" />
</head>

<body>
  <?php
  session_start();
  if (isset($_SESSION['success_message'])) {
    echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
    unset($_SESSION['success_message']);
  }
  ?>
  <div class="container">
    <div class="d-flex justify-content-center mt-5">
      <div class="card" style="width: 36rem;">
        <div class="card-body">

          <div class="d-flex justify-content-center">
            <img src="../public/img/inscreva-se.svg" height="220" />
          </div>

          <div class="row">
            <div class="col">
              <h2>Crie sua conta</h2>
            </div>
          </div>

          <div class="row">
            <div class="col">

              <form action="../validator/valida_registro.php" method="post">
                <div class="form-group">
                  <input name="nome" type="text" class="form-control" placeholder="Nome" autocomplete="true">
                </div>

                <div class="form-group">
                  <input name="email" type="text" class="form-control" placeholder="E-mail">
                </div>
                <div class="form-group">
                  <input type="date" name="dt_nascimento" class="form-control" placeholder="Data de Nascimento">
                </div>
                <div class="form-group">
                  <input name="celular" type="text" class="form-control" placeholder="Celular">
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
</body>

</html>