
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

        <h1 class="uk-heading-divider">Gestion catégorie</h1>

        <h2 class="uk-heading-line uk-text-center"><span>Modification/Supression</span></h2>

        <form class="uk-margin-auto uk-margin-large-top uk-form-stacked uk-width-1-3@m">

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

            <div class="uk-margin">
                <label class="uk-form-label" for="form-stacked-text">Modifier le nom de catégorie</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="form-stacked-text" type="text" placeholder="Remplire si modification du nom">
                </div>
            </div>
            <input type="submit" value="Modifier" class="uk-button uk-button-primary uk-margin-bottom" onclick="UIkit.notification({message: 'Modification réussi.', status: 'success'})"></input>
            <input type="submit" value="Suprimer" class="uk-button uk-button-primary uk-margin-bottom" onclick="UIkit.notification({message: 'Supression réussi.', status: 'success'})"></input>

        </form>

        <h2 class="uk-heading-line uk-text-center"><span>Ajout</span></h2>

        <form class="uk-margin-auto uk-margin-large-top uk-form-stacked uk-width-1-3@m">

            <div class="uk-margin">
                <label class="uk-form-label" for="form-stacked-text">Ajouter un nom de catégorie</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="form-stacked-text" type="text" placeholder="Ecran">
                </div>
            </div>


            <div uk-overflow-auto="selContainer: .uk-height-medium; selContent: .js-wrapper" class="uk-height-medium uk-tile uk-tile-muted">
                <ul class="uk-nav uk-width-1-2 uk-margin-auto">

                    <div>
                        <label class="uk-form-label" for="form-stacked-text">Ajouter un nom de caractéristique</label>
                        <div class="uk-form-controls">
                            <input class="uk-input" id="form-stacked-text" type="text" placeholder="Ecran">
                        </div>
                    </div>
                    <input type="submit" value="Ajout" class="uk-button uk-button-primary uk-margin-small-top uk-margin-bottom" onclick="UIkit.notification({message: 'Ajout réussi.', status: 'success'})"></input>

                    <label class="uk-form-label" for="form-stacked-text">Taille &nbsp;<span uk-icon="trash"></span></label>
                    <label class="uk-form-label" for="form-stacked-text">Taille &nbsp;<span uk-icon="trash"></span></label>
                    <label class="uk-form-label" for="form-stacked-text">Taille &nbsp;<span uk-icon="trash"></span></label>
                    <label class="uk-form-label" for="form-stacked-text">Taille &nbsp;<span uk-icon="trash"></span></label>
                    <label class="uk-form-label" for="form-stacked-text">Taille &nbsp;<span uk-icon="trash"></span></label>

                </ul>
            </div>

            <input type="submit" value="Valider" class="uk-button uk-button-primary uk-margin-small-top uk-margin-bottom" onclick="UIkit.notification({message: 'Ajout réussi.', status: 'success'})"></input>

        </form>

    </body>