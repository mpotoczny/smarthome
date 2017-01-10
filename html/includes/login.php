<?php
//$login = null;
$login = $_SESSION['user'];
$isAdmin = false;
if (!empty($login)) {
    $db = $registry->db;
    echo 'Cześć <b>' . $login . '</b>';
    $isAdmin = $db::isUserInRole($login, 'admin');
    if ($isAdmin) {
        echo ' (Adminstrator)! |';
    }
    ?> 
    <a href="/<?= APP_ROOT ?>/account/logout">WYLOGOWANIE</a>
    <?php
} else {
    ?>
    <a href="/<?= APP_ROOT ?>/account/login">LOGOWANIE</a> &nbsp; |  	
    <a href="/<?= APP_ROOT ?>/account/register">REJESTRACJA</a>
    <?php
}
?>