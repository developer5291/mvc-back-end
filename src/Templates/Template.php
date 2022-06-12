<?php 

namespace App\Templates;

use App\Classes\Request;
use App\Classes\Validator;
use App\Models\Setting;

abstract class Template {

    protected $title;
    protected $setting;
    protected $request;
    protected $validator;

    public function __construct()
    {
        $this->request = new Request();
        $this->validator = new Validator($this->request);

        $settingModel = new Setting();
        $this->setting = $settingModel->getFirstData();
    }

    abstract public function renderPage();

    protected function getAdminHead()
    {
        echo "heeey admin head";
    }

    protected function getHead()
    {
        ?>
        <head>
            <meta charset="UTF-8">
            <meta name="description" content="<?php echo $this->setting->getDescription()?>">
            <meta name="keyword" content="<?php echo $this->setting->getKeyword()?>">
            <meta name="author" content="<?php echo $this->setting->getAuthor()?>">

            <link rel="stylesheet" href="<?= assets('css/styles.css')?>">
            <title><?php echo $this->title?></title>
        </head>
        <?php
    }

    protected function getHeader()
    {
        ?>
        <h1><?php $this->setting->getTitle()?></h1>
        this is header!!!!
        <?php
    }

    protected function getFooter()
    {
        ?>
        <footer>
            <p><?= $this->setting->getFooter();?></p>
        </footer>
        <?php
    }

    protected function getNavbar()
    {
        ?>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Gallery</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="<?= url('index.php', ['action' => 'login']) ?>">login</a></li>
            </ul>
            <form action="#">
                <input type="text" placeholder="search your word!">
                <input type="submot" value="search">
            </form>
        </nav>
        <?php
    }

    protected function getSidebar($topPosts, $lastPost)
    {
        ?>
            <aside>
                <?php if(count($topPosts)): ?>
                    <h2>Top Posts</h2>
                    <ul>
                        <?php foreach($topPosts as $item):?>
                            <li>
                                <a href="#">
                                    <?= $item->getTitle()?>
                                    <small>(<?= $item->getView()?>)</small>
                                </a>
                            </li>
                        <?php endforeach?>
                    </ul>
                <?php endif;?>
                <?php if(count($lastPost)): ?>
                    <h2>Last Posts</h2>
                    <ul>
                        <?php foreach($lastPost as $item):?>
                            <li>
                                <a href="#">
                                    <?= $item->getTitle()?>
                                    <small>(<?= $item->getDate()?>)</small>
                                </a>
                            </li>
                        <?php endforeach?>
                    </ul>
                <?php endif;?>
            </aside>
        <?php
    }
}


?>