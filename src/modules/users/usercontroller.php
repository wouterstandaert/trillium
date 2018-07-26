<?php

namespace App\Controllers;

class UserController extends BaseController
{
    public function __construct()
    {
        // @todo: bind this to the routing functionality
        $this->setModule('users');
        // @todo: bind this to the routing functionality
        $this->setView('users');

        parent::__construct();
    }


    public function showUsers()
    {
        // @todo: move this to the user model



        $this->assign('users', isset($users) ? $users : null);

        // Display the website
        $this->render();
    }


    public function showUser()
    {
        // @todo: get the active user

        // Display the website
        $this->render();
    }
}