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
Route::get("/admin/list-access-groups-trash", "AccessGroups\AccessGroupController@list_access_groups_trash");

Route::get("/admin/hide-access-groups/{id}", "AccessGroups\AccessGroupController@hide_access_groups");
Route::get("/admin/show-access-groups/{id}", "AccessGroups\AccessGroupController@show_access_groups");
Route::get("/admin/trash-access-groups/{id}", "AccessGroups\AccessGroupController@trash_access_groups");
Route::get("/admin/restore-access-groups/{id}", "AccessGroups\AccessGroupController@restore_access_groups");

Route::get("/admin/edit-access-groups/{id}", "AccessGroups\AccessGroupController@edit_access_groups");
Route::post("/admin/update-access-groups/{id}", "AccessGroups\AccessGroupController@update_access_groups");

Route::get("/admin/delete-access-groups/{id}", "AccessGroups\AccessGroupController@delete_access_groups");

## Areas
Route::get("/admin/add-areas", "Areas\AreaController@add_areas");
Route::post("/admin/save-areas", "Areas\AreaController@save_areas");

Route::get("/admin/list-areas", "Areas\AreaController@list_areas");
Route::get("/admin/list-areas-trash", "Areas\AreaController@list_areas_trash");

Route::get("/admin/hide-areas/{id}", "Areas\AreaController@hide_areas");
Route::get("/admin/show-areas/{id}", "Areas\AreaController@show_areas");
Route::get("/admin/trash-areas/{id}", "Areas\AreaController@trash_areas");
Route::get("/admin/restore-areas/{id}", "Areas\AreaController@restore_areas");

Route::get("/admin/edit-areas/{id}", "Areas\AreaController@edit_areas");
Route::post("/admin/update-areas/{id}", "Areas\AreaController@update_areas");

Route::get("/admin/delete-areas/{id}", "Areas\AreaController@delete_areas");

Route::get("/admin/api/list-areas", "Areas\AreaController@list_api_areas");

## Branches
Route::get("/admin/add-branches", "Branches\BranchController@add_branches");
Route::post("/admin/save-branches", "Branches\BranchController@save_branches");

Route::get("/admin/list-branches", "Branches\BranchController@list_branches");
Route::get("/admin/list-branches-trash", "Branches\BranchController@list_branches_trash");

Route::get("/admin/hide-branches/{id}", "Branches\BranchController@hide_branches");
Route::get("/admin/show-branches/{id}", "Branches\BranchController@show_branches");
Route::get("/admin/trash-branches/{id}", "Branches\BranchController@trash_branches");
Route::get("/admin/restore-branches/{id}", "Branches\BranchController@restore_branches");

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
Route::get("/admin/list-departments-trash", "Departments\DepartmentController@list_departments_trash");

Route::get("/admin/hide-departments/{id}", "Departments\DepartmentController@hide_departments");
Route::get("/admin/show-departments/{id}", "Departments\DepartmentController@show_departments");
Route::get("/admin/trash-departments/{id}", "Departments\DepartmentController@trash_departments");
Route::get("/admin/restore-departments/{id}", "Departments\DepartmentController@restore_departments");

Route::get("/admin/second-departments/{id}", "Departments\DepartmentController@second_departments");
Route::get("/admin/first-departments/{id}", "Departments\DepartmentController@first_departments");

Route::get("/admin/edit-departments/{id}", "Departments\DepartmentController@edit_departments");
Route::post("/admin/update-departments/{id}", "Departments\DepartmentController@update_departments");

Route::get("/admin/delete-departments/{id}", "Departments\DepartmentController@delete_departments");


## Education Levels
Route::get("/admin/add-education-levels", "EducationLevels\EducationLevelController@add_education_levels");
Route::post("/admin/save-education-levels", "EducationLevels\EducationLevelController@save_education_levels");

