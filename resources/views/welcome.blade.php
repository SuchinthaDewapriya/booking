@extends('layouts.app')

@section('content')

<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background:url(public/images/cover_2.jpg)" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="gtco-container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0 text-left">
                

                <div class="row row-mt-15em">
                    <div class="col-md-3"></div>
                    <div class="col-md-6 mt-text animate-box" data-animate-effect="fadeInUp">
                        <center>
                        <span class="intro-text-small">LUXURY SIGNATURE HOTEL IN SRI LANKA<a href="" target="_blank"></a></span>
                        <h1 class="cursive-font">Monaara!</h1>	<br>
                        <a href="{{ url('reservation') }}" class="btn btn-reserve btn-block">Reserve Now</a>
                        </center>
                    </div>
                    <div class="col-md-3"></div>
                    {{-- <div class="col-md-4 col-md-push-1 animate-box" data-animate-effect="fadeInRight">
                        <div class="form-wrap">
                            <div class="tab">
                                
                                <div class="tab-content">
                                    <div class="tab-content-inner active" data-content="signup">
                                        <h3 class="cursive-font">Table Reservation</h3>
                                        <form action="#">
                                            <div class="row form-group">
                                                <div class="col-md-12">
                                                    <label for="activities">Persons</label>
                                                    <select name="#" id="" class="form-control">
                                                        <option value="">1</option>
                                                        <option value="">2</option>
                                                        <option value="">3</option>
                                                        <option value="">4</option>
                                                        <option value="">5+</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-12">
                                                    <label for="date-start">Date</label>
                                                    <input type="text" id="date" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-12">
                                                    <label for="date-start">Time</label>
                                                    <input type="text" id="time" class="form-control">
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col-md-12">
                                                    <input type="submit" class="btn btn-primary btn-block" value="Reserve Now">
                                                </div>
                                            </div>
                                        </form>	
                                    </div>

                                    
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</header>

<div class="gtco-section back01">
    <div class="gtco-container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center gtco-heading">
                <h2 class="cursive-font primary-color">ACCOMMODATION</h2>
            </div>
        </div>
        <div class="row">

            <div class="col-lg-6 col-md-6 col-sm-6">
                <a href="images/img_1.jpg" class="fh5co-card-item image-popup">
                    <figure>
                        <div class="overlay"><i class="ti-plus"></i></div>
                        <img src="{{ asset('public/images/rooms/1.jpg')}}" alt="Image" class="img-responsive">
                    </figure>
                    <div class="fh5co-text">
                        <h2>Deluxe</h2>
                        <p>Traditional style & contentporary amenities for the discerning traveller..</p>
                        <p><span class="price cursive-font">Rs.2000.00</span></p>
                    </div>
                </a>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <a href="images/img_2.jpg" class="fh5co-card-item image-popup">
                    <figure>
                        <div class="overlay"><i class="ti-plus"></i></div>
                        <img src="{{ asset('public/images/rooms/family_suits.jpg')}}" alt="Image" class="img-responsive">
                    </figure>
                    <div class="fh5co-text">
                        <h2>Family Suits</h2>
                        <p>Traditional style & contentporary amenities for the discerning traveller..</p>
                        <p><span class="price cursive-font">Rs.5000.00</span></p>
                    </div>
                </a>
            </div>

        </div>
    </div>
</div>

<div id="gtco-features">
    <div class="gtco-container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center gtco-heading animate-box">
                <h2 class="cursive-font">Our Services</h2>
                <p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="feature-center animate-box" data-animate-effect="fadeIn">
                    <span class="icon">
                        <i class="ti-face-smile"></i>
                    </span>
                    <h3>Happy People</h3>
                    <p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="feature-center animate-box" data-animate-effect="fadeIn">
                    <span class="icon">
                        <i class="ti-thought"></i>
                    </span>
                    <h3>Creative Culinary</h3>
                    <p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="feature-center animate-box" data-animate-effect="fadeIn">
                    <span class="icon">
                        <i class="ti-truck"></i>
                    </span>
                    <h3>Food Delivery</h3>
                    <p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
                </div>
            </div>
            

        </div>
    </div>
</div>


{{-- <div class="gtco-cover gtco-cover-sm" style="background-image: url(images/img_bg_1.jpg)"  data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="gtco-container text-center">
        <div class="display-t">
            <div class="display-tc">
                <h1>&ldquo; Their high quality of service makes me back over and over again!&rdquo;</h1>
                <p>&mdash; John Doe, CEO of XYZ Co.</p>
            </div>	
        </div>
    </div>
</div> --}}

{{-- <div id="gtco-counter" class="gtco-section">
    <div class="gtco-container">

        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center gtco-heading animate-box">
                <h2 class="cursive-font primary-color">Fun Facts</h2>
                <p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
            </div>
        </div>

        <div class="row">
            
            <div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
                <div class="feature-center">
                    <span class="counter js-counter" data-from="0" data-to="5" data-speed="5000" data-refresh-interval="50">1</span>
                    <span class="counter-label">Avg. Rating</span>

                </div>
            </div>
            <div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
                <div class="feature-center">
                    <span class="counter js-counter" data-from="0" data-to="43" data-speed="5000" data-refresh-interval="50">1</span>
                    <span class="counter-label">Food Types</span>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
                <div class="feature-center">
                    <span class="counter js-counter" data-from="0" data-to="32" data-speed="5000" data-refresh-interval="50">1</span>
                    <span class="counter-label">Chef Cook</span>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
                <div class="feature-center">
                    <span class="counter js-counter" data-from="0" data-to="1985" data-speed="5000" data-refresh-interval="50">1</span>
                    <span class="counter-label">Year Started</span>

                </div>
            </div>
                
        </div>
    </div>
</div> --}}



{{-- <div id="gtco-subscribe">
    <div class="gtco-container">
        <div class="row animate-box">
            <div class="col-md-8 col-md-offset-2 text-center gtco-heading">
                <h2 class="cursive-font">Subscribe</h2>
                <p>Be the first to know about the villa sunray.</p>
            </div>
        </div>
        <div class="row animate-box">
            <div class="col-md-8 col-md-offset-2">
                <form class="form-inline">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Your Email">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <button type="submit" class="btn btn-default btn-block">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}

@endsection
    