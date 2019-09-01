<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Room;

use App\BookingDetail;

use App\BookingRate;

use App\Booking;

use App\AdditionalPackage;

use App\Bill;

use App\CustomerDetail;

use App\Setting;

use Illuminate\Support\Facades\Validator;

use Mail;

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
        ->orderBy('b_id', 'desc')
        ->get();

        // $Booking = Booking::with('bookingrate','room')->orderBy('b_id', 'desc')
        // ->get();
        // dd($Booking);
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
    public function Setting()
    {
        $allmail = Setting::get();
        // dd($allmail);
        return view('admin.setting')->with('allmail',$allmail);
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
            'r_description' => $request->description,
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

    public function ViewReservation($id,$package)
    {

        if ($package == 0) {
            $packageCheck = 0;
        } else {
            $packageCheck = AdditionalPackage::where('p_price',$package)->pluck('p_name');
        }
         
       
        
        $BookingDetailsCheck = BookingDetail::get();
        
        if ($BookingDetailsCheck != null) {
            $ViewReservation = Booking::with('bookingdetails','bookingrate','customerdetails','room','bill')
            ->where('b_id',$id)->first();
            

            $getBed = BookingDetail::where('bd_booking_id', $id)->get();

                $BedTotalQty = 0;
            foreach ($getBed as $value) {
                $BedTotalQty = $BedTotalQty + $value->bd_additionalbed_quantity; 
            }
            return response()->json(['ViewReservation'=>$ViewReservation, 'packageCheck'=>$packageCheck, 'BedTotalQty'=>$BedTotalQty]);
        } else {
            $ViewReservation = Booking::with('bookingrate', 'customerdetails','room','bill')
            ->where('b_id',$id)->get();
            $BedTotalQty = 0;
            return response()->json(['ViewReservation'=>$ViewReservation, 'packageCheck'=>$packageCheck, 'BedTotalQty'=>$BedTotalQty]);
        }
    }
    public function ConfirmBook($b_id)
    {
        $customer = CustomerDetail::where('cd_bookingid', $b_id)->get();
        
        foreach ($customer as $value) {
            $mail = $value->cd_email;
            $name = $value->cd_salutation.' '.$value->cd_first_name.' '.$value->cd_last_name;
        }

        $data = [
            'name' => $name,
            'bookingId' => $b_id
        ];
        $emails = [$mail];

        $mail = Mail::send('mails.BookingConfirmMail', $data, function($message) use($emails) {
            $message->to($emails)->subject('Monaara - Your reservation is successfully!');
            $message->from('info@monaararesorts.com', 'Monaara Resorts');
        });

        Booking::where('b_id', $b_id)->update([
            'b_status' => 1
        ]);

        return redirect()->back();
    }
    public function live($b_id)
    {
        Booking::where('b_id', $b_id)->update([
            'b_status' => 2
        ]);

        return redirect()->back();
    }
    public function Orders(Request $req)
    {
        Bill::insert([
            'bill_booking_id' => $req->OrderBookingId,
            'bill_pro_qty' => $req->proQty,
            'bill_pro_name' => $req->proName,
            'bill_pro_price' => $req->proPrice,
            'bill_status' => 1
        ]);

        return response()->json();
    }
    public function Print(Request $req)
    {
        Booking::where('b_id', $req->BillBookingId)->update([
            'b_payment_method' => $req->paymentMethod
        ]);

        $billDetails = Bill::where('bill_booking_id', $req->BillBookingId)->get();
            
        $paymentMethod = $req->paymentMethod;
        $BillName = $req->BillName;
        $BillBookingId = $req->BillBookingId;
        $BillArrivalDate = $req->BillArrivalDate;
        $BillDepartureDate = $req->BillDepartureDate;
        $BillCustomerEmail = $req->BillCustomerEmail;
        $BillCustomerContact = $req->BillCustomerContact;
        $BillCustomerCountry = $req->BillCustomerCountry;
        $BillCustomerNote = $req->BillCustomerNote;
        $BillRoomName = $req->BillRoomName;
        $BillRoomQty = $req->BillRoomQty;
        $BillRoomRate = $req->BillRoomRate;
        $BillPackageName = $req->BillPackageName;
        $BillPackageRate = $req->BillPackageRate; 
        $BillBedQty = $req->BillBedQty;
        $BillBedRate = $req->BillBedRate;
        $OrdersProName = $req->OrdersProName;
        $OrdersProQty = $req->OrdersProQty;
        $OrdersProPrice = $req->OrdersProPrice;
        $OrdersGrandTotal = $req->OrdersGrandTotal;

        return view('admin.print')->with('paymentMethod',$paymentMethod)->with('BillName',$BillName)
        ->with('BillBookingId',$BillBookingId)->with('BillArrivalDate',$BillArrivalDate)->with('BillDepartureDate',$BillDepartureDate)
        ->with('BillCustomerEmail',$BillCustomerEmail)->with('BillCustomerContact',$BillCustomerContact)
        ->with('BillCustomerCountry',$BillCustomerCountry)->with('BillCustomerNote',$BillCustomerNote)->with('BillRoomName',$BillRoomName)
        ->with('BillRoomQty',$BillRoomQty)->with('BillRoomRate',$BillRoomRate)->with('BillPackageName',$BillPackageName)
        ->with('BillPackageRate',$BillPackageRate)->with('BillBedQty',$BillBedQty)->with('BillBedRate',$BillBedRate)->with('OrdersProName',$OrdersProName)
        ->with('OrdersProQty',$OrdersProQty)->with('OrdersProPrice',$OrdersProPrice)->with('OrdersGrandTotal',$OrdersGrandTotal)
        ->with('billDetails',$billDetails);
    }
    public function DeleteReservation($id)
    {
       Booking::where('b_id',$id)->delete(); 
       BookingDetail::where('bd_booking_id',$id)->delete();
       BookingRate::where('br_bookingid',$id)->delete();
       Bill::where('bill_booking_id',$id)->delete();

       return response()->json();
    }
    public function BookingComplete($b_id)
    {
        Booking::where('b_id', $b_id)->update([
            'b_status' => 3
        ]);

        return redirect()->back();
    }
    public function NotificationEmail(Request $req)
    {
        // dd($req->email);
        $req->validate([
            'email' => 'required',
        ]);
        if ($req->custom_id == 2) {
            Setting::insert([
                's_mail' => $req->email
            ]);
        }else {
            Setting::where('s_id',1)->update([
                's_mail' => $req->email
            ]);
        }
        

        return redirect()->back();
    }
}
