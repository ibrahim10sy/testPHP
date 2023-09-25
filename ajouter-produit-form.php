<?php 
require "connexion.php";
if(isset($_POST['enregistrer'])){
    
    if (isset($_POST['nomp'],$_POST['descr'],$_POST['prixunitaire'],$_POST['quantite'])) {
       $req = $db->prepare('insert into produits (nomp,descr,prixunitaire,quantite) values (?,?,?,?)');
       $req -> bindValue (1,$_POST['nomp']);
       $req -> bindValue (2,$_POST['descr']);
       $req -> bindValue (3,$_POST['prixunitaire']);
       $req -> bindValue (4,$_POST['quantite']); 
       $req -> execute();
       header('Location:liste-produit.php');
            
    }
    }
//Edition

if(isset($_GET['idm'])) {

    $req = $db ->query('select * from produits where idp=' .$_GET['idm']);
    if($ligne = $req -> fetch()){
        $_POST['idp'] = $ligne['idp'];
        $_POST['nomp'] = $ligne['nomp'];
        $_POST['descr'] = $ligne['descr'];
        $_POST['prixunitaire'] = $ligne['prixunitaire'];
        $_POST['quantite'] = $ligne['quantite'];
    }
}
//modification
if(isset($_POST['modifier'])) {
    if(isset($_POST['nomp'],$_POST['descr'],$_POST['prixunitaire'],$_POST['quantite']));
       $req = $db ->prepare('update produits set nomp=?,descr=?,prixunitaire=?,quantite=? where idp=?');
       $req -> bindValue (1,$_POST['nomp']);
       $req -> bindValue (2,$_POST['descr']);
       $req -> bindValue (3,$_POST['prixunitaire']);
       $req -> bindValue (4,$_POST['quantite']); 
       $req -> bindValue (5,$_POST['idp']); 
       $req -> execute();
       header('Location:liste-produit.php');
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
    <form action="ajouter-produit-form.php" method="POST">
      <div>
        <label >Nom du Produit</label> 
        <input type="text" name="nomp" value="<?php if(isset($_POST['nomp'])) echo $_POST['nomp']?> ">
    </div>
    <div class="">
        <label >Description</label> 
        <input type="text" name="descr" value="<?php if(isset($_POST['descr'])) echo $_POST['descr']?>">
    </div>

    <div>
        <label >Prix Unitaire</label>
         <input type="number" name="prixunitaire" value="<?php if(isset($_POST['prixunitaire'])) echo $_POST['prixunitaire']?>" >
         
       
    </div>
    <div>
   <label >Quantite</label> 
   <input type="number" name="quantite" value="<?php if(isset($_POST['quantite'])) echo $_POST['quantite']?>">
  </div>

   <?php if(isset($_GET['idm'])){ ?>
     <div class="disp">
        <!-- <label for="">&nbsp;</label> -->
        <input type="hidden" name="idp" value="<?php if(isset($_POST['idp'])) echo $_POST['idp'] ?>">
        <input type="submit" class="btn" name="modifier" value="Modifier">
        </div>
        <?php }else{?>
        <div class="disp">
            <input type="submit" class="btn" name="enregistrer" value="Enregistrer">
        </div>
        <?php }?>
    </form>
    </fieldset>
</body>
</html>