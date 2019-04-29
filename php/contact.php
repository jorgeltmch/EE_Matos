<?php
require_once 'fonction.php';


?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Proposez un nouvel article !</title>
        <?php require "ulkit.php"; ?>
    </head>

    <body class="uk-text-center">

        <?php require "navbar.php"; ?>

        <!-- <form class="uk-search uk-search-large">
            <span uk-search-icon></span>
            <input class="uk-search-input" type="search" placeholder="Search...">
        </form> -->

      <h1 class="uk-heading-line uk-text-center uk-margin-large"><span>Signalez le moindre problème !</span></h1>


        <!-- <div class="uk-child-width-1-5@m uk-margin" uk-grid> -->
          <form class="uk-position-center">
            <fieldset class="uk-fieldset">
              <legend class="uk-legend">Aidez-nous à améliorer notre site...</legend>
              <div class="uk-margin">
                <textarea class="uk-textarea" rows="5" placeholder="Je souhaite signalger le bug / problème suivant..."></textarea>
              </div>
            </fieldset>
              <button class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom">Signaler</button>
          </form>
        <!-- </div> -->
        <?php require_once("footer.php");  ?>
    </body>
</html>
