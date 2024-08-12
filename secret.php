<?php
session_start();

if (isset($_GET["do"]) && $_GET["do"] == "logout") {
    unset($_SESSION["auth"]);
    $_SESSION["res"] = 'exited';
    header('Location: index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Secret</title>
</head>
<body>

<ul>
    <li><a href="index.php">Index page</a></li>
</ul>
<?php
if (isset($_SESSION['res'])) {
    echo $_SESSION['res'];
    unset($_SESSION['res']);
}
?>

<?php if (!empty($_SESSION['auth'])): ?>
    <h3>Эту страницу видят только зарегистрированные</h3>
    <a href="?do=logout">Logout</a>
<?php else: ?>
<h3>Не авторизованы</h3>
<?php endif; ?>

</body>
</html>


