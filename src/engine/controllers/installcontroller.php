<?php

namespace App\Controllers;

class InstallController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }


    public function showInstall()
    {
        $this->setMainTemplate('install.twig');
    }
}