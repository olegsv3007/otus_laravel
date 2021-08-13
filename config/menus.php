<?php

return [
    // Меню в профиле пользователя
    // key - имя маршрута
    // value - путь к lang ресурсу
    'profile_menu' => [
        'profile' => 'public/common.profile_menu.profile',
        'profile.order_history' => 'public/common.profile_menu.order_history',
        'profile.view_history' => 'public/common.profile_menu.view_history',
    ],

    // Меню в админ панели
    // key - имя маршрута
    // value - массив, содержащий путь к lang ресурсу и иконке
    'cms_menu' => [
        'admin' => [
            'title' => 'cms/common.menu.main',
            'icon' => 'icons.home',
        ],
        'admin.settings' => [
            'title' => 'cms/common.menu.settings',
            'icon' => 'icons.settings',
        ],
        'admin.hotels' => [
            'title' => 'cms/common.menu.hotels',
            'icon' => 'icons.building',
        ],
        'admin.rooms' => [
            'title' => 'cms/common.menu.rooms',
            'icon' => 'icons.rooms',
        ],
        'admin.orders' => [
            'title' => 'cms/common.menu.orders',
            'icon' => 'icons.book',
        ],
        'admin.feedbacks' => [
            'title' => 'cms/common.menu.feedbacks',
            'icon' => 'icons.pen',
        ],
    ],
];
