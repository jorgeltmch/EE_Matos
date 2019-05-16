<?php
require_once "fonction.php";

if (empty($_SESSION["username"]) || !isAdmin($_SESSION["uID"])["admin"]){
  header("Location: index.php");
  exit;
}

$emprunts = getAllEmprunts();
$singleEmprunt = "";


if (filter_has_var(INPUT_POST,'rendre')) {
  $singleEmprunt = $_POST["rendre"];
  list($idArticle, $idUser, $dateDebut, $dateFin) = explode(",", $singleEmprunt);
  rendreArticle($idArticle, $idUser, $dateDebut, $dateFin);
  header('Refresh: 0; url=adminListe.php');
}

if (filter_has_var(INPUT_POST,'validerEmprunt')) {
  $singleEmprunt = $_POST["validerEmprunt"];
  list($idArticle, $idUser, $dateDebut, $dateFin) = explode(",", $singleEmprunt);
  validerEmprunt($idArticle, $idUser, $dateDebut, $dateFin);
  header('Refresh: 0; url=adminListe.php');
}

if (filter_has_var(INPUT_POST,'refuserEmprunt')) {
  $singleEmprunt = $_POST["refuserEmprunt"];
  list($idArticle, $idUser, $dateDebut, $dateFin) = explode(",", $singleEmprunt);
  refuserEmprunt($idArticle, $idUser, $dateDebut, $dateFin);
  header('Refresh: 0; url=adminListe.php');
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
              <a href="adminListe.php" class="uk-button uk-button-secondary">Emprunts</a>
              <a href="adminListUser.php" class="uk-button uk-button-secondary">Utilisateurs</a>
            </div>
        </div>

        <h1 class="uk-heading-divider">Liste des emprunts</h1>

        <form class="uk-margin-auto uk-margin-large-top uk-form-stacked uk-width-1-2" method="POST" action="#">
          <table class="uk-table uk-table-striped">
            <thead>
              <tr>
                <th>Article</th>
                <th>Utilisateur</th>
                <th>Date début/fin</th>
                <th>Rendu</th>
                <th>Actions</th>
              </tr>
            <tbody>
              <?php
                displayAllEmprunts($emprunts);
               ?>
            </thead>
            <tbody>
            </tbody>
          </table>
        </form>
        <?php require_once("footer.php");  ?>
    </body>
</html>
