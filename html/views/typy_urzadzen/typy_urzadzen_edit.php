<h1>Edycja typu urządzeń</h1>
<?php
if (!empty($error)) {  ?>
    <div class="alert alert-danger" role="alert">
        <?= $error ?>
    </div>
    <?php } else if (!empty($success)) {   ?>
    <div class="alert alert-success" role="alert">
    <?= $success ?>
    </div>
    <?php }
$nazwa_typu = "";
$szczegoly_typu= "";
$id_typu = "";
if (!empty($model)) {
    $nazwa_typu= $model->getNazwa_Typu();
    $szczegoly_typu = $model->getSzczegoly_Typu();
    $id_typu = $model->getId_Typu();
    
    } ?>
<form method="POST" action="/<?= APP_ROOT ?>/typy_urzadzen/edit">
    <div class="form-group">
       
    <label>Nazwa typu </label>
    <input class="form-control" type="text" name="nazwa_typu" value="<?= $nazwa_typu ?>"/>
    <label>Szczegóły typu </label>
    <input class="form-control" type="text" name="szczegoly_typu" value="<?= $szczegoly_typu ?>"/>     
    </div>
    <input type="hidden" name="id_typu" value="<?= $id_typu ?>" />
    <button class="btn btn-info" type="submit">OK</button><br />
</form>