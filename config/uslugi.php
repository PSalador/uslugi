<?php
return [
	'package'	=> 'uslugi',
    'middleware' => [
        'public'  => ['web'],
        'private' => ['web', 'dashboard'],  //обращаться через config('uslugi.middleware.private')
    ],

];
