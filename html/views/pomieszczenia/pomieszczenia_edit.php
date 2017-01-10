<h1>Edycja pomieszczenia</h1>
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
$nazwa_pomieszczenia = "";
$szczegoly_pomieszczenia= "";
$id_pomieszczenia = "";
if (!empty($model)) {
    $nazwa_pomieszczenia= $model->getNazwa_Pomieszczenia();
    $szczegoly_pomieszczenia = $model->getSzczegoly_Pomieszczenia();
    $id_pomieszczenia = $model->getId_Pomieszczenia();
    
    } ?>
<form method="POST" action="/<?= APP_ROOT ?>/pomieszczenia/edit">
    <div class="form-group">
       
    <label>Nazwa pomieszczenia </label>
    <input class="form-control" type="text" name="nazwa_pomieszczenia" value="<?= $nazwa_pomieszczenia ?>"/>
    <label>Szczegóły pomieszczenia </label>
    <input class="form-control" type="text" name="szczegoly_pomieszczenia" value="<?= $szczegoly_pomieszczenia ?>"/>     
    </div>
    <input type="hidden" name="id_pomieszczenia" value="<?= $id_pomieszczenia ?>" />
    <button class="btn btn-info" type="submit">OK</button><br />
</form>