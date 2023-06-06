<?php
return $routes = [
    '' => 'IndexController@Index',
    '?login' => 'IndexController@Index',
    '?register' => 'UserController@Index',
    '?forgot' => 'ContactController@index',
    'LoginSubmit' => 'UserController@Login',
    '?dashboard' => 'BookShelfController@Dashboard'
];