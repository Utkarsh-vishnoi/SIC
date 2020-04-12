<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', [
	'uses' => 'HomeController@getHome',
	'as' => 'home',
	'middleware' => ['guest']
]);

// Tabs

Route::get('/about', [
	'uses' => 'TabsController@about',
	'as' => 'tabs.about'
]);

// Authentication Routes

Route::get('/client/login', [
	'uses' => 'ClientAuthController@showLoginForm',
	'as' => 'client.login',
	'middleware' => ['guest']
]);

Route::post('/client/login', [
	'uses' => 'ClientAuthController@login',
	'middleware' => ['guest']
]);

Route::get('/client/logout', [
	'uses' => 'ClientAuthController@logout',
	'as' => 'client.logout',
	'middleware' => ['client']
]);

// Admin Authentication Routes

Route::get('/admin/login', [
	'uses' => 'AdminAuthController@showLoginForm',
	'as' => 'admin.login',
	'middleware' => ['guest']
]);

Route::post('/admin/login', [
	'uses' => 'AdminAuthController@login',
	'middleware' => ['guest']
]);

Route::get('/admin/logout', [
	'uses' => 'AdminAuthController@logout',
	'as' => 'admin.logout'
]);

Route::post('/admin/verify', [
	'uses' => 'AdminAuthController@verify',
	'as' => 'admin.verify'
]);

Route::get('/admin/dashboard', [
	'uses' => 'AdminHomeController@showDashboard',
	'as' => 'admin.dashboard',
	'middleware' => ['admin']
]);

// Admin Privileges

Route::get('/admin/manageAdmin', [
	'uses' => 'AdminHomeController@manageAdmin',
	'as' => 'admin.manageAdmin',
	'middleware' => ['admin']
]);

Route::get('/admin/manageClient', [
	'uses' => 'AdminHomeController@manageClient',
	'as' => 'admin.manageClient',
	'middleware' => ['admin']
]);

Route::post('/admin/addClient', [
	'uses' => 'AuthController@register',
	'middleware' => ['admin'],
	'as' => 'admin.addClient'
]);

Route::post('/admin/addAdmin', [
	'uses' => 'AdminAuthController@register',
	'middleware' => ['admin'],
	'as' => 'admin.addAdmin'
]);

Route::get('/admin/profile', [
	'uses' => 'AdminHomeController@showProfile',
	'as' => 'admin.profile',
	'middleware' => ['admin']
]);

Route::post('/admin/profile', [
	'uses' => 'AdminHomeController@updateProfile',
	'middleware' => ['admin']
]);

// Admin Roles

Route::get('/admin/client-login/{id}', [
	'uses' => 'AdminRolesController@client_login',
	'middleware' => ['admin'],
	'as' => 'adminroles.clientlogin'
]);

Route::get('/admin/admin-login/{id}', [
	'uses' => 'AdminRolesController@admin_login',
	'middleware' => ['admin'],
	'as' => 'adminroles.adminlogin'
]);

Route::post('/admin/client-update', [
	'uses' => 'AdminRolesController@client_update',
	'middleware' => ['admin'],
	'as' => 'adminroles.updateClient'
]);

Route::post('/admin/admin-update', [
	'uses' => 'AdminRolesController@admin_update',
	'middleware' => ['admin'],
	'as' => 'adminroles.updateAdmin'
]);

Route::post('/admin/client-status', [
	'uses' => 'AdminRolesController@client_status',
	'middleware' => ['admin'],
	'as' => 'adminroles.statusClient'
]);

Route::post('/admin/admin-status', [
	'uses' => 'AdminRolesController@admin_status',
	'middleware' => ['admin'],
	'as' => 'adminroles.statusAdmin'
]);

Route::post('/admin/admin-delete', [
	'uses' => 'AdminRolesController@admin_delete',
	'middleware' => ['admin'],
	'as' => 'adminroles.deleteAdmin'
]);

Route::post('/admin/client-delete', [
	'uses' => 'AdminRolesController@client_delete',
	'middleware' => ['admin'],
	'as' => 'adminroles.deleteClient'
]);

// Client Roles



// Client Privileges

Route::get('/client/dashboard', [
	'uses' => 'ClientHomeController@showDashboard',
	'as' => 'client.dashboard',
	'middleware' => ['client']
]);

// Student Privileges

Route::get('/student/login', [
	'uses' => 'StudentAuthController@showLoginForm',
	'as' => 'student.login',
	'middleware' => ['guest']
]);

// Route::get('/student/login', [
// 	'uses' => 'StudentAuthController@reLogin',
// 	'as' => 'auth.restulogin',
// 	'middleware' => ['guest']
// ]);

Route::post('/student/login', [
	'uses' => 'StudentAuthController@login',
	'middleware' => ['guest']
]);

Route::get('/student/logout', [
	'uses' => 'StudentAuthController@logout',
	'as' => 'student.logout',
	'middleware' => ['student']
]);

Route::get('/student/dashboard', [
	'uses' => 'StudentHomeController@showDashboard',
	'as' => 'student.dashboard',
	'middleware' => ['student']
]);