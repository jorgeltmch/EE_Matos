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
        <button class="uk-button uk-button-secondary" id="login" href="#" onclick="">Login</button>
    </div>

</nav>

<!-- NavBar sur le coter gauche qui est retactable -->

<div id="offcanvas-slide" uk-offcanvas>
    <div class="uk-offcanvas-bar">

        <ul class="uk-nav uk-nav-default uk-text-center">
            <li class="uk-active"><a href="index.php">EE Matos</a></li>
            <li class="uk-nav-header">Catégorie</li>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="profil.php">Profil</a></li>
            <li><a href="materiel.php">Matériel</a></li>
            <li class="uk-nav-divider"></li>
            <li><a href="#">Info</a></li>
        </ul>

    </div>
</div>
