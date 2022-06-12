<?php

namespace App\Templates;

use App\Classes\Auth;
use App\Models\User;

class LoginPage extends Template {

    private $errors = [];

    public function __construct()
    {
        parent::__construct();
        if(Auth::isAuthenticated())
            redirect('panel.php', ['action' => 'posts']);
        $this->title = $this->setting->getTitle() . ' - login to system';
        if($this->request->isPostMethod()){
            $data = $this->validator->validate([
                'email' => ['required', 'email'],
                'password' => ['required', 'min:6']
            ]);

            if(!$data->hasError()){
                $userModel = new User();
                $user = $userModel->authenticateUser($this->request->email, $this->request->password);
                if($user){
                    Auth::loginUser($user);
                    redirect('panel.php');
                }
                else {
                    $this->errors[] = 'invalid credintials!!!';
                }
            }
            else{
                dd($data->getErrors());
                $this->errors = $data->getErrors();
            }
        }
    }

    private function showError()
    {
        if(count($this->showError)){
            echo "i found error";
            foreach($this->errors as $error){
                echo $error;
            }
        }
    }

    public function renderPage()
    {
        $this->getAdminHead();
    }
}


?>