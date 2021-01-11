<section class="hero is-light">
    <div class="hero-body">
        <div class="container">
            <h1 class="title"><?= $params['post']->title ?? 'Créer un nouvel article' ?></h1>
        </div>
    </div>
</section>
<form class="container is-max-desktop mt-3" action="<?= isset($params['post']) ? "/admin/posts/edit/{$params['post']->id }" : "/admin/posts/create" ?>" method="POST">
    <div class="field">
        <label class="label" for="title">Titre de l'aticle</label>
        <input type="text" class="input" name="title" id="title" value="<?= $params['post']->title ?? '' ?>">
    </div>
    <div class="field">
        <label class="label" for="content">Contenue de l'aticle</label>
        <textarea type="text" class="textarea" name="content" id="content"><?= $params['post']->content ?? '' ?></textarea>
    </div>
    <div class="select is-multiple">
        <label for="tags" class="label">Tags de l'article</label>
        <select multiple size="5" id="tags" name="tags[]">
        <?php foreach ($params['tags'] as $tag) : ?>
            <option value="<?= $tag->id ?>"
                    <?php if(isset($params['post'])) : ?>
                    <?php foreach ($params['post']->getTags() as $postTag) {
                        echo ($tag->id === $postTag->id) ? 'selected' : '';
                    }
                    ?>
                    <?php endif ?>><?= $tag->name ?></option>
        <?php endforeach ?>
        </select>
    </div> <br>
    <button type="submit" class="button is-primary mt-3"><?= isset($params['post']) ? 'Enregistrer les modifications' : 'Enregistrer mon article' ?></button>
</form>