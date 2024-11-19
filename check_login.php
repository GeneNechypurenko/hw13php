<?php
include 'config.php';

if (isset($_POST['login'])) {
    $login = $_POST['login'];

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE login = ?");
    $stmt->execute([$login]);
    $userCount = $stmt->fetchColumn();

    if ($userCount > 0) {
        echo 'taken';
    } else {
        echo 'available';
    }
}
?>
