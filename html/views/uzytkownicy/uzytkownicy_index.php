<h1>Użytkownicy</h1>

<br />
<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <tr>
            <th>Login</th><th>Imię</th><th>E-mail</th><th>Hasło(sha1)</th>                                                                 
        </tr>
        <?php
        foreach ($results as $row) {
            echo '<tr>';
            echo "<td>".$row['login']."</td>";
            echo "<td>".$row['imie']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['haslo']."</td>";
            echo '<td><a class="btn btn-info" href="uzytkownicy/edit/' . $row['id_uzytkownika'] . '">Edycja</a></td>';
            echo '<td><a class="btn btn-info" href="uzytkownicy/delete/' . $row['id_uzytkownika'] . '">Usunięcie</a></td>';
            echo '</tr>';
        }
        ?>
    </table>

</div>
<a class="btn btn-info" href="uzytkownicy/add/">Dodanie</a>
