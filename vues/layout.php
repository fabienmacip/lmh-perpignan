<!DOCTYPE html>
<html lang="fr">
<head>
    <title><?= $titre ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap CSS only -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous"> 
    <!--<link href="./script/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
    <!-- <link href="./style.css" rel="stylesheet"> -->
    
    <link rel="stylesheet" href="./css/main.css?v=2">
    
    <!-- JQuery -->
    <!--<script src="./script/jquery-3.6.0.min.js"></script>-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>
    <!-- <script src="./script/md5.js?v=2"></script> -->
    
    <?php
    if(isset($scriptMission)) {
        echo $scriptMission;
    } else {?>
        <!-- <script src="./script/test.js?v=1"></script> -->
        <!-- <script src="https://cdn.jsdelivr.net/npm/jquery.md5@1.0.2/index.min.js"></script> -->
        <script src="./script/visiteurDatas.js?v=2"></script>
        <script src="./script/script.js?v=2"></script>
        <script src="./script/divers.js?v=2"></script>
    <?php }
    ?>

<!-- <link rel="shortcut icon" type="image/x-icon" href="img/icon/favicon.ico">
<link rel="icon" type="image/png" sizes="192x192" href="img/icon/la-reference-android-chrome-192x192.png">
<link rel="icon" type="image/png" sizes="512x512" href="img/icon/la-reference-android-chrome-512x512.png">
<link rel="apple-touch-icon" sizes="180x180" href="img/icon/la-reference-apple-touch-icon-180x180.png">
 -->

<!-- <link rel="shortcut icon" type="image/x-icon" href="img/icon/favicon.ico"> -->
<link rel="apple-touch-icon" sizes="180x180" href="img/icon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="img/icon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="img/icon/favicon-16x16.png">
<link rel="manifest" href="img/icon/site.webmanifest">
<link rel="mask-icon" href="img/icon/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">


</head>
<body id="body">

<?php
    if(isset($_SESSION['role']) && $_SESSION['role'] == 1) {
        $isAdmin = 1;
    } else {
        $isAdmin = 0;
    }

    if(isset($_SESSION['role']) && $_SESSION['role'] == 2) {
        $isPartenaire = 1;
        if(isset($_SESSION['partenaire']) && $_SESSION['partenaire'] > 0) {
            $idPartenaire = $_SESSION['partenaire'];
        }
    } else {
        $isPartenaire = 0;
        $idPartenaire = 0;
    }


    $visiteurRegisteredDatas = '';
    //$visiteurRegisteredDatas = '1,Durand,Jean,durandjean1234321@voila.fr,06 44 33 44 33,2023-07-02';



?>

<input type="hidden" id=isVisiteurRegistered value="<?= $visiteurRegisteredDatas ?>">
<input type="hidden" id=isAdmin value="<?= $isAdmin ?>">
<input type="hidden" id=isPartenaire value="<?= $isPartenaire ?>">

<header class="flex jcsb">
    <div class="logo flex-1 tc">
        <img 
            id="logo" 
            class="logo-large-screen" 
            src="img/logo/logo-la-reference-350x311-transparent.png"
            alt="La maison de l'habitat (by La Centrale de Financement) - Perpignan"
        >
    </div>
    <div class="contacts flex-2 flex">
        <div class="flex">
            <div class="contacts-phone flex-1">
            <img
                id="contacts-phone-img"
                class="contacts-icon"
                src="img/icones/tel.png"
                alt="telephoner"
            > <a href="tel:0634344400" alt="telephoner">06 34 34 44 00</a>
            </div>
            <div class="contacts-mail flex-1">
            <img
                id="contacts-mail-img"
                class="contacts-icon"
                src="img/icones/mail.png"
                alt="mail"
            > <a href="mailto:contact@la-reference.fr">contact@la-reference.fr</a>
            </div>
        </div>
        <div>
            <div class="contacts-lieu flex-1 flex aic">
                <div>
                    <a href="https://goo.gl/maps/G95PAPmo8yBdz5Pg7" target="_blank">
                    <img
                        id="contacts-lieu-img"
                        class="contacts-icon"
                        src="img/icones/map.png"
                        alt="lieu"
                    >
                    </a>
                </div>
                <div>
                    <a href="https://goo.gl/maps/G95PAPmo8yBdz5Pg7" target="_blank">
                    &nbsp;29, avenue de Grande Bretagne&nbsp;
                    </a>
                </div>
                <div>
                    <a href="https://goo.gl/maps/G95PAPmo8yBdz5Pg7" target="_blank">
                    &nbsp;66 000 PERPIGNAN
                    </a>
                </div>
            </div>
        </div>
    </div>



    <!-- <h1 class="text-center my-2">LA MAISON DE L'HABITAT - PERPIGNAN</h1> -->
</header>
<section>
    <!-- <nav class="navbar navbar-light bg-light navbar-expand-lg" style="--bs-scroll-height: 10rem;"> -->
    <nav class="navbar navbar-light navbar-expand-lg" style="--bs-scroll-height: 10rem;">
      <div class="container-fluid">
      
      <!-- ADDED -->
      <button id="navbar-toggler-button" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
      </button>
      <!-- FIN ADDED -->

            <!-- <ul class="navbar-nav navbar-nav-scroll"> -->
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <ul id="nav-ul" class="navbar-nav me-auto mb-2 mb-lg-0">

