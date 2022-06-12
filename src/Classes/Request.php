<?php

namespace App\Classes;

class Request{

    private $attribute = [];
    private $method;
    private $url;

    public function __construct()
    {
        $this->method = $_SERVER["REQUEST_METHOD"];
        $this->url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        if($this->method == "POST"){
            foreach($_POST as $key => $value){
                $this->attribute[$key] = $value;
            }
            foreach($_FILES as $key => $value){
                $this->attribute[$key] = $value;
            }
        }
        foreach($_GET as $key => $value) {
            $this->attribute[$key] = $value;
        }
    }

    public function __get($name)
    {
        if(array_key_exists($name, $this->attribute))
            return $this->attribute[$name];

        return null;
    }

    public function has($name)
    {
        if(isset($this->attribute[$name]))
            return true;

        return false;
    }

    public function get($name)
    {
        if(array_key_exists($name, $this->attribute))
            return $this->attribute[$name];

        return null;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function isPostMethod()
    {
        return strtolower($this->method) == 'post';
    }
}
?>