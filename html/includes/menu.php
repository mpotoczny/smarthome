<?php

error_reporting( error_reporting() & ~E_NOTICE & ~E_STRICT );


$login = $_SESSION['user'];
if (!empty($login)) {
    $db = $registry->db;
    if ($db::isUserInRole($login, 'admin')) {
?>
<!--Menu dla admina-->
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/<?= APP_ROOT ?>">STRONA GŁÓWNA</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="/<?= APP_ROOT ?>/uzytkownicy">Zarządzanie użytkownikami</a></li>
                        <li><a href="/<?= APP_ROOT ?>/pomieszczenia">Zarządzanie pomieszczeniami</a></li>
                        <li><a href="/<?= APP_ROOT ?>/typy_urzadzen">Zarządzanie typami urządzeń</a></li>                           
                        <li><a href="/<?= APP_ROOT ?>/urzadzenia">Zarządzanie urządzeniami</a></li>                        
                        <li><a href="/<?= APP_ROOT ?>/pomiary">Zarządzanie pomiarami</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>
        <?php
    } else { 
        ?>
<!--MENU DLA ZALOGOWANEGO ZWYKŁEGO UŻYTKOWNIKA-->
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/<?= APP_ROOT ?>">STRONA GŁÓWNA</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="/<?= APP_ROOT ?>/pomieszczenia">Pomieszczenia</a></li>
                        <li><a href="/<?= APP_ROOT ?>/urzadzenia">Urządzenia</a></li>                        
                        <li><a href="/<?= APP_ROOT ?>/pomiary">Pomiary</a></li>
                        <li><a href="/<?= APP_ROOT ?>/uzytkownicy">Moje dane</a></li>                        
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>
        <?php  }  ?>  <?php
} else {
    ?>
<!--MENU DLA GOŚCIA-->
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/<?= APP_ROOT ?>">STRONA GŁÓWNA</a>
            </div>
   <!--         <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                      <li><a href="/<?= APP_ROOT ?>/kontakt">Kontakt z administratorem</a></li>
                </ul>
            </div><!--/.nav-collapse --> 
        </div>
    </nav>
    <?php } ?>


