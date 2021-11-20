<?php

namespace App\Controllers;

use App\Core\Responses\Response;

class auth extends \App\Core\AControllerBase
{

    /**
     * @inheritDoc
     */
    public function index()
    {
        return $this->html();
    }
}