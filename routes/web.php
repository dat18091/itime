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

## Reason be late
Route::get("/admin/add-be-late-reasons", "BeLateReasons\BeLateReasonController@add_be_late_reasons");
Route::post("/admin/save-be-late-reasons", "BeLateReasons\BeLateReasonController@save_be_late_reasons");

Route::get("/admin/list-be-late-reasons", "BeLateReasons\BeLateReasonController@list_be_late_reasons");
Route::get("/admin/list-be-late-reasons-trash", "BeLateReasons\BeLateReasonController@list_be_late_reasons_trash");

Route::get("/admin/hide-be-late-reasons/{id}", "BeLateReasons\BeLateReasonController@hide_be_late_reasons");
Route::get("/admin/show-be-late-reasons/{id}", "BeLateReasons\BeLateReasonController@show_be_late_reasons");
Route::get("/admin/trash-be-late-reasons/{id}", "BeLateReasons\BeLateReasonController@trash_be_late_reasons");
Route::get("/admin/restore-be-late-reasons/{id}", "BeLateReasons\BeLateReasonController@restore_be_late_reasons");

Route::get("/admin/edit-be-late-reasons/{id}", "BeLateReasons\BeLateReasonController@edit_be_late_reasons");
Route::post("/admin/update-be-late-reasons/{id}", "BeLateReasons\BeLateReasonController@update_be_late_reasons");

Route::get("/admin/delete-be-late-reasons/{id}", "BeLateReasons\BeLateReasonController@delete_be_late_reasons");

## Reason leave soon
Route::get("/admin/add-leave-soon-reasons", "LeaveSoonReasons\LeaveSoonReasonController@add_leave_soon_reasons");
Route::post("/admin/save-leave-soon-reasons", "LeaveSoonReasons\LeaveSoonReasonController@save_leave_soon_reasons");

Route::get("/admin/list-leave-soon-reasons", "LeaveSoonReasons\LeaveSoonReasonController@list_leave_soon_reasons");
Route::get("/admin/list-leave-soon-reasons-trash", "LeaveSoonReasons\LeaveSoonReasonController@list_leave_soon_reasons_trash");

Route::get("/admin/hide-leave-soon-reasons/{id}", "LeaveSoonReasons\LeaveSoonReasonController@hide_leave_soon_reasons");
Route::get("/admin/show-leave-soon-reasons/{id}", "LeaveSoonReasons\LeaveSoonReasonController@show_leave_soon_reasons");
Route::get("/admin/trash-leave-soon-reasons/{id}", "LeaveSoonReasons\LeaveSoonReasonController@trash_leave_soon_reasons");
Route::get("/admin/restore-leave-soon-reasons/{id}", "LeaveSoonReasons\LeaveSoonReasonController@restore_leave_soon_reasons");

Route::get("/admin/edit-leave-soon-reasons/{id}", "LeaveSoonReasons\LeaveSoonReasonController@edit_leave_soon_reasons");
Route::post("/admin/update-leave-soon-reasons/{id}", "LeaveSoonReasons\LeaveSoonReasonController@update_leave_soon_reasons");

Route::get("/admin/delete-leave-soon-reasons/{id}", "LeaveSoonReasons\LeaveSoonReasonController@delete_leave_soon_reasons");

## Type take leave
Route::get("/admin/add-take-leave-types", "TakeLeaveTypes\TakeLeaveTypeController@add_take_leave_types");
Route::post("/admin/save-take-leave-types", "TakeLeaveTypes\TakeLeaveTypeController@save_take_leave_types");

Route::get("/admin/list-take-leave-types", "TakeLeaveTypes\TakeLeaveTypeController@list_take_leave_types");
Route::get("/admin/list-take-leave-types-trash", "TakeLeaveTypes\TakeLeaveTypeController@list_take_leave_types_trash");

Route::get("/admin/hide-take-leave-types/{id}", "TakeLeaveTypes\TakeLeaveTypeController@hide_take_leave_types");
Route::get("/admin/show-take-leave-types/{id}", "TakeLeaveTypes\TakeLeaveTypeController@show_take_leave_types");
Route::get("/admin/trash-take-leave-types/{id}", "TakeLeaveTypes\TakeLeaveTypeController@trash_take_leave_types");
Route::get("/admin/restore-take-leave-types/{id}", "TakeLeaveTypes\TakeLeaveTypeController@restore_take_leave_types");

Route::get("/admin/edit-take-leave-types/{id}", "TakeLeaveTypes\TakeLeaveTypeController@edit_take_leave_types");
Route::post("/admin/update-take-leave-types/{id}", "TakeLeaveTypes\TakeLeaveTypeController@update_take_leave_types");

