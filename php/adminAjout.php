
<?php
require_once 'fonction.php';

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
            </div>
        </div>

        <h1 class="uk-heading-divider">Ajout de nouveau produit</h1>
        <form class="uk-margin-auto uk-margin-large-top uk-form-stacked uk-width-1-3@m">

            <div class="uk-margin">
                <label class="uk-form-label" for="form-stacked-text">Nom du produit</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="form-stacked-text" type="text" placeholder="ASUS...">
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label" for="form-stacked-text">Type de catégorie</label>
                <select class="uk-select">
                    <option>Ecran</option>
                    <option>Souris</option>
                    <option>Clavier</option>
                    <option>Drone</option>
                    <option>Tablette</option>
                </select>
            </div>

            <label class="uk-form-label" for="form-stacked-text">Caractéristique du produit</label>


            <div uk-overflow-auto="selContainer: .uk-height-medium; selContent: .js-wrapper" class="uk-height-medium uk-tile uk-tile-muted">
                <ul class="uk-nav uk-width-1-2 uk-margin-auto">
                    <li class="uk-active">
                        <label class="uk-form-label" for="form-stacked-text">Taille</label>
                        <div class="uk-form-controls">
                            <input class="uk-input" id="form-stacked-text" type="text" placeholder="L20 x H20 x P20">
                        </div>
                    </li>
                    <li class="uk-active">
                        <label class="uk-form-label" for="form-stacked-text">Résolution</label>
                        <div class="uk-form-controls">
                            <input class="uk-input" id="form-stacked-text" type="text" placeholder="1080 x 1920">
                        </div>
                    </li>
                    <li class="uk-active">
                        <label class="uk-form-label" for="form-stacked-text">Couleur</label>
                        <div class="uk-form-controls">
                            <input class="uk-input" id="form-stacked-text" type="text" placeholder="Rouge">
                        </div>
                    </li>
                    <li class="uk-active">
                        <label class="uk-form-label" for="form-stacked-text">Entré</label>
                        <div class="uk-form-controls">
                            <input class="uk-input" id="form-stacked-text" type="text" placeholder="2 x HDMI, 1 x DisplayPort Femelle">
                        </div>
                    </li>
                </ul>
            </div>


            <label class="uk-form-label" for="form-stacked-text">Image du produit</label>
            <div class="js-upload uk-placeholder uk-text-center">
                <span uk-icon="icon: cloud-upload"></span>
                <span class="uk-text-middle">Glissez, déposez ou </span>
                <div uk-form-custom>
                    <input type="file" multiple>
                    <span class="uk-link">cliquez ici</span>
                </div>
            </div>

            <progress id="js-progressbar" class="uk-progress" value="0" max="100" hidden></progress>

            <script>

                var bar = document.getElementById('js-progressbar');

                UIkit.upload('.js-upload', {

                    url: '',
                    multiple: false,

                    beforeSend: function () {
                        console.log('beforeSend', arguments);
                    },
                    beforeAll: function () {
                        console.log('beforeAll', arguments);
                    },
                    load: function () {
                        console.log('load', arguments);
                    },
                    error: function () {
                        console.log('error', arguments);
                    },
                    complete: function () {
                        console.log('complete', arguments);
                    },

                    loadStart: function (e) {
                        console.log('loadStart', arguments);

                        bar.removeAttribute('hidden');
                        bar.max = e.total;
                        bar.value = e.loaded;
                    },

                    progress: function (e) {
                        console.log('progress', arguments);

                        bar.max = e.total;
                        bar.value = e.loaded;
                    },

                    loadEnd: function (e) {
                        console.log('loadEnd', arguments);

                        bar.max = e.total;
                        bar.value = e.loaded;
                    },

                    completeAll: function () {
                        console.log('completeAll', arguments);

                        setTimeout(function () {
                            bar.setAttribute('hidden', 'hidden');
                        }, 1000);

                        alert('Upload Completed');
                    }

                });

            </script>
            <input type="submit" value="Ajouter" class="uk-button uk-button-primary uk-margin-bottom" onclick="UIkit.notification({message: 'Ajout réussi.', status: 'success'})"></input>
        </form>


    </body>
