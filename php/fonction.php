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
function addProduit($nom, $idCategorie, $description, $imgArticle)
 {
   $sql = "INSERT INTO article(nom, descriptionArticle, idCategorie, imgArticle) VALUES(:nom, :descriptionArticle, :idCategorie, :imgArticle)";
   $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
   $req->execute(
     array(
        'nom' => $nom,
        'descriptionArticle' => $description,
        'idCategorie' => $idCategorie,
        'imgArticle' => $imgArticle
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

//Recherche d'articles
function Recherche($recherche){
  $sql = "SELECT * FROM article WHERE nomArticle LIKE '%'. :recherche .'%'"
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
    $sql = 'SELECT idArticle, nom, descriptionArticle, dateAjout, dateModif, idCategorie, imgArticle FROM article WHERE idArticle = :id';
    $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
    $req->execute(array(
            ':id' => $id
            ));
            $res = $req->fetch();
            return $res;
  }

  function getEmpruntsByUserID($id)
   {
     $sql = 'SELECT nom, dateDebut, dateFin, rendu FROM emprunt JOIN article ON article.idArticle = emprunt.idArticle  WHERE idUser = :id';
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

function displayEmprunts($emprunts)
{
  foreach ($emprunts as $key => $value) {
echo "<tr><td>" . $value["dateDebut"] ."</td> " . "<td> " . $value["nom"] . "</td>" . "<td>" . $value["dateFin"] . "</td>";
if ($value["rendu"] == 1) {
  echo "<td>Oui</td>";
}
else{
  echo "<td>Non</td>";
}
echo "<td>";
include("popupRelouer.php");
echo "</td></tr>";

  }
}
