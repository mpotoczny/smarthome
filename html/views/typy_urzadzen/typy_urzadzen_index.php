<h1>Lista typów urządzeń</h1>

<br />
<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <tr>
            <th>Nazwa typu</th><th>Szczegóły typu</th>                                                                 
        </tr>
        <?php
        foreach ($results as $row) {
            echo '<tr>';
            echo "<td>".$row['nazwa_typu']."</td>";
            echo "<td>".$row['szczegoly_typu']."</td>";
            echo '<td><a class="btn btn-info" href="typy_urzadzen/edit/' . $row['id_typu'] . '">Edycja</a></td>';
            echo '<td><a class="btn btn-info" href="typy_urzadzen/delete/' . $row['id_typu'] . '">Usunięcie</a></td>';
            echo '</tr>';
        }
        ?>
    </table>

</div>
<a class="btn btn-info" href="typy_urzadzen/add/">Dodanie</a>
