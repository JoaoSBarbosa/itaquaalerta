<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Enviado com Sucesso</title>

    <style>
        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }

        body {
            background-color: #fff;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            max-width: 1000px;
            margin: 10px auto;
            padding: 1.5rem;

        }

        .card {
            padding: 10px;
        }

        .card img {
            width: 90%;
        }

        .index {
            margin: 1rem 0;
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            background-color: cornflowerblue;
            color: #fff;
            border: none;
            border-radius: 5px;
            transition: all .4s;
            opacity: .8;
        }

        .index:hover {
            opacity: 1;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <h1 class="text-center">Email Enviado com Sucesso!</h1>
            <p>Um e-mail foi enviado para redefinir a sua senha. Por favor, verifique sua caixa de entrada e siga as instruções fornecidas no e-mail para concluir a redefinição.</p>
            <p>Caso não tenha recebido o e-mail, verifique sua pasta de spam ou lixo eletrônico.</p>
            <a href="../index.php" class="index">Página Inicial</a>
        </div>
        <div class="card">
            <img src="../public/img/mail-sent.svg" alt="imagem">
        </div>
    </div>


</body>

</html>