<h1><?= $params['tag']->name ?></h1>

<?php foreach ($params['tag']->getPosts() as $post): ?>

    <div class="card-header centered">
        <div class="content">
            <a><a href="/posts/<?= $post->id ?>"><?= $post->title ?></a></a>
        </div>
    </div>

<?php endforeach ?>
