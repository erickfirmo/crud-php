<?php

namespace App\Controllers;

use App\Models\Customer;

class HomeController extends Controller {

    // página home
    public function index()
    {
        $customers = (new Customer())->select()->get();

        return view('home', ['customers' => $customers]);
    }
}