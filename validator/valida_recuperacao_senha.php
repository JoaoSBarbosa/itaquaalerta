<?php
session_start();
// Função para gerar um token de recuperação de senha

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Conectar-se ao banco de dados
  $conn = new mysqli("localhost", "root", "", "itaqua_alerta");

  if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
  }

  $email = $_POST["email"];

  // Verificar se o email está registrado no banco de dados
  $sql = "SELECT * FROM usuarios WHERE email = '$email'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // Email encontrado, gerar token de recuperação de senha e enviar por e-mail
    $usuario = $result->fetch_assoc();
    $usuarioId = $usuario["id"];
    $token = generateToken();

    // Salvar o token no banco de dados
    $sql = "INSERT INTO recuperacao_senha (usuario_id, token) VALUES ('$usuarioId', '$token')";
    if ($conn->query($sql) === TRUE) {
      // Envie o e-mail de recuperação de senha com o link contendo o token
      $link = "https://seusite.com/resetar_senha.php?token=" . $token;
      // Aqui você pode utilizar uma biblioteca de envio de e-mails, como PHPMailer, para enviar o e-mail com o link de recuperação de senha

      // Redirecionar o usuário para uma página informando que um e-mail de recuperação foi enviado
      header("Location: ../pages/email_enviado.php");
      exit;
    } else {
      echo "Erro ao salvar o token: " . $conn->error;
    }
  } else {
    // Email não encontrado, redirecionar o usuário para uma página informando que o email não está registrado
    header("Location: ../pages/email_nao_registrado.php");
    exit;
  }

  // Fechar a conexão com o banco de dados
  $conn->close();
}

// Função para gerar um token de recuperação de senha
// Função para gerar um token de recuperação de senha
function generateToken()
{
  $tokenLength = 32; // Comprimento do token desejado
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; // Caracteres disponíveis para o token
  $token = '';

  // Gera o token concatenando caracteres aleatórios do conjunto de caracteres
  for ($i = 0; $i < $tokenLength; $i++) {
    $randomIndex = rand(0, strlen($characters) - 1);
    $token .= $characters[$randomIndex];
  }

  return $token;
}