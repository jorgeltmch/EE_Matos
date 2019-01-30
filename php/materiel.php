<?php
require_once 'fonction.php';

$idArticle = $_GET["idArticle"];

$dateFin = (empty($_POST["dateFin"])) ? '' : $_POST["dateFin"];
$dateDebut = (empty($_POST["dateDebut"])) ? '' : $_POST["dateDebut"];

if (!empty($idArticle)) {
  $article = getProduitByID($idArticle);
}

if (!empty($dateFin) && !empty($dateDebut)) {
  addEmprunt($article["idArticle"], "1", $dateDebut, $dateFin); //TODO : changer id
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

      <div class="uk-padding-small" uk-height-viewport="expand: true" >
        <div class="uk-grid-small uk-child-width-1-2@s" uk-grid="masonry: true">
            <div>
                <div class="uk-card uk-card-default uk-card-body uk-text-center"  style="height: 400px">
                    <div class="uk-child-width-1-3@m" uk-grid uk-lightbox="animation: slide">
                        <div>
                            <?php
                            echo '<a href="apercu.php?idArticle='.$article['idArticle'].'"><img src="apercu.php?idArticle='.$article['idArticle'].'" alt="'.$article['nom'].'" title="'.$article['nom'].'" /></a>';
                             ?>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-default uk-card-body" style="height: 815px">
                <div>
                  <h1 class="uk-heading-bullet" ><?php echo $article["nom"] ?><button class="uk-float-right uk-button uk-button-default uk-text-center">Modifier</button></h1>

                  <div class="uk-alert-success" uk-alert>
                      <a class="uk-alert-close" uk-close></a>
                      <p>5 éléments en stock</p>
                  </div>
                  <?php displayInfos($article) ?>
                  <!-- <ul class="uk-list uk-list-striped uk-width-expand">
                    <li>Marque: AOC</li>
                    <li>Modèle: C24G1</li>
                    <li>Taille de l'écran :	24 pouces</li>
                    <li>Format de l'écran :	16/9</li>
                    <li>Technologie LCD :	VA</li>
                    <li>Résolution Max : 1920 x 1080 pixels</li>
                    <li>Entrées vidéo : 1 X DisplayPort Femelle 2 X HDMI Femelle 1 X VGA (D-sub 15 Femelle)</li>
                    <li>Sorties audio	: Casque (Jack 3.5mm Femelle)</li>
                    <li>Luminosité : 250 cd/m²</li>
                    <li>Angle de vision (horizontal) : 178 Degré(s)</li>
                    <li>Angle de vision (vertical) : 178 Degré(s)</li>
                </ul>-->
              </div>
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-default uk-card-body uk-width-*@s" style="height: 400px">
                  <a class="uk-button uk-button-default" href="#modal-center" uk-toggle><?php include("calendrier.php"); ?></a>
            <?php  include("popupLouer.php"); ?>
            </div>
        </div>
      </div>
    </body>
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
</html>
