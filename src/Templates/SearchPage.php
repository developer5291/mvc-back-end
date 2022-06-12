<?php 

namespace App\Templates;

use App\Exceptions\NotFoundException;
use App\Models\Post;

class SearchPage extends Template {
    
    private $posts;
    private $topPosts;
    private $lastPosts;

    public function __construct()
    {
        parent::__construct();
        if(!$this->request->has('word'))
            throw new NotFoundException('page not found');

        $word = $this->request->word;
        $this->title = $this->setting->getTitle() . ' - result for: ' . $word;
        $postModel = new Post();

        $this->posts = $postModel->filterData(function($item) use($word) {
            return strpos($item->getTitle(), $word) or strpos($item->getContent() , $word) ? true : false;
        });

        $this->topPosts = $postModel->sortData(function($first, $second) {
            return $first->getView() > $second->getView() ? -1 : 1 ;
        });

        $this->lastPosts = $postModel->sortData(function($first, $second) {
            return $first->getTimestamp() > $second->getTimestamp() ? -1 : 1;
        });        
    }

    public function renderPage()
    {
        print_r($this->posts);
        echo "<hr>";
        print_r($this->topPosts);
        echo "<hr>";
        print_r($this->lastPosts);
    }
}