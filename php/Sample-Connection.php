<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Exemple</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://apis.google.com/js/platform.js"></script>
        <script type="text/javascript" src="../js/eelauth.js"></script>

    </head>
    <body>
        <div class="divSignIn">
        <button type="button" id="SignInButton">Connexion</button>
        </div>
        <div id="content">
            <div id="profilImage" style="width: 9.3%;height: 9.3%;text-align: center"></div>
            <p id="lastName"></p>
            <p id="firstName"></p>
            <p id="email"></p>
            <p id="locale"></p>
        </div>
        <div>
            <p id="infoMsg"></p>
        </div>




        <script type="text/javascript">
            // Email pour savoir si on a déjà envoyé les information de pointage pour un user.
            // alwaysLowered est mis à 1 afin de placer la fenêtre de déconnexion derrière
            // une fois qu'on remet le focus sur la fenêtre principale
            var strWindowFeatures = "menubar=no,location=no,resizable=no,scrollbars=no,status=no,alwaysLowered=1";


            $(document).ready(function () {
                // Ajouter un handle sur le bouton connexion
                $(".SignInButton").click(handleAuthClick);
                // Initialiser l'api people de google
                // en lui passant une call-back pour la mise à jour
                // du status de la personne connectée.
                EELAuth.EELClientInitialize(updateSigninStatus);

            });

            function updateSigninStatus(isSignedIn) {
                // Si l'utilisateur est connecté, on va récupérer
                // les infos de l'utilisateur sous forme d'objet
                // qui contient :
                //          lastname,
                //          firstname
                //          email,
                //          image,
                //          locale
                if (isSignedIn) {
                    EELAuth.getUserInfo(onReceiveUserInfo);

                } else {
                    EELAuth.signIn();
                }
            }
            /**
             * Call-back quand on click sur le bouton login
             * @param {type} event
             */
            function handleAuthClick(event) {

                event.preventDefault();
                updateSigninStatus(EELAuth.isSignedIn());
            }


            function onReceiveUserInfo(info) {
                // Si on a déjà envoyé une requête pour le même user
                // on ne renvoye pas.
                /* @remark Vous récupérez un objet de ce type:
                  info.email
                  info.lastname
                  info.firstname
                  info.image
                  info.locale
                  */

                  $("#profilImage").html('<img src="' + info.image + '" alt="imgOf' + info.email + '"/>');
                  $("#lastName").html(info.lastname);
                  $("#firstName").html(info.firstname);
                  $("#email").html(info.email);
                  $("#locale").html(info.locale);
            }

            /**
             * Gère la déconnection avec people api de google
             * @returns {undefined}
             */
            function disconnect() {
                /*
                 var delete_cookie = function () {
                 document.cookie = "G_AUTHUSER_H=0" + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
                 };
                 delete_cookie("G_AUTHUSER_H=0");
                 */
                EELAuth.revokeAllScopes();
                clearInfo();
                // On lance la fenêtre de déconnexion
                window.open('https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout', "LogoutEEL", strWindowFeatures);
            }




            /**
             * Efface les information relatives au pointage de l'utilisateur
             */
            function clearInfo() {
                $("#profilImage").html('');
                $("#profilName").html('');
                $("#eventTime").html('');
                $("#disconnectMsg").html('');
            }

        </script>

    </body>
</html>
