<?php
require_once 'fonction.php';

$idArticle = $_GET["idArticle"];

$dateFin = (empty($_POST["dateFin"])) ? '' : $_POST["dateFin"];
$dateDebut = (empty($_POST["dateDebut"])) ? '' : $_POST["dateDebut"];

if (!empty($idArticle)) {
  $article = getProduitByID($idArticle);
}

if (!empty($dateFin) && !empty($dateDebut)) {
  addEmprunt($article["idArticle"], $_SESSION["uID"], $dateDebut, $dateFin); //TODO : changer id
}


// Modife article 
if(isset($_POST['validation'])){
$modifNom = filter_input( INPUT_POST, 'modifNom', FILTER_SANITIZE_STRING);
$idCategorie = filter_input( INPUT_POST, 'modifCategorie', FILTER_SANITIZE_STRING);
$modifDescript = filter_input( INPUT_POST, 'modifDescript', FILTER_SANITIZE_STRING);
$image = filter_input( INPUT_POST, 'image', FILTER_SANITIZE_STRING);

$idArticle = $article["idArticle"];

if ($modifNom == ""){
    $modifNom = $article["nom"];
}
if ($idCategorie == ""){
    $idCategorie = $article["idCategorie"];
}
if ($modifDescript == ""){
    $modifDescript = $article["descriptionArticle"];
}


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
           

    				echo 'L\'insertion s est bien déroulée !';
    			 }
    		  }
    	  }

$image = (empty($image)) ? $article["img"] : $image ;
 ModifierArticle($idArticle, $modifNom, $idCategorie, $modifDescript, $image, $_FILES['image']['type']);
header("Refresh:0");
        }

?>
<!DOCTYPE html>
<html>

<head>
    <title>Matos</title>
    <meta charset="utf-8">
    <?php require "ulkit.php"; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/uikit.min.css" />
</head>

<body class="uk-background-muted">
    <header>
        <?php  include("navbar.php"); ?>
    </header>

    <div class="uk-padding-small" uk-height-viewport="expand: true">
        <div class="uk-grid-small uk-child-width-1-2@s" uk-grid="masonry: true">
            <div>
                <div class="uk-card uk-card-default uk-card-body uk-text-center" style="height: 400px">
                    <div class="uk-child-width-1-3@m" uk-grid uk-lightbox="animation: slide">
                        <div>
                            <?php
                            echo '<img src="apercu.php?idArticle='.$article['idArticle'].'" alt="'.$article['nom'].'" title="'.$article['nom'].'" />';
                             ?>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-default uk-card-body" style="height: 815px">
                    <div>
                        <h1 class="uk-heading-bullet"><?php echo $article["nom"] ?>
                            <a class="uk-float-right uk-button uk-button-default uk-text-center" href="#modal-overflow"
                                uk-toggle>Modifier</a>
                        </h1>

                        <div class="uk-alert-success" uk-alert> <?php // TODO: alert rouge si pas disponible ?>
                            <a class="uk-alert-close" uk-close></a>
                            <p><?php echo $article["stockDisponible"] ?> éléments en stock</p>
                        </div>
                        <?php displayInfos($article) ?>
                    </div>
                </div>
            </div>
            <?php if(!empty($_SESSION["username"])): ?>
            <div>
                <div class="uk-card uk-card-default uk-card-body uk-width-*@s" style="height: 400px">
                    <a class="uk-button uk-button-default" href="#modal-center"
                        uk-toggle><?php include("calendrier.php"); ?></a>
                    <?php  include("popupLouer.php"); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>





        <div id="modal-overflow" uk-modal>
            <div class="uk-modal-dialog">

                <button class="uk-modal-close-default" type="button" uk-close></button>

                <div class="uk-modal-header">
                    <h2 class="uk-modal-title">Modification</h2>
                </div>

                <div class="uk-modal-body" uk-overflow-auto>


                    <form enctype="multipart/form-data" class="uk-margin-auto uk-margin-large-top uk-form-stacked"
                        method="POST" action="#">

                        <div class="uk-margin">
                            <label class="uk-form-label" for="form-stacked-text">Modifier le nom de l'article</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="modifNom" type="text" name="modifNom"
                                    placeholder="Remplire si modification du nom">
                            </div>
                        </div>

                        <div class="uk-margin">
                            <label class="uk-form-label" for="form-stacked-text">Catégorie</label>
                            <select id="modifCategorie" name="modifCategorie" class="uk-select">
                                <?php
                  foreach (getCategories() as $com)
                  { 
 
                    if($article["idCategorie"] != $com['idCategorie']){

                   echo '<option value="'.$com['idCategorie'].'">'.$com['nomCategorie'].'</option>';

                    }else { 
                       
                         echo '<option value="'.$com['idCategorie'].'" selected="selected">'.$com['nomCategorie'].'</option>';
                         
                    }

                  }

                  ?>
                            </select>

                        </div>

                        <div class="uk-margin">
                            <textarea id="modifDescript" name="modifDescript" class="uk-textarea" rows="5"
                                placeholder="Textarea"><?php echo $article["descriptionArticle"];  ?></textarea>
                        </div>


                        <label class="uk-form-label" for="form-stacked-text">Selection si modification de
                            l'image</label>
                        <div class="uk-margin" uk-margin>
                            <div uk-form-custom="target: true">
                                <input type="file" name="image" id="image" />
                                <input class="uk-input uk-form-width-medium" type="text" placeholder="Select file"
                                    disabled>

                            </div>

                            <div class="uk-modal-footer uk-text-right">
                                <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                                <input type="submit" name="validation" id="validation" value="Envoyer"
                                    class="uk-button uk-button-primary "></input>
                            </div>
                    </form>
                </div>
            </div>

</body>
<script src="js/uikit.min.js"></script>
<script src="js/uikit-icons.min.js"></script>

</html>