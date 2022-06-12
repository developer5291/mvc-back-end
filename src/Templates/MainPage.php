<?php

namespace App\Templates;

use App\Models\Post;

class MainPage extends Template {

    private $topPost;
    private $lastPost;
    private $post;

    public function __construct()
    {
        parent::__construct();
        $this->title = $this->setting->getTitle();

        $postModel = new Post();

        $this->topPost = $postModel->sortData(function($first, $second) {
            return $first->getView() > $second->getView() ? -1 : 1;
        });

        $this->lastPost = $postModel->sortData(function($first, $second) {
            return $first->getTimestamp() > $second->getTimestamp() ? -1 : 1;
        });

        $this->post = $postModel->getAllData();
    }

    public function renderPage()
    {
        ?>
        <!DOCTYPE html>
        <html lang="en">
            <?php $this->getHead()?>
        <body>
            <main>
                <?php $this->getHeader()?>
                <?php $this->getNavbar()?>
                <section>
                    <?php $this->getSidebar($this->topPost, $this->lastPost);?>
                </section>
                <?php $this->getFooter();?>
            </main>
        </body>
        </html>
        <?php
    }
}



?>