<?php 

namespace App\Entities;

class UserEntity {
    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $password;
    private $date;

    public function __construct($array)
    {
        $this->id = $array['id'];
        $this->firstName = $array['first_name'];
        $this->lasName = $array['last_name'];
        $this->email = $array['email'];
        $this->password = $array['password'];
        $this->date = $array['date'];
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'password' => $this->password,
            'date' => $this->date,
        ];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }
    
    public function getLastName()
    {
        return $this->lastName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getTimestamp()
    {
        return strtotime($this->date);
    }
}





?>