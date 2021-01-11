<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Omada</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
</head>
<body>
<nav class="navbar background is-light" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="/">
            <img src="/img/logo.png" width="40" height="30">
        </a>
        <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item" href="/"><strong>Acceuil</strong></a>
            <a class="navbar-item" href="/posts"><strong>Les derniers articles</strong></a>
        </div>
        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                    <a class="button is-link" href="/login">Connexion</a>
                    <?php if(isset($_SESSION['auth'])) : ?>
                    <a class="button is-light" href="/logout">Se déconnecter</a>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</nav>
    <?= $content ?>
</body>
