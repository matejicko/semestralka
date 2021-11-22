<?php

namespace App\Controllers;

use App\Core\AControllerBase;

/**
 * Class homeController
 * Example of simple controller
 * @package App\Controllers
 */
class homeController extends \App\Controllers\AControllerRedirect
{

    public function index()
    {
        return $this->html();
    }

    public function contact()
    {
        return $this->html();
    }

    public function about()
    {
        return $this->html();
    }
}