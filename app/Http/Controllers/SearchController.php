<?php

namespace App\Http\Controllers;

use App\Booking;

use App\Room;

use App\AdditionalPackage;

// use Cart;

use Carbon\Carbon;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function reservation()
    {
        // $cart = Cart::getContent();
        // // dd($cart);
        // return view('reservation')->with('data',$cart);
        return view('reservation');
    }
    function CheckAvailability(Request $request) {
            // $checkBooking = Booking::whereBetween('b_checkoutdate', [$request->checkIn, $request->checkOut])
            //     ->pluck('b_id');

            // $checkBookingRID = Booking::whereBetween('b_checkoutdate', [$request->checkIn, $request->checkOut])
            // ->pluck('b_rid');

            // if (count($checkBooking) > 0) {
            //     $test = Booking::where('b_id',$checkBooking)->pluck('b_quantity');
            //     $roomQuantity = Room::where('r_id', '=', $checkBookingRID)->where('r_quantity','>=', $test)->pluck('r_id');
            //     $checkRoom = Room::whereNotIn('r_id',$roomQuantity)->get();
            // } else {
            //     $checkRoom = Room::get();
            // }
            
           
            // dd($checkBooking);
            //  if (count($checkBooking) > 0) {

                
            //      foreach ($checkBooking as $value) {
            //         $roomQuantity = Room::where('r_id',$value->b_rid)->where('r_quantity','<=', $value->b_quantity)->pluck('r_id');
            //      }

            //         $checkRoom = Room::wherenotIn('r_id',$roomQuantity)->get();
                
                
            //  } else {
            //     $checkRoom = Room::get();

            //  }

            $checkBooking = Booking::latest('b_checkoutdate')->where('b_checkoutdate', '>=' ,$request->checkIn)
            ->pluck('b_rid');
            
            $checkOutDate = Carbon::parse($request->checkOut);
            $checkInDate = Carbon::parse($request->checkIn);

            $packages = AdditionalPackage::get();

            $days = $checkOutDate->diffInDays($checkInDate);

            $id = 0;
            if ( count($checkBooking) > 0 ) {
                $room = Room::where('r_id',$checkBooking)->get();
                foreach ($room as $rooms) {
                    if ($rooms->r_bookquantity != 0) {
                        $checkRoom = Room::get();
                    } 
                    else{
                        $checkRoom = Room::whereNotIn('r_id',$checkBooking)->get();
                    }   
                    $id = 1;
                    return response()->json(['checkIn' => $request->checkIn, 'checkOut' => $request->checkOut, 'checkRoom' => $checkRoom, 'id' => $id, 'days' => $days, 'packages' => $packages]);
                }
            } else {
                $checkRoom = Room::get();
                $id = 2;
                return response()->json(['checkIn' => $request->checkIn, 'checkOut' => $request->checkOut, 'checkRoom' => $checkRoom, 'id' => $id, 'days' => $days, 'packages' => $packages]);
            }
  
        
    }
    // public function Addtocart(Request $request,$id)
    // {
    //     // dd($request->all());
    //     if (Cart::getContent($id)) {
    //         Cart::update($id, array(
    //             'name' => $request->r_name,
    //             'price' => $request->r_rate,
    //             'quantity' => array(
    //                 'relative' => false,
    //                 'value' => $request->r_quantity,
    //             ),
    //             'attributes' => array(
    //                 'days' => $request->r_days,
    //                 'image' => $request->r_image,
    //             )
    //         ));
    //     }else{
    //         Cart::add(array(
    //             'id' => $id,
    //             'name' => $request->r_name,
    //             'price' => $request->r_rate,
    //             'quantity' => $request->r_quantity,
    //             'attributes' => array(
    //                 'days' => $request->r_days,
    //                 'image' => $request->r_image,
    //             )
    //         ));
    //     }
        
    //     return Cart::getContent();
    // }

}
