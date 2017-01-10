<h1>Usuniecie urzadzenia</h1>
<?php
$nazwa_urzadzenia = "";
$id_urzadzenia = "";
if (!empty($model)) {
    $nazwa_urzadzenia = $model->getNazwa_Urzadzenia();
    $id_urzadzenia = $model->getId_Urzadzenia();
}
?>
<h3>Czy na pewno chcesz usunąć urzadzenie: <b><?=$nazwa_urzadzenia?></b>?</h3>
<form method="POST" action="/<?= APP_ROOT ?>/urzadzenia/delete">
    <input type="hidden" name="id_urzadzenia" value="<?=$id_urzadzenia?>"/>
    <button class="btn btn-info" type="submit" name="cancel" >NIE</button><br />
    <button class="btn btn-info"  type="submit" name="delete">TAK</button><br />
</form>