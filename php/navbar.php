<?php
require_once 'fonction.php';
$username = filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_STRING);
$fistname = filter_input(INPUT_POST, "fistname", FILTER_SANITIZE_STRING);
$locale = filter_input(INPUT_POST, "locale", FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
$imgProfil = filter_input(INPUT_POST, "imgProfil");



if (!empty($username)) {
  $_SESSION["username"] = $username;
  $_SESSION["firstname"] = $fistname;
  $_SESSION["email"] = $email;
  $_SESSION["imgProfil"] = $imgProfil;
  $_SESSION["isAdmin"] = "0";

  if (empty(userExists($username))) {
    addUser($username, $email);
  }
  $_SESSION["uID"] = getUserIdByEmail($_SESSION["email"])["idUser"];
}

if (isset($_POST['decuser'])) {
    if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
    }
    $_SESSION = array();
    session_destroy();
}
 ?>
<!--NavBar Haut avec bouton-->
<nav class="uk-navbar uk-navbar-container uk-margin uk-width-auto@m ">

    <div class="uk-navbar-item uk-navbar-left ">


        <a href="#offcanvas-slide" class="" uk-navbar-toggle-icon uk-toggle></a>
    </div>

    <div class="uk-navbar-left ">

        <a class="uk-navbar-item uk-logo" href="index.php">Matos</a>

    </div>

    <div class="uk-navbar-item uk-navbar-right">
        <div class="uk-container">
        <form action="index.php" method="get" class=" uk-search uk-search-default uk-margin-right uk-width-1-1@m">
            <span class="uk-search-icon-flip" uk-search-icon></span>
            <input name="recherche" class="uk-search-input" type="search" placeholder="Recherche...">
        </form>
        </div>
        <form method="post">
            <?php if (empty($_SESSION["username"])):
            ?>

            <button class="uk-button uk-button-default" id="SignInButton" onclick=""><a
                    href="adminAjout.php">Connexion</a></button>
            <?php else: ?>
            <a href="profil.php"><img class="uk-border-circle uk-height-max-medium"
                    src="<?php echo $_SESSION["imgProfil"]; ?>" alt="Border circle" style="height: 40px"></a>
            <button class="uk-button uk-button-secondary" id="SignOutButton" onclick=""><a
                    href="index.php">Déconnexion</a></button>
            <?php endif; ?>
        </form>

        <div id="result"></div>
    </div>

</nav>
<script type="text/javascript" src="../js/eelauth.js"></script>
<script src="https://apis.google.com/js/platform.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
// Email pour savoir si on a déjà envoyé les information de pointage pour un user.
// alwaysLowered est mis à 1 afin de placer la fenêtre de déconnexion derrière
// une fois qu'on remet le focus sur la fenêtre principale
var strWindowFeatures = "menubar=no,location=no,resizable=no,scrollbars=no,status=no,alwaysLowered=1";


$(document).ready(function() {
    // Ajouter un handle sur le bouton connexion
    $("#SignInButton").click(handleAuthClick);
    $("#SignOutButton").click(disconnect);
    // Initialiser l'api people de google
    // en lui passant une call-back pour la mise à jour
    // du status de la personne connectée.
    EELAuth.EELClientInitialize(updateSigninStatus);

});

function updateSigninStatus(isSignedIn) {
    // location.reload();
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
    $.ajax({
        method: "POST",
        url: "navbar.php",
        data: {
            "lastname": info.lastname,
            "fistname": info.firstname,
            "email": info.email,
            "locale": info.locale,
            "imgProfil": info.image
        },
        success: function() {
            window.location.replace("profil.php");
        }
    });
}


/**
 * Gère la déconnection avec people api de google
 * @returns {undefined}
 */
function disconnect() {
    /*EELAuth.revokeAllScopes();
      clearInfo();
      // On lance la fenêtre de déconnexion
      window.open('https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout', "LogoutEEL", strWindowFeatures);
    */

    $.post('navbar.php', {
        decuser: "dec"
    }, function(data) {
        console.log(data);
        clearInfo();
        window.location.replace("index.php");
    });
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



<!-- NavBar sur le coter gauche qui est retactable -->

<div id="offcanvas-slide" uk-offcanvas>
    <div class="uk-offcanvas-bar">
        <a href="index.php">
            <h1>EE Matos</h1>
        </a>
        <?php
      if (!empty($_SESSION["username"]) && isAdmin($_SESSION["uID"])["admin"]):
      ?>
        <br>

        <ul class="uk-nav uk-nav-default uk-text-center">
            <li class="uk-nav-header">Administration</li>
            <li class="uk-nav-divider"></li>
            <li><a href=adminAjout.php>Ajout d'article</a></li>
            <li><a href=adminGestion.php>Gestion des catégories</a></li>
            <li><a href=adminListe.php>Liste des emprunts</a></li>
            <li><a href=adminListUser.php>Liste des utilisateurs</a></li>
        </ul>
        <?php endif; ?><br>
        <?php displayCategories();?>
        <br>
        <ul class="uk-nav uk-nav-default uk-text-center">
            <li class="uk-nav-header">Contact</li>
            <li class="uk-nav-divider"></li>
            <li><a href=proposerArticle.php>Proposer un article</a></li>
            <li><a href=contact.php>Signaler un bug</a></li>
        </ul><br>

    </div>
</div>
