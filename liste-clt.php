<?php
require "connexion.php";
//suppression
if (isset($_GET['ids'])) {
    $db->query('delete from client where idclt=' . $_GET['ids']);
    header('Location:liste-clt.php');
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
        $req = $db->query('Select * from client');
        $i = 1;
        while ($ligne = $req->fetch()) {
            echo '<tr>';
            echo '<td>' . $i . '</td>';
            echo '<td>' . $ligne['nomclt'] . '</td>';
            echo '<td>' . $ligne['prenomclt'] . '</td>';
            echo '<td>' . $ligne['adresseclt'] . '</td>';
            echo '<td>' . $ligne['telephone'] . '</td>';
            echo '<td>
            <a href="ajouter-clt-form.php?idm=' . $ligne['idclt'] .'">Editer<a/>
            <a href="liste-clt.php?ids=' . $ligne['idclt'] .'">Supprimer<a/>
            </td>';

            $i++;
            echo '</tr>';
        }
        ?>

    </table>

</body>

</html>