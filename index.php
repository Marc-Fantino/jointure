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

<div class="card mb-3" style="max-width: 540px;">
  <div class="row gy-5">
    <div class="col-md-6">
      <img src="<?=$produit['id_photo1_produit'];?>" alt="<?=$produit['id_nom_produit'];?>" class="img-fluid rounded-start align-items-center" title="<?=$produit['id_nom_produit'];?>">
    </div>
    <div class="col-md-8">
      <div class="card-body text-center">
        <h5 class="card-title"><?=$produit['id_nom_produit'];?></h5>
        <p class="card-text"><?=$produit['id_descritption_produit'];?></p>
        <p class="card-text"><?=$produit['id_taille_produit'];?></p>
        <p class="card-text">Prix :<b class="text-sucess"><?=$produit['id_prix_produit'];?> €</b></p>
        <p class="card-text"><small class="text-muted">Date de dépot :<?=$produit['id_date_produit'];?></small></p>
        <a href="../crud_php_jointure/detail.php?id_produit=<?=$produit['id_produit']?>" class="mt-2 btn btn-primary">Detail produit</a>
        <a href="../crud_php_jointure/suppression.php?id_produit=<?=$produit['id_produit']?>" class="mt-2 btn btn-danger">supprimer produit</a>
        
      </div>
    </div>
  </div>
</div>
    
 

<?php
}
?>
    
</body>
</html>