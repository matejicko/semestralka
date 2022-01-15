<?php

namespace App\Controllers;

use App\Core\Responses\Response;
use App\Core\Responses\ViewResponse;

/**
 * Class homeController
 * Example of simple controller
 * @package App\Controllers
 */
class homeController extends AControllerRedirect
{

    public function index(): ViewResponse|Response
    {
        return $this->html(
            ['success_message' => $this->request()->getValue('success_message')]
        );
    }

    public function contact(): ViewResponse
    {
        return $this->html();
    }

    public function about(): ViewResponse
    {
        return $this->html();
    }
}