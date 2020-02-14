@extends('layouts.app')

@section('content')
     <!--Begin Banner Section-->
    <section class="single-banner blog-page-banner clear" style="background: url({{URL::to('/')}}/storage/app/public/{{setting('general.banner_img')}}) no-repeat center 0; background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="title">
                        <h1>News & articles</h1>
                    </div>
                </div>
                <div class="col-sm-6">
                </div>
                <div class="col-sm-12">
                    <div class="blog-categories" id="blogFilterDiv">
                        <form action="#" method="post">
                            <!-- <ul>
                                <li><a href="{{url('/news-articles')}}?filter=all" class="active">All</a></li>
                                @if(isset($categories))
                                @foreach($categories as $row)
                                    <li><a href="{{url('/news-articles')}}?filter={{$row->slug}}">{{$row->name}}</a></li>
                                @endforeach
                                @endif
                            </ul> -->
                            <ul>
                                <?php if(empty($_GET['filter'])){ ?>
                                <li><a href="{{url('/news-articles')}}?filter=all" class="active">All</a></li>
                                <?php }elseif($_GET['filter'] == 'all'){ ?>
                                    <li><a href="{{url('/news-articles')}}?filter=all" class="active">All</a></li>
                                <?php } else {?>
                                <li><a href="{{url('/news-articles')}}?filter=all" >All</a></li>
                                <?php } ?>
                                @if(isset($categories))
                                @foreach($categories as $row)
                                    <?php if(isset($_GET['filter'])){ ?>
                                     <?php if($_GET['filter'] == $row->slug){ ?>
                                    <li><a href="{{url('/news-articles')}}?filter={{$row->slug}}" class="active">{{$row->name}}</a></li>
                                    <?php } else { ?>
                                        <li><a href="{{url('/news-articles')}}?filter={{$row->slug}}" >{{$row->name}}</a></li>
                                        <?php }  ?>
                                        <?php } else { ?>
                                             <li><a href="{{url('/news-articles')}}?filter={{$row->slug}}" >{{$row->name}}</a></li>
                                        <?php }  ?>
                                @endforeach
                                @endif
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section><!--// End Banner Section -->
    <!--Begin News & Articles Featured Section -->
    <section class="content-section blog-section blog-featured-section">
        <div class="container categories-mobile-filter">
            <div class="row">
                <div class="col-sm-12">
                    <div class="blog-categories" id="blogFilterDiv">
                        <form action="#" method="post">
                            <!-- <ul>
                                <li><a href="{{url('/news-articles')}}?filter=all" class="active">All</a></li>
                                @if(isset($categories))
                                @foreach($categories as $row)
                                    <li><a href="{{url('/news-articles')}}?filter={{$row->slug}}">{{$row->name}}</a></li>
                                @endforeach
                                @endif
                            </ul> -->
                            <ul>
                                <li><a href="{{url('/news-articles')}}?filter=all" class="active">All</a></li>
                                @if(isset($categories))
                                @foreach($categories as $row)
                                    <li><a href="{{url('/news-articles')}}?filter={{$row->slug}}">{{$row->name}}</a></li>
                                @endforeach
                                @endif
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="blog-content">
                    @php $i = 0; @endphp
                    @if(count($data) > 0) 
                    @if(isset($data))
                    @foreach($data as $row)
                    <?php if($row->status == "PUBLISHED") { ?>
                    <?php if($i < 2) { ?>
                    <div class="col-sm-6">
                        <div class="blog-item-wrap">
                            <div class="thumb-wrap">
                                <a href="{{url('/news-article')}}/{{$row->slug}}"><img src="{{URL::to('/')}}/storage/app/public/{{$row->image}}" alt="{{$row->title}}"></a>
                                <a href="{{url('/news-article')}}/{{$row->slug}}" class="overlay"></a>
                                <a href="{{url('/news-article')}}/{{$row->slug}}" class="hover-overlay"></a>
                            </div>
                            <div class="blog-title">
                                <h4><a href="{{url('/news-article')}}/{{$row->slug}}">{{$row->title}}</a></h4>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <?php $i++; } ?>
                    @endforeach
                    @endif
                    @else
                    <div class="not-found">There are no posts to list in this category.</div>
                    @endif
                   
                </div>
            </div>
        </div>
    </section><!--// End News & Articles Featured Section -->
    <!--Begin News & Articles Section -->
    <section class="content-section blog-section blog-page">
        <div class="container">
            <div class="row">
                <div class="blog-content">
                    @php $i = 0; @endphp
                    @if(count($data) > 0) 
                    @if(isset($data))
                    @foreach($data as $row)
                    <?php if($row->status == "PUBLISHED") { ?>
                    <?php if($i >= 2) { ?>
                    <div class="col-sm-3">
                        <div class="blog-item-wrap">
                            <div class="thumb-wrap">
                                <a href="{{url('/news-article')}}/{{$row->slug}}"><img src="{{URL::to('/')}}/storage/app/public/{{$row->image}}" alt="{{$row->title}}"></a>
                                <a href="{{url('/news-article')}}/{{$row->slug}}" class="overlay"></a>
                                <a href="{{url('/news-article')}}/{{$row->slug}}" class="hover-overlay"></a>
                            </div>
                            <div class="blog-title">
                                <h4><a href="{{url('/news-article')}}/{{$row->slug}}">{{$row->title}}</a></h4>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <?php $i++; } ?>
                    @endforeach
                    @endif
                    @else
                    <div class="not-found">There are no posts to list in this category.</div>
                    @endif
                </div>
            </div>
        </div>
    </section><!--// End News & Articles Section -->
@endsection
