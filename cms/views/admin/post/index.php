<section class="hero is-light">
    <div class="hero-body">
        <div class="container">
            <h1 class="title">Administration des articles</h1>
            <a href="/admin/posts/create" class="button is-success">Créer un nouvel article</a>
        </div>
    </div>
</section>

<?php if(isset($_GET['success'])) : ?>
    <div class="notification is-primary">Vous êtes connecter</div>
<?php endif ?>



<table class="table container is-max-desktop mt-5">
    <thead>
    <tr>
        <td <abbr title="title">Titre</abbr></td>
        <td <abbr title="publication">Publié le</abbr></td>
        <td <abbr title="actions">Actions</abbr></td>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($params['posts'] as $post) : ?>
            <tr>
                <th<?= $post->id ?></th>
                <td><?= $post->title ?></td>
                <td><?= $post->getCreatedAt() ?></td>
                <td>

                    <form action="/admin/posts/delete/<?= $post->id ?>" method="POST" class="column">
                        <a href="/admin/posts/edit/<?= $post->id ?>" class="button is-warning">Modifier</a>
                        <button href="/admin/posts/delete/<?= $post->id ?>" class="button is-danger">supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>