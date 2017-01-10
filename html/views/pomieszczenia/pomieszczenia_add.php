<h1>Nowe pomieszczenie w systemie</h1>
<?php
if (!empty($error)) {
    ?>
    <div class="alert alert-danger" role="alert">
        <?= $error ?>
    </div>
    <?php }
else if (!empty($success)) {  ?> 
    <div class="alert alert-success" role="alert">
        <?= $success ?>
    </div>
    <?php } ?>
<form method="POST" action="/<?= APP_ROOT ?>/pomieszczenia/add">
        <div class="form-group">
        <label>Nazwa pomieszczenia</label>
        <input type="text" name="nazwa_pomieszczenia" class="form-control" /> 
    </div>
    <div class="form-group">
        <label>Szczegóły pomieszczenia</label>
        <input type="text" name="szczegoly_pomieszczenia" class="form-control" /> 
    </div>
    <button class="btn btn-info" type="submit">OK</button>
</form>