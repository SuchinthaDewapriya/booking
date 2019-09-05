@extends('layouts.admin')

@section('adminContent')

<section class="content">
    <div class="row main-padding">
        <h3>Reservations Calendar</h3>
    </div>
    <div class="row main-padding" style="padding-left:100px; padding-right:100px;">
        {!! $calender_details->calendar() !!}
    </div>
</section>
{!! $calender_details->script() !!}
@endsection