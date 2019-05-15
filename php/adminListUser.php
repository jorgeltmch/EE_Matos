<?php
require_once "fonction.php";

if (empty($_SESSION["username"]) || !isAdmin($_SESSION["uID"])){
  header("Location: index.php");
  exit;
}

$users = getAllUsers();
$singleEmprunt = "";

if (filter_has_var(INPUT_POST,'promouvoir')) {
  $idUser = $_POST["promouvoir"];
  promoteUser($idUser);
  header('Refresh: 0; url=adminListUser.php');
}

if (filter_has_var(INPUT_POST,'retrograder')) {
  $idUser = $_POST["retrograder"];
  demoteUser($idUser);
  header('Refresh: 0; url=adminListUser.php');
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

        <h1 class="uk-heading-divider">Liste des utilisateurs</h1>

        <form class="uk-margin-auto uk-margin-large-top uk-form-stacked uk-width-1-2" method="POST" action="#">
          <table class="uk-table uk-table-striped">
            <thead>
              <tr>
                <th>Utilisateur</th>
                <th>Adresse</th>
                <th>Statut</th>
                <th>Actions</th>
              </tr>
            <tbody>
              <?php
                displayAllUsers($users);
               ?>
            </thead>
            <tbody>
            </tbody>
          </table>
        </form>
        <?php require_once("footer.php");  ?>
    </body>
</html>
