<?php

namespace App\Controllers;

class PageController extends BaseController
{
    public function __construct()
    {
        // @todo: bind this to the routing functionality
        $this->setModule('pages');
        // @todo: bind this to the routing functionality
        $this->setView('pages');

        parent::__construct();
    }


    /**
     * Display the pages
     */
    public function showPages()
    {
        $this->assign('pages', isset($pages) ? $pages : null);

        // Display the website
        $this->render();
    }


    public function showDemoDashboard()
    {

    }
}