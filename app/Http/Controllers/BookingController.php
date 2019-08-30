<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Booking;

use App\BookingDetail;

use App\BookingRate;

use App\Room;

use App\CustomerDetail;

use App\Setting;

use Mail;

class BookingController extends Controller
{
    public function ConfirmOrder(Request $req)
    {
        $setting = Setting::get();

       return view('checkout')
       ->with('setting',$setting)
       ->with('package', $req->package)
       ->with('quantity', $req->quantity)
       ->with('bed', $req->bed)
       ->with('ratebed', $req->ratebed)
       ->with('fixedrate', $req->fixedrate)
       ->with('id', $req->id)
       ->with('image', $req->image)
       ->with('r_name', $req->r_name)
       ->with('additionalPackage', $req->additionalPackage)
       ->with('TotalRoomRate', $req->TotalRoomRate)
       ->with('TotalBedRate', $req->TotalBedRate)
       ->with('TotalPackageRate', $req->TotalPackageRate)
       ->with('FinalTotal', $req->FinalTotal)
       ->with('additionalbed', $req->additionalbed)
       ->with('packagerate', $req->packagerate)
       ->with('days', $req->days)
       ->with('checkIn', $req->checkIn)
       ->with('checkOut', $req->checkOut);
    }
    public function BookingTable(Request $req)
    {
        $package = $req->package;
        $quantity = $req->quantity;
        $bed = $req->bed;
        $ratebed = $req->ratebed;
        $fixedrate = $req->fixedrate;
        $id = $req->id;
        $image = $req->image;
        $r_name = $req->r_name;
        $additionalPackage = $req->additionalPackage;
        $TotalRoomRate = $req->TotalRoomRate;
        $TotalBedRate = $req->TotalBedRate;
        $TotalPackageRate = $req->TotalPackageRate;
        $FinalTotal = $req->FinalTotal;
        $additionalbed = $req->additionalbed;
        $packagerate = $req->packagerate;
        $days = $req->days;
        $checkIn = $req->checkIn;
        $checkOut = $req->checkOut;

        $OWNER_MAIL = $req->OwnerMail;
        $CUSTOMER_NAME = $req->salutation.' '.$req->fname.' '.$req->lname;
        $CUSTOMER_EMAIL = $req->email;


        $BookingTable = Booking::insertGetId([
            'b_rid' => $req->id,
            'b_checkindate' => $req->checkIn,
            'b_checkoutdate' => $req->checkOut,
            'b_rquantity' => $req->quantity,
            'b_package' => $req->package,
            'b_status' => 0
        ]);


        $UserRegister = CustomerDetail::insertGetId([
            'cd_bookingid' => $BookingTable,
            'cd_salutation' => $req->salutation,
            'cd_first_name' => $req->fname,
            'cd_last_name' => $req->lname,
            'cd_email' => $req->email,
            'cd_phone' => $req->mobile,
            'cd_country' => $req->country,
            'cd_note' => $req->note,
            'cd_status' => 1
        ]);

        return $this->BookingDetailsTable($quantity,$bed,$ratebed,
        $fixedrate,$id,$image,$r_name,$additionalPackage,$TotalRoomRate,
        $TotalBedRate,$TotalPackageRate,$FinalTotal,$additionalbed,
        $packagerate,$days,$checkIn,$checkOut,$BookingTable,$CUSTOMER_NAME,$CUSTOMER_EMAIL,$OWNER_MAIL);
    }
    public function BookingDetailsTable($quantity,$bed,$ratebed,
    $fixedrate,$id,$image,$r_name,$additionalPackage,$TotalRoomRate,
    $TotalBedRate,$TotalPackageRate,$FinalTotal,$additionalbed,
    $packagerate,$days,$checkIn,$checkOut,$BookingTable,$CUSTOMER_NAME,$CUSTOMER_EMAIL,$OWNER_MAIL)
    {
       

        if ($bed == '') {
            $bedFiled = array();
            $bedFiled = $bed;
            $dataSet = [];

            foreach ($bedFiled as $value) {
                $dataSet[] = [
                    'bd_booking_id' => $BookingTable,
                    'bd_additionalbed_quantity' => $value,
                    'bd_status' => 1
                ];
            }
            BookingDetail::insert($dataSet);
        }
        
       

        return $this->BookingRatesTable($quantity,$bed,$ratebed,
        $fixedrate,$id,$image,$r_name,$additionalPackage,$TotalRoomRate,
        $TotalBedRate,$TotalPackageRate,$FinalTotal,$additionalbed,
        $packagerate,$days,$checkIn,$checkOut,$BookingTable,$CUSTOMER_NAME,$CUSTOMER_EMAIL,$OWNER_MAIL);
    }
    public function BookingRatesTable($quantity,$bed,$ratebed,
    $fixedrate,$id,$image,$r_name,$additionalPackage,$TotalRoomRate,
    $TotalBedRate,$TotalPackageRate,$FinalTotal,$additionalbed,
    $packagerate,$days,$checkIn,$checkOut,$BookingTable,$CUSTOMER_NAME,$CUSTOMER_EMAIL,$OWNER_MAIL)
    {
        BookingRate::insert([
            'br_bookingid' => $BookingTable,
            'br_roomRate' => $TotalRoomRate,
            'br_packageRate' => $TotalPackageRate,
            'br_bedmRate' => $TotalBedRate,
            'br_totalRate' => $FinalTotal,
        ]);
        return $this->Customermail($quantity,$bed,$ratebed,
        $fixedrate,$id,$image,$r_name,$additionalPackage,$TotalRoomRate,
        $TotalBedRate,$TotalPackageRate,$FinalTotal,$additionalbed,
        $packagerate,$days,$checkIn,$checkOut,$BookingTable,$CUSTOMER_NAME,$CUSTOMER_EMAIL,$OWNER_MAIL);
    }
    public function Customermail($quantity,$bed,$ratebed,
    $fixedrate,$id,$image,$r_name,$additionalPackage,$TotalRoomRate,
    $TotalBedRate,$TotalPackageRate,$FinalTotal,$additionalbed,
    $packagerate,$days,$checkIn,$checkOut,$BookingTable,$CUSTOMER_NAME,$CUSTOMER_EMAIL,$OWNER_MAIL)
    {
        $data = [
            'mail' => $CUSTOMER_EMAIL,
            'name' => $CUSTOMER_NAME,
            'bookingId' => $BookingTable
        ];
        $emails = [$CUSTOMER_EMAIL]; 

        $mail = Mail::send('mails.BookingCustomerMail', $data, function($message) use($emails) {
            $message->to($emails)->subject('Customer Mail');
        });

        return $this->Ownermail($BookingTable,$CUSTOMER_NAME,$CUSTOMER_EMAIL,$OWNER_MAIL);
    }
    public function Ownermail($BookingTable,$CUSTOMER_NAME,$CUSTOMER_EMAIL,$OWNER_MAIL)
    {
        $data = [
            'name' => $CUSTOMER_NAME,
            'bookingId' => $BookingTable
        ];
        $emails = [$OWNER_MAIL];

        $mail = Mail::send('mails.BookingOwnerMail', $data, function($message) use($emails) {
            $message->to($emails)->subject('Owner Mail');
        });

        return response()->json();
    }
}
