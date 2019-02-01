<!--NavBar Haut avec bouton-->
<nav class="uk-navbar uk-navbar-container uk-margin uk-width-auto@m ">

    <div class="uk-navbar-item uk-navbar-left ">


        <a href="#offcanvas-slide" class="" uk-navbar-toggle-icon uk-toggle></a>
    </div>

    <div class="uk-navbar-left ">

        <a class="uk-navbar-item uk-logo" href="index.php">Matos</a>

    </div>

    <div class="uk-navbar-item uk-navbar-right">

        <form class=" uk-search uk-search-default uk-margin-right uk-width-1-2@m">
            <span class="uk-search-icon-flip" uk-search-icon></span>
            <input class="uk-search-input" type="search" placeholder="Search...">
        </form>
        <form method="post">
        <?php
        if (!isset($_SESSION["username"])): ?>
          <button class="uk-button uk-button-secondary" id="SignInButton"  onclick=""><a href="profil.php">Login</a></button>
      <?php endif;
      if (isset($_SESSION["username"])):
        ?>
        <button class="uk-button uk-button-secondary" id="SignOutButton"  onclick=""><a href="profil.php">Logout</a></button>
      <?php endif; ?>
            </form>
        <div id="result"></div>
    </div>

</nav>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    // Email pour savoir si on a déjà envoyé les information de pointage pour un user.
    // alwaysLowered est mis à 1 afin de placer la fenêtre de déconnexion derrière
    // une fois qu'on remet le focus sur la fenêtre principale
    var strWindowFeatures = "menubar=no,location=no,resizable=no,scrollbars=no,status=no,alwaysLowered=1";


    $(document).ready(function () {
        // Ajouter un handle sur le bouton connexion
        $("#SignInButton").click(handleAuthClick);
        $("#SignOutButton").click(disconnect);
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

          $("#profilImage").html('<img src="' + info.image + '" alt="imgOf' + info.email + '" class = \"uk-border-circle uk-height-max-medium\" style = \"height : 200px\"/>');
          $("#lastName").html(info.lastname);
          $("#firstName").html(info.firstname);
          $("#email").html(info.email);
          $("#locale").html(info.locale);
          $("#result").html(info.lastName);
          $.post('manageLoginAjax.php', {postuser:$("#lastName").html()}, function(data) {
            location.reload();
            // console.log(data);
            // $("#SignInButton").hide();
          });
    }

    /**
     * Gère la déconnection avec people api de google
     * @returns {undefined}
     */
    function disconnect(){
      /*EELAuth.revokeAllScopes();
        clearInfo();
        // On lance la fenêtre de déconnexion
        window.open('https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout', "LogoutEEL", strWindowFeatures);
      */
        $.post('manageLoginAjax.php', {decuser:"dec"}, function(data) {
          console.log(data);

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
      <?php displayCategories(); ?>
      <!--  <ul class="uk-nav uk-nav-default uk-text-center">
            <li class="uk-active"><a href="index.php">EE Matos</a></li>
            <li class="uk-nav-header">Catégorie</li>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="profil.php">Profil</a></li>
            <li><a href="materiel.php">Matériel</a></li>
            <li class="uk-nav-divider"></li>
            <li><a href="#">Info</a></li>
        </ul>
      -->
    </div>
</div>
