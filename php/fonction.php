<?php
require_once '../classe/database.php';
session_start();


function test(){
  $sql = 'SELECT imageTest FROM article WHERE idArticle = 71'; //AND rendu = 1
  $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
  $req->execute();
          $res = $req->fetch();
          return $res;
}

function getEmpruntsByArticleId($id){
  $sql = 'SELECT dateDebut, dateFin, rendu, idArticle FROM emprunt WHERE idArticle = :id'; //AND rendu = 1
  $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
  $req->execute(array(
          ':id' => $id
          ));
          $res = $req->fetchAll();
          return $res;
}

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
 function ModifierArticle($idArticle, $modifNom, $stock, $idCategorie, $modifDescript, $imageArticle, $exImg)
 {
   $sql = 'UPDATE article SET nom = :modifNom, stockDisponible = :stock, idCategorie = :idCategorie, descriptionArticle = :modifDescript, dateModif = :dateModif, img = :imageArticle, imgExtension = :exImg WHERE idArticle = :idArticle';
   $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
   $req->execute(array(
           'modifNom' => $modifNom,
           'stock' => $stock,
           'idCategorie' => $idCategorie,
           'modifDescript' => $modifDescript,
           'dateModif' => date('Y-m-d H:i:s'),
           'imageArticle' => $imageArticle,
           'exImg' => $exImg,
           'idArticle' => $idArticle
         ));
           return $sucessA = EDatabase::lastInsertId();
 };

 function supprimerArticle($idArticle)
 {
   $sql = 'UPDATE article SET visible = 0 WHERE idArticle = :idArticle';
   $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
   $req->execute(array(
           'idArticle' => $idArticle
         ));
           return $sucessA = EDatabase::lastInsertId();
 }

 //Ajoute Comentaire dans la base donnée
 function AjoutComArticle($idArticle, $mailUser, $comArticle, $noteArticle)
 {
   $sql = 'INSERT INTO commentaire(idArticle, mailUser, com, note) VALUES(:idArticle, :mailUser, :comArticle, :noteArticle)';
   $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
   $req->execute(
    array(
            'idArticle' => $idArticle,
            'mailUser' => $mailUser,
            'comArticle' => $comArticle,
            'noteArticle' => $noteArticle,
            )
          );
     return $sucessB = EDatabase::lastInsertId();
 }

 //affichage commentaire
 function GetCommentaire($idArticle){
   $sql = 'SELECT * FROM commentaire WHERE idArticle = :idArticle';
   $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
   $req->execute(
     array(
        'idArticle' => $idArticle
        )
   );
   $datacom = $req->fetchAll(PDO::FETCH_ASSOC);
   return $datacom;

 }

