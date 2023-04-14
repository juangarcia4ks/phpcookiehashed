<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $db = require_once __DIR__ . '/database.php';

    $stmt = $db->prepare('SELECT * FROM user WHERE username = :username');
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];

        // Set the cookie
        $cookie_name = 'login_cookie';
        $cookie_value = password_hash($user['username'], PASSWORD_DEFAULT);
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Login</h1>

    <?php if (isset($error)): ?>
        <p><?= htmlspecialchars($error) ?></p>
    <?php endif ?>

    <form method="post">
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
        </div>
       
