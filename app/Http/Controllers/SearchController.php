<?php

namespace App\Http\Controllers;

use App\Booking;

use App\Room;

use App\AdditionalPackage;

use Illuminate\Support\Facades\Validator;

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

            $validator = Validator::make($request->all(),[
                'checkOut' => 'required',
                'checkIn' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()->all()]);
            }
            

            $checkBookingId = Booking::where('b_checkoutdate', '>=' ,$request->checkIn)
            ->where('b_checkindate', '<=' ,$request->checkOut)
            ->pluck('b_rid');

            

            
            // dd($checkBookingId);
            // $DifferenceQty =  number_format($roomQty) - number_format($BookingQty);

            $checkOutDate = Carbon::parse($request->checkOut);
            $checkInDate = Carbon::parse($request->checkIn);

            $packages = AdditionalPackage::get();

            $days = $checkOutDate->diffInDays($checkInDate);
 
            $id = 0;
            if ( count($checkBookingId) > 0 ) {
            //     $newBookingQty = Booking::where('b_checkoutdate', '>=' ,$request->checkIn)
            // ->where('b_checkindate', '<=' ,$request->checkOut)
            // ->pluck('b_rquantity');
            $BookingQty = Booking::where('b_checkoutdate', '>=' ,$request->checkIn)
            ->where('b_checkindate', '<=' ,$request->checkOut)
            ->get();
                $newBookingQty = 0;
            foreach ($BookingQty as $value) {
                $newBookingQty = $newBookingQty + $value->b_rquantity;
            }
                $room = Room::where('r_id',$checkBookingId)->get();
                $roomQty = Room::where('r_id',$checkBookingId)->pluck('r_quantity');
                foreach ($room as $rooms) {
                    if ($rooms->r_quantity >= $newBookingQty) {
                        $checkRoom = Room::get();
                    } 
                    else{
                        $checkRoom = Room::whereNotIn('r_id',$checkBookingId)->get();
                    }   
                    $id = 1;
                    return response()->json(['BookingQty' => $newBookingQty, 'roomQty' => $roomQty, 'checkIn' => $request->checkIn, 'checkOut' => $request->checkOut, 'checkRoom' => $checkRoom, 'id' => $id, 'days' => $days, 'packages' => $packages]);
                }
            } else {
                $checkRoom = Room::get();
                $id = 2;
                return response()->json(['checkIn' => $request->checkIn, 'checkOut' => $request->checkOut, 'checkRoom' => $checkRoom, 'id' => $id, 'days' => $days, 'packages' => $packages]);
            }

            //..............................................

            // $checkBooking = Booking::where('b_status',1)->where('b_checkoutdate', '>=' ,$request->checkIn)
            // ->pluck('b_rid');
            
            // $checkOutDate = Carbon::parse($request->checkOut);
            // $checkInDate = Carbon::parse($request->checkIn);

            // $packages = AdditionalPackage::get();

            // $days = $checkOutDate->diffInDays($checkInDate);

            // $id = 0;
            // if ( count($checkBooking) > 0 ) {
            //     $room = Room::where('r_id',$checkBooking)->get();
            //     foreach ($room as $rooms) {
            //         if ($rooms->r_bookquantity != 0) {
            //             $checkRoom = Room::get();
            //         } 
            //         else{
            //             $checkRoom = Room::whereNotIn('r_id',$checkBooking)->get();
            //         }   
            //         $id = 1;
            //         return response()->json(['checkIn' => $request->checkIn, 'checkOut' => $request->checkOut, 'checkRoom' => $checkRoom, 'id' => $id, 'days' => $days, 'packages' => $packages]);
            //     }
            // } else {
            //     $checkRoom = Room::get();
            //     $id = 2;
            //     return response()->json(['checkIn' => $request->checkIn, 'checkOut' => $request->checkOut, 'checkRoom' => $checkRoom, 'id' => $id, 'days' => $days, 'packages' => $packages]);
            // }
  
        
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