Route::get("/admin/delete-type-take-leave/{id}", "TakeLeaveTypes\TakeLeaveTypeController@delete_take_leave_types");

## Type date take leave
Route::get("/admin/add-date-take-leave-types", "DateTakeLeaveTypes\DateTakeLeaveTypeController@add_date_take_leave_types");
Route::post("/admin/save-date-take-leave-types", "DateTakeLeaveTypes\DateTakeLeaveTypeController@save_date_take_leave_types");

Route::get("/admin/list-date-take-leave-types", "DateTakeLeaveTypes\DateTakeLeaveTypeController@list_date_take_leave_types");
Route::get("/admin/list-date-take-leave-types-trash", "DateTakeLeaveTypes\DateTakeLeaveTypeController@list_date_take_leave_types_trash");

Route::get("/admin/hide-date-take-leave-types/{id}", "DateTakeLeaveTypes\DateTakeLeaveTypeController@hide_date_take_leave_types");
Route::get("/admin/show-date-take-leave-types/{id}", "DateTakeLeaveTypes\DateTakeLeaveTypeController@show_date_take_leave_types");
Route::get("/admin/trash-date-take-leave-types/{id}", "DateTakeLeaveTypes\DateTakeLeaveTypeController@trash_date_take_leave_types");
Route::get("/admin/restore-date-take-leave-types/{id}", "DateTakeLeaveTypes\DateTakeLeaveTypeController@restore_date_take_leave_types");

Route::get("/admin/edit-date-take-leave-types/{id}", "DateTakeLeaveTypes\DateTakeLeaveTypeController@edit_date_take_leave_types");
Route::post("/admin/update-date-take-leave-types/{id}", "DateTakeLeaveTypes\DateTakeLeaveTypeController@update_date_take_leave_types");

Route::get("/admin/delete-date-take-leave-types/{id}", "DateTakeLeaveTypes\DateTakeLeaveTypeController@delete_date_take_leave_types");

## Take leave manager app and web
Route::get("/admin/approve-takeleave/{id}", "Requirements\RequirementController@approve_takeleave");
Route::get("/admin/denied-takeleave/{id}", "Requirements\RequirementController@denied_takeleave");
Route::get("/admin/trash-takeleave/{id}", "Requirements\RequirementController@trash_takeleave");

Route::get("/admin/list-requirements-takeleave", "Requirements\RequirementController@list_requirements_takeleave");
Route::get("/admin/list-requirements-takeleave-approve", "Requirements\RequirementController@list_requirements_takeleave_approve");
Route::get("/admin/list-requirements-takeleave-denied", "Requirements\RequirementController@list_requirements_takeleave_denied");
Route::get("/admin/list-requirements-takeleave-trash", "Requirements\RequirementController@list_requirements_takeleave_trash");

## Be late manager app and web
Route::get("/admin/approve-late/{id}", "Requirements\RequirementController@approve_late");
Route::get("/admin/denied-late/{id}", "Requirements\RequirementController@denied_late");
Route::get("/admin/trash-late/{id}", "Requirements\RequirementController@trash_late");

Route::get("/admin/list-requirements-late", "Requirements\RequirementController@list_requirements_late");
Route::get("/admin/list-requirements-late-approve", "Requirements\RequirementController@list_requirements_late_approve");
Route::get("/admin/list-requirements-late-denied", "Requirements\RequirementController@list_requirements_late_denied");
Route::get("/admin/list-requirements-late-remove", "Requirements\RequirementController@list_requirements_late_remove");

## Leave soon manager app and web
Route::get("/admin/approve-soon/{id}", "Requirements\RequirementController@approve_soon");
Route::get("/admin/denied-soon/{id}", "Requirements\RequirementController@denied_soon");
Route::get("/admin/trash-soon/{id}", "Requirements\RequirementController@trash_soon");

Route::get("/admin/list-requirements-soon", "Requirements\RequirementController@list_requirements_soon");
Route::get("/admin/list-requirements-soon-approve", "Requirements\RequirementController@list_requirements_soon_approve");
Route::get("/admin/list-requirements-soon-denied", "Requirements\RequirementController@list_requirements_soon_denied");
Route::get("/admin/list-requirements-soon-remove", "Requirements\RequirementController@list_requirements_soon_remove");

## Attendance
Route::get("/admin/list-attendances", "Attendances\AttendanceController@list_attendances");
Route::get("/admin/delete-attendances/{id}", "Attendances\AttendanceController@delete_attendances");
Route::get("/admin/list-attendances-history", "Attendances\AttendanceController@list_attendances_history");

## Voyager
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
