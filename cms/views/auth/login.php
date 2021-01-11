<section class="hero is-light">
    <div class="hero-body">
        <div class="container">
            <h1 class="title">Connexion</h1>
        </div>
    </div>
</section>

<?php if (isset($_SESSION['errors'])): ?>

<?php foreach($_SESSION['errors'] as $errorsArray): ?>
    <?php foreach ($errorsArray as $errors): ?>
        <div>
            <?php foreach($errors as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach ?>
        </div>
        <?php endforeach ?>
<?php endforeach ?>

<?php endif ?>
<?php session_destroy() ?>

<form class="container is-max-desktop mt-3" action="/login" method="POST">
    <div class="field">
        <label class="label" for="username">Nom d'utilisateur</label>
        <input type="text" class="input" name="username" id="username">
    </div>
    <div class="field">
        <label class="label" for="username">Mot de passe</label>
        <input type="password" class="input" name="password" id="password">
    </div>
    <button type="submit" class="button is-link">Se connecter</button>
</form>