<?php
session_start();

$login = 'admin';
$password_hash = '$2y$10$2kAs1wrncFqh4rKXs1b5s./soKV3TAcRrMj.2Kawll7ur/J9SO9JS';

if (!empty($_POST)) {
    if ($_POST['login'] == $login && password_verify($_POST["password"], $password_hash)) {
        $_SESSION['auth'] = 'xyz';
        $_SESSION['res'] = 'Success';
        header('Location: secret.php');
        exit;
    } else {
        $_SESSION['res'] = 'Error';
        header('Location: index.php');
        die;
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Index</title>
</head>
<body>

<ul>
    <li><a href="secret.php">Secret page</a></li>
</ul>

<h3>Эту страницу видят все</h3>

<?php
if (isset($_SESSION['res'])) {
    echo $_SESSION['res'];
    unset($_SESSION['res']);
}
?>
<form method="post">
    Login: <input type="text" name="login">
    Password: <input type="password" name="password">
    <button type="submit">Login</button>
</form>

</body>
</html>


