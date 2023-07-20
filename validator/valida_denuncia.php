<?php
session_start();
include '../pages/db_connect.php';

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {


  // Capturar os dados do formulário
  $usuario_id = $_POST["usuario_id"];
  $titulo = $_POST["titulo"];
  $categoria = $_POST["categoria"];
  $descricao = $_POST["descricao"];

  // Verificar se foi enviado um arquivo de foto
  if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] === UPLOAD_ERR_OK) {
    // Diretório onde a foto será armazenada (altere para o diretório desejado)
    $diretorio = "../upload/";

    // Nome do arquivo
    $nomeArquivo = basename($_FILES["foto"]["name"]);

    // Caminho completo para o arquivo
    $caminhoArquivo = $diretorio . $nomeArquivo;

    // Move o arquivo temporário para o diretório de destino
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $caminhoArquivo)) {
      // Sucesso ao mover o arquivo
    } else {
      echo "Erro ao fazer upload da foto.";
      exit;
    }
  } else {
    echo "Nenhuma foto foi enviada.";
    exit;
  }

  // Inserir os dados na tabela de denúncias
  $sql = "INSERT INTO denuncias (titulo, categoria, descricao, foto, usuario_id) VALUES ('$titulo', '$categoria', '$descricao', '$nomeArquivo', '$usuario_id')";

  if ($conn->query($sql) === TRUE) {
    // Sucesso ao inserir os dados
    header('Location: ../pages/sucesso.php');
  } else {
    echo "Erro ao inserir a denúncia: " . $conn->error;
  }

  // Fechar a conexão com o banco de dados
  $conn->close();
}
?>