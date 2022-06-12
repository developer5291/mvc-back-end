<?php

namespace App\Templates;

class ErrorPage extends Template {
     
    private $message;

    public function __construct($message)
    {
        parent::__construct();
        $this->message = $message;
        $this->title = $message;

    }

    public function renderPage()
    {
        echo "khikhikhi \n page not found biach";
    }

}


?>