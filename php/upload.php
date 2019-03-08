<?php
require_once 'fonction.php';

if(isset($_POST["btnAjout"])){
    $check = getimagesize($_FILES["imgArticle"]["tmp_name"]);
    if($check !== false){
        $image = $_FILES['imgArticle']['tmp_name'];
        $imgArticle = addslashes(file_get_contents($image));
      //  $imageProperties = getimageSize($_FILES['userImage']['tmp_name']);

        //Insert image content into database
        $nomProduit = filter_input(INPUT_POST, 'nomProduit', FILTER_SANITIZE_STRING);
        $idCategorie = filter_input(INPUT_POST, 'categorie', FILTER_SANITIZE_STRING);
        $caracteristique1 = filter_input(INPUT_POST, 'caracteristique1', FILTER_SANITIZE_STRING);
        $caracteristique2 = filter_input(INPUT_POST, 'caracteristique2', FILTER_SANITIZE_STRING);
        $caracteristique3 = filter_input(INPUT_POST, 'caracteristique3', FILTER_SANITIZE_STRING);
        $caracteristique4 = filter_input(INPUT_POST, 'caracteristique4', FILTER_SANITIZE_STRING);

        $description = $caracteristique . "," . $caracteristique2 . "," . $caracteristique3 . "," . $caracteristique4;
        addProduit($nomProduit, $idCategorie, $description, $imgArticle);

        header("Location: adminAjout.php");
        exit;
    }else{
        echo "Please select an image file to upload.";
    }
}
