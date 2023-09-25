<?php 
require "connexion.php";
if(isset($_POST['enregistrer'])){
    
    if (isset($_POST['nomf'],$_POST['prenomf'],$_POST['adressef'],$_POST['telephone'])) {
       $req = $db->prepare('insert into fournisseurs (nomf,prenomf,adressef,telephone) values (?,?,?,?)');
       $req -> bindValue (1,$_POST['nomf']);
       $req -> bindValue (2,$_POST['prenomf']);
       $req -> bindValue (3,$_POST['adressef']);
       $req -> bindValue (4,$_POST['telephone']); 
       $req -> execute();
       header('Location:liste-frs.php');
            
    }
    }
//Edition

if(isset($_GET['idm'])) {

    $req = $db ->query('select * from fournisseurs where idf=' .$_GET['idm']);
    if($ligne = $req -> fetch()){
        $_POST['idf'] = $ligne['idf'];
        $_POST['nomf'] = $ligne['nomf'];
        $_POST['prenomf'] = $ligne['prenomf'];
        $_POST['adressef'] = $ligne['adressef'];
        $_POST['telephone'] = $ligne['telephone'];
    }
}
//modification
if(isset($_POST['modifier'])) {
    if(isset($_POST['nomf'],$_POST['prenomf'],$_POST['adressef'],$_POST['telephone']));
       $req = $db ->prepare('update fournisseurs set nomf=?,prenomf=?,adressef=?,telephone=? where idf=?');
       $req -> bindValue (1,$_POST['nomf']);
       $req -> bindValue (2,$_POST['prenomf']);
       $req -> bindValue (3,$_POST['adressef']);
       $req -> bindValue (4,$_POST['telephone']); 
       $req -> bindValue (5,$_POST['idf']); 
       $req -> execute();
       header('Location:liste-frs.php');
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
    <form action="ajouter-frs-form.php" method="POST">
      <div>
        <label >nom</label> 
        <input type="text" name="nomf" value="<?php if(isset($_POST['nomf'])) echo $_POST['nomf']?> ">
    </div>
    <div class="">
        <label >Prénom</label> 
        <input type="text" name="prenomf" value="<?php if(isset($_POST['prenomf'])) echo $_POST['prenomf']?>">
    </div>

    <div>
        <label >adresse</label>
         <input type="text" name="adressef" id="" class="selec"  value="<?php if(isset($_POST['adressef'])) echo $_POST['adressef']?>" >
         
       
    </div>
    <div>
   <label >Téléphone</label> 
   <input type="tel" name="telephone" id="" value="<?php if(isset($_POST['telephone'])) echo $_POST['telephone']?>">
  </div>

   <?php if(isset($_GET['idm'])){ ?>
     <div class="disp">
        <!-- <label for="">&nbsp;</label> -->
        <input type="hidden" name="idf" value="<?php if(isset($_POST['idf'])) echo $_POST['idf'] ?>">
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