<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;

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

    public function handleContact()
    {

    }
}