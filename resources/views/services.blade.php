@extends('layouts.app')

@section('content')
    <!--Begin Banner Section-->
    <section class="single-banner clear" style="background: url({{URL::to('/')}}/storage/app/public/{{setting('general.banner_img')}}) no-repeat center 0; background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="title">
                        <h2>Our Services</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                </div>
            </div>
        </div>
    </section><!--// End Banner Section -->
    <!--Begin Services Section -->
    <section class="content-section services-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="section-title">
                       <!--  <h2>Our Services</h2> -->
                        <h3>Our mission is to serve the community</h3>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="services-content">
                        <div class="row">
                            @if(isset($data))
                            @foreach($data as $row)
                            <div class="col-sm-6">
                                <div class="services-item-wrap">
                                    <div class="icon-wrap">
                                        <img src="{{URL::to('/')}}/storage/app/public/{{$row->image}}" alt="Religious">
                                    </div>
                                    <div class="title">
                                        <h4>{{$row->title}}</h4>
                                    </div>
                                    <div class="description">
                                        <?php echo $row->body; ?>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section><!--// End Services Section -->
@endsection