Route::get("/admin/list-education-levels", "EducationLevels\EducationLevelController@list_education_levels");
Route::get("/admin/list-education-levels-trash", "EducationLevels\EducationLevelController@list_education_levels_trash");

Route::get("/admin/hide-education-levels/{id}", "EducationLevels\EducationLevelController@hide_education_levels");
Route::get("/admin/show-education-levels/{id}", "EducationLevels\EducationLevelController@show_education_levels");
Route::get("/admin/trash-education-levels/{id}", "EducationLevels\EducationLevelController@trash_education_levels");
Route::get("/admin/restore-education-levels/{id}", "EducationLevels\EducationLevelController@restore_education_levels");

Route::get("/admin/edit-education-levels/{id}", "EducationLevels\EducationLevelController@edit_education_levels");
Route::post("/admin/update-education-levels/{id}", "EducationLevels\EducationLevelController@update_education_levels");

Route::get("/admin/delete-education-levels/{id}", "EducationLevels\EducationLevelController@delete_education_levels");


## Employees
Route::get("/admin/add-employees", "Employees\EmployeeController@add_employees");
Route::post("/admin/save-employees", "Employees\EmployeeController@save_employees");

Route::get("/admin/list-employees", "Employees\EmployeeController@list_employees");
Route::get("/admin/list-employees-trash", "Employees\EmployeeController@list_employees_trash");

Route::get("/admin/hide-employees/{id}", "Employees\EmployeeController@hide_employees");
Route::get("/admin/show-employees/{id}", "Employees\EmployeeController@show_employees");
Route::get("/admin/trash-employees/{id}", "Employees\EmployeeController@trash_employees");
Route::get("/admin/restore-employees/{id}", "Employees\EmployeeController@restore_employees");

Route::get("/admin/renew-permit/{id}", "Employees\EmployeeController@renew_permit");
Route::get("/admin/terminate-permit/{id}", "Employees\EmployeeController@terminate_permit");

Route::get("/admin/edit-employees/{id}", "Employees\EmployeeController@edit_employees");
Route::post("/admin/update-employees/{id}", "Employees\EmployeeController@update_employees");

Route::get("/admin/delete-employees/{id}", "Employees\EmployeeController@delete_employees");

## Positions
Route::get("/admin/add-positions", "Positions\PositionController@add_positions");
Route::post("/admin/save-positions", "Positions\PositionController@save_positions");

Route::get("/admin/list-positions", "Positions\PositionController@list_positions");
Route::get("/admin/list-positions-trash", "Positions\PositionController@list_positions_trash");

Route::get("/admin/hide-positions/{id}", "Positions\PositionController@hide_positions");
Route::get("/admin/show-positions/{id}", "Positions\PositionController@show_positions");
Route::get("/admin/trash-positions/{id}", "Positions\PositionController@trash_positions");
Route::get("/admin/restore-positions/{id}", "Positions\PositionController@restore_positions");

Route::get("/admin/edit-positions/{id}", "Positions\PositionController@edit_positions");
Route::post("/admin/update-positions/{id}", "Positions\PositionController@update_positions");

Route::get("/admin/delete-positions/{id}", "Positions\PositionController@delete_positions");

## Requirements
Route::get("/admin/list-requirements-takeleave", "Requirements\RequirementController@list_requirements_takeleave");
Route::get("/admin/list-requirements-soon", "Requirements\RequirementController@list_requirements_soon");
Route::get("/admin/list-requirements-late", "Requirements\RequirementController@list_requirements_late");

## Shifts
Route::get("/admin/add-shifts", "Shifts\ShiftController@add_shifts");
Route::post("/admin/save-shifts", "Shifts\ShiftController@save_shifts");

Route::get("/admin/list-shifts", "Shifts\ShiftController@list_shifts");
Route::get("/admin/list-shifts-trash", "Shifts\ShiftController@list_shifts_trash");

