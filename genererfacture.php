<?php
require('connexion.php');
//suppression
if (isset($_GET['ids'])) {
    $db->query('delete from commande where idc=' . $_GET['ids']);
    header('Location:liste-commande.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="facture.css">
    <style>
        .container{
            display: flex;
            justify-content: space-around;
        }
        table{
            text-align: center;
            width: 80%;
            margin-left: 5rem;
            margin-top: 2rem;
        }
    </style>
</head>
<body>
    <section>
        <h2>Facture</h2>
    <div class="container">

    <div class="cor">
        <p>Nom : <?php
$req = $db->query('SELECT * from commande join client on commande.idc=client.idclt');
$i = 1;
while ($ligne = $req->fetch()) {
    echo '<tr>';
    echo '<td>' . $ligne['prenomclt']  . '</td>';
    echo '<td>' . $ligne['nomclt'] . '</td>';
    $i++;
    echo '</tr>';
}
?></p>
        <p>Téléphone: <?php
$req = $db->query('SELECT * from commande join client on commande.idc=client.idclt');
$i = 1;
while ($ligne = $req->fetch()) {
    echo '<tr>';
    echo '<td>' . $ligne['telephone']  . '</td>';
    $i++;
    echo '</tr>';
}
?></p>
        <p>Adresse : <?php
$req = $db->query('SELECT * from commande join client on commande.idc=client.idclt');
$i = 1;
while ($ligne = $req->fetch()) {
    echo '<tr>';
    echo '<td>' . $ligne['adresseclt']  . '</td>';
    $i++;
    echo '</tr>';
}
?></p> 
</div>
<div class="recu">
    <p>Recu #: <?php
$req = $db->query('SELECT * from commande ');
$i = 1;
while ($ligne = $req->fetch()) {
    echo '<tr>';
    echo '<td>' . $ligne['idc']  . '</td>';
    $i++;
    echo '</tr>';
}
?></p>
<p>Date </p>
</div>
</div>
    <table border="1">

        <tr>
        <!-- <th>N</th>
        <th>Client</th> -->
        <th>Produit commandé</th>
         <th>Quantite</th>
         <th>Prix unitaire</th>
        <th>Prix total</th>
</tr>

<?php
$req = $db->query('SELECT * from commande join client on commande.idc=client.idclt');
$i = 1;
while ($ligne = $req->fetch()) {
    echo '<tr>';
    // echo '<td>' . $i . '</td>';
    // echo '<td>' . $ligne['nomclt'] . '</td>';
    echo '<td>' . $ligne['produitc'] . '</td>';
    echo '<td>' . $ligne['quantitec'] . '</td>';
    echo '<td>' . $ligne['prixunitaire'] . '</td>';
    echo '<td>' . $ligne['prixtotal'] . '</td>';
    // echo '<td>
    // <a href="commande-form.php?idm=' . $ligne['idc'] .'">Editer<a/>
    // <a href="liste-commande.php?ids=' . $ligne['idc'] .'">Supprimer<a/>
    // </td>';

    $i++;
    echo '</tr>';
}
?>

</table>


    </section>
</body>
</html>