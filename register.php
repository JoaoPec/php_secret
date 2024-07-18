<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <h1>Register Page</h1>
        <?php
        include "header.php";
        ?>
    </header>
    <main>
        <section>
            <h2>Register</h2>
            <form action="#" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username">
                <br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email">
                <br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
                <br>
                <button type="submit">Register</button>
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Your Website. All rights reserved.</p>
    </footer>
</body>

</html>



<?php

include 'database.php'; // Certifique-se de que o arquivo de conexão está correto

// Pegue os dados do formulário
$name = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Hash a senha
$hash = password_hash($password, PASSWORD_DEFAULT);

// Prepare a consulta de inserção
$sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";



if ($stmt = $conn->prepare($sql)) {

    // Vincule os parâmetros
    $stmt->bind_param("sss", $name, $email, $hash);

    // Execute a consulta
    if ($stmt->execute()) {
        // Pegue o ID do último registro inserido
        $user_id = $stmt->insert_id;

        // Armazene o ID do usuário em um cookie
        setcookie('user_id', $user_id, time() + 3600, '/');
        setcookie('username', $name, time() + 3600, '/');

        // Redirecione para a página secreta
        header('Location: secret.php');
        exit();
    } else {
        echo "Erro: " . $stmt->error;
    }

    // Feche a declaração
    $stmt->close();
} else {
    echo "Erro: " . $conn->error;
}

// Feche a conexão
$conn->close();
?>