@extends('layouts.app')

@section('content')
    <!--Begin Banner Section-->
    <section class="single-banner clear" style="background: url({{URL::to('/')}}/storage/app/public/{{setting('general.banner_img')}}) no-repeat center 0; background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="title">
                        <h1>Events</h1>
                    </div>
                </div>
                <div class="col-sm-6">
                </div>
            </div>
        </div>
    </section><!--// End Banner Section -->

    <!--Begin Event Section -->
    <section class="content-section events-page-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="events-tab-wrap">
                        <div class="events-tab" id="eventsTabs">
                            <ul>
                                <li><a href="#upcomingEvents">Upcoming events</a></li>
                                <li><a href="#pastEvents">Past events</a></li>
                            </ul>
                            <!--Begin Upcoming Events -->
                            <div id="upcomingEvents">
                                <div class="section-title">
                                    <h2>Upcoming Events</h2>
                                </div>
                                <div class="row">
                                    @php $i = 0; $today = date("Y-m-d H:i:s"); @endphp
                                    @if(isset($data))
                                    @foreach($data as $row)
                                    @if($row->is_published == 'PUBLISHED' )
                                    @php 
                                    $endDate = $row->end_date;
                                    $endtime = $row->end_time;
                                    $endDateTime = $endDate." ".$endtime;
                                    @endphp

                                    <!-- event date validation --> 
                                    @if ($today < $endDateTime)
                                    <div class="col-sm-4">
                                        <div class="events-item-wrap">
                                            <div class="thumb-wrap">
                                                <img src="{{URL::to('/')}}/storage/app/public/{{$row->image}}" alt="History of Jerusalem - The oldest city in the world">
                                                <a href="{{url('/event')}}/{{$row->slug}}" class="overlay"></a>
                                            </div>
                                            <div class="events-bottom-content">
                                                <div class="event-date-wrap">
                                                    <span class="event-month">{{ Carbon\Carbon::parse($row->start_date)->format('M') }}</span>
                                                    <span class="event-date">{{ Carbon\Carbon::parse($row->start_date)->format('d') }}</span>
                                                </div>
                                                <div class="event-title">
                                                    <h4><a href="{{url('/event')}}/{{$row->slug}}">{{$row->title}}</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endif
                                    @endforeach
                                    @endif
                                </div>
                            </div><!--// End Upcoming Events -->

                            <!--Begin Past Events -->
                            <div id="pastEvents">
                                <div class="section-title">
                                    <h2>Past Events</h2>
                                </div>
                                <div class="row">
                                    @php $i = 0; $today = date("Y-m-d H:i:s"); @endphp
                                    @if(isset($data))
                                    @foreach($data as $row)
                                    @if($row->is_published == 'PUBLISHED' )
                                    @php 
                                    $endDate = $row->end_date;
                                    $endtime = $row->end_time;
                                    $endDateTime = $endDate." ".$endtime;
                                    @endphp

                                    <!-- event date validation --> 
                                    @if ($today > $endDateTime)
                                    <div class="col-sm-4">
                                        <div class="events-item-wrap">
                                            <div class="thumb-wrap">
                                                <img src="{{URL::to('/')}}/storage/app/public/{{$row->image}}" alt="History of Jerusalem - The oldest city in the world">
                                                <a href="{{url('/event')}}/{{$row->slug}}" class="overlay"></a>
                                            </div>
                                            <div class="events-bottom-content">
                                                <div class="event-date-wrap">
                                                    <span class="event-month">{{ Carbon\Carbon::parse($row->start_date)->format('M') }}</span>
                                                    <span class="event-date">{{ Carbon\Carbon::parse($row->start_date)->format('d') }}</span>
                                                </div>
                                                <div class="event-title">
                                                    <h4><a href="{{url('/event')}}/{{$row->slug}}">{{$row->title}}</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endif
                                    @endforeach
                                    @endif
                                </div>
                            </div><!--// End Past Events -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--// End Event Section -->
@endsection
