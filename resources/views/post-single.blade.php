@extends('layouts.app')

@section('content')
<?php if($post->status == "PUBLISHED") { ?>
    
    <!--Begin Banner Section-->
    <section class="blog-single-banner clear" style="background-image: url({{URL::to('/')}}/storage/app/public/{{ $post->image}});">
        <div class="container">
            <div class="single-title">
                <span class="category-name">{{ $post->category->name}}</span>
                <h1>{{$post->title}}</h1>
                <!--<div class="blog-meta"><a href="#" class="author-name">{{ $post->author->name}}</a> / <span class="post-date">{{ Carbon\Carbon::parse($post->created_at)->format('j M Y ') }}</span></div>-->
                <div class="blog-meta"><span class="post-date">{{ Carbon\Carbon::parse($post->created_at)->format('j M Y ') }}</span></div>
            </div>
        </div>
    </section><!--// End Banner Section -->
    <!--Begin News & Articles Featured Section -->
    <section class="content-section blog-single-section borderB">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="blog-content">
                        <?php echo $post->body; ?>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="social-share">
                        <div class="title">
                            <h3>Share with your family and friends.</h3>
                        </div>
                        <div class="social-share-wrap">                                    
                            <a href="#" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a>              
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--// End News & Articles Featured Section -->
    <!--Begin News & Articles Latest News Section -->
    <section class="content-section blog-section blog-single-latest grey-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="section-title">
                        <h2>Latest news & articles</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="blog-content">
                    @php $i = 0; @endphp
                    @if(count($allposts) > 0) 
                    @if(isset($allposts))
                    @foreach($allposts as $row)
                    <?php if($row->status == "PUBLISHED") { ?>
                    <?php if($i < 3) { ?>
                    <div class="col-sm-4">
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
    </section><!--// End News & Articles Latest News Section -->
<?php } ?>
@endsection
