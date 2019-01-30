<?php
require_once 'fonction.php';


    //si nous avons une image
    if(!empty($_GET['idArticle'])) {


	//on sécurise notre donnée
	$idArticle = intval($_GET['idArticle']);
  $article = getProduitByID($idArticle);

		//on indique qu'on affiche une image
		header ("Content-type: ".$article['imgExtension']);
		//on affiche l'image en elle même
		echo $article['img'];
}
else
echo 'Vous n avez pas sélectionné d image !';

     echo '<a href="apercu.php?id_img='.$article["idArticle"].'"><img src="apercu.php?id_img='.$article["idArticle"].'" alt="'.$article["nom"].'" title="'.$article["nom"].'" /></a>';

   ?>
