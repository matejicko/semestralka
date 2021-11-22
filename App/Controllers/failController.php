<?php

namespace App\Controllers;

use App\Core\Responses\Response;

class failController extends AControllerRedirect
{

    /**
     * @inheritDoc
     */
    public function index()
    {
        return $this->html();
    }

    public function userData()
    {
        return $this->html();
    }
}