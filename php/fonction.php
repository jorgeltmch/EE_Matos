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

//Supprime la categorie voulue de la base de donnée
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

 //Modifie l'article
 function ModifierArticle($idArticle, $modifNom, $idCategorie, $modifDescript, $imageArticle, $exImg)
 {
   $sql = 'UPDATE article SET nom = :modifNom, idCategorie = :idCategorie, descriptionArticle = :modifDescript, dateModif = :dateModif, img = :imageArticle, imgExtension = :exImg WHERE idArticle = :idArticle';
   $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
   $req->execute(array(
           'modifNom' => $modifNom,
           'idCategorie' => $idCategorie,
           'modifDescript' => $modifDescript,
           'dateModif' => date('Y-m-d H:i:s'),
           'imageArticle' => $imageArticle,
           'exImg' => $exImg,
           'idArticle' => $idArticle
         ));
           return EDatabase::lastInsertId();
 };

//Ajoute un produit
function addProduit($nom, $idCategorie, $description, $stock, $imgArticle, $imgExtension)
 {
   $sql = "INSERT INTO article(nom, descriptionArticle, idCategorie, stockDisponible, img, imgExtension) VALUES(:nom, :descriptionArticle, :idCategorie, :stock, :img, :imgExtension)";
   $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
   $req->execute(
     array(
        'nom' => $nom,
        'descriptionArticle' => $description,
        'idCategorie' => $idCategorie,
        'stock' => $stock,
        'img' => $imgArticle,
        'imgExtension' => $imgExtension
        )
    );
    return EDatabase::lastInsertId();
 }

//Récupère une catégorie
 function GetCategories(){
   $sql = 'SELECT * FROM categorie';
   $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
   $req->execute();
   $datacom = $req->fetchAll(PDO::FETCH_ASSOC);
   return $datacom;

 }

//Récupère le nombre total d'article
 function getNumberArticles(){
   $sql = 'SELECT COUNT(*) FROM article';
   $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
   $req->execute();
   $datacom = $req->fetch();
   return $datacom;
 }


//Récupère le nombre d'article pour une certaine catégorie
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

//Récupère une catégorie par son id
 function GetCategorieById($idCategorie){
   $sql = 'SELECT * FROM categorie WHERE idCategorie = :id';
   $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
   $req->execute(array(
           ':id' => $idCategorie,
           ));
           $res = $req->fetch();
           return $res;

 }

//Récupère tous les articles d'une catégorie
 function getArticlesByCategorie($idCategorie, $page){
   $pageLimit2 = $page * 10;
   $pageLimit1 = ($page == 1) ? 0 : $page * 10 - 10;

   $pageLimit1 -= 1;
           $sql = 'SELECT * FROM article WHERE idCategorie = :id  ORDER BY dateAjout LIMIT ' .$pageLimit1. ','. $pageLimit2  ;
             $req = EDatabase::prepare($sql);
                  $req->execute(array(
                          ':id' => $idCategorie,
                          ));
                     $res = $req->fetchAll(PDO::FETCH_ASSOC);
                     return $res;

 }


//Récupère tous les articles par date
 function getArticlesByDate($page){

   $pageLimit2 = $page * 10;
   $pageLimit1 = ($page == 1) ? 0 : $page * 10 - 10;

//   $pageLimit1 -= 1;
  // $pageLimit2 -= 1 ;
   $sql = 'SELECT * FROM article ORDER BY dateAjout DESC LIMIT ' .$pageLimit1. ','. $pageLimit2  ;
   try {
     $req = EDatabase::prepare($sql);
          $req->execute();
             $res = $req->fetchAll(PDO::FETCH_ASSOC);
             return $res;
   } catch (\Exception $e) {
     echo $e->getMessage();
   }



 }
//Recherche d'articles par nom
function Recherche($recherche){
  $sql = "SELECT * FROM article WHERE nom LIKE :recherche ORDER BY nom"  ;
  try {
    $recherche = "%$recherche%";
    $req = EDatabase::prepare($sql);
    $req->execute(
           array(
             'recherche' => $recherche
           )
         );
            $res = $req->fetchAll(PDO::FETCH_ASSOC);
            return $res;
  } catch (\Exception $e) {
    echo $e->getMessage();
  }
}

//Ajoute un Utilisateur s'il ne s'est jamais connecté
function addUser($username, $email){
  $sql = "INSERT INTO users(username, email) VALUES(:username, :email)";
  $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
  $req->execute(
    array(
       'username' => $username,
       'email' => $email
       )
   );
   return EDatabase::lastInsertId();
}

//Vérifie que l'utilisateur existe
function userExists($username){
  $sql = "SELECT idUser FROM users WHERE username = :username";
  $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
  $req->execute(
    array(
       'username' => $username
       )
   );
   $res = $req->fetch();
   return $res;
}

