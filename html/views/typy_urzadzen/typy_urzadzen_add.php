<h1>Nowy typ urzadzen w systemie</h1>
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
<form method="POST" action="/<?= APP_ROOT ?>/typy_urzadzen/add">
        <div class="form-group">
        <label>Nazwa typu</label>
        <input type="text" name="nazwa_typu" class="form-control" /> 
    </div>
    <div class="form-group">
        <label>Szczegóły typu</label>
        <input type="text" name="szczegoly_typu" class="form-control" /> 
    </div>
    <button class="btn btn-info" type="submit">OK</button>
</form>