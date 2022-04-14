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
        //0 - Une cles etrangère est une reference a une cle primaire d'une autre table
        //1- Selectionne tous de la table produits
        //2- Joint la table categories ou (table) produits.(cle etrangère) = (table) categories.(cle primaire)
        //3 - Joint la table vendeurs ou (table) produits.(cle etrangère) =  (table) vendeurs.(cle primaire)
        //4 - Joint la tablecommentaires ou (table) produits.(cle etrangère) = (table)  commentaires.(cle primaire)
        //5 - On ajoute le prediquat where qui filtre les produits par id (cle primaire des produits)
        
        $sql ="SELECT * FROM produits 
        INNER JOIN categorie ON produits.categorie_id= categorie.id_categorie
        INNER JOIN vendeur ON produits.vendeur_id= vendeur.id_vendeur
        WHERE id_produit = ? ";
        
        $request = $vinted->prepare($sql);
        
        $id_editer = $_GET['id_produit'];
        
        $request->bindParam(1, $id_editer);
        
        $request->execute();
        
        $editer = $request->fetch(PDO::FETCH_ASSOC);

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
            <h3 class="text-center">Edition d'un article dans le dressing</h3>
        <div class="container">
            <form action="traitement_editer.php?id_produit=<?=$editer['id_produit']?>" id="form-creation" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="id_nom_produit" class="form-label">Nom de l'article</label>
                    <input type="text" class="form-control" id="id_nom_produit" name="id_nom_produit" value="<?=$editer['id_nom_produit']?>" required>
                </div>
                <div class="mb-3">
                    <label for="id_description_produit" class="form-label">Description de l'article</label>
                    <input type="text" class="form-control" id="id_description_produit" name="id_description_produit">
                </div>
                <div class="mb-3">
                    <label for="id_prix_produit" class="form-label">Prix de l'article</label>
                    <input type="text" class="form-control" id="id_prix_produit" name="id_prix_produit" value="<?=$editer['id_prix_produit']?>" required>
                </div>
                <div class="mb-3">
                    <label for="id_taille_produit" class="form-label">Taille de l'article</label>
                    <input type="text" class="form-control" id="id_taille_produit" name="id_taille_produit" value="<?=$editer['id_taille_produit']?>" required>
                </div>
                <div class="mb-3">
                    <label for="id_date_produit" class="form-label">Date de création de l'article</label>
                    <input type="date" class="form-control" id="id_date_produit" name="id_date_produit" value="<?=$editer['id_date_produit']?>" required>
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
                    <label for="id_photo1_produit" class="form-label">Photo de l'article</label>
                    <input type="file" class="form-control" id="id_photo_produit" name="id_photo1_produit" value="<?=$editer['id_photo1_produit']?>" required>
                </div>
           
                <div class="text-center">
                    <button type="submit" name="btn-creation" class="btn btn-success">Modifier l'article</button>
                    <a href="detail.php" class="btn btn-primary">Annuler</a>
                </div>
            
            </form>
        
        </div>
    </div>
    
   
</body>
</html>