<?php
require_once '../classe/database.php';

function addProduit($nom, $dateAjout, $dateModif)
 {
   $sql = 'INSERT INTO categoriesw(nomCategorie, dateAjout, dateModif) VALUES(:nom, :dateAjout, :dateModif)';
   $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
   $req->execute(array(
           ':nom' => $nom,
           ':dateAjout' => $dateAjout,
           ':dateModif' => $dateModif
           ));
           return EDatabase::lastInsertId();
 }