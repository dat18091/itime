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



#### BACKEND
## Home page admin
Route::get('/admin/dashboard', 'Admin\AdminController@dashboard');