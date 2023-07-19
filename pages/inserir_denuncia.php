<?php
session_start();
if (!isset($_SESSION["autenticado"]) || $_SESSION["autenticado"] != 'SIM') {
  header('Location: ../index.php?login=erro2');
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>Itaquá Alerta</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <style>
    .card-abrir-chamado {
      padding: 30px 0 0 0;
      width: 100%;
      margin: 0 auto;
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
      <img src="../public/img/logo-index.png" width="30" height="30" class="d-inline-block align-top" alt="">
      Itaquá Alerta
    </a>
  </nav>

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

                <form action="inserir_denuncia.php" method="POST" enctype="multipart/form-data">
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

<?php
include 'db_connect.php';

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtém os dados do formulário
  $titulo = $_POST['titulo'];
  $categoria = $_POST['categoria'];
  $descricao = $_POST['descricao'];

  // Verifica se foi enviado um arquivo de foto
  if (isset($_FILES['foto'])) {
    $foto = $_FILES['foto']['name'];
    $foto_tmp = $_FILES['foto']['tmp_name'];

    // Move o arquivo para uma pasta de destino
    move_uploaded_file($foto_tmp, "caminho/da/pasta/destino/" . $foto);
  }


  include 'db_connect.php';

  // Verifica se o formulário foi enviado
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $titulo = $_POST['titulo'];
    $categoria = $_POST['categoria'];
    $descricao = $_POST['descricao'];

    // Verifica se foi enviado um arquivo de foto
    if (isset($_FILES['foto'])) {
      $foto = $_FILES['foto']['name'];
      $foto_tmp = $_FILES['foto']['tmp_name'];

      // Move o arquivo para uma pasta de destino
      move_uploaded_file($foto_tmp, "caminho/da/pasta/destino/" . $foto);
    }

    // Insira aqui o código para salvar os dados no banco de dados
    $sql = "INSERT INTO denuncia (titulo, categoria, descricao, foto) VALUES ('$titulo', '$categoria', '$descricao', '$foto')";
    if ($conn->query($sql) === TRUE) {
      echo "Denúncia inserida com sucesso!";
    } else {
      echo "Erro ao inserir denúncia: " . $conn->error;
    }
  }

  $conn->close();


  // ...
  // Use as variáveis $titulo, $categoria, $descricao e $foto para inserir no banco de dados

  echo "Denúncia inserida com sucesso!";
}

$conn->close();
?>