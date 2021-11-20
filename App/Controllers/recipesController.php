<?php

namespace App\Controllers;

use App\Core\Responses\Response;

class recipesController extends \App\Controllers\AControllerRedirect
{
    /**
     * @inheritDoc
     */
    public function index()
    {
        return $this->html(
            [ 'nazov' => 'Pizza'
        ]);
    }
}