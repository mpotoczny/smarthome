<h1>Edycja urzadzenia</h1>

<?php
$nazwa_urzadzenia = "";
$szczegoly_urzadzenia = "";
$typy_urzadzen = array();
$id = "";

if (!empty($model)) {
    $id = $model->getId_Urzadzenia();
    $nazwa_urzadzenia= $model->getNazwa_Urzadzenia();
    $szczegoly_urzadzenia = $model->getSzczegoly_Urzadzenia();
    $typ = $model->getTyp_Urzadzenia();
    
    } ?>

<form method="POST" action="/<?= APP_ROOT ?>/urzadzenia/edit">
    <div class="form-group">
       
    <label>Nazwa urzadzenia </label>
    <input class="form-control" type="text" name="nazwa_urzadzenia" value="<?= $nazwa_urzadzenia ?>"/>
    <input type="hidden" name="id" value="<?= $id ?>" />
    <label>Szczegóły urzadzenia </label>
    <input class="form-control" type="text" name="szczegoly_urzadzenia" value="<?= $szczegoly_urzadzenia ?>"/>     
    </div>
    
    <div class="form-group">
        <label>Typ urządzenia</label>
        
        <select name="typ_urzadzenia" class="form-control">
            <?php  
            foreach ($typy_urzadzenAll as $typ_urzadzenia) {
               // if ($typ_urzadzenia['id_typu'] == $typ->getId_Typu()) {
                //    echo '<option value="' . $typ_urzadzenia['id_typu'] . '" selected>' . $typ_urzadzenia['nazwa_typu'] . '</option>';
                //} else {
                    echo '<option value="' . $typ_urzadzenia['id_typu'] . '" >' . $typ_urzadzenia['nazwa_typu'] . '</option>';
              //  }
            }
            ?>    
        </select>
    </div>
    
    
    
    <button class="btn btn-info" type="submit">OK</button>
</form>