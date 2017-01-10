<h1>Edycja pomiaru</h1>

<?php
$szczegoly_pomiaru = "";
$wartosc = "";
$czas_pomiaru = "";
$id = "";

$urzadzeniaa = array();
$pomieszczeniaa = array();


if (!empty($model)) {
    $id = $model->getId_Pomiaru();
    $wartosc = $model->getWartosc();
    $czas_pomiaru = $model->getCzas_Pomiaru();
    $szczegoly_pomiaru = $model->getSzczegoly_Pomiaru();
    
    $pomieszcz = $model->getPomieszczenie();
    $urzadz = $model->getUrzadzenie();    
    
    } ?>

<form method="POST" action="/<?= APP_ROOT ?>/pomiary/edit">
    <div class="form-group">
       

    <label>Wartość </label>
    <input class="form-control" type="text" name="wartosc" value="<?= $wartosc ?>"/>
    <input type="hidden" name="id" value="<?= $id ?>" />  
    </div>    
    <label>Czas pomiaru </label>
    <input class="form-control" type="text" name="czas_pomiaru" value="<?= $czas_pomiaru ?>"/>     
    </div>
    
    <div class="form-group">
        <label>Nazwa urzadzenia</label>
        
        <select name="urzadzenie" class="form-control">
            <?php  
            foreach ($urzadzeniaAll as $urzadzenie) {
               // if ($typ_urzadzenia['id_typu'] == $typ->getId_Typu()) {
                //    echo '<option value="' . $typ_urzadzenia['id_typu'] . '" selected>' . $typ_urzadzenia['nazwa_typu'] . '</option>';
                //} else {
                    echo '<option value="' . $urzadzenie['id_urzadzenia'] . '" >' . $urzadzenie['nazwa_urzadzenia'] . '</option>';
              //  }
            }
            ?>    
        </select>
    </div>
    
    <div class="form-group">
        <label>Nazwa pomieszczenia</label>
        
        <select name="pomieszczenie" class="form-control">
            <?php  
            foreach ($pomieszczeniaAll as $pomieszczenie) {
               // if ($typ_urzadzenia['id_typu'] == $typ->getId_Typu()) {
                //    echo '<option value="' . $typ_urzadzenia['id_typu'] . '" selected>' . $typ_urzadzenia['nazwa_typu'] . '</option>';
                //} else {
                    echo '<option value="' . $pomieszczenie['id_pomieszczenia'] . '" >' . $pomieszczenie['nazwa_pomieszczenia'] . '</option>';
              //  }
            }
            ?>    
        </select>
    </div>    
    
    
    
    <button class="btn btn-info" type="submit">OK</button>
</form>