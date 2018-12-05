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
    <body class="">
      <?php require "navbar.php"; ?>
      <!-- <div class="" > -->
        <div class=" uk-padding-large">

          <h1 class="uk-margin-left uk-heading-bullet uk-heading-line">Profile</h1>
          <img src="./img/homer.jpg" width="230" height="230" class="uk-overlay uk-overlay-default ">

          <div style="float: left">
            <h2 class="uk-margin-large-left">Homer Simpson</h2>
            <div class="uk-padding-small">
            <p>Nom : SIMPSON</p>
            <p>Prénom : Homer</p>
            <p>Adresse : homer.smpsn@eduge.ch</p>
            <p>Nombre de prêts : 4</p>

            <div class="uk-alert-warning">
              Vous devez rendre un objet dans 1 jour !
            </div>

            </div>
          </div>
        </div>

        <div class="uk-position-right uk-width-1-2 uk-position-relative">
          <table class="uk-table uk-table-hover uk-table-divider">
            <thead>
              <tr>
                <th>Prêt</th>
                <th> </th>
                <th>Début</th>
                <th> </th>
                <th>Fin</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>iPad</td>
                <td> du </td>
                <td>04.11.18</td>
                <td> au </td>
                <td>06.11.18<td>
              </tr>
              <tr>
                <td>Imprimante 3D</td>
                <td> du </td>
                <td>26.10.18</td>
                <td> au </td>
                <td>27.10.18</td>
              </tr>
              <tr>
                <td>Souris</td>
                <td> du </td>
                <td>02.10.18</td>
                <td> au </td>
                <td>10.10.18</td>
              </tr>
              <tr>
                <td>Clavier</td>
                <td> du </td>
                <td>02.10.18</td>
                <td> au </td>
                <td>10.10.18</td>
              </tr>
            </tbody>
          </table>
        </div>

      <!-- </div> -->

    </body>
</html>
