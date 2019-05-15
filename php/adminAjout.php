<?php

require_once 'fonction.php';

if (empty($_SESSION["username"]) || !isAdmin($_SESSION["uID"])){
  header("Location: index.php");
  exit;
}

if(isset($_POST['validation'])){
    $nomProduit = filter_input(INPUT_POST, 'nomProduit', FILTER_SANITIZE_STRING);
    $idCategorie = filter_input(INPUT_POST, 'categorie', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $imgArticle = filter_input(INPUT_POST, 'imgArticle', FILTER_SANITIZE_STRING);
    $stock = filter_input(INPUT_POST, 'stock', FILTER_SANITIZE_STRING);

    //Indique si le fichier a été téléchargé
    	 if(!is_uploaded_file($_FILES['image']['tmp_name']))
    		echo 'Un problème est survenu durant l\'opération. Veuillez réessayer !';
    	 else {
    		//liste des extensions possibles
    		$extensions = array('/png', '/gif', '/jpg', '/jpeg', '/HEIC');

    		//récupère la chaîne à partir du dernier / pour connaître l'extension
    		$extension = strrchr($_FILES['image']['type'], '/');

    		//vérifie si l'extension est dans notre tableau
    		if(!in_array($extension, $extensions))
    			echo 'Vous devez uploader un fichier de type png, gif, jpg, jpeg.';
    		else {

    			//on définit la taille maximale
    			define('MAXSIZE', 30000000000);
    			if($_FILES['image']['size'] > MAXSIZE)
    			   echo 'Votre image est supérieure à la taille maximale de '.MAXSIZE.' octets';
    			else {

    				//Lecture du fichier
    				$image = file_get_contents($_FILES['image']['tmp_name']);

            addProduit($nomProduit, $idCategorie, $description, $stock, $image, $_FILES['image']['type']);

    				echo 'L\'insertion s est bien déroulée !';
    			 }
    		  }
    	  }
}
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>EE Matos</title>
    <?php require "ulkit.php"; ?>
</head>

<body class="uk-text-center">

    <?php require "navbar.php"; ?>

    <div>
        <div class="uk-button-group">
            <a href="adminGestion.php" class="uk-button uk-button-secondary">Gestion</a>
            <a href="adminAjout.php" class="uk-button uk-button-secondary">Ajout</a>
            <a href="adminListe.php" class="uk-button uk-button-secondary">Emprunts</a>
            <a href="adminListUser.php" class="uk-button uk-button-secondary">Utilisateurs</a>
        </div>

    </div>
    </div>

    <h1 class="uk-heading-divider">Ajout de nouveau produit</h1>
    <form enctype="multipart/form-data" action="adminAjout.php" method="post"
        class="uk-margin-auto uk-margin-large-top uk-form-stacked uk-width-1-3@m">

            <div class="uk-margin">
                <label class="uk-form-label" for="form-stacked-text">Nom du produit</label>
                <div class="uk-form-controls">
                    <input name="nomProduit" class="uk-input" id="form-stacked-text" type="text" placeholder="Souris HP...">
                </div>
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="form-stacked-text">Catégorie de l'objet</label>
            <select name="categorie" class="uk-select">
                <?php
                  foreach (getCategories() as $com)
                  {
                    echo '<option value="'.$com['idCategorie'].'">'.$com['nomCategorie'].'</option>';
                  }
                  ?>
            </select>
        </div>

            <label class="uk-form-label" for="form-stacked-text">Caractéristiques du produit (séparer avec des virgules)</label>
            <div class="uk-margin">
              <textarea class="uk-textarea" rows="5" name="description" placeholder="Noir, 2000dpi, USB, ..."></textarea>
            </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="form-stacked-text">Stock disponible</label>
            <div class="uk-form-controls">
                <input name="stock" class="uk-input" id="form-stacked-text" type="number" min="0">
            </div>
        </div>


        <label class="uk-form-label" for="form-stacked-text">Image du produit</label>
        <div class="js-upload uk-placeholder uk-text-center">
            <span uk-icon="icon: cloud-upload"></span>
            <span class="uk-text-middle">Glissez, déposez ou </span>
            <div uk-form-custom>
                <input type="file" name="image" id="image" />
                <span class="uk-link">cliquez ici</span>
            </div>

            <input type="submit" name="validation" id="validation" value="Envoyer"
                class="uk-button uk-button-primary uk-margin-bottom" />
    </form>
    <?php require_once("footer.php");  ?>
</body>
