<?php

function registration(): bool
{
    global $pdo;
    $login = !empty($_POST['login']) ? trim($_POST['login']) : '';
    $password = !empty($_POST['pass']) ? trim($_POST['pass']) : '';
    if (empty($login) || empty($password)) {
        $_SESSION['errors'] = 'Fields login and password are required.';
        return false;
    }

    $res = $pdo->prepare("SELECT COUNT(*) FROM users WHERE login = ?");
    $res->execute([$login]);
    if ($res->fetchColumn() > 0) {
        $_SESSION['errors'] = 'Login already exists.';
        return false;
    }
    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
    $query = $pdo->prepare("INSERT INTO users (login, password) VALUES (?, ?)");
    if ($query->execute([$login, $hashed_pass])) {
        $_SESSION['success'] = 'You have been registered.';
        return true;
    } else {
        $_SESSION['errors'] = 'Registration failed.';
        return false;
    }
}

function authorization(): bool
{
    global $pdo;

    $login = !empty($_POST['login']) ? trim($_POST['login']) : '';
    $password = !empty($_POST['pass']) ? trim($_POST['pass']) : '';
    if (empty($login) || empty($password)) {
        $_SESSION['errors'] = 'Fields login and password are required.';
        return false;
    }

    $query = $pdo->prepare("SELECT * FROM users WHERE login = ?");
    $query->execute([$login]);
    if (!$user = $query->fetch()) {
        $_SESSION['errors'] = 'Login or password is incorrect.';
        return false;
    }

    if (password_verify($password, $user['password'])) {
        $_SESSION['success'] = 'You have been logged in.';
        $_SESSION['user']['login'] = $user['login'];
        $_SESSION['user']['id'] = $user['id'];
        return true;
    } else {
        $_SESSION['errors'] = 'Login or password is incorrect.';
        return false;
    }
}

function save_message(): bool
{
    global $pdo;
    $message = !empty($_POST['message']) ? trim($_POST['message']) : '';

    if (!isset($_SESSION['user']['id'])) {
        $_SESSION['errors'] = 'You must be logged in.';
        return false;
    }

    if (empty($message)) {
        $_SESSION['errors'] = 'Enter message.';
        return false;
    }

    $query = $pdo->prepare("INSERT INTO messages (user_id, message) VALUES (?, ?)");
    if ($query->execute([$_SESSION['user']['id'], $message])) {
        $_SESSION['success'] = 'Message saved.';
        return true;
    } else {
        $_SESSION['errors'] = 'Message failed.';
        return false;
    }
}

function get_message(): array
{
    global $pdo;
    $query = $pdo->query("SELECT * FROM messages
    JOIN users ON messages.user_id = users.id
    ORDER BY messages.created_at DESC 
    ");
    return $query->fetchAll();
}