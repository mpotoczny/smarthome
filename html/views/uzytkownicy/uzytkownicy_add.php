<h1>Nowy użytkownik w systemie</h1>
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
<form method="POST" action="/<?= APP_ROOT ?>/uzytkownicy/add">
        <div class="form-group">
        <label>Login</label>
        <input type="text" name="login" class="form-control" /> 
    </div>
    <div class="form-group">
        <label>Imię</label>
        <input type="text" name="imie" class="form-control" /> 
    </div>
    <div class="form-group">
        <label>E-mail</label>
        <input type="email" name="email" class="form-control" />
    </div>
    <div class="form-group">
        <label>Hasło</label>
        <input type="password" name="haslo" class="form-control" /> 
    </div>
    <div class="form-group">
        <label>Hasło ponownie</label>
        <input type="password" name="haslo2" class="form-control" /> 
    </div> 

    <button class="btn btn-info" type="submit">OK</button>
</form>