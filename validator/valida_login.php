<?php
session_start();
print_r($_SESSION);
echo '<hr/>';
$usuario_autenticado = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Conectar-se ao banco de dados
  $conn = new mysqli("localhost", "root", "", "itaqua_alerta");

  if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
  }

  $email = $_POST["email"];
  $senha = $_POST["senha"];

  // Verificar as credenciais do usuário no banco de dados
  $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $usuario_autenticado = true;
    // Credenciais corretas
    $usuario = $result->fetch_assoc();
    $_SESSION["autenticado"] = 'SIM';
    $_SESSION["usuarioId"] = $usuario["id"];
    $_SESSION["usuarioNome"] = $usuario["nome"];

    header("Location: ../pages/home.php");
    exit;
  } else {
    $_SESSION["autenticado"] = 'NÃO';
    // Credenciais incorretas
    header('Location: ../index.php?login=erro');

  }

  // Fechar a conexão com o banco de dados
  $conn->close();
}
?>