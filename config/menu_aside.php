<?php
// Aside menu
return [

    'items' => [
        // Dashboard
        [
            'title' => 'Dashboard',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => '/dashboard',
            'new-tab' => false,
        ],

        [
            'title' => 'Users',
            'icon' => 'media/svg/icons/General/User.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'User List',
                    'page' => 'dashboard/all-users',
                    
                ],
                [
                    'title' => 'Create User',
                    'page' => 'dashboard/create-user',
                    
                ],
                
            ]
        ],

        [
            'title' => 'Subscription Plan',
            'icon' => 'media/svg/icons/Communication/Spam.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'All Plans',
                    'page' => 'dashboard/all-subscription-plan',
                    
                ],
                [
                    'title' => 'Create Plan',
                    'page' => 'dashboard/create-subscription-plan',
                    
                ],
                
            ]
        ],

        [
            'title' => 'Plugins',
            'icon' => 'media/svg/icons/Communication/Spam.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'All Plugins',
                    'page' => 'dashboard/all-plugins',
                    
                ],
                [
                    'title' => 'Upload New Plugin',
                    'page' => 'dashboard/create-plugin',
                    
                ],
                [
                    'title' => 'Activation Code',
                    'page' => 'dashboard/activation-code',
                    
                ],
                
            ]
        ],

        [
            'title' => 'Orders',
            'icon' => 'media/svg/icons/Communication/Spam.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'All Order',
                    'page' => 'dashboard/all-orders',
                ]
                
            ]
        ],

        [
            'title' => 'Payment settings',
            'icon' => 'media/svg/icons/Communication/Spam.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Settings',
                    'page' => 'dashboard/payment-settings',
                ]
                
            ]
        ],

        

    ],


    'user_items' => [

        [
            'title' => 'Dashboard',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => '/user/dashboard',
            'bi-icon' => 'bi bi-speedometer',
            'new-tab' => false,
        ],

        [
            'title' => 'Plugins',
            'icon' => 'media/svg/icons/General/User.svg',
            'bi-icon' => 'bi bi-plug',
            'bullet' => 'line',
            'root' => true,
            'id' => 'plugins',
            'submenu' => [
                [
                    'title' => 'Plugin List',
                    'page' => '/user/my-plugins',
                    
                ],
                [
                    'title' => 'Activation Code',
                    'page' => '/user/get-activation-code',
                    
                ],
                
            ]
        ],
        [
                'title' => 'Payment',
                'icon' => 'media/svg/icons/General/User.svg',
                'bullet' => 'line',
                'root' => true,
                'id' => 'payment',
                'bi-icon' => 'bi bi-credit-card',
                'submenu' => [
                    [
                        'title' => 'Payment History',
                        'page' => '/user/my-payment-history',
                        
                    ],
                    
                ]
            ]


       
    ]

];
