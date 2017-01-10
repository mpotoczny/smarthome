<h1>Lista pomiarów</h1>


<?php
  global $isAdmin;
    ?>
<br />
<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <tr>
            <th>Id pomiaru</th><!--<th>Szczegóły pomiaru--></th><th>Wartość</th><th>Nazwa urządzenia</th> <th>Czas pomiaru</th><th>Nazwa pomieszczenia</th>                                                                  
        </tr>
        <?php
          
 /*       foreach ($results as $row) {
            echo '<tr>';
            echo "<td>".$row['id_pomiaru']."</td>";
            echo "<td>".$row['szczegoly_pomiaru']."</td>";
            echo "<td>".$row['wartosc']."</td>";
            echo "<td>".$row['czas_pomiaru']."</td>";
            echo "<td>".$row['pomieszczenia_id_pomieszczenia']."</td>";
            echo "<td>".$row['urzadzenia_id_urzadzenia']."</td>";
            echo '<td><a class="btn btn-info" href="pomiary/edit/' . $row['id_pomiaru'] . '">Edycja</a></td>';
            echo '<td><a class="btn btn-info" href="pomiary/delete/' . $row['id_pomiaru'] . '">Usunięcie</a></td>';
            echo '</tr>';
        }
        ?>*/
            foreach ($pomiary as $pomiar) {
                echo '<tr>';
                echo '<td>' . $pomiar->getId_Pomiaru() . '</td>';
                //echo '<td>' . $pomiar->getSzczegoly_Pomiaru() . '</td>';
                echo '<td>' . $pomiar->getWartosc() . '</td>';
                echo '<td>' . $pomiar->getUrzadzenie()->getNazwa_Urzadzenia() . '</td>';
                echo '<td>' . $pomiar->getCzas_Pomiaru() . '</td>';
                echo '<td>' . $pomiar->getPomieszczenie()->getNazwa_Pomieszczenia() . '</td>';               
            if ($isAdmin) {
            echo '<td><a class="btn btn-info" href="pomiary/edit/' . $pomiar->getId_Pomiaru() . '">Edycja</a></td>';
            echo '<td><a class="btn btn-info" href="pomiary/delete/' . $pomiar->getId_Pomiaru() . '">Usunięcie</a></td>';                  
            }
            

//echo '<td><a class="btn btn-info" href="pomiary/edit/' . $row['id_pomiaru'] . '">Edycja</a></td>';
                //echo '<td><a class="btn btn-info" href="pomiary/delete/' . $row['id_pomiaru'] . '">Usunięcie</a></td>';
                echo '</tr>';
            }
            ?>        
        
        
        
    </table>

</div>

    <?php
        if ($isAdmin) {
        ?>
        <a class="btn btn-info" href="pomiary/add/">Dodanie</a>
    <?php
            }
    ?>    


