<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Room;

use App\AdditionalPackage;

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
        return view('admin.reservations');
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

    public function AddNewPackage(Request $request)
    {
        // dd($request->all());
        $NewRoom = AdditionalPackage::insert([
            'p_name' => $request->packageName,
            'p_price' => $request->packageRate,
            'p_additional_bed' => $request->additionalBedRate,
            'p_status' => 1
        ]);
        
        $getPackage = AdditionalPackage::get();

        return response()->json(['getPackage'=>$getPackage]);
    }
    public function DeleteAllPackages()
    {
        $deleteAll = Room::truncate();
        
        $getRoom = Room::get();
        return response()->json(['getRoom'=>$getRoom]);
    }
    public function PackageDelete($id)
    {

        Room::where('r_id',$id)->delete();

        $getRoom = Room::get();
        return response()->json(['getRoom'=>$getRoom]);
    }
    function Packagedit($id) {
        $editRoom = Room::where('r_id', $id)->first();

        return $editRoom;
    }
}
