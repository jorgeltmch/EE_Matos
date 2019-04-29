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

      <h1 class="uk-heading-line uk-text-center uk-margin-large"><span>Proposez un nouvel objet</span></h1>


        <!-- <div class="uk-child-width-1-5@m uk-margin" uk-grid> -->
          <form class="uk-position-center">
            <fieldset class="uk-fieldset">
              <legend class="uk-legend">Quel objet souhaiteriez-vous sur le site ?</legend>
              <div class="uk-margin">
                <input class="uk-input" type="text" placeholder="Tapis de souris">
              </div>
              <div class="uk-margin">
                <select name="TypeCategorie" class="uk-select" id="selectCat" style="display:none">
                  <?php
                  foreach (getCategories() as $com)
                  {
                    echo '<option value="'.$com['idCategorie'].'">'.$com['nomCategorie'].'</option>';
                  }
                  ?>
                </select>
              </div>
              <div class="uk-margin">
                <textarea class="uk-textarea" rows="5" placeholder="Je souhaiterais que cet objet soit ajouté au site car..."></textarea>
              </div>
              <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                <label><input type="checkbox" name="cat" id="catOui" value="1">Appartient à une catégorie existante</label>
              </div>
            </fieldset>
            <script>

              const checkbox = document.getElementById('catOui');
              const select1 = document.getElementById('selectCat');
              checkbox.addEventListener('change', (event) => {
                if (event.target.checked) {
                  select1.style.display = 'block';
                } else {
                  select1.style.display = 'none';
                  }
                })
              </script>
              <button class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom">Envoyer</button>
          </form>
        <!-- </div> -->
        <div>
          <?php require_once("footer.php");  ?>
        </div>
    </body>
</html>
