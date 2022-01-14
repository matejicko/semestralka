<!DOCTYPE html>
<html lang="sk">
<head>
    <title>Svetové kuchyne</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">-->

    <link rel="stylesheet" href="public/style.css">

    <!--Bootstrap 5-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>

    <!--Icons from Font Awesome-->
    <script src="https://kit.fontawesome.com/f02d4df4d5.js" crossorigin="anonymous"></script>

    <!--Fancy alerts-->
    <script src="sweetalert-dev.js"></script>
    <link rel=”stylesheet” href="sweetalert.css">

</head>
<body>

<!--Main navigation bar - menu-->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">

        <a class="navbar-brand" href="index.html">
            <img class="logo" alt="Logo stránky" src="public/images/logos/Logo%20SK.png">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="?c=home&a=index">Hlavná stránka</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?c=home&a=about">O projekte</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?c=home&a=contact">Kontakt</a>
                </li>
                <li class="nav-link">|</li>

                <!--In case that user is logged in, there are more options to choose-->
                <?php if (\App\Authentification::isLogged()){?>

                    <li class="nav-item">
                        <a class="nav-link" href="?c=account&a=showMyRecipes">Moje Recepty</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="?c=recipes&a=addRecipeForm">Pridať recept</a>
                    </li>

                    <li class="nav-link">|</li>

                    <li class="nav-item">
                        <a class="nav-link" href="?c=account">Účet</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="?c=account&a=settingsForm">Nastavenia</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-danger" href="?c=auth&a=logout">Odhlásiť</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link " href="?c=account">
                            <i class="text-success">● </i>
                            <i><?=\App\AccountHandler::getLoggedUser()->getUsername()?></i></a>
                    </li>


                <?php }else{ ?>

                    <li class="nav-item">
                        <a class="nav-link text-success" href="?c=auth&a=loginForm">Prihlásiť</a>
                    </li>

                <?php } ?>



            </ul>
        </div>
    </div>
</nav>


<?= $contentHTML ?>

<footer class="container-fluid footer">
    <div class="row">


        <div class="col-sm-5 text-end"  style="margin: auto"></div>

        <div class="col-sm-1 text-center"  style="margin: auto">
            <img class="logo" alt="MG Logo" src="public/images/logos/MG%20Logo%20white.png">
        </div>

        <div class="col-sm-6">
            <div class="contact-menu">

                <a href="contact.html" target="_blank" rel="noopener noreferrer" class="bleda-ikona fas fa-user-alt btn"></a> Matej Grochal<br>
                <a href="tel:+421905798203" target="_blank" rel="noopener noreferrer" class="bleda-ikona fas fa-phone-square-alt btn"></a> +421 905 798 203<br>
                <a href="mailto:matogrochal01@gmail.com" target="_blank" rel="noopener noreferrer" class="bleda-ikona fas fa-envelope btn"></a>matogrochal01@gmail.com<br>
                <a href="https://www.facebook.com/mato.grochal.1/" target="_blank" rel="noopener noreferrer" class="btn"><i class="bleda-ikona fab fa-facebook"></i></a>
                <a href="https://www.instagram.com/mato_grochal/" target="_blank" rel="noopener noreferrer" class="btn"><i class="bleda-ikona fab fa-instagram"></i></a>

            </div>

        </div>

        <p class="text-center">Vytvorené pomocou Bootstrap 5</p>

    </div>
</footer>

</body>
</html>

