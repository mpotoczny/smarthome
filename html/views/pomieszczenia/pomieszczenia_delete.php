<h1>Usuniecie pomieszczenia</h1>
<?php
$nazwa_pomieszczenia = "";
$id_pomieszczenia = "";
if (!empty($model)) {
    $nazwa_pomieszczenia = $model->getNazwa_Pomieszczenia();
    $id_pomieszczenia = $model->getId_Pomieszczenia();
}
?>
<h3>Czy na pewno chcesz usunąć pomieszczenie: <b><?=$nazwa_pomieszczenia?></b>?</h3>
<form method="POST" action="/<?= APP_ROOT ?>/pomieszczenia/delete">
    <input type="hidden" name="id_pomieszczenia" value="<?=$id_pomieszczenia?>"/>
    <button class="btn btn-info" type="submit" name="cancel" >NIE</button><br />
    <button class="btn btn-info"  type="submit" name="delete">TAK</button><br />
</form>