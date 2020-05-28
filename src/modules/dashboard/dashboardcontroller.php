<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function __construct()
    {
        // @todo: bind this to the routing functionality
        $this->setModule('dashboard');
        // @todo: bind this to the routing functionality
        $this->setView('dashboard');

        parent::__construct();
    }


    public function showDashboard()
    {
        // @todo: move this to the user model

        $users = [
            [
                'firstname' => 'Wouter',
                'lastname' => 'Standaert'
            ],
            [
                'firstname' => 'John',
                'lastname' => 'Doe'
            ]
        ];

        $this->assign('users', $users);

        // Display the website
        $this->render();
    }


    public function handleConfig()
    {
        var_dump($_POST);
        die();
    }
}