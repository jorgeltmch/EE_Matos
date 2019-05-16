<?php
require_once '../classe/database.php';


require_once '../PHPMailer/examples/gmail.php';


$sql = 'SELECT e.idUser, email, nom, dateFin, nbArticles
FROM `emprunt` e, users u, article a  
WHERE dateFin < NOW() 
AND e.idUser = u.idUser
AND e.idArticle = a.idArticle;';

   $req = EDatabase::prepare($sql, array(PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL));
   $req->execute();
   $datacom = $req->fetchAll(PDO::FETCH_ASSOC);

   foreach ($datacom as $com)
                  {                   
                    getMail($com['email'], $com['idUser'], $com['nom']);
                    $_SESSION["verifRenduUser"] = $com['idUser'];
                    $_SESSION["verifRenduDate"] = $com['dateFin'];
                    $_SESSION["verifRenduNb"] = $com['nbArticles'];
                  };