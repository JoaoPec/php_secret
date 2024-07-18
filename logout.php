<?php
// Apaga os cookies de username e user_id
setcookie('username', '', time() - 3600, '/');
setcookie('user_id', '', time() - 3600, '/');

// Redireciona para a página inicial
header('Location: index.php');
exit();
?>

