<!-- <?php
include '../pages/db_connect.php';

$nome = $_POST['nome'];
$email = $_POST['email'];
$dt_nascimento = $_POST['dt_nascimento'];
$celular = $_POST['celular'];
$senha = $_POST['senha'];

if (!empty($nome) && !empty($email) && !empty($dt_nascimento) && !empty($celular) && !empty($senha)) {
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $sql = "INSERT INTO usuarios (nome, email, data_nascimento, celular, senha) VALUES ('$nome', '$email', '$dt_nascimento', '$celular', '$senha')";
    if ($conn->query($sql) === TRUE) {
      header("Location: ../pages/home.php");
      exit;
    } else {
      echo "Erro ao inserir os dados: " . $conn->error;
    }
  } else {
    echo "Formato de email inválido";
  }
} else {
  echo "Todos os campos são obrigatórios";
}

$conn->close();
?> -->


<?php
session_start();
include '../pages/db_connect.php';

$nome = $_POST['nome'];
$email = $_POST['email'];
$dt_nascimento = $_POST['dt_nascimento'];
$celular = $_POST['celular'];
$senha = $_POST['senha'];

// Verificar se os campos foram preenchidos
if (!empty($nome) && !empty($email) && !empty($dt_nascimento) && !empty($celular) && !empty($senha)) {
  // Validar o formato do email
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // Inserir os dados no banco de dados
    $sql = "INSERT INTO usuarios (nome, email, data_nascimento, celular, senha) VALUES ('$nome', '$email', '$dt_nascimento', '$celular', '$senha')";
    if ($conn->query($sql) === TRUE) {
      // Definir a mensagem de sucesso na variável de sessão
      $_SESSION['success_message'] = "Usuário registrado com sucesso!";
      // Redirecionar para a página de sucesso
      header("Location: ../pages/home.php");
      exit;
    } else {
      echo "Erro ao inserir os dados: " . $conn->error;
    }
  } else {
    echo "Formato de email inválido";
  }
} else {
  echo "Todos os campos são obrigatórios";
}

$conn->close();
?>