<?php 
    $menuGestion = '';
    if(isset($_SESSION['role']) && $_SESSION['role'] == 1){
        $menuGestion = '';
    }
?>
                <li class="nav-item"><a href="index.php?page=accueil" class="nav-link">Accueil</a></li>
                <li class="nav-item relative" id="nav-nos-references">
                    <a href="#" class="nav-link" id="nos-references-link">Nos r&eacute;f&eacute;rences</a>
                    <!-- <a href="index.php?page=univers" class="nav-link">Nos r&eacute;f&eacute;rences</a> -->
                    <ul id="sub-nav-univers" class="absolute">
                    <?php if(isset($universs)) {
                        foreach ($universs as $univers): ?>
                        <li><a href="index.php?page=univers&univid=<?= $univers->getId() ?>"><?= $univers->getNom() ?></a></li>
                        <!-- onclick="showUnivers('=?= $univers->getId() ?=')" -->
                    <?php endforeach; }  else { 
                      // A refactoriser. Il faudrait avoir à disposition la variable $universs tout au long de la navigation  
                    ?>
                        <li><a href="index.php?page=univers&univid=3">Acheter mon logement</a></li>
                        <li><a href="index.php?page=univers&univid=6">Assurance</a></li>
                        <li><a href="index.php?page=univers&univid=4">Construire ma maison</a></li>
                        <li><a href="index.php?page=univers&univid=2">Copropri&eacute;t&eacute;</a></li>
                        <li><a href="index.php?page=univers&univid=5">Cr&eacute;dit</a></li>
                        <li><a href="index.php?page=univers&univid=1">Travaux</a></li>
                    <?php } ?>

                    
                    </ul>
                </li>
                <li class="nav-item"><a href="index.php?page=devenir-partenaire" class="nav-link">Devenir Partenaire</a></li>
                               
                
                <?php 
                if(!isset($_SESSION['role']) || $_SESSION['role'] < 1) { ?>
                    <li class="nav-item"><a href="index.php?page=connexion" class="nav-link">Se connecter</a></li>
                    <?php
                } else { ?>
                    <li class="nav-item"><a href="index.php?page=reserver" class="nav-link">Réserver</a></li>
                    <?php
                    // Si la personne connectée est un PARTENAIRE
                    if(isset($_SESSION['role']) && $_SESSION['role'] == 2 && isset($_SESSION['idadminpart'])){?>
                        <li class="nav-item"><a href="index.php?page=adminpartenaire&idadminpart=<?=$_SESSION['idadminpart']?>" class="nav-link">Mon compte</a></li>
                    <?php
                    }
                    
                    // Si la personne connectée est un ADMINISTRATEUR
                    if(isset($_SESSION['role']) && $_SESSION['role'] == 1){
                    ?>
                    <li class="nav-item"><a href="index.php?page=universs" class="nav-link">Univers</a></li>
                    <li class="nav-item"><a href="index.php?page=partenaires&actif=1" class="nav-link">Partenaires activés</a></li>
                    <li class="nav-item"><a href="index.php?page=partenaires&actif=0" class="nav-link">Partenaires non-actifs</a></li>
                    <li class="nav-item"><a href="index.php?page=stats" class="nav-link">Stats</a></li>
                    <li class="nav-item"><a href="index.php?page=administrateurs" class="nav-link">Administrateurs</a></li>
                    
                    <?php
                    }
                    if(isset($_SESSION['role']) && $_SESSION['role'] >= 1){
                    ?>
                        <li class="nav-item"><a href="index.php?page=deconnexion" class="nav-link">D&eacute;connexion</a></li>

                    <?php
                    }
                    ?>
                <?php
                    }
                

                
                ?>

            </ul>
            <!-- ADDED -->
        </div>
        <!-- FIN ADDED -->
    </div>
    <div id="logo2-div">
        <img 
          id="logo2" 
          src="img/logo/logo-la-reference-350x311-transparent.png"
          class="logo-little-screen" 
          alt="La maison de l'habitat (by La Centrale de Financement) - Perpignan"
          >
          <!-- src="img/logo/logo_lmh_perpignan.png"  -->
    </div>

    </nav>
    <?php 

        if(isset($_SESSION['prenom']) && isset($_SESSION['nom']) && isset($_SESSION['role-libelle']) && (!empty($_SESSION['role-libelle']))) {
            echo "<div id='bonjour' class='bonjour'><i>".$_SESSION['prenom']." ".$_SESSION['nom']." - <b>".$_SESSION['role-libelle']."</b></i></div>";
        } else {
            echo "<div id='bonjour'></div>";
        }

    ?>

    <?= $contenu ?>
</section>
</main>
<footer class="fw-light fst-italic fs-6 text-center mt-5">
    <p>La R&eacute;f&eacute;rence - Perpignan - Tous droits réservés</p>
    <p>Webmaster - <a href="mailto:fabien.macip@gmail.com">fabien.macip@gmail.com</a></p>
</footer>

<!-- ADDED -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<!-- FIN ADDED -->

</body>
</html>