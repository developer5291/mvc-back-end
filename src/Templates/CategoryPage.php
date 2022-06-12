<?php 

namespace App\Templates;

use App\Exceptions\NotFoundException;
use App\Models\Post;

class CategoryPage extends Template {
    private $posts;
    private $topPosts;
    private $lastPosts;

    public function __construct()
    {
        parent::__construct();

        if(!$this->request->has('category'))
            throw new NotFoundException('page not found!');

        $category = $this->request->category;
        $this->title = $this->setting->getTitle(). ' - ' . $category;
        $postModel = new Post();

        $this->posts = $postModel->filterData(function($item) use($category){
            return $item->getCategory() == $category ? true : false;    
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
        var_dump($this->posts);
        echo "<hr>";
        var_dump($this->topPosts);
        echo "<hr>";
        var_dump($this->lastPosts);

    }
}



?>