Route::get("/admin/hide-shifts/{id}", "Shifts\ShiftController@hide_shifts");
Route::get("/admin/show-shifts/{id}", "Shifts\ShiftController@show_shifts");
Route::get("/admin/trash-shifts/{id}", "Shifts\ShiftController@trash_shifts");
Route::get("/admin/restore-shifts/{id}", "Shifts\ShiftController@restore_shifts");

Route::get("/admin/edit-shifts/{id}", "Shifts\ShiftController@edit_shifts");
Route::post("/admin/update-shifts/{id}", "Shifts\ShiftController@update_shifts");

Route::get("/admin/delete-shifts/{id}", "Shifts\ShiftController@delete_shifts");

## Reason take leave
Route::get("/admin/add-take-leave-reasons", "TakeLeaveReasons\TakeLeaveReasonController@add_take_leave_reasons");
Route::post("/admin/save-take-leave-reasons", "TakeLeaveReasons\TakeLeaveReasonController@save_take_leave_reasons");

Route::get("/admin/list-take-leave-reasons", "TakeLeaveReasons\TakeLeaveReasonController@list_take_leave_reasons");
Route::get("/admin/list-take-leave-reasons-trash", "TakeLeaveReasons\TakeLeaveReasonController@list_take_leave_reasons_trash");

Route::get("/admin/hide-take-leave-reasons/{id}", "TakeLeaveReasons\TakeLeaveReasonController@hide_take_leave_reasons");
Route::get("/admin/show-take-leave-reasons/{id}", "TakeLeaveReasons\TakeLeaveReasonController@show_take_leave_reasons");
Route::get("/admin/trash-take-leave-reasons/{id}", "TakeLeaveReasons\TakeLeaveReasonController@trash_take_leave_reasons");
Route::get("/admin/restore-take-leave-reasons/{id}", "TakeLeaveReasons\TakeLeaveReasonController@restore_take_leave_reasons");

Route::get("/admin/edit-take-leave-reasons/{id}", "TakeLeaveReasons\TakeLeaveReasonController@edit_take_leave_reasons");
Route::post("/admin/update-take-leave-reasons/{id}", "TakeLeaveReasons\TakeLeaveReasonController@update_take_leave_reasons");

Route::get("/admin/delete-take-leave-reasons/{id}", "TakeLeaveReasons\TakeLeaveReasonController@delete_take_leave_reasons");

## Reason be late (Pending)
Route::get("/admin/add-be-late-reasons", "BeLateReasons\ShiftController@add_be_late_reasons");
Route::post("/admin/save-be-late-reasons", "BeLateReasons\ShiftController@save_be_late_reasons");

Route::get("/admin/list-be-late-reasons", "BeLateReasons\ShiftController@list_be_late_reasons");
Route::get("/admin/list-be-late-reasons-trash", "BeLateReasons\ShiftController@list_be_late_reasons_trash");

Route::get("/admin/hide-be-late-reasons/{id}", "BeLateReasons\ShiftController@hide_be_late_reasons");
Route::get("/admin/show-be-late-reasons/{id}", "BeLateReasons\ShiftController@show_be_late_reasons");
Route::get("/admin/trash-be-late-reasons/{id}", "BeLateReasons\ShiftController@trash_be_late_reasons");
Route::get("/admin/restore-be-late-reasons/{id}", "BeLateReasons\ShiftController@restore_be_late_reasons");

Route::get("/admin/edit-be-late-reasons/{id}", "BeLateReasons\ShiftController@edit_be_late_reasons");
Route::post("/admin/update-be-late-reasons/{id}", "BeLateReasons\ShiftController@update_be_late_reasons");

Route::get("/admin/delete-be-late-reasons/{id}", "BeLateReasons\ShiftController@delete_be_late_reasons");

## Reason leave soon (Pending)
Route::get("/admin/add-reason-leave-soon", "Shifts\ShiftController@add_reason_leave_soon");
Route::post("/admin/save-reason-leave-soon", "Shifts\ShiftController@save_reason_leave_soon");

