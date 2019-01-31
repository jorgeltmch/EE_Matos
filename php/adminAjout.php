<?php

require_once 'fonction.php';

if(isset($_POST['validation'])){
    $nomProduit = filter_input(INPUT_POST, 'nomProduit', FILTER_SANITIZE_STRING);
    $idCategorie = filter_input(INPUT_POST, 'categorie', FILTER_SANITIZE_STRING);
    $caracteristique1 = filter_input(INPUT_POST, 'caracteristique1', FILTER_SANITIZE_STRING);
    $caracteristique2 = filter_input(INPUT_POST, 'caracteristique2', FILTER_SANITIZE_STRING);
    $caracteristique3 = filter_input(INPUT_POST, 'caracteristique3', FILTER_SANITIZE_STRING);
    $caracteristique4 = filter_input(INPUT_POST, 'caracteristique4', FILTER_SANITIZE_STRING);
    $imgArticle = filter_input(INPUT_POST, 'imgArticle', FILTER_SANITIZE_STRING);

    $description = $caracteristique1 . ", " . $caracteristique2 . ", " . $caracteristique3 . ", " . $caracteristique4;

    //Indique si le fichier a été téléchargé
    	 if(!is_uploaded_file($_FILES['image']['tmp_name']))
    		echo 'Un problème est survenu durant l\'opération. Veuillez réessayer !';
    	 else {
    		//liste des extensions possibles
    		$extensions = array('/png', '/gif', '/jpg', '/jpeg');

    		//récupère la chaîne à partir du dernier / pour connaître l'extension
    		$extension = strrchr($_FILES['image']['type'], '/');

    		//vérifie si l'extension est dans notre tableau
    		if(!in_array($extension, $extensions))
    			echo 'Vous devez uploader un fichier de type png, gif, jpg, jpeg.';
    		else {

    			//on définit la taille maximale
    			define('MAXSIZE', 3000000);
    			if($_FILES['image']['size'] > MAXSIZE)
    			   echo 'Votre image est supérieure à la taille maximale de '.MAXSIZE.' octets';
    			else {

    				//Lecture du fichier
    				$image = file_get_contents($_FILES['image']['tmp_name']);

            addProduit($nomProduit, $idCategorie, $description, $image, $_FILES['image']['type']);

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
            </div>
        </div>

        <h1 class="uk-heading-divider">Ajout de nouveau produit</h1>
        <form enctype="multipart/form-data" action="adminAjout.php" method="post" class="uk-margin-auto uk-margin-large-top uk-form-stacked uk-width-1-3@m">

            <div class="uk-margin">
                <label class="uk-form-label" for="form-stacked-text">Nom du produit</label>
                <div class="uk-form-controls">
                    <input name="nomProduit" class="uk-input" id="form-stacked-text" type="text" placeholder="ASUS...">
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label" for="form-stacked-text">Type de catégorie</label>
                <select name="categorie" class="uk-select">
                  <?php
                  foreach (getCategories() as $com)
                  {
                    echo '<option value="'.$com['idCategorie'].'">'.$com['nomCategorie'].'</option>';
                  }
                  ?>
                </select>
            </div>

            <label class="uk-form-label" for="form-stacked-text">Caractéristique du produit</label>


            <div uk-overflow-auto="selContainer: .uk-height-medium; selContent: .js-wrapper" class="uk-height-medium uk-tile uk-tile-muted">
                <ul class="uk-nav uk-width-1-2 uk-margin-auto">
                    <li class="uk-active">
                        <label class="uk-form-label" for="form-stacked-text">Taille</label>
                        <div class="uk-form-controls">
                            <input name="caracteristique1" class="uk-input" id="form-stacked-text" type="text" placeholder="L20 x H20 x P20">
                        </div>
                    </li>
                    <li class="uk-active">
                        <label class="uk-form-label" for="form-stacked-text">Résolution</label>
                        <div class="uk-form-controls">
                            <input name="caracteristique2" class="uk-input" id="form-stacked-text" type="text" placeholder="1080 x 1920">
                        </div>
                    </li>
                    <li class="uk-active">
                        <label class="uk-form-label" for="form-stacked-text">Couleur</label>
                        <div class="uk-form-controls">
                            <input name="caracteristique3" class="uk-input" id="form-stacked-text" type="text" placeholder="Rouge">
                        </div>
                    </li>
                    <li class="uk-active">
                        <label class="uk-form-label" for="form-stacked-text">Entré</label>
                        <div class="uk-form-controls">
                            <input name="caracteristique4" class="uk-input" id="form-stacked-text" type="text" placeholder="2 x HDMI, 1 x DisplayPort Femelle">
                        </div>
                    </li>
                </ul>
            </div>


            <label class="uk-form-label" for="form-stacked-text">Image du produit</label>
            <div class="js-upload uk-placeholder uk-text-center">
                <span uk-icon="icon: cloud-upload"></span>
                <span class="uk-text-middle">Glissez, déposez ou </span>
                <div uk-form-custom>
                    <input type="file" name="image" id="image"/>
                    <span class="uk-link">cliquez ici</span>
                </div>
            </div>
            <input type="submit" name="validation" id="validation" value="Envoyer" class="uk-button uk-button-primary uk-margin-bottom"/>
        </form>


    </body>
