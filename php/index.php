<?php
require_once 'fonction.php';

$idCategorie = (empty($_GET["idCategorie"])) ? '' : $_GET["idCategorie"];
$page = (empty($_GET["page"])) ? '1' : $_GET["page"];

if (!empty($idCategorie)) {
  $categorie = GetCategorieById($idCategorie);
  $articles = getArticlesByCategorie($idCategorie, $page);
  $nbArticles = getNumberArticlesByCategorie($idCategorie);
}
else{
  $articles = getArticlesByDate($page);
  $nbArticles = getNumberArticles();
}



$nbPages = ceil($nbArticles[0] / 10);
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

        <!-- <form class="uk-search uk-search-large">
            <span uk-search-icon></span>
            <input class="uk-search-input" type="search" placeholder="Search...">
        </form> -->

      <h1 class="uk-heading-line uk-text-center uk-margin-large"><span>
        <?php
        if (!empty($idCategorie)) {
          echo $categorie["nomCategorie"];
        }
        else{
          echo "Nouveautés";
        }
        ?></span></h1>

        <ul class="uk-pagination uk-flex-center	">

           <?php for ($i=1; $i <= $nbPages; $i++)  : ?>
             <?php if (!empty($categorie))  :  ?>
              <?php if ($page == $nbPages[$i]) :?>
                <li><a class="uk-active " href=<?php echo "index.php?page=" . $i . "&idCategorie=" . $idCategorie; ?>><?php echo $i; ?></a></li>
              <?php else: ?>
                <li><a href=<?php echo "index.php?page=" . $i . "&idCategorie=" . $idCategorie; ?>><?php echo $i; ?></a></li>
              <?php endif; ?>
            <?php else : ?>
              <?php if ($page == $nbPages[$i]) :?>
                <li><a class="uk-active " href=<?php echo "index.php?page=" . $i ?>><?php echo $i; ?></a></li>
              <?php else: ?>
                <li><a href=<?php echo "index.php?page=" . $i; ?>><?php echo $i; ?></a></li>
              <?php endif; ?>
             <?php endif; ?>
        <?php endfor; ?>

        </ul>

        <div class="uk-child-width-1-5@m uk-margin" uk-grid>

          <?php foreach ($articles as $key => $value) :?>

            <div class="uk-margin-auto">
                <div class="uk-card uk-card-default">
                    <div class="uk-card-media-top">
                        <?php echo '<a href="materiel.php?idArticle='. $value["idArticle"] . '"><img height="300" src="apercu.php?idArticle='.$value['idArticle'].'" alt="'.$value['nom'].'" title="'.$value['nom'].'" /></a>'; ?>
                    </div>
                    <div class="uk-card-body">

                        <h3 class="uk-card-title"><?php $nom = (strlen($value["nom"]) > 20) ? substr($value["nom"], 0, 20) . "..." : $value["nom"]; echo $nom; ?></h3>
                        <p><?php echo substr($value["descriptionArticle"], 0, 50) . " ..."; ?></p>
                    </div>
                </div>
            </div>


          <?php endforeach; ?>





    </body>
</html>
