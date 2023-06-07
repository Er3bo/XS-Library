<?php
return $routes = [
    //GET
    '' => 'IndexController@Index',
    'login' => 'IndexController@Index',
    'register' => 'UserController@Index',
    'forgot' => 'UserController@ForgotPass',
    'dashboard' => 'BookShelfController@Dashboard',
    'logOut' => 'IndexController@Index',
    'edit-profile' => 'UserController@UserEdit',
    'users' => 'AdminController@UserList',
    'user_id' => 'AdminController@UserApprove',
    //POST
    'LoginSubmit' => 'UserController@Login',
    'RegisterSubmit' => 'UserController@Register',
    'ForgotSubmit' => 'UserController@ForgotPassSubmit',
    'editUser' => 'UserController@UserEditSubmit',
];