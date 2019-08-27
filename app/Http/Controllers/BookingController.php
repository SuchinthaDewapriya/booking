<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function ConfirmOrder(Request $req)
    {
       return view('checkout')
       ->with('quantity', $req->quantity)
       ->with('bed', $req->bed)
       ->with('ratebed', $req->ratebed)
       ->with('fixedrate', $req->fixedrate)
       ->with('id', $req->id)
       ->with('image', $req->image)
       ->with('r_name', $req->r_name)
       ->with('additionalPackage', $req->additionalPackage)
       ->with('totalpackageRate', $req->totalpackageRate)
       ->with('bedtotalrate', $req->bedtotalrate)
       ->with('totalpackageRate1', $req->totalpackageRate1)
       ->with('additionalbed', $req->additionalbed)
       ->with('packagerate', $req->packagerate)
       ->with('days', $req->days)
       ->with('checkIn', $req->checkIn)
       ->with('checkOut', $req->checkOut);
    }
}
