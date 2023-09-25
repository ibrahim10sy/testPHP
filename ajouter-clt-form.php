<?php 
require "connexion.php";
if(isset($_POST['enregistrer'])){
    
    if (isset($_POST['nomclt'],$_POST['prenomclt'],$_POST['adresseclt'],$_POST['telephone'])) {
       $req = $db->prepare('insert into client (nomclt,prenomclt,adresseclt,telephone) values (?,?,?,?)');
       $req -> bindValue (1,$_POST['nomclt']);
       $req -> bindValue (2,$_POST['prenomclt']);
       $req -> bindValue (3,$_POST['adresseclt']);
       $req -> bindValue (4,$_POST['telephone']); 
       $req -> execute();
       header('Location:liste-clt.php');
            
    }
    }
//Edition

if(isset($_GET['idm'])) {

    $req = $db ->query('select * from client where idclt=' .$_GET['idm']);
    if($ligne = $req -> fetch()){
        $_POST['idclt'] = $ligne['idclt'];
        $_POST['nomclt'] = $ligne['nomclt'];
        $_POST['prenomclt'] = $ligne['prenomclt'];
        $_POST['adresseclt'] = $ligne['adresseclt'];
        $_POST['telephone'] = $ligne['telephone'];
    }
}
//modification
if(isset($_POST['modifier'])) {
    if(isset($_POST['nomclt'],$_POST['prenomclt'],$_POST['adresseclt'],$_POST['telephone']));
       $req = $db ->prepare('update client set nomclt=?,prenomclt=?,adresseclt=?,telephone=? where idclt=?');
       $req -> bindValue (1,$_POST['nomclt']);
       $req -> bindValue (2,$_POST['prenomclt']);
       $req -> bindValue (3,$_POST['adresseclt']);
       $req -> bindValue (4,$_POST['telephone']); 
       $req -> bindValue (5,$_POST['idclt']); 
       $req -> execute();
       header('Location:liste-clt.php');
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
    <form action="ajouter-clt-form.php" method="POST">
      <div>
        <label >nomclt</label> 
        <input type="text" name="nomclt" value="<?php if(isset($_POST['nomclt'])) echo $_POST['nomclt']?> ">
    </div>
    <div class="">
        <label >Prénomclt</label> 
        <input type="text" name="prenomclt" value="<?php if(isset($_POST['prenomclt'])) echo $_POST['prenomclt']?>">
    </div>

    <div>
        <label >adresseclt</label>
         <input type="text" name="adresseclt" id="" class="selec"  value="<?php if(isset($_POST['adresseclt'])) echo $_POST['adresseclt']?>" >
         
       
    </div>
    <div>
   <label >Téléphone</label> 
   <input type="tel" name="telephone" id="" value="<?php if(isset($_POST['telephone'])) echo $_POST['telephone']?>">
  </div>

   <?php if(isset($_GET['idm'])){ ?>
     <div class="disp">
        <!-- <label for="">&nbsp;</label> -->
        <input type="hidden" name="idclt" value="<?php if(isset($_POST['idclt'])) echo $_POST['idclt'] ?>">
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