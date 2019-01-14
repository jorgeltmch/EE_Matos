<!DOCTYPE html>
<html>
    <head>
        <title>Matos</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/uikit.min.css" />
        <script src="js/uikit.min.js"></script>
        <script src="js/uikit-icons.min.js"></script>
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
                            <a class="uk-inline" href="img/AOC_C24G1.jpg" data-caption="Caption 1"></a>
                        </div>
                        <div>
                            <a class="uk-inline" href="img/ecran1.jpg" data-caption="Caption 2"><img src="img/AOC_C24G1.jpg" alt=""></a>
                        </div>
                        <div>
                            <a class="uk-inline" href="img/AOC_C24G1.jpg" data-caption="Caption 3"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-default uk-card-body" style="height: 815px">
                <div>
                  <h1 class="uk-heading-bullet uk-heading-line" >AOC C24G1 24" 144Hz</h1>
                  <div class="uk-alert-success" uk-alert>
                      <a class="uk-alert-close" uk-close></a>
                      <p>5 éléments en stock</p>
                  </div>
                  <ul class="uk-list uk-list-striped uk-width-expand">
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
                </ul>
              </div>
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-default uk-card-body uk-width-*@s" style="height: 400px">
                  <a class="uk-button uk-button-default" href="#modal-center" uk-toggle><?php include("calendrier.php"); ?></a>
                  <div id="modal-center" class="uk-flex-top" uk-modal>
                      <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
                          <button class="uk-modal-close-default" type="button" uk-close></button>
                          <form class="uk-form">
                            <fieldset class="uk-fieldset">
                            <legend class="uk-legend">Réserver ce produit</legend>
                            <p>Date de début : <input type="text" data-uk-datepicker="{format:'DD.MM.YYYY'}"></p>
                            <p>Date de fin : <input type="text" data-uk-datepicker="{format:'DD.MM.YYYY'}"></p>
                            </fieldset>
                            <button class="uk-button uk-button-default uk-float-right">Réserver</button>
                          </form>
                      </div>
                    </div>

                </div>
            </div>
        </div>
      </div>

<!--
      <div class="uk-background-muted uk-padding-small" uk-height-viewport="expand: true">
        <div class="uk-animation-toggle">
              <div class=" uk-position-relative uk-position-medium uk-position-top-left uk-overlay uk-overlay-default uk-width-1-4@m">
                <div class="uk-animation-fade uk-width-medium@m uk-margin-auto">
                  <img src="img/AOC_C24G1.jpg" alt="AOC_C24G1">
                </div>
              </div>
        </div>

          <div class="uk-position-absolute uk-position-center-right uk-overlay uk-overlay-default uk-width-2-3@m">
            <h1 class="uk-heading-bullet uk-heading-line" >AOC C24G1 24" 144Hz</h1>
            <h2 class="uk-heading-line uk-text-center"><span>Description</span></h2>
            <ul class="uk-list uk-list-striped uk-width-expand@m">
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


            </ul>
          </div>
          <div class="uk-position-relative uk-position-medium uk-position-bottom-left uk-overlay uk-overlay-default uk-width-1-4@m">
            <?php include("calendrier.php"); ?>
          </div>

      </div>
-->
    </body>
</html>
