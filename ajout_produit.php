<?php

$pass="";
$user="root";
$baseDonnee="vinted";
$hote="localhost";
try{

$vinted= new PDO("mysql:host=".$hote.";dbname=".$baseDonnee.";charset=UTF8", $user, $pass);

$vinted->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){
echo "erreur !".$e->getMessage() . "</br>";

die();
}

$sql =" SELECT * FROM produits INNER JOIN categorie ON produits.categorie_id = categorie.id_categorie INNER JOIN vendeur ON produits.vendeur_id = vendeur.id_vendeur";
$produits = $vinted->query($sql);

foreach($produits as $produit)
{
    ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../crud_php_jointure/assets/sass/style.css">
    <title>Document</title>
</head>
<body>
    
    <div class="container-fluid">
            <h1 class="text-center">Bienvenue</h1>
            <h3 class="text-center">Création d'article dans le dressing</h3>
        <div class="container">
            <form action="traitement_ajouter_produit" id="form-creation" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="id_nom_produit" class="form-label">Nom de l'article</label>
                    <input type="text" class="form-control" id="id_nom_produit" name="id_nom_produit" required>
                </div>
                <div class="mb-3">
                    <label for="id_description_produit" class="form-label">Description de l'article</label>
                    <input type="text" class="form-control" id="id_description_produit" name="id_description_produit" required>
                </div>
                <div class="mb-3">
                    <label for="id_prix_produit" class="form-label">Prix de l'article</label>
                    <input type="text" class="form-control" id="id_prix_produit" name="id_prix_produit" required>
                </div>
                <div class="mb-3">
                    <label for="id_taille_produit" class="form-label">Taille de l'article</label>
                    <input type="text" class="form-control" id="id_taille_produit" name="id_taille_produit" required>
                </div>
                <div class="mb-3">
                    <label for="id_date_produit" class="form-label">Date de création de l'article</label>
                    <input type="date" class="form-control" id="id_date_produit" name="id_date_produit" required>
                </div>
                <div class="mb-3">
                Catégorie :
                <select name="categories" class="form-control">
                <?php
                    $sql = "SELECT * FROM categorie";
                    $categorie = $vinted->query($sql);
                    
                    foreach($categorie as $category){
                ?>
                <option value="<?=$category['id_categorie']?>"><?=$category['type_categorie']?></option>
                    
                <?php
                    }
                ?>
                </select>
                </div>
                
                <div class="mb-3">
                Vendeur :
                <select name="vendeurs" class="form-control">
                <?php
                    $sql = "SELECT * FROM vendeur";
                    $vendeurs = $vinted->query($sql);
                    
                    foreach($vendeurs as $vendeur){
                ?>
                <option value="<?=$vendeur['id_vendeur']?>"><?=$vendeur['id_nom_vendeur']?></option>
                    
                <?php
                    }
                ?>
                </select>
                </div>
                
                <div class="mb-3">
                    <label for="id_photo1_produit" class="form-label">Premier photo de l'article</label>
                    <input type="file" class="form-control" id="id_photo_produit" name="id_photo1_produit" required>
                </div>
           
                <div class="text-center">
                    <button type="submit" name="btn-creation" class="btn btn-success">Ajouter l'article</button>
                    <a href="index.php" class="btn btn-primary">Annuler</a>
                </div>
            
            </form>
        
        </div>
    </div>
 <?php   
}
?>
    
</body>
</html>