Route::get("/admin/list-reason-leave-soon", "Shifts\ShiftController@list_reason_leave_soon");
Route::get("/admin/list-reason-leave-soon-trash", "Shifts\ShiftController@list_reason_leave_soon_trash");

Route::get("/admin/hide-reason-leave-soon/{id}", "Shifts\ShiftController@hide_reason_leave_soon");
Route::get("/admin/show-reason-leave-soon/{id}", "Shifts\ShiftController@show_reason_leave_soon");
Route::get("/admin/trash-reason-leave-soon/{id}", "Shifts\ShiftController@trash_reason_leave_soon");
Route::get("/admin/restore-reason-leave-soon/{id}", "Shifts\ShiftController@restore_reason_leave_soon");

Route::get("/admin/edit-reason-leave-soon/{id}", "Shifts\ShiftController@edit_reason_leave_soon");
Route::post("/admin/update-reason-leave-soon/{id}", "Shifts\ShiftController@update_reason_leave_soon");

Route::get("/admin/delete-reason-leave-soon/{id}", "Shifts\ShiftController@delete_reason_leave_soon");

## Type take leave (Pending)
Route::get("/admin/add-type-take-leave", "Shifts\ShiftController@add_type_take_leave");
Route::post("/admin/save-type-take-leave", "Shifts\ShiftController@save_type_take_leave");

Route::get("/admin/list-type-take-leave", "Shifts\ShiftController@list_type_take_leave");
Route::get("/admin/list-type-take-leave-trash", "Shifts\ShiftController@list_type_take_leave_trash");

Route::get("/admin/hide-type-take-leave/{id}", "Shifts\ShiftController@hide_type_take_leave");
Route::get("/admin/show-type-take-leave/{id}", "Shifts\ShiftController@show_type_take_leave");
Route::get("/admin/trash-type-take-leave/{id}", "Shifts\ShiftController@trash_type_take_leave");
Route::get("/admin/restore-type-take-leave/{id}", "Shifts\ShiftController@restore_type_take_leave");

Route::get("/admin/edit-type-take-leave/{id}", "Shifts\ShiftController@edit_type_take_leave");
Route::post("/admin/update-type-take-leave/{id}", "Shifts\ShiftController@update_type_take_leave");

Route::get("/admin/delete-type-take-leave/{id}", "Shifts\ShiftController@delete_type_take_leave");

## Type date take leave (Pending)
Route::get("/admin/add-type-date-take-leave", "Shifts\ShiftController@add_type_date_take_leave");
Route::post("/admin/save-type-date-take-leave", "Shifts\ShiftController@save_type_date_take_leave");

Route::get("/admin/list-type-date-take-leave", "Shifts\ShiftController@list_type_date_take_leave");
Route::get("/admin/list-type-date-take-leave-trash", "Shifts\ShiftController@list_type_date_take_leave_trash");

Route::get("/admin/hide-type-date-take-leave/{id}", "Shifts\ShiftController@hide_type_date_take_leave");
Route::get("/admin/show-type-date-take-leave/{id}", "Shifts\ShiftController@show_type_date_take_leave");
Route::get("/admin/trash-type-date-take-leave/{id}", "Shifts\ShiftController@trash_type_date_take_leave");
Route::get("/admin/restore-type-date-take-leave/{id}", "Shifts\ShiftController@restore_type_date_take_leave");

Route::get("/admin/edit-type-date-take-leave/{id}", "Shifts\ShiftController@edit_type_date_take_leave");
Route::post("/admin/update-type-date-take-leave/{id}", "Shifts\ShiftController@update_type_date_take_leave");

Route::get("/admin/delete-type-date-take-leave/{id}", "Shifts\ShiftController@delete_type_date_take_leave");

## Take leave manager app and web (Pending)

## Be late manager app and web (Pending)

## Leave soon manager app and web (Pending)

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
