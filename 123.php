<?php
if (isset($_GET['do']) && $_GET['do'] == 'reset') {
    setcookie(name: 'count', value: '', expires_or_options: - 3600);
    header('location: qwer.php');
    exit();
}

$cookie_value = isset($_COOKIE['count']) ? ++$_COOKIE['count'] : 1;
setcookie('count', $cookie_value, time() + 10);

echo "Посещений: " . $cookie_value;

echo "<p><a href='?do=reset'>Reset</a></p>";
