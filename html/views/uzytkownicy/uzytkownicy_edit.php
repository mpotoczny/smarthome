<h1>Edycja użytkownika</h1>
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
$login = "";
$imie= "";
$email= "";
$haslo= "";
$haslo2= "";
$id_uzytkownika = "";
if (!empty($model)) {
    $login = $model->getLogin();
    $haslo= $model->getHaslo();
    $email= $model->getEmail();
    $imie = $model->getImie();
    $id_uzytkownika = $model->getId_Uzytkownika();
    
    } ?>
<form method="POST" action="/<?= APP_ROOT ?>/uzytkownicy/edit">
    <div class="form-group">
       
    <label>Login </label>
    <input class="form-control" type="text" name="login" value="<?= $login ?>"/>
    <label>Imię </label>
    <input class="form-control" type="text" name="imie" value="<?= $imie ?>"/>    
    <label>Email </label>
    <input class="form-control" type="text" name="email" value="<?= $email ?>"/> 
    <label>Hasło </label>
    <input class="form-control" type="password" name="haslo" value="<?= $haslo ?>"/>
    <label>Powtórz hasło</label>
    <input class="form-control" type="password" name="haslo2" value="<?= $haslo ?>"/>    
    </div>
    <input type="hidden" name="id_uzytkownika" value="<?= $id_uzytkownika ?>" />
    <button class="btn btn-info" type="submit">OK</button><br />
</form>