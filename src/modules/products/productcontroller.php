<?php

namespace App\Controllers;

class ProductController extends BaseController
{
    public function __construct()
    {
        parent::__construct('products', 'products');
    }


    public function showProducts()
    {
        // @todo: move this to the user model

        $products = [
            [
                'id' => 1,
                'model' => 'Macbook Pro 13"',
                'name' => 'Macbook Pro 13"',
                'price' => '€ 1299,95'
            ],
            [
                'id' => 2,
                'model' => 'iPod mini 64gb',
                'name' => 'iPod mini 64gb',
                'price' => '€ 299,95'
            ]
        ];

        // Assign the available products
        $this->assign('products', $products);

        // Display the website
        $this->render();
    }


    public function showCategories()
    {
        $this->setView('categories');

        // @todo: get the active user

        // Display the website
        $this->render();
    }


    public function showModels()
    {
        // @todo: get the active user

        // Display the website
        $this->render();
    }
}