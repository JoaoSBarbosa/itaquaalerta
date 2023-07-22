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
    // Verificar se o e-mail já está cadastrado no banco de dados
    $sql_check_email = "SELECT * FROM usuarios WHERE email = '$email'";
    $result_check_email = $conn->query($sql_check_email);

    if ($result_check_email->num_rows > 0) {
      // E-mail já cadastrado, redirecionar para a página de recuperação de senha
      // header('Location: ../pages/recuperar_senha.php');
      header('Location: ../pages/registro.php?registro=usuariocadastrado');
      exit;
    } else {
      // E-mail não cadastrado, inserir os dados no banco de dados
      $sql = "INSERT INTO usuarios (nome, email, data_nascimento, celular, senha) VALUES ('$nome', '$email', '$dt_nascimento', '$celular', '$senha')";
      if ($conn->query($sql) === TRUE) {
        // Obter o ID e nome do usuário recém-cadastrado
        $usuario_id = $conn->insert_id;
        $sql = "SELECT id, nome FROM usuarios WHERE id = $usuario_id";
        $result = $conn->query($sql);
        $usuario = $result->fetch_assoc();

        // Definir as variáveis de sessão
        $_SESSION["autenticado"] = 'SIM';
        $_SESSION["usuarioId"] = $usuario["id"];
        $_SESSION["usuarioNome"] = $usuario["nome"];
        $_SESSION['success_message'] = "Usuário registrado com sucesso!";
        // Redirecionar para a página de sucesso
        header("Location: ../pages/home.php");
        exit;
      } else {
        header('Location: ../pages/registro.php?login=erroinserir');
      }
    }
  } else {
    header('Location: ../pages/registro.php?login=erroemail');
  }
} else {
  header('Location: ../pages/registro.php?login=errocampos');
}

$conn->close();
?>