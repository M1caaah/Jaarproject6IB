<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

class SiteController extends Controller
{
    public function home()
    {
        $params = [
            'name' => "M1caaah"
        ];
        return $this->render('home', $params);
    }

    public function handleHome()
    {

    }

    public function contact()
    {
        $params = [
            'name' => "M1caaah"
        ];
        return $this->render('contact', $params);
    }

    public function handleContact(Request $request)
    {
        $body = $request->getBody();
        echo '<pre>';
        var_dump($body);
        echo '</pre>';
        exit;
        return 'Handling submitted data';
    }
}