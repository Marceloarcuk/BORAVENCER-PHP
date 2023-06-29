<?PHP
session_start();
session_destroy();
unset ($_SESSION['login']);
unset ($_SESSION['nome']);
header('location:login.php');
?> 