//___________________________AJOUT PRODUIT________________________________
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

           $sql = 'SELECT * FROM article WHERE idCategorie = :id AND visible = 1  ORDER BY dateAjout LIMIT ' .$pageLimit1. ','. $pageLimit2  ;
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
   $sql = 'SELECT * FROM article WHERE visible = 1 ORDER BY dateAjout DESC LIMIT ' .$pageLimit1. ','. $pageLimit2  ;
   try {
     $req = EDatabase::prepare($sql);
          $req->execute();
             $res = $req->fetchAll(PDO::FETCH_ASSOC);
             return $res;
   } catch (\Exception $e) {
     echo $e->getMessage();
   }



 }

 function getDatesNonDisponibles($idArticle){
   $sql = 'SELECT dateDebut, dateFin FROM emprunt WHERE idArticle = :id';
   $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
   $req->execute(array(
           ':id' => $id
           ));
           $res = $req->fetch();
           return $res;
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

function isAdmin($uID){
  $sql = "SELECT admin FROM users WHERE idUser = :uID";
  $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
  $req->execute(
    array(
       'uID' => $uID
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

   function getEmpruntsToday($id, $date)
    {
      $sql = 'SELECT nom, dateDebut, dateFin, rendu, nbArticles, article.idArticle FROM emprunt JOIN article ON article.idArticle = emprunt.idArticle  WHERE emprunt.idArticle = :id  AND DATEDIFF(:dateEmprunt, dateDebut) >= 0 AND DATEDIFF(:dateEmprunt, dateFin) <= 0';
      $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
      $req->execute(array(
              ':id' => $id,
              ':dateEmprunt' => $date

              ));
              $res = $req->fetchAll();
              return $res;
    }

    function getEmpruntsTodayUser($id, $date)
     {
       $sql = 'SELECT  dateDebut, dateFin, rendu, nbArticles, idArticle FROM emprunt  WHERE idUser = :id  AND DATEDIFF(:dateEmprunt, dateDebut) >= 0 AND DATEDIFF(:dateEmprunt, dateFin) <= 0';
       $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
       $req->execute(array(
               ':id' => $id,
               ':dateEmprunt' => $date

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


    function getAllUsers()
    {
      $sql = 'SELECT admin, username, email, idUser FROM users';
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

function getUserById($id){
     $sql = 'SELECT * FROM users WHERE idUser = :id';
     $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
     $req->execute(array(
             ':id' => $id
             ));
             $res = $req->fetch();
             return $res;
   }
//Ajoute un emprunt
function addEmprunt($idArticle, $idUser, $dateDebut, $dateFin, $nbArticles)
  {
    $sql = 'INSERT INTO emprunt(idArticle, idUser, dateDebut, dateFin, nbArticles) VALUES(:idArticle, :idUser, :dateDebut, :dateFin, :nbArticles)';
    $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $req->execute(array(
            ':idArticle' => $idArticle,
            ':idUser' => $idUser,
            ':dateDebut' => $dateDebut,
            ':dateFin' => $dateFin,
            ':nbArticles' => $nbArticles

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
  // decreaseStock($idArticle);
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

// function decreaseStock($idArticle){
//   $sql = 'UPDATE article SET stockDisponible = stockDisponible - 1 WHERE idArticle = :idArticle';
//   $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
//   $req->execute(array(
//           'idArticle' => $idArticle
//         ));
//           return EDatabase::lastInsertId();
// }
//
// function increaseStock($idArticle){
//   $sql = 'UPDATE article SET stockDisponible = stockDisponible + 1 WHERE idArticle = :idArticle';
//   $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
//   $req->execute(array(
//           'idArticle' => $idArticle
//         ));
//           return EDatabase::lastInsertId();
// }

//Promouvoir un utilisateur au statut d'admin Admin
  function promoteUser($idUser){
    $sql = 'UPDATE users SET admin = 1 WHERE idUser = :idUser';
    $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $req->execute(array(
            'idUser' => $idUser
          ));
            return EDatabase::lastInsertId();
  }

//Rétrograder un admin au statut d'utilisateur
  function demoteUser($idUser){
    $sql = 'UPDATE users SET admin = 0 WHERE idUser = :idUser';
    $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $req->execute(array(
            'idUser' => $idUser
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
      echo "<td></td>";
      }
      else{
      echo "<td>Non</td>";
      echo "<th><button class='uk-button uk-button-default' name='rendre' value='" . $tmpInfo . "'>Rendre</button></td>";
      }
    }else {
      echo "<td>Non</td>";
      echo "<th><button class='uk-button uk-button-primary' name='validerEmprunt' value='" . $tmpInfo . "'>Accepter</button></td>";
      echo "<th><button class='uk-button uk-button-danger' name='refuserEmprunt' value='" . $tmpInfo . "'>Refuser</button></td>";
    }
  }
}

  function displayAllUsers($users)
  {
    foreach ($users as $key => $value) {
      $tmpInfo = $value["idUser"];
      echo "<tr><td>" . $value["username"] ."</td> " . "<td> " . $value["email"] . "</td>";
        if ($value["admin"] == 1) {
        echo "<td>Oui</td>";
        echo "<th><button class='uk-button uk-button-danger' name='retrograder' value='" . $tmpInfo . "'>Rétrograder</button></td>";
        }
        else{
        echo "<td>Non</td>";
        echo "<th><button class='uk-button uk-button-primary' name='promouvoir' value='" . $tmpInfo . "'>Promouvoir</button></td>";
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
  // increaseStock($idArticle);
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

function articleEnRetard($idUser){
  $sql = "SELECT idArticle FROM emprunt WHERE idUser = :idUser AND dateFin < NOW()";


    $req = EDatabase::prepare($sql);
    $req->execute(
           array(
             'idUser' => $idUser,
           )
         );
            $res = $req->fetchAll(PDO::FETCH_ASSOC);
            return $res;
}
