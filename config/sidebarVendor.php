<?php

return [
    [
        'icon' => 'nav-icon fas fa-tachometer-alt',
        'title' => 'Dashboard',
        'route' => 'dashboard.vendor.dashboard',
    ],
    [
        'title' => 'Products',
        'active' => 'dashboard.vendor.products.*',
        'route' => 'dashboard.vendor.products.index',
        'submenu' => [
            [
                'icon' => 'nav-icon fas fa-list',
                'title' => 'All Products',
                'route' => 'dashboard.vendor.products.index',
                'ability' => 'products.index',

            ],
            [
                'icon' => 'nav-icon fas fa-plus',
                'title' => 'Create Product',
                'route' => 'dashboard.vendor.products.create',
                'ability' => 'products.create',

            ],
            [
                'icon' => 'nav-icon fas fa-info',
                'title' => 'Trashed Products',
                'route' => 'dashboard.products.vendor.trash',
                'ability' => 'products.trash',

            ],
        ],
    ],
    [
        'title' => 'Order',
        'active' => 'dashboard.vendor.orders.*',
        'route' => 'dashboard.vendor.orders.index',
        'submenu' => [
            [
                'icon' => 'nav-icon fas fa-list',
                'title' => 'All Order',
                'route' => 'dashboard.vendor.orders.index',
                'ability' => 'orders.index',

            ],
        ],
    ],
    [
        'title' => 'Stores',
        'active' => 'dashboard.vendor.stores.*',
        'route' => 'dashboard.vendor.stores.index',
        'submenu' => [
            [
                'icon' => 'nav-icon fas fa-list',
                'title' => 'All Stores',
                'route' => 'dashboard.vendor.stores.index',
                'ability' => 'stores.index',

            ],
        ],
    ],
    [
        'title' => 'Offers',
        'active' => 'dashboard.vendor.offers.*',
        'route' => 'dashboard.vendor.offers.index',
        'submenu' => [
            [
                'icon' => 'nav-icon fas fa-list',
                'title' => 'All Offers',
                'route' => 'dashboard.vendor.offers.index',
                'ability' => 'offers.index',

            ],
        ],
    ],
    [
        'title' => 'Reviews',
        'active' => 'dashboard.vendor.reviews.*',
        'route' => 'dashboard.vendor.reviews.index',
        'submenu' => [
            [
                'icon' => 'nav-icon fas fa-list',
                'title' => 'All Reviews',
                'route' => 'dashboard.vendor.reviews.index',
                'ability' => 'reviews.index',

            ],
        ],
    ],
    [
        'title' => 'Coupons',
        'active' => 'dashboard.vendor.coupon.*',
        'route' => 'dashboard.vendor.coupon.index',
        'submenu' => [
            [
                'icon' => 'nav-icon fas fa-list',
                'title' => 'All Coupons',
                'route' => 'dashboard.vendor.coupon.index',
                'ability' => 'coupons.index',

            ],
        ],
    ],



];