function isAdmin($username){
  $sql = "SELECT admin FROM users WHERE username = :username";
  $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
  $req->execute(
    array(
       'username' => $username
       )
   );
   $res = $req->fetch();
   return $res;
}


//Récupère un produit par son id
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


//Récupère tous les
  function getEmpruntsByUserID($id)
   {
     $sql = 'SELECT nom, dateDebut, dateFin, rendu, article.idArticle FROM emprunt JOIN article ON article.idArticle = emprunt.idArticle  WHERE idUser = :id';
     $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
     $req->execute(array(
             ':id' => $id
             ));
             $res = $req->fetchAll();
             return $res;
   }

//Récupère tous les emprunts
   function getAllEmprunts()
    {
      $sql = 'SELECT nom, dateDebut, dateFin, rendu, valide, username, emprunt.idArticle, emprunt.idUser FROM emprunt JOIN article ON article.idArticle = emprunt.idArticle JOIN users ON users.idUser = emprunt.idUser';
      $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
      $req->execute();
              $res = $req->fetchAll();
              return $res;
    }


//Récupère l'utilisateur avec son email
   function getUserIdByEmail($email){
     $sql = 'SELECT idUser FROM users WHERE email = :email';
     $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
     $req->execute(array(
             ':email' => $email
             ));
             $res = $req->fetch();
             return $res;
   }


//Ajoute un emprunt
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

function validerEmprunt($idArticle, $idUser, $dateDebut, $dateFin){
  decreaseStock($idArticle);
  $sql = 'UPDATE emprunt SET valide = 1 WHERE idArticle = :idArticle AND idUser = :idUser AND dateDebut = :dateDebut AND dateFin = :dateFin';
  $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
  $req->execute(array(
          'idArticle' => $idArticle,
          'idUser' => $idUser,
          'dateDebut' => $dateDebut,
          'dateFin' => $dateFin
        ));
          return EDatabase::lastInsertId();
}

function refuserEmprunt($idArticle, $idUser, $dateDebut, $dateFin){
  $sql = 'DELETE FROM emprunt WHERE idArticle = :idArticle AND idUser = :idUser AND dateDebut = :dateDebut AND dateFin = :dateFin';
  $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
  $req->execute(array(
          'idArticle' => $idArticle,
          'idUser' => $idUser,
          'dateDebut' => $dateDebut,
          'dateFin' => $dateFin
        ));
          return EDatabase::lastInsertId();
}

function decreaseStock($idArticle){
  $sql = 'UPDATE article SET stockDisponible = stockDisponible - 1 WHERE idArticle = :idArticle';
  $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
  $req->execute(array(
          'idArticle' => $idArticle
        ));
          return EDatabase::lastInsertId();
}

function increaseStock($idArticle){
  $sql = 'UPDATE article SET stockDisponible = stockDisponible + 1 WHERE idArticle = :idArticle';
  $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
  $req->execute(array(
          'idArticle' => $idArticle
        ));
          return EDatabase::lastInsertId();
}


///////////////AFFICHAGE///////////////////
function displayCategories(){
  $categories = GetCategories();
  echo "<ul class=\"uk-nav uk-nav-default uk-text-center\">";
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

function displayAllEmprunts($emprunts)
{
  foreach ($emprunts as $key => $value) {
    $tmpInfo = $value["idArticle"] . "," . $value["idUser"] . "," .$value["dateDebut"] . "," .$value["dateFin"];
    echo "<tr><td>" . $value["nom"] ."</td> " . "<td> " . $value["username"] . "</td>" . "<td>" . "du " . date('d-m-Y', strtotime($value["dateDebut"])) . " au " . date('d-m-Y', strtotime($value["dateFin"])) . "</td>";
    if ($value["valide"] == 1) {
      if ($value["rendu"] == 1) {
      echo "<td>Oui</td>";
      echo "<td>[EVAL]</td>";
      }
      else{
      echo "<td>Non</td>";
      echo "<th><button class='uk-button uk-button-default' name='rendre' value='" . $tmpInfo . "'>Rendre</button></td>";
      }
    }else {
      echo "<td>Non</td>";
      echo "<th><button class='uk-button uk-button-default' name='validerEmprunt' value='" . $tmpInfo . "'>Accepter</button></td>";
      echo "<th><button class='uk-button uk-button-default' name='refuserEmprunt' value='" . $tmpInfo . "'>Refuser</button></td>";
    }
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

function rendreArticle($idArticle, $idUser, $dateDebut, $dateFin){
  increaseStock($idArticle);
  $sql = 'UPDATE emprunt SET rendu = 1 WHERE idArticle = :idArticle AND idUser = :idUser AND dateDebut = :dateDebut AND dateFin = :dateFin';
  $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
  $req->execute(array(
          'idArticle' => $idArticle,
          'idUser' => $idUser,
          'dateDebut' => $dateDebut,
          'dateFin' => $dateFin
        ));
          return EDatabase::lastInsertId();
}
