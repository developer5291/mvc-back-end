<!-- favicon error -->
<link rel="shortcut icon" href="#">

<?php

session_start();

require "./vendor/autoload.php";

use App\Classes\Request;
use App\Exceptions\DoesNotExistException;
use App\Exceptions\NotFoundException;
use App\Templates\CategoryPage;
use App\Templates\ErrorPage;
use App\Templates\LoginPage;
use App\Templates\MainPage;
use App\Templates\NotFoundPage;
use App\Templates\SearchPage;
use App\Templates\SinglePage;

try {
    $request = new Request;
    switch($request->get('action')){
        case 'single' :
            $page = new SinglePage();
        break;
        case 'search' :
            $page = new SearchPage();
        break;
        case 'category' :
            $page = new CategoryPage();
        break;
        case 'login' :
            $page = new LoginPage();
        break;
        case NULL :
            $page = new MainPage();
        break;
        default :
            throw new NotFoundException('page not found!');
    }
}
catch(DoesNotExistException | NotFoundException $exception) {
    $page = new NotFoundPage($exception->getMessage());
}
catch(Exception $exception){
    $page = new ErrorPage($exception->getMessage());
}
finally {
    $page->renderPage();
}


// $database = new Database('posts', PostEntity::class);

// $postEntity = new PostEntity([
    // 'id' => 7,
    // 'title' => 'the title 7',
    // 'content' => 'the content 7',
    // 'category' => 'sports 7 ',
    // 'view' => 7,
    // 'image' => './images/7.jpg',
    // 'date' => date('Y:m:d H:i:s'),
// ]);


// $database->data[] = $postEntity;
// $database->setData($database->data);
// dd($database->data);
