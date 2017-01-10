<h1>Usuniecie typu urządzeń</h1>
<?php
$nazwa_typu = "";
$id_typu = "";
if (!empty($model)) {
    $nazwa_typu = $model->getNazwa_Typu();
    $id_typu = $model->getId_Typu();
}
?>
<h3>Czy na pewno chcesz usunąć typ urządzeń: <b><?=$nazwa_typu?></b>?</h3>
<form method="POST" action="/<?= APP_ROOT ?>/typy_urzadzen/delete">
    <input type="hidden" name="id_typu" value="<?=$id_typu?>"/>
    <button class="btn btn-info" type="submit" name="cancel" >NIE</button><br />
    <button class="btn btn-info"  type="submit" name="delete">TAK</button><br />
</form>