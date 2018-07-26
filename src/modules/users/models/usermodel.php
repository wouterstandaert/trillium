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
}