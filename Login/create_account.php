<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $filepath = "acc/$username.txt";

    // Verifica se o arquivo já existe
    if (file_exists($filepath)) {
        echo "Conta já existe!";
    } else {
        // Cria o arquivo e escreve a senha
        file_put_contents($filepath, $password);
        echo "Conta criada com sucesso!";
    }
}
?>
