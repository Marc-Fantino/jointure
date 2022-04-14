
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
<div class="mt-4 container bg-main overflow-hidden">
    <div class="row g-2">
    
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

    if(isset($_FILES['id_photo1_produit'])){
    $destination ="assets/img/";
    
    $photoArticle1 = $destination.basename($_FILES['id_photo1_produit']['name']);
    
    
    $_POST['id_photo1_produit'] = $photoArticle1;
    
    
    if(move_uploaded_file($_FILES['id_photo1_produit']['tmp_name'], $photoArticle1)){
        echo "<p class='container alert-alert-success'>Le fichier est validé et téléchargé avec success</p>";
    
    }else{
        echo "<p class='container alert-alert-danger'>Erreur lors du téléchargement</p>";
    }
}else{
    echo "<p class='container alert-alert-success'>Le fichier est invalide seul les format .png, .jpg, .bmp, .svg, .webp sont autorisé !</p>";

}

    $sql = "UPDATE `produits` SET `id_nom_produit`= ?,`id_photo1_produit`= ?,`id_taille_produit`= ?,`id_prix_produit`= ?,`id_date_produit`= ?,`id_descritption_produit`= ?,`categorie_id`= ?,`vendeur_id`= ? WHERE id_produit = ?";

    $modif = $vinted->prepare($sql);
    
 
    
    $modif->execute(array(
        
        $_POST['id_nom_produit'],
        $_POST['id_photo1_produit'],
        $_POST['id_taille_produit'],
        $_POST['id_prix_produit'],
        $_POST['id_date_produit'],
        $_POST['id_description_produit'],
        $_POST['categories'],
        $_POST['vendeurs'],
        $_GET['id_produit']
      
    
    ));
    if($modif){
        echo "<p class='container alert alert-success'>Votre produit a été ajouté avec succès !</p>";
        echo "<a href='index.php' class='container btn btn-success'>Voir mon produit</a>";
    }else{
        echo "<p class='container alert alert-danger'>Erreur lors de l'ajoutdu produit</p>";
    }
?>
    
    </div>

</div>


</body>
</html>