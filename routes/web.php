<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('welcome');
})->name('homepage');

Auth::routes(['register' => false, 'reset' => true]);
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/admin', 'AdminController@dashboard');

#ADMIN ADMIN
Route::get('/add_admin', 'AdminController@showAddAdmin');
Route::post('/add_admin', 'AdminController@addAdmin')->name('add_admin');
Route::get('/view_admins', 'AdminController@showViewAdmin');
Route::get('/edit_admin/{user}', 'AdminController@showEditAdmin');
Route::put('/edit_admin/{user}', 'AdminController@editAdmin');
//Route::get('/add_file/', 'AdminController@showAddFile');

#ADMIN ORGANIZATION
Route::get('/add_company', 'AdminController@showAddCompany');
Route::post('/add_company', 'AdminController@addCompany')->name('add_company');
Route::get('/view_companys/{folder}', 'AdminController@showViewFolderCompanys');
Route::get('/view_companys', 'AdminController@showViewCompanys');
Route::get('/edit_company/{company}', 'AdminController@showEditCompany');
Route::put('/edit_company/{company}', 'AdminController@editCompany');
Route::post('/delete_company/{company}', 'AdminController@deleteCompany');

#ADMIN USER
Route::get('/view_users', 'AdminController@showViewUsers');
Route::get('/add_user', 'AdminController@showAddUser');
Route::post('/add_user', 'AdminController@addUser')->name('add_user');

#USER
Route::get('/user/{user}', 'UserController@dashboard');

Route::get('/edit_user/{user}', 'UserController@showEditUser');
Route::put('/edit_user/{user}', 'UserController@editUser');
Route::post('/delete_user/{user}', 'AdminController@deleteUser');

Route::post('/user/{user}/add_file/', 'UserController@addFile');
Route::post('/edit_file/{file}', 'UserController@editFile');
Route::get('/edit_file/{file}', 'UserController@showEditFile');
Route::post('/delete_file/{file}', 'UserController@deleteFile');
Route::get('/file/{file}', 'UserController@downloadFile');
Route::get('/file/{folder}/{file}', 'UserController@downloadFileUc');

Route::post('/user/{user}/add_folder/', 'UserController@addFolder');
Route::get('/user/{user}/add_folder/', 'UserController@showAddFolder');
Route::post('/edit_folder/{folder}', 'UserController@editFolder');
Route::get('/edit_folder/{folder}', 'UserController@showEditFolder');
Route::post('/delete_folder/{folder}', 'UserController@deleteFolder');

Route::get('user/{user}/folder/{type}', 'UserController@showFolder');
Route::get('custom_folder/{folder}', 'UserController@showCustomFolder');
Route::get('uc/{uc}', 'UserController@showFolderUc');

Route::post('/file/{file}/folder/{folder}', 'UserController@checkFolder');

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test', 'Controller@test');