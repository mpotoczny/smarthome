
<!--
<h4>
<br/>Jeżeli chcesz dołączyć do systemu, trzeba wprowadzić dane potrzebne do rejestracji w poniższych polach.
<br/>Jeśli administrator uzna prośbę za uzasadnioną, wtedy ją zaakceptuje i zostaniesz użytkownikiem systemu.
<br/>
<br/>
</h4>
-->

	


<?php
if (!empty($error)) {
    ?>
      <div class="alert alert-danger" role="alert">
        <?= $error ?>
    </div>
    <?php
    
}
?>
<form method="POST" action="/<?= APP_ROOT ?>/account/register">
        <div class="form-group">
        <label>LOGIN </label>
        <input type="text" name="login" class="form-control" required="true"/> 
    </div>
    <div class="form-group">
        <label>IMIĘ </label>
        <input type="text" name="imie" class="form-control" required="true"/> 
    </div>
    <div class="form-group">
        <label>EMAIL </label>
        <input type="email" name="email" class="form-control" required="true"/>
    </div>

    <div class="form-group">
        <label>HASŁO </label>
        <input type="password" name="haslo" class="form-control" required="true"/> 
    </div>
    <div class="form-group">
        <label>HASŁO PONOWNIE </label>
        <input type="password" name="haslo2" class="form-control" required="true"/> 
    </div>     

    <button type="submit" class="btn btn-default">OK</button> 

</form>