@extends('layouts.app')

@section('content')
    <!--Begin Banner Section-->
    <section class="single-banner clear" style="background: url({{URL::to('/')}}/storage/app/public/{{setting('general.banner_img')}}) no-repeat center 0; background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="title">
                        <h1>{{ $page->title }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </section><!--// End Banner Section -->

    <!-- Begin Single Page Section -->
    <section class="content-section single-page-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="single-page-content">
                         <?php echo  $page->body; ?>
                    </div>
                </div>
            </div>
        </div>
    </section><!--// End Single Page Section -->
@endsection
