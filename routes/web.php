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
Route::get("/", "Home\HomeController@home_page");

#### AUTHENTICATION
## Register
Route::get("/register", "Auth\RegisterController@register");
Route::post("/sign-up", "Auth\RegisterController@sign_up");

## Login
Route::get("/login", "Auth\LoginController@login");
Route::post("/sign-in", "Auth\LoginController@sign_in");

## logout
Route::get("/logout", "Auth\LoginController@logout");

#### BACKEND
## Home page admin
Route::get("/admin/dashboard", "Admin\AdminController@dashboard");

## Access groups
Route::get("/admin/add-access-groups", "AccessGroups\AccessGroupController@add_access_groups");
Route::post("/admin/save-access-groups", "AccessGroups\AccessGroupController@save_access_groups");

Route::get("/admin/list-access-groups", "AccessGroups\AccessGroupController@list_access_groups");

Route::get("/admin/hide-access-groups/{id}", "AccessGroups\AccessGroupController@hide_access_groups");
Route::get("/admin/show-access-groups/{id}", "AccessGroups\AccessGroupController@show_access_groups");

Route::get("/admin/edit-access-groups/{id}", "AccessGroups\AccessGroupController@edit_access_groups");
Route::post("/admin/update-access-groups/{id}", "AccessGroups\AccessGroupController@update_access_groups");

Route::get("/admin/delete-access-groups/{id}", "AccessGroups\AccessGroupController@delete_access_groups");

## Areas
Route::get("/admin/add-areas", "Areas\AreaController@add_areas");
Route::post("/admin/save-areas", "Areas\AreaController@save_areas");

Route::get("/admin/list-areas", "Areas\AreaController@list_areas");

Route::get("/admin/hide-areas/{id}", "Areas\AreaController@hide_areas");
Route::get("/admin/show-areas/{id}", "Areas\AreaController@show_areas");

Route::get("/admin/edit-areas/{id}", "Areas\AreaController@edit_areas");
Route::post("/admin/update-areas/{id}", "Areas\AreaController@update_areas");

Route::get("/admin/delete-areas/{id}", "Areas\AreaController@delete_areas");

Route::get("/admin/api/list-areas", "Areas\AreaController@list_api_areas");

## Branches
Route::get("/admin/add-branches", "Branches\BranchController@add_branches");
Route::post("/admin/save-branches", "Branches\BranchController@save_branches");

Route::get("/admin/list-branches", "Branches\BranchController@list_branches");

Route::get("/admin/hide-branches/{id}", "Branches\BranchController@hide_branches");
Route::get("/admin/show-branches/{id}", "Branches\BranchController@show_branches");

Route::get("/admin/edit-branches/{id}", "Branches\BranchController@edit_branches");
Route::post("/admin/update-branches/{id}", "Branches\BranchController@update_branches");

Route::get("/admin/delete-branches/{id}", "Branches\BranchController@delete_branches");

## Companies
Route::get("/admin/edit-profile/{id}", "Companies\CompanyController@edit_profile");

Route::get("/admin/list-companies", "Companies\CompanyController@list_companies");

## Departments
Route::get("/admin/add-departments", "Departments\DepartmentController@add_departments");
Route::post("/admin/save-departments", "Departments\DepartmentController@save_departments");

Route::get("/admin/list-departments", "Departments\DepartmentController@list_departments");

Route::get("/admin/hide-departments/{id}", "Departments\DepartmentController@hide_departments");
Route::get("/admin/show-departments/{id}", "Departments\DepartmentController@show_departments");

Route::get("/admin/second-departments/{id}", "Departments\DepartmentController@second_departments");
Route::get("/admin/first-departments/{id}", "Departments\DepartmentController@first_departments");

Route::get("/admin/edit-departments/{id}", "Departments\DepartmentController@edit_departments");
Route::post("/admin/update-departments/{id}", "Departments\DepartmentController@update_departments");

Route::get("/admin/delete-departments/{id}", "Departments\DepartmentController@delete_departments");


## Education Levels
Route::get("/admin/add-education-levels", "EducationLevels\EducationLevelController@add_education_levels");
Route::post("/admin/save-education-levels", "EducationLevels\EducationLevelController@save_education_levels");

Route::get("/admin/list-education-levels", "EducationLevels\EducationLevelController@list_education_levels");

Route::get("/admin/hide-education-levels/{id}", "EducationLevels\EducationLevelController@hide_education_levels");
Route::get("/admin/show-education-levels/{id}", "EducationLevels\EducationLevelController@show_education_levels");

Route::get("/admin/edit-education-levels/{id}", "EducationLevels\EducationLevelController@edit_education_levels");
Route::post("/admin/update-education-levels/{id}", "EducationLevels\EducationLevelController@update_education_levels");

Route::get("/admin/delete-education-levels/{id}", "EducationLevels\EducationLevelController@delete_education_levels");


## Employees
Route::get("/admin/add-employees", "Employees\EmployeeController@add_employees");
Route::post("/admin/save-employees", "Employees\EmployeeController@save_employees");

Route::get("/admin/list-employees", "Employees\EmployeeController@list_employees");

Route::get("/admin/hide-employees", "Employees\EmployeeController@hide_employees");
Route::get("/admin/show-employees", "Employees\EmployeeController@show_employees");

Route::get("/admin/edit-employees", "Employees\EmployeeController@edit_employees");
Route::post("/admin/update-employees", "Employees\EmployeeController@update_employees");

Route::get("/admin/delete-employees", "Employees\EmployeeController@delete_employees");


## Positions
Route::get("/admin/add-positions", "Positions\PositionController@add_positions");
Route::post("/admin/save-positions", "Positions\PositionController@save_positions");

Route::get("/admin/list-positions", "Positions\PositionController@list_positions");

Route::get("/admin/hide-positions/{id}", "Positions\PositionController@hide_positions");
Route::get("/admin/show-positions/{id}", "Positions\PositionController@show_positions");

Route::get("/admin/edit-positions/{id}", "Positions\PositionController@edit_positions");
Route::post("/admin/update-positions/{id}", "Positions\PositionController@update_positions");

Route::get("/admin/delete-positions/{id}", "Positions\PositionController@delete_positions");

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
