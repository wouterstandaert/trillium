<?php

namespace App\Models;

class UserModel
{
    public static function getUsers()
    {
        $query = "select * from users";

        // @todo: make this shit dynamic

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

        return $users;
    }


    public static function getLanguages()
    {
        $sql = "SELECT
                    languages.id,
                    language_translations.name
                FROM languages
                INNER JOIN language_translations on languages.id = language_translations.language_id
                WHERE languages.available = 1 and languages.id = 3";
        echo $sql;
    }


    public static function getBrands()
    {
        $sql = "select
                    brands.*,
                    brand_translations.description,
                    brand_translations.slug,
                    brand_translations.meta_title,
                    brand_translations.meta_description
                from brands
                inner join brand_translations on brands.id = brand_translations.brand_id
                inner join languages on brand_translations.language_id = languages.id
                where languages.id = 1";
        echo $sql;
    }


    public static function getColors()
    {
        $sql = "select
                    colors.id,
                    colors.hex_code,
                    color_translations.name
                from colors
                inner join color_translations on colors.id = color_translations.color_id
                inner join languages on color_translations.language_id = languages.id
                where languages.id = 1";
        echo $sql;
    }


    public static function getProducts()
    {
        $sql = "select
                    product_translations.*,
                    color_translations.name as color,
                    brands.name as brand
                from products
                inner join product_translations on products.id = product_translations.product_id
                inner join languages on product_translations.language_id = languages.id
                inner join product_models on products.product_model_id = product_models.id
                inner join colors on products.color_id = colors.id
                inner join color_translations on colors.id = color_translations.color_id and product_translations.language_id = color_translations.language_id
                left join brands on products.brand_id = brands.id
                left join brand_translations on brands.id = brand_translations.brand_id and product_translations.language_id = brand_translations.language_id
                where product_translations.slug = 'nike-air-max-2017-black' and languages.id = 2";
        echo $sql;
    }


    public static function getProductsLinkedToCategories()
    {
        $sql = "select
                    product_maincategory_translations.name as main_category,
                    product_category_translations.name as category,
                    color_translations.name as color,
                    brands.name as brand,
                    product_translations.*
                from products
                inner join product_translations on products.id = product_translations.product_id
                inner join languages on product_translations.language_id = languages.id
                inner join product_models on products.product_model_id = product_models.id
                inner join colors on products.color_id = colors.id
                inner join color_translations on colors.id = color_translations.color_id and product_translations.language_id = color_translations.language_id
                inner join brands on products.brand_id = brands.id
                inner join brand_translations on brands.id = brand_translations.brand_id and product_translations.language_id = brand_translations.language_id
                left join product_maincategories on products.product_maincategory_id = product_maincategories.id
                left join product_maincategory_translations on product_maincategory_translations.product_maincategory_id and product_translations.language_id = product_maincategory_translations.language_id
                left join product_categories on products.product_category_id = product_categories.id
                left join product_category_translations on product_categories.id = product_category_translations.product_category_id and product_translations.language_id = product_category_translations.language_id
                where product_translations.slug = 'nike-air-max-2017-zwart' and languages.id = 1";
        echo $sql;
    }


    public static function getProduct($slug)
    {
        var_dump($slug);

        $sql = "select
                    product_maincategory_translations.name as main_category,
                    product_category_translations.name as category,
                    color_translations.name as color,
                    brands.name as brand,
                    product_translations.*
                from products
                inner join product_translations on products.id = product_translations.product_id
                inner join languages on product_translations.language_id = languages.id
                inner join product_models on products.product_model_id = product_models.id
                inner join color_translations on products.color_id = color_translations.color_id and product_translations.language_id = color_translations.language_id
                inner join brands on products.brand_id = brands.id
                inner join brand_translations on products.brand_id = brand_translations.brand_id and product_translations.language_id = brand_translations.language_id
                left join product_maincategory_translations on products.product_maincategory_id = product_maincategory_translations.product_maincategory_id and product_translations.language_id = product_maincategory_translations.language_id
                left join product_category_translations on products.product_category_id = product_category_translations.product_category_id and product_translations.language_id = product_category_translations.language_id
                where product_translations.slug = 'nike-air-max-2017-zwart' and languages.id = 1";
        echo $sql;
    }
}