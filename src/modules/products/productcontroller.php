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
        $products = \App\Models\Product::all();

        // Assign the available products
        $this->assign('products', $products);

        // Display the website
        $this->render();
    }


    public function showProduct()
    {
        $this->setView('product');

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
        $this->setView('models');

        $productModels = \App\Models\ProductModel::all();

        $this->assign('product_models', $productModels);
        // Display the website
        $this->render();
    }


    public function handleProduct()
    {
        //var_dump($_POST);

        header("location: /products");
    }
}