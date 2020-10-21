<?php
Route::group(['namespace' => 'MediaSci\CmsBackendAuth\Http\Controllers\CmsBackendAuth', 'middleware' => ['web'], 'prefix' => config('cms-backend-auth.prefix')], function() {
    Route::any('login', 'AuthController@login');
    Route::any('logout', 'AuthController@logOut');
    Route::any('lockedscreen', 'AuthController@lockscreen');
    Route::any('forget-password', 'AuthController@forgetPassword');
    Route::any('reset-password/{token}/{email}', 'AuthController@resetPassword');
    Route::group(['middleware' =>  config('cms-backend-auth.middleware')], function() {
        Route::any('update-profile', 'ProfileController@UpdateProfile');
        Route::any('update-password', 'ProfileController@UpdatePassword');
//        Route::any('pages/create', 'PagesController@create');
//        Route::any('pages/update/{id}', 'PagesController@update');
//        Route::any('pages/delete/{id}', 'PagesController@delete');
//        Route::any('pages', 'PagesController@index');
//        Route::any('pages/generate', 'PagesController@generate');
//        Route::any('backend_users', 'UsersController@index');
//        Route::any('backend_users/create', 'UsersController@create');
//        Route::any('backend_users/update/{id}', 'UsersController@update');
//        Route::any('backend_users/delete/{id}', 'UsersController@delete');
//        Route::any('backend_users/active/{id}', 'UsersController@active');
//        Route::any('roles', 'RolesController@index');
//        Route::any('roles/create', 'RolesController@create');
//        Route::any('roles/update/{id}', 'RolesController@update');
//        Route::any('roles/delete/{id}', 'RolesController@delete');
//        Route::any('roles/actions/{id}', 'RolesController@actions');
    });
});
