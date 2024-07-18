<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
        <li><a href="secret.php">Secret</a></li>
        <?php
        if (isset($_COOKIE['user_id'])) {
            echo '<li><a href="logout.php">Logout</a></li>';
        }
        ?>
    </ul>
</nav>

