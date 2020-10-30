<?php
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;
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

#### FRONTEND
## Home page web
Route::get("/", 'Home\HomeController@home_page');

#### AUTHENTICATION

#### BACKEND
## Home page admin
Route::get('/admin/dashboard', 'Admin\AdminController@dashboard');

## Access groups
Route::get('/admin/add-access-groups', 'AccessGroups\AccessGroupController@add_access_groups');
Route::post('/admin/save-access-groups', 'AccessGroups\AccessGroupController@save_access_groups');

Route::get('/admin/list-access-groups', 'AccessGroups\AccessGroupController@list_access_groups');

Route::get('/admin/hide-access-groups/{id}', 'AccessGroups\AccessGroupController@hide_access_groups');
Route::get('/admin/show-access-groups/{id}', 'AccessGroups\AccessGroupController@show_access_groups');

Route::get('/admin/edit-access-groups/{id}', 'AccessGroups\AccessGroupController@edit_access_groups');
Route::post('/admin/update-access-groups/{id}', 'AccessGroups\AccessGroupController@update_access_groups');

Route::get('/admin/delete-access-groups/{id}', 'AccessGroups\AccessGroupController@delete_access_groups');

## Areas
Route::get('/admin/add-areas', 'Areas\AreaController@add_areas');
Route::post('/admin/save-areas', 'Areas\AreaController@save_areas');

Route::get('/admin/list-areas', 'Areas\AreaController@list_areas');

Route::get('/admin/hide-areas/{id}', 'Areas\AreaController@hide_areas');
Route::get('/admin/show-areas/{id}', 'Areas\AreaController@show_areas');

Route::get('/admin/edit-areas/{id}', 'Areas\AreaController@edit_areas');
Route::post('/admin/update-areas/{id}', 'Areas\AreaController@update_areas');

Route::get('/admin/delete-areas/{id}', 'Areas\AreaController@delete_areas');

## Branches
Route::get('/admin/add-branches', 'Branches\BranchController@add_branches');
Route::post('/admin/save-branches', 'Branches\BranchController@save_branches');

Route::get('/admin/hide-branches/{id}', 'Branches\BranchController@hide_branches');
Route::get('/admin/show-branches/{id}', 'Branches\BranchController@show_branches');

Route::get('/admin/edit-branches/{id}', 'Branches\BranchController@edit_branches');
Route::post('/admin/update-branches/{id}', 'Branches\BranchController@update_branches');

Route::get('/admin/delete-branches/{id}', 'Branches\BranchController@delete_branches');

## Departments

## Employees
Route::get('/admin/add-employees', 'Employees\EmployeeController@add_employees');
Route::post('/admin/save-employees', 'Employees\EmployeeController@save_employees');

Route::get('/admin/list-employees', 'Employees\EmployeeController@list_employees');

Route::get('/admin/hide-employees', 'Employees\EmployeeController@hide_employees');
Route::get('/admin/show-employees', 'Employees\EmployeeController@show_employees');

Route::get('/admin/edit-employees', 'Employees\EmployeeController@edit_employees');
Route::post('/admin/update-employees', 'Employees\EmployeeController@update_employees');

Route::get('/admin/delete-employees', 'Employees\EmployeeController@delete_employees');

## Positions

## Companies