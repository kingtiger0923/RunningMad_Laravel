@extends('layouts.app')

@section('content')
    <!--Begin Banner Section-->
    <section class="single-banner clear">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="title">
                        <h1>{{$event->title}}</h1>
                    </div>
                </div>
            </div>
        </div>
    </section><!--// End Banner Section -->

    <!--Begin Event Section -->
    <section class="content-section single-events-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-5 pull-right">
                    <div class="right-column">
                        <div class="thumb">
                            <img src="{{URL::to('/')}}/storage/app/public/{{$event->image}}" alt="{{$event->title}}">
                        </div>
                        <div class="btn-wrap-row">
                            <a href="#" class="btn-wrap big-btn">Register</a>
                        </div>
                        <div class="event-info-wrap">
                            <div class="custom-row">
                                <h4>
                                    Time
                                    <span class="events-time"> {{ Carbon\Carbon::parse($event->start_date)->format('j M Y') }} - {{ Carbon\Carbon::parse($event->end_date)->format('j M Y ') }}</span>
                                </h4>
                                <h4>
                                    Location
                                    <span class="events-location">{{$event->location}}</span>
                                </h4>
                                <h4>
                                    Price
                                    <span class="events-price">Free</span>
                                </h4>
                            </div>
                        </div>                      
                    </div>
                </div>
                <div class="col-sm-7 pull-left">
                    <div class="left-column">
                        <div class="single-event-content">
                            <div class="events-content-wrap">                            
                                <div class="custom-row">
                                    <h4>Event Details</h4>
                                    <?php echo $event->description; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--// End Event Section -->
@endsection
