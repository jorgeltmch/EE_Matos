<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Profile</title>
     <?php require "ulkit.php"; ?>
    </head>
    <body class="uk-background-muted">

      <header>
        <?php
          require_once "navbar.php";
          //require_once "js/eelauth.js";
        ?>
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
                  <img class="uk-border-circle uk-height-max-medium" src="../img/profil.png" alt="Border circle" style="height: 200px">
                </div>
            </div>
            <div style="width: 500px;">
                <div class="uk-card uk-card-default uk-card-body" style="height: 815px">
                  <h3 class="uk-card-title uk-heading-bullet uk-heading-line">Profil</h3>
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
                        <tr>
                            <td>28.09.2018</td>
                            <td>Samsung SSD 860 EVO 250 Go</td>
                            <td>05.09.2018</td>
                            <td>Non</td>
                            <td>
                              <button class="uk-button uk-button-default">Modifier</button>
                            </td>
                        </tr>
                        <tr>
                            <td>17.08.2018</td>
                            <td>iiyama 27" LED - G-MASTER G2730HSU-B1</td>
                            <td>29.08.2018</td>
                            <td>Non</td>
                            <td>
                              <button class="uk-button uk-button-default uk-toggle">Modifier</button>
                            </td>
                        </tr>
                        <tr>
                            <td>29.12.2017</td>
                            <td>Clé de démontage pour clavier mécanique</td>
                            <td>10.01.2017</td>
                            <td>Oui</td>
                            <td>
                              <div class="uk-width-*@s" style="height: 40px">
                                <a class="uk-button uk-button-default" href="#modal-center" uk-toggle>Relouer</a>
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
                            </td>
                        </tr>
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
