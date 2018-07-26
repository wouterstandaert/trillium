<?php

namespace App\Controllers;

class LoginController extends BaseController
{
    public function __construct()
    {
        parent::__construct('login', 'login');
    }


    public function showLogin()
    {
        $this->render();
    }
}