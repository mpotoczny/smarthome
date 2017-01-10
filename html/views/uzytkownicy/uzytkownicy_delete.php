<h1>Usuniecie uzytkownika</h1>
<?php
$login = "";
$id_uzytkownika = "";
if (!empty($model)) {
    $login = $model->getLogin();
    $id_uzytkownika = $model->getId_Uzytkownika();
}
?>
<h3>Czy na pewno chcesz usunąć użytkownika: <b><?=$login?></b>?</h3>
<form method="POST" action="/<?= APP_ROOT ?>/uzytkownicy/delete">
    <input type="hidden" name="id_uzytkownika" value="<?=$id_uzytkownika?>"/>
    <button class="btn btn-info" type="submit" name="cancel" >NIE</button><br />
    <button class="btn btn-info"  type="submit" name="delete">TAK</button><br />
</form>