<h1>Usuniecie pomiaru</h1>
<?php
$id_pomiaru = "";
$czas_pomiaru = "";

if (!empty($model)) {
    $id_pomiaru = $model->getId_Pomiaru();
    $czas_pomiaru = $model->getCzas_Pomiaru();
    
}
?>

<h3>Czy na pewno chcesz usunąć pomiar z <b><?=$czas_pomiaru?></b> ?</h3>
<form method="POST" action="/<?= APP_ROOT ?>/pomiary/delete">
    <input type="hidden" name="id_pomiaru" value="<?=$id_pomiaru?>"/>
    <button class="btn btn-info" type="submit" name="cancel" >NIE</button><br />
    <button class="btn btn-info"  type="submit" name="delete">TAK</button><br />
</form>