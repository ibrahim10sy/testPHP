<?php 
require "connexion.php";
if(isset($_POST['enregistrer'])){
    
    if (isset($_POST['idclt'],$_POST['produitc'],$_POST['quantitec'],$_POST['prixunitaire'])) {
       $req = $db->prepare('insert into commande (idclt,produitc,quantitec,prixunitaire) values (?,?,?,?)');
       $req -> bindValue (1,$_POST['idclt']);
       $req -> bindValue (2,$_POST['produitc']);
       $req -> bindValue (3,$_POST['quantitec']);
       $req -> bindValue (4,$_POST['prixunitaire']);
       $req -> execute();
       header('Location:liste-commande.php');
            
    }
    }
//Edition

if(isset($_GET['idm'])) {

    $req = $db ->query('select * from commande where idc=' .$_GET['idm']);
    if($ligne = $req -> fetch()){
        $_POST['idc'] = $ligne['idc'];
        $_POST['idclt'] = $ligne['idclt'];
        $_POST['produitc'] = $ligne['produitc'];
        $_POST['quantitec'] = $ligne['quantitec'];
        $_POST['prixunitaire'] = $ligne['prixunitaire'];
    }
}
//modification
if (isset($_POST['idclt'],$_POST['produitc'],$_POST['quantitec'],$_POST['prixunitaire'])) {
    $req = $db->prepare('insert into commande (idclt,produitc,quantitec,prixunitaire) values (?,?,?,?)');
    $req -> bindValue (1,$_POST['idclt']);
    $req -> bindValue (2,$_POST['produitc']);
    $req -> bindValue (3,$_POST['quantitec']);
    $req -> bindValue (4,$_POST['prixunitaire']);
    $req -> execute();
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
    <link rel="stylesheet" href="style.css">
  
</head>
<body>
   <fieldset>
    <legend>Saissir les informations</legend>
    <form action="commande-form.php" method="POST">
      <div>
        <label >Client</label> 
        <select name="idclt" id="">
            <option value="">  </option>
            <?php 
                $req = $db->query('select * from client');

                while($ligne = $req ->fetch()){
                    if(isset($_POST['idclt']) && $ligne['idclt']== $_POST['idclt']){
                        echo '<option value="'.$ligne['idclt'].'" selected>'.$ligne['nomclt'].''
                        .$ligne['prenomclt']. '</option>';
                    } else{
                        echo '<option value="'.$ligne['idclt'].'">'.$ligne['nom'].''.
                        $ligne['prenomclt'].'</option>';
                    }
                }
            
            ?>
        </select>
    </div>
    <div class="">
        <label >Produit commandé</label> 
        <select name="idclt" id="productSelect" onchange="getProductPrice()">
            <option value="">  </option>
            <?php 
                $req = $db->query('select * from produits');

                while($ligne = $req ->fetch()){
                    if(isset($_POST['idp']) && $ligne['idp']== $_POST['idp']){
                        echo '<option value="'.$ligne['idp'].'" selected>'.$ligne['nomp'].
                        '</option>';
                    } else{
                        echo '<option value="'.$ligne['idp'].'">'.$ligne['nomp'].
                       '</option>';
                    }
                }
            
            ?>
        </select>
    </div>
   
    <div>
   <label >Quantite commandé</label> 
   <input type="number" name="quantitec" value="<?php if(isset($_POST['quantitec'])) echo $_POST['quantitec']?>">
  </div>
  <div>
        <label >Prix unitaire</label> 
        <select name="idp" id="productPrice" >
            <option value="">Selectionner le prix</option>
            <?php 
                $req = $db->query('select * from produits');

                while($ligne = $req ->fetch()){
                    if(isset($_POST['idp'] , $_POST['prixunitaire']) && $ligne['idp'] == $_POST['idp']){
                        echo '<option value="'.$ligne['idp'].'" selected>'.$ligne['prixunitaire'].'</option>';
                    } else{
                        echo '<option value="'.$ligne['idp'].'">'.$ligne['prixunitaire'].
                       '</option>';
                    }
                }

                
                // Assuming you have a database connection
                $product = $_POST['nomp']; // Assuming you're using POST method
                
                $req = $db->query ( "SELECT prixunitaire FROM produits WHERE nom = '$product'");
                
                if ($ligne = $req ->fetch()) {
                  $price = $ligne['prixunitaire'];
                  echo '<option value="'.$ligne['idp'].'" selected>'.$ligne['prixunitaire'].'</option>'; // Send the price back as the response
                }
                
            
            ?>
        </select>
    </div>
  <!-- end  -->

   <?php if(isset($_GET['idm'])){ ?>
     <div class="disp">
        <input type="hidden" name="idc" value="<?php if(isset($_POST['idc'])) echo $_POST['idc'] ?>">
        <input type="submit" class="btn" name="modifier" value="Modifier">
        </div>
        <?php }else{?>
        <div class="disp">
            <input type="submit" class="btn" name="enregistrer" value="Enregistrer">
        </div>
        <?php }?>
    </form>
    </fieldset>

    <script>
        function getProductPrice() {
            var selectedProduct = document.getElementById("productSelect").value;

// Création d'une instance de l'objet XMLHttpRequest
var xhr = new XMLHttpRequest();

// Fonction de rappel appelée lorsque la réponse du serveur est reçue
xhr.onreadystatechange = function() {
  if (xhr.readyState === XMLHttpRequest.DONE) {
    if (xhr.status === 200) {
      var price = xhr.responseText;
      document.getElementById("productPrice").textContent = "Prix : $" + price;
    } else {
      console.error("Une erreur s'est produite.");
    }
  }
};

// Envoi de la requête au serveur
xhr.open("POST", "votre_script.php", true);
xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
xhr.send("product=" + selectedProduct);
}
    </script>
</body>
</html>