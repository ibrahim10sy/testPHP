<?php
require "connexion.php";
//suppression
if (isset($_GET['ids'])) {
    $db->query('delete from produits where idp=' . $_GET['ids']);
    header('Location:liste-produit.php');
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
            <th>Nom produit</th>
            <th>Description</th>
            <th>Prix Unitaire</th>
            <th>Quantite</th>
            <th>Action</th>
        </tr>

        <?php
        $req = $db->query('Select * from produits');
        $i = 1;
        while ($ligne = $req->fetch()) {
            echo '<tr>';
            echo '<td>' . $i . '</td>';
            echo '<td>' . $ligne['nomp'] . '</td>';
            echo '<td>' . $ligne['descr'] . '</td>';
            echo '<td>' . $ligne['prixunitaire'] . '</td>';
            echo '<td>' . $ligne['quantite'] . '</td>';
            echo '<td>
            <a href="ajouter-produit-form.php?idm=' . $ligne['idp'] .'">Editer<a/>
            <a href="liste-produit.php?ids=' . $ligne['idp'] .'">Supprimer<a/>
            </td>';

            $i++;
            echo '</tr>';
        }
        ?>

    </table>

</body>

</html>