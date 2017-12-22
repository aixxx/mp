<?php

return [

    'account' => [
        [
            'group' => 'account',
            'label' => '公众号',
            'collection' => [
                [
                    'label' => '公众号管理',
                    'icon'  => 'ion-social-whatsapp',
                    'submenus' => [
                        [
                            'label' => '公众号列表',
                            'uri'   => 'account',
                        ]
                    ],
                ],
                [
                    'label' => '管理员',
                    'icon'  => 'ion-android-people',
                    'submenus' => [
                        [
                            'label' => '密码修改',
                            'uri'   => 'user/password',
                        ],
                    ],
                ],
            ],
        ],
    ],

    'func' => [
        [
            'group' => 'func',
            'label' => '功能管理',
            'collection' => [
                [
                    'label' => '消息',
                    'icon'  => 'ion-ios-chatboxes',
                    'submenus' => [
                        [
                            'label' => '实时消息',
                            'uri'   => 'message/timeline',
                        ],
                        // [
                        //     'label' => '消息群发',
                        //     'uri'   => 'message/broadcasting',
                        // ],
                        [
                            'label' => '消息资源库',
                            'uri'   => 'message/resource',
                        ],
                        // [
                        //     'label' => '模板消息',
                        //     'uri'   => 'notice',
                        // ],

                    ],
                ],
                [
                    'label' => '功能',
                    'icon'  => 'ion-ios-keypad',
                    'submenus' => [
                        [
                            'label' => '粉丝管理',
                            'uri'   => 'fan',
                        ],
                        [
                            'label' => '素材管理',
                            'uri'   => 'material',
                        ],
                        [
                            'label' => '自定义菜单',
                            'uri'   => 'menu',
                        ],
                        [
                            'label' => '自动回复',
                            'uri'   => 'reply',
                        ],
                        // [
                        //     'label' => '客服管理',
                        //     'uri'   => 'staff',
                        // ],
                    ],
                ],
            ],
        ],
    ],
];