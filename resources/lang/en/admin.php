<?php

return [
    'admin-user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
            'edit_profile' => 'Edit Profile',
            'edit_password' => 'Edit Password',
        ],

        'columns' => [
            'id' => 'ID',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'password_repeat' => 'Password Confirmation',
            'activated' => 'Activated',
            'forbidden' => 'Forbidden',
            'language' => 'Language',
                
            //Belongs to many relations
            'roles' => 'Roles',
                
        ],
    ],

    'product' => [
        'title' => 'Products',

        'actions' => [
            'index' => 'Products',
            'create' => 'New Product',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'sku' => 'Sku',
            'name' => 'Name',
            'slug' => 'Slug',
            'description' => 'Description',
            'cover' => 'Cover',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'status' => 'Status',
            
        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];