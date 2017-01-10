    
        
<h1>Lista urządzeń</h1>

<?php
  global $isAdmin;
    ?>

<br />
<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <tr>
            <th>Nazwa urządzenia</th><th>Szczegoly</th><th>Typ urządzenia</th>                                                                 
        </tr>
        <?php
        foreach ($urzadzenia as $urzadzenie) {
            echo '<tr>';
            echo '<td>' . $urzadzenie->getNazwa_Urzadzenia() . '</td>';
            echo '<td>' . $urzadzenie->getSzczegoly_Urzadzenia() . '</td>';
            echo '<td>' . $urzadzenie->getTyp_Urzadzenia()->getNazwa_Typu() . '</td>'; 
             if ($isAdmin) {
            echo '<td><a class="btn btn-info" href="urzadzenia/edit/' . $urzadzenie->getId_Urzadzenia() . '">Edycja</a></td>';
            echo '<td><a class="btn btn-info" href="urzadzenia/delete/' . $urzadzenie->getId_Urzadzenia() . '">Usunięcie</a></td>';        
             }
        }
        ?>
    </table>

    
     <?php
        if ($isAdmin) {
        ?>
        <a class="btn btn-info" href="urzadzenia/add/">Dodanie</a>
    <?php
            }
    ?>     
    


	