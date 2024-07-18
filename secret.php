<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secret Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Secret Page</h1>
        <?php
            include "header.php";
        ?>
    </header>
    <main>
        <?php
        if (isset($_COOKIE['user_id'])) {
            $name = $_COOKIE['username'];
            echo "<h1>Welcome to the secret page, {$name}</h1>";
            echo "<p>This is a secret page that can only be viewed by authenticated users.</p>";

            echo "<form action='secret.php' method='post'>
                    <label for='secret'>Secret:</label>
                    <textarea id='secret' name='secret' rows='4' cols='50'></textarea>
                    <br>
                    <button type='submit'>Submit</button>
                  </form>";
            include "secrets_list.php";
        } else {
            echo '<section>';
            echo '<h2>This is a secret page</h2>';
            echo '<p>You must be logged in to see this page.</p>';
            echo '</section>';
        }
        ?>
    </main>
    <footer>
        <p>&copy; 2024 Your Website. All rights reserved.</p>
    </footer>
</

<?php

include 'database.php';

if (isset($_COOKIE['user_id'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $secret = $_POST['secret'];
        $user_id = $_COOKIE['user_id'];

        $sql = "INSERT INTO secrets (secret, user_id) VALUES (?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param('si', $secret, $user_id);
            $stmt->execute();
        }

    header('Location: secret.php');

    }
}

?>
