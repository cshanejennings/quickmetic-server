<?php

return [

    // These CSS rules will be applied after the regular template CSS

    /*
        'css' => [
            '.button-content .button { background: red }',
        ],
    */

    'colors' => [

        'highlight' => '#004ca3',
        'button'    => '#004cad',

    ],

    'view' => [
        'senderName'  => env('APP_NAME'),
        'reminder'    => 'You\'re receiving this email because you have created an account with Math Drills.',
        'unsubscribe' => null,
        'address'     => 'Math Drills',

        'logo'        => [
            'path'   => '%PUBLIC%/images/text-waiting.logo.png',
            'width'  => '',
            'height' => '',
        ],

        'twitter'  => null,
        'facebook' => null,
        'flickr'   => null,
    ],

];
