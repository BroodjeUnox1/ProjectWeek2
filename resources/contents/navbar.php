<?php
// set active to nothing to overcome a bugg
$active = "";
// check if content isset set active to content else  content is home
if (isset($_GET["content"])) {
    $active = $_GET["content"];
} else $active = "home";

// check if user is loggedin
$loggedin = $_SESSION['loggedin'] ?? NULL;
?>

<nav class="navbar navbar-expand-lg navbar-light bg-secondary">
    <a class="navbar-brand" href="#">
    <img src="./img/spacex.svg" alt="" width="70" height="25">
    </a>
    <a class="navbar-brand text-white">Mbo Utrecht</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php if($active == "Home"){echo "active";}?>">
                <a class="nav-link text-white" href="index.php?content=home">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item <?php if($active == "Game"){echo "active";}?>">
                <a class="nav-link text-white" href="index.php?content=game">Game</a>
            </li>
            <?php if(!$loggedin): ?>
            <li class="nav-item me-2 <?php if($active == "Login"){echo "active";}?>">
                <a class="nav-link text-white" href="index.php?content=login">Inloggen</a>
            </li>
            <li class="nav-item me-2 <?php if($active == "Register"){echo "active";}?>">
                <a class="nav-link text-white" href="index.php?content=register">Regristreren</a>
            </li>
            <?php endif;?>
            <?php if($loggedin): ?>
            <li class="nav-item <?php if($active == "Inschrijvingen"){echo "active";}?>">
                <a class="nav-link text-white" href="index.php?content=inschrijvingen">Inschrijvingen</a>
            </li>
            <li class="nav-item <?php if($active == "Inschrijven"){echo "active";}?>">
                <a class="nav-link text-white" href="index.php?content=inschrijven">Inschrijven</a>
            </li>
            <li class="nav-item me-2 <?php if($active == "logout"){echo "active";}?>">
                <a class="nav-link text-white me-2" href="index.php?content=logout">Uitloggen</a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>