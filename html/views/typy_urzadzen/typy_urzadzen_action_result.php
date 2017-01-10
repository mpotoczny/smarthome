<?php
if (!empty($error)) {
    ?>
    <div class="alert alert-danger" role="alert">
        <?= $error ?>
    </div>
    <?php
}
else if (!empty($success)) {
    ?>
    <div class="alert alert-success" role="alert">
        <?= $success ?>
    </div>

    <?php
}
?>
<a class="btn btn-info" href="/<?=APP_ROOT?>/typy_urzadzen">Powrót</a>
