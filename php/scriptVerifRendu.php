<?php
require_once '../classe/database.php';
/*use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;*/



require_once '../PHPMailer/examples/gmail.php';
session_start();

$sql = 'SELECT e.idUser, email, nom 
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
                  };