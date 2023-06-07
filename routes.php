<?php
return $routes = [
    //GET
    '' => 'IndexController@Index',
    'login' => 'IndexController@Index',
    'register' => 'UserController@Index',
    'forgot' => 'UserController@ForgotPass',
    'dashboard' => 'BookShelfController@Dashboard',
    'logOut' => 'IndexController@Index',
    //POST
    'LoginSubmit' => 'UserController@Login',
    'RegisterSubmit' => 'UserController@Register',
    'ForgotSubmit' => 'UserController@ForgotPassSubmit',
];