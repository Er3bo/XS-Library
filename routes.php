<?php
return $routes = [
    //GET
    '' => 'IndexController@Index',
    'login' => 'IndexController@Index',
    'register' => 'UserController@Index',
    'forgot' => 'UserController@ForgotPass',
    'dashboard' => 'BookShelfController@Dashboard',
    'logOut' => 'IndexController@LogOut',
    'edit-profile' => 'UserController@UserEdit',
    'users' => 'AdminController@UserList',
    'user_id' => 'AdminController@UserApprove',
    'book_create' => 'AdminController@CreateBookForm',
    'book_edit' => 'AdminController@EditBookForm',
    //POST
    'LoginSubmit' => 'UserController@Login',
    'RegisterSubmit' => 'UserController@Register',
    'ForgotSubmit' => 'UserController@ForgotPassSubmit',
    'editUser' => 'UserController@UserEditSubmit',
    'editBook' => 'AdminController@CreateBookFormSubmit',
    'book_delete' => 'AdminController@DeleteBook',
];