<section class="hero is-light">
    <div class="hero-body">
        <div class="container">
            <h1 class="title">Les derniers articles</h1>
        </div>
    </div>
</section>
<?php foreach ($params['posts'] as $post): ?>

    <div class="card-header container is-max-desktop p-2 mt-2">
        <div class="content">
            <h2 class="title is-4"><?= $post->title ?></h2>
            <div>
                <?php foreach($post->getTags() as $tag): ?>
                    <div class="has-background-info"><a href="/tags/<?= $tag->id ?>" class="is-link" <?= $tag->name ?></a></div>
                <?php endforeach ?>
            </div>
            <small class="has-background-info has-text-link-light p-1">Publié le <?= $post->created_at ?></small>
            <p class="pt-2"><?= $post->content ?></p>
            <a href="/posts/<?= $post->id ?>" class="button is-primary">Lire plus</a>
        </div>
    </div>

<?php endforeach ?>
