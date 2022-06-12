<?php

namespace App\Templates;

use App\Exceptions\NotFoundException;
use App\Models\Post;

class SinglePage extends Template {

    private $post;
    private $topPosts;
    private $lastPosts;

    public function __construct()
    {
        parent::__construct();

        if(!$this->request->has('id'))
            throw new NotFoundException('page not found');

        $id = $this->request->id;
        $postModel = new Post();
        $this->post = $postModel->getDataById($id);
        $this->title = $this->setting->getTitle() . ' - ' . $this->post->getTitle();

        $this->topPosts = $postModel->sortData(function($first, $second) {
            return $first->getView() > $second->getView() ? -1 : 1 ;
        });

        $this->lastPosts = $postModel->sortData(function($first, $second) {
            return $first->getTimestamp() > $second->getTimestamp() ? -1 : 1;
        });
    }

    public function renderPage()
    {
        var_dump($this->post);
        echo "<hr>";
        var_dump($this->topPosts);
        echo "<hr>";
        var_dump($this->lastPosts);
    }
}


?>