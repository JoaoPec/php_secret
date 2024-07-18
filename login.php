<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Login Page</h1>
        <?php
            include "header.php";
        ?>
    </header>
    <main>
        <section>
            <h2>Login</h2>
            <form action="#" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username">
                <br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
                <br>
                <button type="submit">Login</button>
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Your Website. All rights reserved.</p>
    </footer>
</body>
</html>

<?php

include 'database.php';

$name = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = ?";

if ($stmt = $conn->prepare($sql)) {

    $stmt->bind_param('s', $name);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {

            setcookie('username', $name, time() + 3600, '/');
            setcookie('user_id', $row['id'], time() + 3600, '/');

            header('Location: secret.php');
            exit();
        } else {
            echo '<h2 style="color:red;">Senha incorreta</h2>';
        }
    } else {
        echo '<h2 style="color:red;">Usuário não encontrado</h2>';
    }

    $stmt->close();
}

