<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * This function to redirect home page
     * created by : DatNQ
     * created at : 31/10/2020
     */
    public function home_page() {
        return view('user_layout');
    }
}
