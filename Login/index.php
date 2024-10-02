<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criação de Conta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 300px;
        }

        h1, h2 {
            text-align: center;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        .message {
            text-align: center;
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Criação de Conta</h1>

        <?php
        // Verifica se o formulário de criação de conta foi enviado
        if (isset($_POST['create_account'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $filepath = "acc/$username.txt";

            // Verifica se o diretório "acc" existe, caso contrário, cria
            if (!is_dir('acc')) {
                mkdir('acc', 0777, true);
            }

            // Verifica se o arquivo já existe
            if (file_exists($filepath)) {
                echo "<div class='message'>Conta já existe!</div>";
            } else {
                // Cria o arquivo e escreve a senha
                file_put_contents($filepath, $password);
                echo "<div class='message'>Conta criada com sucesso!</div>";
            }
        }

        // Verifica se o formulário de login foi enviado
        if (isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $filepath = "acc/$username.txt";

            // Verifica se o arquivo existe
            if (file_exists($filepath)) {
                $saved_password = file_get_contents($filepath);

                // Verifica se a senha está correta
                if ($saved_password === $password) {
                    // Salva o login na segunda linha do arquivo
                    $ip = $_SERVER['REMOTE_ADDR'];
                    $login_info = "Login: $username | IP: $ip\n";
                    file_put_contents($filepath, $login_info, FILE_APPEND | LOCK_EX);
                    echo "<div class='message'>Login bem-sucedido!</div>";
                } else {
                    echo "<div class='message'>Senha incorreta!</div>";
                }
            } else {
                echo "<div class='message'>Usuário não encontrado!</div>";
            }
        }
        ?>

        <form action="" method="POST">
            <input type="text" name="username" placeholder="Nome de Usuário" required>
            <input type="password" name="password" placeholder="Senha" required>
            <button type="submit" name="create_account">Criar Conta</button>
        </form>

        <h2>Login</h2>
        <form action="" method="POST">
            <input type="text" name="username" placeholder="Nome de Usuário" required>
            <input type="password" name="password" placeholder="Senha" required>
            <button type="submit" name="login">Entrar</button>
        </form>
    </div>
</body>
</html>
