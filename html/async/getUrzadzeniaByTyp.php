<?php
include '../application/database.class.php';
include '../model/Urzadzenia.class.php';
include '../model/Typy_urzadzen.class.php';

$db = Database::getInstance();
$id_typu = $_GET['typ_urzadzenia'];
if ($id_typu == "Wszystkie") {
    $results = $db::getUrzadzeniaList();
} else {
    $results = $db::getUrzadzeniaListByTyp($id_typu);
}

$response = "<tr><th>Nazwa urządzenia</th><th>Szczegoly</th><th>No i typ</th></tr>";                                  
foreach ($results as $row) {
    $typ_urzadzenia = $db::getTypyUrzadzenById($row['id_typu']);
    $response .= '<tr>';
    $response .= '<td>' . $row['nazwa_urzadzenia'] . "</td>";
    $response .= '<td>' . $row['szczegoly_urzadzenia'] . "</td>";
    $response .= '<td>' . $typ_urzadzenia->getNazwa_Typu() . "</td>";
    $response .= "</tr>";
}
echo $response;


