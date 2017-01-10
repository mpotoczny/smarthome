<h1>Nowy pomiar</h1>
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
<form method="POST" action="/<?= APP_ROOT ?>/pomiary/add">
    
<!--       <div class="form-group">
        <label>Szczegóły pomiaru</label>
        <input type="text" name="szczegoly_pomiaru" class="form-control" /> 
    </div>
-->    

<div class="form-group">
        <label>Wartość</label>
        <input type="text" name="wartosc" class="form-control" /> 
    </div>
    <div class="form-group">
        <label>Czas pomiaru</label>
        <input type="text" name="czas_pomiaru" class="form-control" /> 
    </div>    
    
    <div class="form-group">
        <label>Nazwa urzadzenia</label>
        
        <select name="urzadzenie" class="form-control">
            <?php
            foreach ($urzadzenia as $urzadzenie) {
                echo '<option value="' . $urzadzenie['id_urzadzenia'] . '" >' . $urzadzenie['nazwa_urzadzenia'] . '</option>';
            }
            ?>
        </select>
        <br />
    </div> 
    
    <div class="form-group">
        <label>Nazwa pomieszczenia</label>
        
        <select name="pomieszczenie" class="form-control">
            <?php
            foreach ($pomieszczenia as $pomieszczenie) {
                    echo '<option value="' . $pomieszczenie['id_pomieszczenia'] . '" >' . $pomieszczenie['nazwa_pomieszczenia'] . '</option>';
            }
            ?>
        </select>
        <br />
    </div>     
    
    
    
    <button class="btn btn-info" type="submit">OK</button>
</form>