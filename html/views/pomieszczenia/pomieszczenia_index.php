<h1>Lista pomieszczeń</h1>

<?php
  global $isAdmin;
    ?>

<br />
<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <tr>
            <th>Nazwa pomieszczenia</th><th>Szczegoly</th>                                                                 
        </tr>
        <?php
        foreach ($results as $row) {
            echo '<tr>';
            echo "<td>".$row['nazwa_pomieszczenia']."</td>";
            echo "<td>".$row['szczegoly_pomieszczenia']."</td>";
            
             if ($isAdmin) {            
            echo '<td><a class="btn btn-info" href="pomieszczenia/edit/' . $row['id_pomieszczenia'] . '">Edycja</a></td>';
            echo '<td><a class="btn btn-info" href="pomieszczenia/delete/' . $row['id_pomieszczenia'] . '">Usunięcie</a></td>';
            echo '</tr>';
             }
        }
        ?>
    </table>

     <?php
        if ($isAdmin) {
        ?>
        <a class="btn btn-info" href="pomieszczenia/add/">Dodanie</a>
    <?php
            }
    ?>   