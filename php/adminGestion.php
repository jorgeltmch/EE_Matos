<?php
require_once "fonction.php";

//Initialisation des variables nécessaires
$nomCategorie = "";

// Récupération des paramètres
$idCategorie = (empty(filter_input(INPUT_POST, "TypeCategorie"))) ? "" : filter_input(INPUT_POST, "TypeCategorie");
$nomCategorie = (empty(filter_input(INPUT_POST, "nomCategorie", FILTER_SANITIZE_STRING))) ? "" : filter_input(INPUT_POST, "nomCategorie", FILTER_SANITIZE_STRING);
$nouveauNomCategorie = (empty(filter_input(INPUT_POST, "nouveauNom", FILTER_SANITIZE_STRING))) ? "" : filter_input(INPUT_POST, "nouveauNom", FILTER_SANITIZE_STRING);

$flashMessage = "";

if (!empty($nomCategorie)) {
  AjouterCategorie($nomCategorie);
  $nomCategorie = "";
  $flashMessage = '<div class="uk-alert-success" uk-alert>
                  <a class="uk-alert-close" uk-close></a>
                  <p>La catégorie à été ajoutée avec succès.</p>
                  </div>';
}

if (filter_has_var(INPUT_POST,'Supprimer')) {
  SupprimerCategorie($idCategorie);
  $flashMessage = '<div class="uk-alert-success" uk-alert>
                  <a class="uk-alert-close" uk-close></a>
                  <p>La catégorie à été supprimée avec succès.</p>
                  </div>';
}

if (filter_has_var(INPUT_POST,'Modifier')) {
  ModifierCategorie($idCategorie, $nouveauNomCategorie);
  $flashMessage = '<div class="uk-alert-success" uk-alert>
                  <a class="uk-alert-close" uk-close></a>
                  <p>La catégorie à été modifiée avec succès.</p>
                  </div>';
}

?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>EE Matos</title>
        <?php require "ulkit.php"; ?>
    </head>

    <body class="uk-text-center">

        <?php require "navbar.php"; ?>

        <div>
          <div class="uk-button-group">
              <a href="adminGestion.php" class="uk-button uk-button-secondary">Gestion</a>
              <a href="adminAjout.php" class="uk-button uk-button-secondary">Ajout</a>
              <a href="adminListe.php" class="uk-button uk-button-secondary">Liste</a>
          </div>
        </div>

        <h1 class="uk-heading-divider">Gestion catégorie</h1>

        <h2 class="uk-heading-line uk-text-center"><span>Modification/Supression</span></h2>

        <?php echo $flashMessage; ?>

        <form class="uk-margin-auto uk-margin-large-top uk-form-stacked uk-width-1-3@m" method="POST" action="#">

            <div class="uk-margin">
                <label class="uk-form-label" for="form-stacked-text">Catégorie</label>
                <select name="TypeCategorie" class="uk-select">
                  <?php
                  foreach (getCategories() as $com)
                  {
                    echo '<option value="'.$com['idCategorie'].'">'.$com['nomCategorie'].'</option>';
                  }
                  ?>
                </select>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label" for="form-stacked-text">Modifier le nom de catégorie</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="form-stacked-text" type="text" name="nouveauNom" placeholder="Remplir si modification du nom">
                </div>
            </div>
            <input type="submit" name="Supprimer" value="Supprimer" id="Supprimer" class="uk-button uk-button-primary uk-margin-small-top uk-margin-bottom" ></input>
            <input type="submit" name="Modifier" value="Modifier" id="Modifier" class="uk-button uk-button-primary uk-margin-small-top uk-margin-bottom" ></input>


        </form>

        <h2 class="uk-heading-line uk-text-center"><span>Ajout</span></h2>

        <form action="#" method="post" class="uk-margin-auto uk-margin-large-top uk-form-stacked uk-width-1-3@m">

            <div class="uk-margin">
                <label class="uk-form-label" for="form-stacked-text">Ajouter un nom de catégorie</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="form-stacked-text" type="text" name="nomCategorie" placeholder="Ecran">
                </div>
            </div>
            <input type="submit" name="creerCategorie" value="Valider" class="uk-button uk-button-primary uk-margin-small-top uk-margin-bottom" onclick="UIkit.notification({message: 'Ajout réussi.', status: 'success'})"></input>

        </form>
        <?php require_once("footer.php");  ?>
    </body>
    </html>
