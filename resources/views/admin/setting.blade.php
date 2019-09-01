@extends('layouts.admin')

@section('adminContent')
@php
    // $mail = DB::table('settings')->get();
    if (count($allmail) > 0) {
        foreach ($allmail as $value) {
            $NMail = $value->s_mail;
            $Id = $value->s_mail;
        }
    }
   
@endphp
<section class="content">
    <div class="row main-padding">
        <h3>Site Configuration</h3>
    </div>
    <div class="row main-padding">
        <form action="{{ url('notification-email')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="my-textarea">Notification Email</label>
                <input type="text" class="form-control" name="email" value="@if(count($allmail) > 0) {{$NMail}} @endif" placeholder="Email">
                <input type="hidden" class="form-control" name="custom_id" value="@if(count($allmail) > 0) 1 @else 2 @endif" placeholder="Email">
            @if ($errors->has('email'))
                <div class="alert alert-danger">{{ $errors->first('email') }}</div>
            @endif
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
</section>        
@endsection