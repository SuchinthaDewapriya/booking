<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Index()
    {
        return view('admin.index');
    }
    public function Bookings()
    {
        return view('admin.bookings');
    }
}
