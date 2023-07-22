<?php
require_once '../pages/db_connect.php'; // Inclua o arquivo de conexão com o banco de dados
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Verificar se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Obter o e-mail fornecido pelo usuário
  $email = $_POST["email"];

  // Verificar se o e-mail está cadastrado no banco de dados
  $sql = "SELECT * FROM usuarios WHERE email = '$email'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // E-mail cadastrado, gerar token para o link de redefinição
    $token = md5(uniqid(rand(), true));

    // Atualizar o banco de dados com o token gerado
    $sql = "UPDATE usuarios SET token = '$token' WHERE email = '$email'";
    if ($conn->query($sql) === TRUE) {
      // Enviar e-mail com o link de redefinição
      try {
        require '../PHPMailer/src/Exception.php';
        require '../PHPMailer/src/PHPMailer.php';
        require '../PHPMailer/src/SMTP.php';

        $mail = new PHPMailer(true);

        // Configurações do servidor de e-mail
        $mail->isSMTP();
        $mail->Host = 'seu_servidor_smtp';
        $mail->SMTPAuth = true;
        $mail->Username = 'seu_email';
        $mail->Password = 'sua_senha';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Remetente
        $mail->setFrom('seu_email', 'Seu Nome');

        // Destinatário
        $mail->addAddress($email);

        // Conteúdo do e-mail
        $mail->isHTML(true);
        $mail->Subject = 'Redefinição de Senha';
        $mail->Body = 'Para redefinir sua senha, clique no link abaixo:<br>';
        $mail->Body .= '<a href="http://seusite.com/resetar_senha.php?token=' . $token . '">Redefinir Senha</a>';

        // Enviar o e-mail
        $mail->send();

        // Redirecionar o usuário para a página de sucesso
        header("Location: sucesso.php");
        exit;
      } catch (Exception $e) {
        // Erro ao enviar o e-mail
        header("Location: erro_envio_email.php");
        exit;
      }
    } else {
      // Erro ao atualizar o banco de dados
      header("Location: erro_bd.php");
      exit;
    }
  } else {
    // E-mail não cadastrado no banco de dados
    header("Location: email_nao_cadastrado.php");
    exit;
  }
}
?>