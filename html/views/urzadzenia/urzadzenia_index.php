<?php
?>
<h1>Lista urządzeń</h1>
<br />

<?php
  global $isAdmin;
if (!$isAdmin) {
    ?>
    <!-- WYBÓR KATEGORII -->
    <div class="form-group">
        <label>Wybierz typ urzadzenia</label>
        <select id="typ_urzadzenia" name="typ_urzadzenia" class="form-control">
            <option value="Wszystkie">Wszystkie</option>
            <?php
            foreach ($typy_urzadzen as $typ_urzadzenia) {
                echo '<option value="' . $typ_urzadzenia->getId_Typu() . '">' . $typ_urzadzenia->getNazwa_Typu() . '</option>';
            }
            ?>
        </select>
        <br />
    </div>
    <?php
}
?>


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
            echo '</tr>'; 
        }
        ?>
    </table>
</div>
    
     <?php
        if ($isAdmin) {
        ?>
        <a class="btn btn-info" href="urzadzenia/add/">Dodanie</a>
    <?php
            }
    ?>     
    
<!--SKRYPT JQUERY - ŻĄDANIE AJAX -->
<script>
    $("#typ_urzadzenia").change(function () {
        var typ = $("#typ_urzadzenia option:selected").val();
        $.ajax({
            url: 'html/async/getUrzadzeniaByTyp.php',
            type: 'GET',
            data: {typ_urzadzenia: typ},
            dataType : "html",
            contentType: 'application/html; charset=utf-8',
            success: function (response) {
                
                $("#urzadzenia").html(response);
            },
            error: function () {
                alert("error");
            }
        });
    })
</script>

	

 
    
