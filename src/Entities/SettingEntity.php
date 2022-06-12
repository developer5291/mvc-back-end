<?php 

namespace App\Entities;

class SettingEntity {
    private $id;
    private $title;
    private $description;
    private $keyword;
    private $footer;
    private $author;
    private $logo;

    public function __construct($array)
    {
        $this->id = $array['id'];
        $this->title = $array['title'];
        $this->description = $array['description'];
        $this->keywords = $array['keywords'];
        $this->footer = $array['footer'];
        $this->author = $array['author'];
        $this->logo = $array['logo'];
    }

    public function getid()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }
    
    public function getKeyword()
    {
        return $this->keyword;
    }

    public function getFooter()
    {
        return $this->footer;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getLogo()
    {
        return $this->logo;
    }

}





?>