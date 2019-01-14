<?php
require_once '../classe/database.php';



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
   $sql = 'DELETE FROM categorie WHERE $idCategorie = :idCategorie';
   $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
   $req->execute(array(
            'idCategorie' => $idCategorie
            ));
 }

//Modifie la categorie voulue
 function ModifierCategorie($idCategorie, $nomCategorie)
 {
   $sql = 'INSERT INTO categorie(nomCategorie, dateAjout, dateModif) VALUES(:nom, :dateAjout, :dateModif)';
   $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
   $req->execute(array(
           ':nom' => $nom,
           ':dateAjout' => $dateAjout,
           ':dateModif' => $dateModif
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
        ':nom' => $nom,
        ':descriptionArticle' => $description,
        ':idCategorie' => $idCategorie,
        ':imgArticle' => $imgArticle
        )
    );
    return EDatabase::lastInsertId();
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
