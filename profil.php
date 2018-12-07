<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Profile</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/uikit.min.css" />
        <script src="js/uikit.min.js"></script>
        <script src="js/uikit-icons.min.js"></script>
    </head>
    <body>
      <header>
        <?php require "navbar.php"; ?>
      </header>
      <!--<div class="uk-background-muted uk-padding-small" uk-height-viewport="expand: true" >

        <div class="uk-child-width-expand@s uk-text-center" uk-grid>

            <div>
              <div class="uk-text-left uk-padding-small" uk-height-viewport="offset-bottom: 60">

              </div>
              <div>
                <div class="uk-card uk-card-default uk-text-left uk-padding-small" uk-height-viewport="offset-bottom: 60">

                </div>
              </div>
              <div>

              </div>
            </div>
            <div>
              <div class="uk-card uk-card-default uk-flex uk-flex-center uk-flex-middle" uk-height-viewport="offset-bottom: 15"><?php include("calendrier.php"); ?></div>
            </div>
        </div>

      </div> -->
      <div class="uk-background-muted uk-padding-small" uk-height-viewport="expand: true" >
        <div class="uk-grid-small uk-child-width-1-3@s" uk-grid="masonry: true">
            <div>
                <div class="uk-card uk-card-default uk-card-body uk-text-center"  style="height: 300px">
                  <img class="uk-border-circle uk-height-max-medium" src="img/profil.png" alt="Border circle" style="height: 200px">
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-default uk-card-body" style="height: 815px">
                  <h3 class="uk-card-title">Profil</h3>
                  <p><b>Nom :</b> Machado</p>
                  <p><b>Prenom :</b> Jorge</p>
                  <p><b>Email :</b> jorge.ltmch@eduge.ch </p>
                  <p><b>Nombre de prets :</b> 15</p>
                  <div class="uk-alert-success" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    <p>Vous n'avez aucun article en retard</p>
                  </div>
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-default uk-card-body" style="height: 815px">
                <div>
                <h3 class="uk-card-title">Historique des prêts</h3>
                <table class="uk-table uk-table-hover uk-table-divider">
                  <thead>
                    <tr>
                      <th>Prêt</th>
                      <th> </th>
                      <th>Début</th>
                      <th> </th>
                      <th>Fin</th>
                      <th>État</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>iPad</td>
                      <td> du </td>
                      <td>26.11.18</td>
                      <td> au </td>
                      <td>7.12.18</td>
                      <td>En retard</td>
                    </tr>
                    <tr>
                      <td>Imprimante 3D</td>
                      <td> du </td>
                      <td>26.10.18</td>
                      <td> au </td>
                      <td>27.10.18</td>
                      <td>Rendu</td>
                    </tr>
                    <tr>
                      <td>Souris</td>
                      <td> du </td>
                      <td>02.10.18</td>
                      <td> au </td>
                      <td>10.10.18</td>
                      <td>Rendu</td>
                    </tr>
                    <tr>
                      <td>Clavier</td>
                      <td> du </td>
                      <td>02.10.18</td>
                      <td> au </td>
                      <td>10.10.18</td>
                      <td>Rendu</td>
                    </tr>
                  </tbody>
                </table>
                </div>
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-default uk-card-body" style="height: 500px"><?php include("calendrier.php"); ?> </div>
            </div>
        </div>
      </div>
    </body>
</html>
