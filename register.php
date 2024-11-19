<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (login, password) VALUES (?, ?)");
    $stmt->execute([$login, $hashedPassword]);
    echo "Регистрация прошла успешно!";
}
?>
