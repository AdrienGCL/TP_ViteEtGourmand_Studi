<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vite & Gourmand</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

    <div class="global-container padding-t-l padding-b-l bg-dark position-relative min-vh-100">
        <header class="container-fluid p-0 m-0">
            <div class="d-flex justify-content-center margin-b-l">
                <h1 class="brand-l primary-text m-0">Vite & Gourmand</h1>
            </div>
            <?php require _ROOTPATH_.'\templates\separator.php'; ?>
            <div class="d-flex justify-content-center margin-t-l margin-b-l">
                <ul class="nav nav-pills headline w-100 justify-content-around padding-l-l padding-r-l">
                    <li class="nav-item">
                        <a href="./index.php?controller=home&action=show" class="nav-link primary-text p-0" aria-current="page">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a href="./index.php?controller=menu&action=showAll" class="nav-link primary-text p-0">Nos Menus</a>
                    </li>
                    <li class="nav-item">
                        <a href="./index.php?controller=espacePerso" class="nav-link primary-text p-0">Mon Espace</a>
                    </li>
                    <li class="nav-item">
                        <a href="./index.php?controller=connexion&action=connexion" class="nav-link primary-text p-0">Connexion</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a href="#" class="nav-link primary-text py-0 px-5">Nous Contacter</a>
                    </li> -->
                </ul>
            </div>
            <?php require _ROOTPATH_.'\templates\separator.php'; ?>
        </header>