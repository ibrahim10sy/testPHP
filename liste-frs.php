<?php
require "connexion.php";
//suppression
if (isset($_GET['ids'])) {
    $db->query('delete from fournisseurs where idf=' . $_GET['ids']);
    header('Location:liste-frs.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible"content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <table border="1">

        <tr>
            <th>N</th>
            <th>nom</th>
            <th>Prenom</th>
            <th>adresse</th>
            <th>Telephone</th>
            <th>Action</th>
        </tr>

        <?php
        $req = $db->query('Select * from fournisseurs');
        $i = 1;
        while ($ligne = $req->fetch()) {
            echo '<tr>';
            echo '<td>' . $i . '</td>';
            echo '<td>' . $ligne['nomf'] . '</td>';
            echo '<td>' . $ligne['prenomf'] . '</td>';
            echo '<td>' . $ligne['adressef'] . '</td>';
            echo '<td>' . $ligne['telephone'] . '</td>';
            echo '<td>
            <a href="ajouter-frs-form.php?idm=' . $ligne['idf'] .'">Editer<a/>
            <a href="liste-frs.php?ids=' . $ligne['idf'] .'">Supprimer<a/>
            </td>';

            $i++;
            echo '</tr>';
        }
        ?>

    </table>

</body>

</html>