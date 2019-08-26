@extends('layouts.app')

@section('content')

<header id="gtco-header" class="gtco-cover-custom gtco-cover-md" role="banner" style="background:url(public/images/img_bg_1.jpg)" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="gtco-container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="row row-mt-15em">
                    <center><h1 class="cursive-font">Checkout</h1></center>
                </div>                
            </div>
        </div>
    </div>
</header>
<div class="gtco-section">
    <div class="gtco-container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="animate-box" data-animate-effect="fadeInRight">
                    <div class="card reservation-card">
                        <div class="card-body">
                            <div class="card reservation-card1">
                                <div class="card-body">
                                        <center><h3 class="font">Room Details</h3></center><hr><br>
                                    <table class="table table-light">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Quantity</th>
                                                <th>Rate (Rs.)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <img width="30px" src="{{ asset('public/images/rooms')}}/{{$image}}" alt="">
                                                </td>
                                                <td>
                                                    {{$r_name}} for {{$days}} days
                                                </td>
                                                <td>
                                                    {{$quantity}}
                                                </td>
                                                <td>
                                                    {{$ratebed}}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="animate-box" data-animate-effect="fadeInRight">
                        <div class="card reservation-card">
                            <div class="card-body">
                                <div class="card reservation-card1">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <div class="d-flex justify-content-center">
                                                <center><h3 class="font">Your Details</h3></center><hr><br>
                                                <form method="post" action="">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-2">
                                                            <label for="Salutation">Salutation</label>
                                                            <select name="Salutation" class="form-control" id="">
                                                                <option value="mr">Mr</option>
                                                                <option value="miss">Miss</option>
                                                                <option value="mrs">Mrs</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-5">
                                                            <label for="fname">First Name</label>
                                                            <input type="text" class="form-control" id="fname" placeholder="First Name">
                                                        </div>
                                                        <div class="form-group col-md-5">
                                                        <label for="lname">Last Name</label>
                                                        <input type="text" class="form-control" id="lname" placeholder="Last Name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="country">Country</label>
                                                        <select name="country" class="form-control" id="">
                                                            <option value="Sri Lanka">Sri Lanka</option>
                                                            <option value="United States">United States</option>
                                                            <option value="India">India</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="email">Email</label>
                                                        <input type="email" class="form-control" id="email" placeholder="Email">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="note">Note</label>
                                                        <textarea id="note" class="form-control" name="note" rows="3" placeholder="Note"></textarea>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="gridCheck">
                                                        <label class="form-check-label" for="gridCheck">
                                                            Check me out
                                                        </label>
                                                        </div>
                                                    </div>
                                                    <div style="padding:15px;">
                                                        <button type="submit"  class="btn btn-primary">Sign in</button>
                                                    </div>    
                                                </form>
                                            </div>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</div>           
@endsection