<!DOCTYPE html>
<html lang="fr">
<head>
    <title><?= $titre ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS only -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous"> 
    <!--<link href="./script/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
    <link href="./style.css" rel="stylesheet">

    <!-- JQuery -->
    <!--<script src="./script/jquery-3.6.0.min.js"></script>-->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous"></script>
    
    <?php
    if(isset($scriptMission)) {
        echo $scriptMission;
    } else {?>
        <script src="./script/script.js"></script>
    <?php }
    ?>

</head>
<body id="body">

<?php
    if(isset($_SESSION['admin']) && $_SESSION['admin'] === 1) {
        $isAdmin = 1;
    } else {
        $isAdmin = 0;
    }
?>
<input type="hidden" id=isAdmin value="<?= $isAdmin ?>">

<header>
    <h1 class="text-center my-2">DIANE LESPIGNAISE - Etiquettes</h1>
</header>
<section>
    <nav class="navbar navbar-light bg-light navbar-expand-lg" style="--bs-scroll-height: 10rem;">
      <div class="container-fluid">
      
      <!-- ADDED -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
      </button>
      <!-- FIN ADDED -->

            <!-- <ul class="navbar-nav navbar-nav-scroll"> -->
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">


                <li class="nav-item"><a href="index.php?page=accueil" class="nav-link">Accueil</a></li>
                <li class="nav-item"><a href="index.php?page=payss" class="nav-link">Chasseurs</a></li>
                <li class="nav-item"><a href="index.php?page=dates" class="nav-link">Dates</a></li>
                <li class="nav-item"><a href="index.php?page=animals" class="nav-link">Animaux</a></li>
                
                <?php 
                if(!isset($_SESSION['admin']) || $_SESSION['admin'] !== 1) { ?>
                    <li class="nav-item"><a href="index.php?page=connexion" class="nav-link">Se connecter</a></li>
                <?php
                } else { ?>
                    <li class="nav-item"><a href="index.php?page=administrateurs" class="nav-link">Administrateurs</a></li>
                    <li class="nav-item"><a href="index.php?page=deconnexion" class="nav-link">D&eacute;connexion</a></li>
                <?php
                }
                ?>

            </ul>
            <!-- ADDED -->
            </div>
            <!-- FIN ADDED -->
      </div>
    </nav>
    <?= $contenu ?>
</section>
</main>
<footer class="fw-light fst-italic fs-6 text-center mt-4">
    <p>Diane Lespignanaise - Tous droits réservés</p>
    <p>Webmaster - <a href="mailto:fabien.macip@gmail.com">fabien.macip@gmail.com</a></p>
</footer>

<!-- ADDED -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<!-- FIN ADDED -->

</body>
</html>