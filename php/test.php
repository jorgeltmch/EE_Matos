<?php
require_once 'fonction.php';

$article = getProduitByID("9");


echo '<img src="data:image;base64,'.  $article['imgArticle']  .'"/>';
