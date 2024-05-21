<?php

return [
    [
        'icon' => 'nav-icon fas fa-tachometer-alt',
        'title' => 'Dashboard',
        'route' => 'dashboard.dashboard',
    ],
    [
        'title' => 'Categories',
        'active' => 'dashboard.categories.*',
        'route' => 'dashboard.categories.index',
        'submenu' => [
            [
                'icon' => 'nav-icon fas fa-list',
                'title' => 'All Categories',
                'route' => 'dashboard.categories.index',
                'ability' => 'categories.index',
            ],
            [
                'icon' => 'nav-icon fas fa-plus',
                'title' => 'Create Category',
                'route' => 'dashboard.categories.create',
                'ability' => 'categories.create',

            ],
            [
                'icon' => 'nav-icon fas fa-info',
                'title' => 'Trashed Category',
                'route' => 'dashboard.categories.trash',
                'ability' => 'categories.trash',

            ],
        ],
    ],
    [
        'title' => 'Brands',
        'active' => 'dashboard.brands.*',
        'route' => 'dashboard.brands.index',
        'submenu' => [
            [
                'icon' => 'nav-icon fas fa-list',
                'title' => 'All Brands',
                'route' => 'dashboard.brands.index',
                'ability' => 'brands.index',

            ],
            [
                'icon' => 'nav-icon fas fa-plus',
                'title' => 'Create Brand',
                'route' => 'dashboard.brands.create',
                'ability' => 'brands.create',

            ],
            [
                'icon' => 'nav-icon fas fa-info',
                'title' => 'Trashed Brands',
                'route' => 'dashboard.brands.trash',
                'ability' => 'brands.trash',

            ],
        ],
    ],
    [
        'title' => 'Products',
        'active' => 'dashboard.products.*',
        'route' => 'dashboard.products.index',
        'submenu' => [
            [
                'icon' => 'nav-icon fas fa-list',
                'title' => 'All Products',
                'route' => 'dashboard.products.index',
                'ability' => 'products.index',

            ],
            [
                'icon' => 'nav-icon fas fa-plus',
                'title' => 'Create Product',
                'route' => 'dashboard.products.create',
                'ability' => 'products.create',

            ],
            [
                'icon' => 'nav-icon fas fa-info',
                'title' => 'Trashed Products',
                'route' => 'dashboard.products.trash',
                'ability' => 'products.trash',

            ],
        ],
    ],
    [
        'title' => 'Options',
        'active' => 'dashboard.options.*',
        'route' => 'dashboard.options.index',
        'submenu' => [
            [
                'icon' => 'nav-icon fas fa-list',
                'title' => 'All Options',
                'route' => 'dashboard.options.index',
                'ability' => 'options.index',

            ],
            [
                'icon' => 'nav-icon fas fa-plus',
                'title' => 'Create option',
                'route' => 'dashboard.options.create',
                'ability' => 'options.create',

            ],
            [
                'icon' => 'nav-icon fas fa-info',
                'title' => 'Trashed Options',
                'route' => 'dashboard.options.trash',
                'ability' => 'options.trash',


            ],
        ],
    ],
    [
        'title' => 'Roles',
        'active' => 'dashboard.roles.*',
        'route' => 'dashboard.roles.index',
        'submenu' => [
            [
                'icon' => 'nav-icon fas fa-list',
                'title' => 'All Roles',
                'route' => 'dashboard.roles.index',
                'ability' => 'roles.index',

            ],
            [
                'icon' => 'nav-icon fas fa-list',
                'title' => 'All Users',
                'route' => 'dashboard.users.index',
                'ability' => 'users.index',

            ],
        ],
    ],


];
