<?php
return $routes = [
    //GET
    '' => 'IndexController@index',
    'login' => 'IndexController@index',
    'register' => 'UserController@index',
    'forgot' => 'UserController@forgotPass',
    'dashboard' => 'BookShelfController@dashboard',
    'logOut' => 'IndexController@logOut',
    'edit-profile' => 'UserController@userEdit',
    'users' => 'AdminController@userList',
    'user_id' => 'AdminController@userApprove',
    'book_create' => 'AdminController@createBookForm',
    'book_edit' => 'AdminController@editBookForm',
    'favorite' => 'FavoriteBookController@favoriteList',
    'book_id' => 'BookShelfController@singleBook',
    //POST
    'LoginSubmit' => 'UserController@login',
    'RegisterSubmit' => 'UserController@register',
    'ForgotSubmit' => 'UserController@forgotPassSubmit',
    'editUser' => 'UserController@userEditSubmit',
    'editBook' => 'AdminController@createBookFormSubmit',
    'book_delete' => 'AdminController@deleteBook',
    'remove_favorite' => 'FavoriteBookController@removeFavorite',
    'add-favorite' => 'FavoriteBookController@addToFavorite',
];