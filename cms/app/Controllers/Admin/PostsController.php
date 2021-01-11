<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;

class PostsController extends Controller {

    public function index()
    {
        //$this->isAdmin(); //Protéger les données

        $posts =  (new Post($this->getDB()))->all();

        return $this->view('admin.post.index', compact('posts'));
    }

    public function create()
    {
        //$this->isAdmin();

        $tags = (new Tag($this->getDB()))->all();

        return $this->view('admin.post.edit', compact('tags'));
    }

    public function createPost()
    {
        //$this->isAdmin();

        $post = new Post($this->getDB());
        $tags = array_pop($_POST);
        $result = $post->create($_POST);

        if ($result) {
            return header('Location: /admin/posts');
        }
    }

    public function edit(int $id)
    {

        //$this->isAdmin();

        $post = (new Post($this->getDB()))->findById($id);
        $tags = (new Tag($this->getDB()))->all();

        return $this->view('admin.post.edit', compact('post', 'tags'));
    }

    public function update(int $id)
    {
        //$this->isAdmin();

        $post = new Post($this->getDB());
        $result = $post->update($id, $_POST);

        if ($result) {
            return header('Location: /admin/posts');
        }
    }

    public function destroy(int $id)
    {
        //$this->isAdmin();

        $post = (new Post($this->getDB()));
        $result = $post->destroy($id);

        if ($result) {
            return header('Location: /admin/posts');
        }
    }
}