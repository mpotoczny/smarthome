<h1>Nowe urzadzenie w systemie</h1>
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
<form method="POST" action="/<?= APP_ROOT ?>/urzadzenia/add">
        <div class="form-group">
        <label>Nazwa urzadzenia</label>
        <input type="text" name="nazwa_urzadzenia" class="form-control" /> 
    </div>
    <div class="form-group">
        <label>Szczegóły urzadzenia</label>
        <input type="text" name="szczegoly_urzadzenia" class="form-control" /> 
    </div>
    <div class="form-group">
        <label>Typ urządzenia</label>
        
        <select name="typ_urzadzenia" class="form-control">
            <?php
            foreach ($typy_urzadzen as $typ_urzadzenia) {
                echo '<option value="' . $typ_urzadzenia['id_typu'] . '">' . $typ_urzadzenia['nazwa_typu'] . '</option>';
            }
            ?>
        </select>
        <br />
    </div> 
    
    
    
    <button class="btn btn-info" type="submit">OK</button>
</form>