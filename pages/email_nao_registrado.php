<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Email não registrado</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <div class="container d-flex justify-content-center align-items-center flex-column">
        <h1>Email não registrado</h1>
        <figure style="width: 100%;" class="d-flex justify-content-center align-items-center">
            <img src="../public/img/token-invalido.svg" alt="imagem redefinir senha" class="img-fluid" style="max-width: 400px;">
        </figure>

        <form method="post" action="" class="w-100">
            <div class="card p-4 d-flex justify-content-center align-items-center flex-column">
                <h1 class="text-center">Email não registrado</h1>
                <p class="text-center">Desculpe, você não tem permissão para acessar esta página.</p>
                <p class="text-center">Por favor, registre-se no sistema para ter acesso aos recursos restritos.</p>
                <p class="text-center">Se você já possui uma conta, faça o login para continuar.</p>


                <p class="text-center"><a href="../pages/registro.php" class="btn btn-primary btn-block" style="width:max-content">Registrar-se</a></p>
                <p class="text-center"><a href="../index.php" class="btn btn-primary btn-block" style="width:max-content">Login</a></p>

            </div>
        </form>
    </div>
</body>

</html>