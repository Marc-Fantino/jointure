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
}if($vinted){
$sql = "SELECT * FROM produits INNER JOIN categorie ON produits.categorie_id = categorie.id_categorie Where id_produit = ?";

$id_produit = $_GET['id_produit'];

$request = $vinted->prepare($sql);

$request->bindParam(1, $id_produit);

$request->execute();

$detail = $request->fetch(PDO::FETCH_ASSOC);
}

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
<form method="POST" id="delete">
<div class="card mb-3 container p-5" style="width: 75rem;">
  <div class="row">
  <div class="col-2" style="width: 150px;">
  <img src="<?= $detail['id_photo1_produit']?>" class="d-block w-100 p-2 demo" alt="<?= $detail['id_nom_produit']?>">
  <img src="<?= $detail['id_photo2_produit']?>" class="d-block w-100 p-2 demo" alt="<?= $detail['id_nom_produit']?>">
  <img src="<?= $detail['id_photo3_produit']?>" class="d-block w-100 p-2 demo" alt="<?= $detail['id_nom_produit']?>">
  <img src="<?= $detail['id_photo4_produit']?>" class="d-block w-100 p-2 demo" alt="<?= $detail['id_nom_produit']?>">
  
  </div>
  
    <div class="col-4" style="width: 35rem;">
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner" style="width: 35rem;">
    <div class="carousel-item active">
    <img src="<?= $detail['id_photo1_produit']?>" class="d-block w-100 p-2 " alt="<?= $detail['id_nom_produit']?>">
    </div>
    <div class="carousel-item">
      <img src="<?= $detail['id_photo2_produit']?>" class="d-block w-100 p-2" alt="<?= $detail['id_nom_produit']?>">
    </div>
    <div class="carousel-item">
      <img src="<?= $detail['id_photo3_produit']?>" class="d-block w-100 p-2" alt="<?= $detail['id_nom_produit']?>">
    </div>
    <div class="carousel-item">
      <img src="<?= $detail['id_photo4_produit']?>" class="d-block w-100 p-2" alt="<?= $detail['id_nom_produit']?>">
    </div>
  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
      
    </div>
    <div class="col-6" style="width: 18rem;">
      <div class="card-body">
        <h5 class="card-title"><?=$detail['id_nom_produit'];?></h5>
        <p class="card-text"><?=$detail['type_categorie'];?></p>
        <p class="card-text"><?=$detail['id_descritption_produit'];?></p>
        <p class="card-text"><?=$detail['id_taille_produit'];?></p>
        <p class="card-text btn btn-warning">Prix :<b class="text-sucess"><?=$detail['id_prix_produit'];?> €</b></p>
        <p class="card-text"><small class="text-muted">Date de dépot :<?=$detail['id_date_produit'];?></small></p>
        <button type="button" class="btn btn-primary btn-lg">Ajouter au panier</button>
      </div>
    </div>
  </div>
</div>
<div class="d-flex justify-content-center">
                    <button type="submit" name="btn-delete" class="btn btn-danger">Confirmer la suppression ?</button>
                    <a href="index.php" class="btn btn-success">Annuler la demande de suppression</a>
                    </div>
</form>
<?php
if(isset($_POST['btn-delete'])){
    $sql ="DELETE FROM produits WHERE id_produit = ?";
    $delete = $vinted->prepare($sql);
    $id_delete_produit =$_GET['id_produit'];
    
    $delete->bindParam(1, $id_delete_produit);
    $delete->execute();
    
    if($delete){
        echo "<p class='container alert alert-success'>Votre produit a bien été supprimer !</p>";
        echo "<div class='container'><a href='index.php' class='mt-3 btn btn-success'>RETOUR</a></div>";
      
    }

?>

<style>#delete{display: none;}</style>
<?php
}else{
    echo "<p class='alert alert-danger'>Erreur lors de la supression du produit !</p>";
    echo "<div class='container'><a href='index.php' class='mt-3 btn btn-success'>RETOUR</a></div>";
}

?>

</body>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</html>