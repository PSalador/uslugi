<?php
return [
    'middleware' => [
        'public'  => ['web'],
        'private' => ['web', 'dashboard'],  //обращаться через config('uslugi.middleware.private')
    ],

];
