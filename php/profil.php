<?php
require_once 'fonction.php';
$emprunts = getEmpruntsByUserID("1");



$dateFin = (empty($_POST["dateFin"])) ? '' : $_POST["dateFin"];
$idArticle = (empty($_POST["idArticle"])) ? '' : $_POST["dateFin"];
$dateDebut = (empty($_POST["dateDebut"])) ? '' : $_POST["dateDebut"];

if (!empty($dateFin) && !empty($dateDebut)) {
  addEmprunt($idArticle, "1", $dateDebut, $dateFin); //TODO : changer id
}

?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Profile</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://apis.google.com/js/platform.js"></script>
        <script type="text/javascript" src="../js/eelauth.js"></script>
     <?php require "ulkit.php"; ?>
    </head>
    <body class="uk-background-muted">

      <header>
        <?php
          require_once "navbar.php";
          //require_once "js/eelauth.js";
        ?>
      </header>

      <div class="uk-background-muted uk-padding-small" uk-height-viewport="expand: true" >
        <div class="uk-grid-small uk-child-width-1-3@s" uk-grid="masonry: true">
            <div>
                <div class="uk-card uk-card-default uk-card-body uk-text-center" id="profilImage" style="height: 300px">
                  <img class="uk-border-circle uk-height-max-medium"  src="<?php echo $username; ?>" alt="Border circle" style="height: 200px">
                </div>
            </div>
            <div style="width: 500px;">
                <div class="uk-card uk-card-default uk-card-body" style="height: 815px">
                  <h3 class="uk-card-title uk-heading-bullet uk-heading-line">Profil</h3>
                  <span><b>Prenom :</b> </span><span id="firstName"></span><br>
                  <span><b>Nom complet : </b>  </span><span id="lastName"></span><br>
                  <span><b>Email : </b></span><span id="email"></span><br>

                  <p><b>Nombre de prets :</b> 15</p>
                  <div class="uk-alert-success" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    <p>Vous n'avez aucun article en retard</p>
                  </div>
                </div>
            </div>
            <div>

                <div class="uk-card uk-card-default uk-card-body uk-overflow-auto">
                  <h2 class="uk-heading-bullet uk-heading-line" >Historique</h2>
                  <table class="uk-table uk-table-striped">
                    <thead>
                        <tr>
                            <th>Debut</th>
                            <th>Objet</th>
                            <th>Fin</th>
                            <th>Rendu</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php displayEmprunts($emprunts); ?>

                    </tbody>
                </table>
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-default uk-card-body uk-width-*@s" style="height: 500px"><?php include("calendrier.php"); ?> </div>
            </div>
        </div>
      </div>
    </body>
</html>
