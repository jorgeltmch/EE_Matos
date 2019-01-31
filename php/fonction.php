<?php
require_once '../classe/database.php';
session_start();

//Ajoute une catégorie à la basse de donnée
 function AjouterCategorie($nomCategorie)
 {
   $sql = 'INSERT INTO categorie(nomCategorie) VALUES(:nomCategorie)';
   $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
   $req->execute(array(
            'nomCategorie' => $nomCategorie
            ));
    return EDatabase::lastInsertId();
 }

//Suprime la categorie voulue de la base de donnée
 function SupprimerCategorie($idCategorie)
 {
   $sql = 'DELETE FROM categorie WHERE idCategorie = :idCategorie';
   $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
   $req->execute(array(
            'idCategorie' => $idCategorie
            ));
 }


//Modifie la categorie voulue
 function ModifierCategorie($idCategorie, $nomCategorie)
 {
   $sql = 'UPDATE categorie SET nomCategorie = :nomCategorie WHERE idCategorie = :idCategorie';
   $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
   $req->execute(array(
           'nomCategorie' => $nomCategorie,
           'idCategorie' => $idCategorie
         ));
           return EDatabase::lastInsertId();
 }

//___________________________AJOUT PRODUIT________________________________
function addProduit($nom, $idCategorie, $description, $imgArticle, $imgExtension)
 {
   $sql = "INSERT INTO article(nom, descriptionArticle, idCategorie, img, imgExtension) VALUES(:nom, :descriptionArticle, :idCategorie, :img, :imgExtension)";
   $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
   $req->execute(
     array(
        'nom' => $nom,
        'descriptionArticle' => $description,
        'idCategorie' => $idCategorie,
        'img' => $imgArticle,
        'imgExtension' => $imgExtension
        )
    );
    return EDatabase::lastInsertId();
 }

 function GetCategories(){
   $sql = 'SELECT * FROM categorie';
   $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
   $req->execute();
   $datacom = $req->fetchAll(PDO::FETCH_ASSOC);
   return $datacom;

 }


 function getNumberArticles(){
   $sql = 'SELECT COUNT(*) FROM article';
   $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
   $req->execute();
   $datacom = $req->fetch();
   return $datacom;
 }

 function getNumberArticlesByCategorie($idCategorie){
   $sql = 'SELECT COUNT(*) FROM article WHERE idCategorie = :idCategorie';
   $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
   $req->execute(
     array(
        'idCategorie' => $idCategorie
        )
   );
   $datacom = $req->fetch();
   return $datacom;
 }

 function GetCategorieById($idCategorie){
   $sql = 'SELECT * FROM categorie WHERE idCategorie = :id';
   $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
   $req->execute(array(
           ':id' => $idCategorie,
           ));
           $res = $req->fetch();
           return $res;

 }

 function getArticlesByCategorie($idCategorie, $page){
           $page2 = $page * 10;
           $page = ($page == 1) ? 0 : $page + 10 - 1;
           $sql = 'SELECT * FROM article WHERE idCategorie = :id  ORDER BY dateAjout LIMIT ' .$page. ','. $page2  ;
             $req = EDatabase::prepare($sql);
                  $req->execute(array(
                          ':id' => $idCategorie,
                          ));
                     $res = $req->fetchAll(PDO::FETCH_ASSOC);
                     return $res;

 }

 function getArticlesByDate($page){
   $page2 = $page * 10;
   $page = ($page == 1) ? 1 : $page + 10 - 1;
   $sql = 'SELECT * FROM article ORDER BY dateAjout LIMIT ' .$page. ','. $page2  ;
   try {
     $req = EDatabase::prepare($sql);
          $req->execute();
             $res = $req->fetchAll(PDO::FETCH_ASSOC);
             return $res;
   } catch (\Exception $e) {
     echo $e->getMessage();
   }



 }
//Recherche d'articles
function Recherche($recherche){
  $sql = "SELECT * FROM article WHERE nomArticle LIKE '%'. :recherche .'%'";
  $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
  $req->execute(
    array(
       'recherche' => $recherche
       ));
       $res = $req->fetchAll();
       return $res;
}

 //function idCategorie($categorie)
 //{
 // $sql = 'SELECT idCategorie FROM categorie WHERE nomCategorie = :nomCategorie';
 // $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
 // $req->execute(
 //   array(
 //      ':nomCategorie' => $categorie
 //      )
 //  );
 //  $res = $req->fetch();
 //  return $res;
 //}

 function getProduitByID($id)
  {
    $sql = 'SELECT * FROM article WHERE idArticle = :id';
    $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $req->execute(array(
            ':id' => $id
            ));
            $res = $req->fetch();
            return $res;
  }

  function getEmpruntsByUserID($id)
   {
     $sql = 'SELECT nom, dateDebut, dateFin, rendu, emprunt.idArticle FROM emprunt JOIN article ON article.idArticle = emprunt.idArticle  WHERE idUser = :id';
     $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
     $req->execute(array(
             ':id' => $id
             ));
             $res = $req->fetchAll();
             return $res;
   }

function addEmprunt($idArticle, $idUser, $dateDebut, $dateFin)
  {
    $sql = 'INSERT INTO emprunt(idArticle, idUser,dateDebut, dateFin) VALUES(:idArticle, :idUser, :dateDebut, :dateFin)';
    $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $req->execute(array(
            ':idArticle' => $idArticle,
            ':idUser' => $idUser,
            ':dateDebut' => $dateDebut,
            ':dateFin' => $dateFin
           ));
            return EDatabase::lastInsertId();
  }
function ajoutEmprunt($idUser, $idArticle, $dateDebut,$dateFin){
  $sql = 'INSERT INTO emprunt(idUser, idArticle, dateDebut, dateFin) VALUES(:idUser, :idArticle, :dateDebut, :dateFin)';
  $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
  $req->execute(array(
          ':idUser' => $idUser,
          ':idArticle' => $idArticle,
          ':dateDebut' => $dateDebut,
          ':dateFin' => $dateFin,
          ));
          return EDatabase::lastInsertId();
}

function displayCategories(){
  $categories = GetCategories();
  echo "<ul class=\"uk-nav uk-nav-default uk-text-center\">";
  echo "<li class=\"uk-active\"><a href=\"index.php\">EE Matos</a></li>";
  echo "<li class=\"uk-nav-header\">Catégories</li>";
  echo "<li class=\"uk-nav-divider\"></li>";
  foreach ($categories as $key => $value) {
    echo "<li><a href=\"index.php?idCategorie=" .  $value["idCategorie"] . "\">" . $value["nomCategorie"] . "</a></li>";
  }
  echo "</ul>";
}

function displayEmprunts($emprunts)
{
  foreach ($emprunts as $key => $value) {
echo "<tr><td>" . date('d-m-Y', strtotime($value["dateDebut"])) ."</td> " . "<td> " . $value["nom"] . "</td>" . "<td>" . date('d-m-Y', strtotime($value["dateFin"]))  . "</td>";
if ($value["rendu"] == 1) {
  echo "<td>Oui</td>";
}
else{
  echo "<td>Non</td>";
}
echo "<td><a class=\"uk-button uk-button-default\" href=\"materiel.php?idArticle=". $value["idArticle"] . "\">Relouer</a>";
echo "</td></tr>";

  }
}
function displayInfos($article){
  echo "<ul class=\"uk-list uk-list-striped uk-width-expand\">";
    $description = explode(',', $article["descriptionArticle"]);
    foreach ($description as $key => $value) {
      echo "<li>" . $value . "</li>";
    }
  echo "</ul>";

}
