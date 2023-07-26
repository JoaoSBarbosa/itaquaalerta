<?php
require_once 'db_connect.php'; // Inclua o arquivo de conexão com o banco de dados

// Verificar se o token foi fornecido na URL
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verificar se o token existe na tabela de usuários
    $sql = "SELECT * FROM usuarios WHERE password_resets = '$token'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        // Token válido, exiba o formulário para redefinir a senha
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Obter a nova senha fornecida pelo usuário
            $novaSenha = $_POST["nova_senha"];
            $confirmarNovaSenha = $_POST["confirmar_nova_senha"];

            // Verificar se as senhas coincidem
            if ($novaSenha === $confirmarNovaSenha) {
                // Hash da senha para armazenamento seguro
                $hashedSenha = password_hash($novaSenha, PASSWORD_DEFAULT);

                // Atualizar a senha no banco de dados
                $sql = "UPDATE usuarios SET senha_hash = '$hashedSenha', password_resets = NULL WHERE password_resets = '$token'";
                if ($conn->query($sql) === TRUE) {
                    // Redirecionar o usuário para a página de sucesso após redefinir a senha
                    header("Location: senha_redefinida.php");
                    exit;
                } else {
                    // Erro ao atualizar a senha no banco de dados
                    header("Location: erro_bd.php");
                    exit;
                }
            } else {
                // As senhas não coincidem, exiba uma mensagem de erro
                $erroSenha = true;
            }
        }
        ?>
        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Redefinir Senha</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>

        <body>
            <?php
            if (isset($erroSenha) && $erroSenha) {
                echo '<p style="color: red;">As senhas não coincidem. Tente novamente.</p>';
            }
            ?>
            <div class="container d-flex justify-content-center align-items-center flex-column" >
                <h1>Redefinir Senha</h1>
                <figure style="width: 100%;" class="d-flex justify-content-center align-items-center">
                    <img src="../public/img/redefinir-senha.svg" alt="imagem redefinir senha" class="img-fluid" style="max-width: 300px;">
                </figure>

                <form method="post" action="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="password" name="nova_senha" id="nova_senha" class="form-control" required>
                                <label for="nova_senha">Nova Senha</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="password" name="confirmar_nova_senha" id="confirmar_nova_senha" class="form-control" required>
                                <label for="confirmar_nova_senha">Confirmar Nova Senha</label>
                            </div>
                        </div>
                    </div>
                    <input type="submit" value="Redefinir Senha" class="btn btn-primary">
                </form>
            </div>
        </body>

        </html>
        <?php
    } else {
        // Token inválido ou já utilizado
        header("Location: token_invalido.php");
        exit;
    }
} else {
    // Token não fornecido na URL
    header("Location: token_nao_fornecido.php");
    exit;
}
?>
