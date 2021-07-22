<?php 
return [

    'apiKey' => env('ELASTIC_EMAIL_API_KEY', null),

    'apiUrl' => env('ELASTIC_EMAIL_API_URL', 'https://api.elasticemail.com/v2/email/send'),

    'sender' => [
        'from' => 'send@zrobleno.com.ua',
        'fromName'  => 'ТОВ "ЗРОБЛЕНО"',
    ],
    
    'templates' => [

        'ResetPassword' => [
            'from' => 'send@zrobleno.com.ua',
            'fromName'  => 'ТОВ "ЗРОБЛЕНО"',
            'subject'  => 'dawdf32',
            'fields' => [
                'reset_password_title' => '',
                'reset_password_link' => ''
            ]
        ]

    ],

    // 'profiles' => [

    //     'default' => [
    //         'apiKey' => env('ELASTIC_EMAIL_API_KEY', null),
    //         'from'      => 'send@zrobleno.com.ua',
    //         'fromName'  => 'ТОВ "ЗРОБЛЕНО"',
    //         'to'        => [
    //             // 'send@zrobleno.com.ua',
    //             'wotshef@gmail.com',
    //         ],
    //         'template'  => 'ResetPassword',
    //         'fields'    => []
    //     ],

    //     'reset_password' => [
    //         'apiKey'    => env('ELASTIC_EMAIL_API_KEY', null),
    //         'subject'   => 'Відновлення доступу до аккаунту',
    //         'from'      => 'send@zrobleno.com.ua',
    //         'fromName'  => 'ТОВ "ЗРОБЛЕНО"',
    //         'to'        => [
    //             // 'send@zrobleno.com.ua',
    //             'wotshef@gmail.com',
    //         ],
    //         'template'  => 'ResetPassword',
    //         'fields'    => [
    //             'reset_password_link' => ''
    //         ]
    //     ],

    // ],


];
