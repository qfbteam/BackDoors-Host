<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
            echo "Login bem-sucedido!";
        } else {
            echo "Senha incorreta!";
        }
    } else {
        echo "Usuário não encontrado!";
    }
}
?>
