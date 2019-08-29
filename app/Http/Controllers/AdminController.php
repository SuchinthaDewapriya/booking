<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Room;

use App\BookingDetail;

use App\BookingRate;

use App\Booking;


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
    public function Reservations()
    {
        $Booking = Booking::join('booking_rates', 'bookings.b_id', '=', 'booking_rates.br_bookingid')
        ->join('rooms', 'bookings.b_rid', '=', 'rooms.r_id')
        ->get();
        return view('admin.reservations')->with('Booking',$Booking);
    }
    public function Rooms()
    {
        $room = Room::get();
        return view('admin.rooms')->with('room', $room);
    }
    public function Packages()
    {
        $Package = AdditionalPackage::get();
        return view('admin.packages')->with('Package',$Package);
    }
    public function AddNewRoom(Request $request)
    {
        // dd($request->all());
        $imageName = time().'.'.request()->roomImage->getClientOriginalExtension();  
        request()->roomImage->move(public_path('images/rooms'), $imageName);

        $NewRoom = Room::insert([
            'r_name' => $request->roomName,
            'r_price' => $request->roomRate,
            'r_quantity' => $request->roomQuantity,
            'r_bookquantity' => 0,
            'r_additional_bed' => $request->additionalBedRate,
            'r_image' => $imageName,
            'r_status' => 1
        ]);
        
        $getRoom = Room::get();

        return response()->json(['getRoom'=>$getRoom]);
    }
    public function DeleteAllRooms()
    {
        $deleteAll = Room::truncate();
        
        $getRoom = Room::get();
        return response()->json(['getRoom'=>$getRoom]);
    }
    public function RoomDelete($id)
    {

        Room::where('r_id',$id)->delete();

        $getRoom = Room::get();
        return response()->json(['getRoom'=>$getRoom]);
    }
    function RoomEdit($id) {
        $editRoom = Room::where('r_id', $id)->first();

        return $editRoom;
    }
    public function RoomUpdate(Request $request)
    {
        $imageName = time().'.'.request()->roomImage->getClientOriginalExtension();  
        request()->roomImage->move(public_path('images/rooms'), $imageName);

        $updateRoom = Room::where('r_id', $request->updateRoomId)->update([
            'r_name' => $request->roomName,
            'r_price' => $request->roomRate,
            'r_quantity' => $request->roomQuantity,
            'r_additional_bed' => $request->additionalBedRate,
            'r_image' => $imageName,
            'r_status' => 1
        ]);
        $getRoom = Room::get();
        return response()->json(['getRoom'=>$getRoom]);
    }


    public function AddNewPackage(Request $request)
    {
        // dd($request->all());
        $NewPackage = AdditionalPackage::insert([
            'p_name' => $request->PackageName,
            'p_price' => $request->PackageRate,
            'p_additional_bed' => $request->additionalBedRate,
            'p_status' => 1
        ]);
        
        $getPackage = AdditionalPackage::get();

        return response()->json(['getPackage'=>$getPackage]);
    }
    public function DeleteAllPackages()
    {
        $deleteAll = AdditionalPackage::truncate();
        
        $getPackage = AdditionalPackage::get();
        return response()->json(['getPackage'=>$getPackage]);
    }
    public function PackageDelete($id)
    {

        AdditionalPackage::where('p_id',$id)->delete();

        $getPackage = AdditionalPackage::get();
        return response()->json(['getPackage'=>$getPackage]);
    }
    function PackageEdit(Request $request, $id) {
        $editPackage = AdditionalPackage::where('p_id', $id)->first();

        return $editPackage;
    }
    public function PackageUpdate(Request $request)
    {
        $updatePackage = AdditionalPackage::where('p_id', $request->UpdatePackageId)->update([
            'p_name' => $request->PackageName,
            'p_price' => $request->PackageRate,
            'p_additional_bed' => $request->additionalBedRate,
            'p_status' => 1
        ]);
        $getPackage = AdditionalPackage::get();
        return response()->json(['getPackage'=>$getPackage]);
    }
    //Reservaion page

    public function ViewReservation($id)
    {
        
        $BookingDetailsCheck = BookingDetail::get();
        
        if ($BookingDetailsCheck == null) {
            $ViewReservation = Booking::with('bookingdetails', 'bookingrate')->where('b_id',$id)->first();

            // $ViewReservation = Booking::join('booking_rates', 'bookings.b_id', '=', 'booking_rates.br_bookingid')
            // ->join('booking_details', 'bookings.b_id', '=', 'booking_details.bd_booking_id')
            // ->join('customer_details', 'bookings.b_id', '=', 'customer_details.cd_bookingid')
            // ->join('rooms', 'bookings.b_rid', '=', 'rooms.r_id')
            // ->where('b_id',$id)
            // ->first();
        } else {
            $ViewReservation = Booking::join('booking_rates', 'bookings.b_id', '=', 'booking_rates.br_bookingid')
            ->join('rooms', 'bookings.b_rid', '=', 'rooms.r_id')
            ->join('customer_details', 'bookings.b_id', '=', 'customer_details.cd_bookingid')
            ->where('b_id',$id)
            ->first();
        }
        return response()->json(['ViewReservation'=>$ViewReservation]);
    }
}
