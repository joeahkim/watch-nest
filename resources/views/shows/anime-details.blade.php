@extends('layouts.app')

@section('content')



<div class="breadcrumb-option" style="margin-top:-30px; background-color: #0b0c2a;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a>
                        <a href="./categories.html">Categories</a>
                        <span>{{$show->genre}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <section class="anime-details spad" style="background-color: #0b0c2a;">
        <div class="container">
            <div class="anime__details__content">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="anime__details__pic set-bg" data-setbg="{{asset('assets/img/'.$show->image.'')}}">
                            <div class="comment"><i class="fa fa-comments"></i> {{$numberComments}}</div>
                            <div class="view"><i class="fa fa-eye"></i> {{$numberViews}}</div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="anime__details__text">
                            <div class="anime__details__title">
                                <h3>{{$show->name}}</h3>
                            </div>
                           
                            <p>{{$show->description}}</p>
                            <div class="anime__details__widget">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Type:</span> TV Show</li>
                                            <li><span>Studios:</span> {{$show->studios}}</li>
                                            <li><span>Date aired:</span>{{$show->date_aired}}</li>
                                            <li><span>Status:</span> {{$show->status}}</li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Genre:</span> {{$show->genre}}</li>

                                            <li><span>Duration:</span> {{$show->duration}}</li>
                                            <li><span>Quality:</span> {{$show->quality}}</li>
                                            <li><span>Views:</span> {{$numberViews}}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="anime__details__btn">
                                @if(isset(auth::user()->id))
                                        @if($validateFollowing>0)
                                            <button disabled class="follow-btn"><i class="fa fa-heart-o"></i> Following</button>

                                        @else
                                            <form method="POST" action="{{route('anime.follow', $show->id)}}">
                                                @csrf
                                                <input type="hidden" name="show_image" value="{{ $show->image }}">
                                                <input type="hidden" name="show_name" value="{{$show->name}}">
                                                <button type="submit" class="follow-btn"><i class="fa fa-heart-o"></i> Follow</button>
                                            </form>
                                        @endif
                                    @endif
                                    <a href="{{route('anime.watching', ['show_id' => $show->id,'episode_id' => 1])}}" class="watch-btn"><span>Watch Now</span> <i
                                    class="fa fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    
                        <div class="col-lg-8 col-md-8">
                            <div class="anime__details__review">
                                <div class="section-title">
                                    <h5>Reviews</h5>
                                </div>
                                @foreach($comments as $comment)
                                <div class="anime__review__item">
                                    <div class="anime__review__item__pic">
                                        <img src="{{asset('assets/user_images/'.$comment->image.'')}}" alt="">
                                    </div>
                                    <div class="anime__review__item__text">
                                        <h6>{{$comment->user_name}} - <span>{{$comment->created_at}}</span></h6>
                                        <p>{{$comment->comment}}</p>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                            <div class="anime__details__form">
                                <div class="section-title">
                                    <h5>Your Comment</h5>
                                </div>
                                @if(isset(auth::user()->id))

                                    <form method="POST" action="{{ route('anime.insert.comments', $show->id)}}">
                                    @csrf
                                        <textarea name="comment" placeholder="Your Comment"></textarea>
                                        <button type="submit"><i class="fa fa-location-arrow"></i> Review</button>
                                    </form>
                                @else
                                    <p class="alert alert-success">Login to write Comments</p>
                                @endif
                            </div>
                        </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="anime__details__sidebar">
                            <div class="section-title">
                                <h5>you might like...</h5>
                            </div>
                            @foreach($randomshows as $show)
                                <div class="product__sidebar__view__item set-bg" data-setbg="{{asset('assets/img/'.$show->image.'')}}">
                                    <!-- <div class="ep">18 / ?</div>
                                    <div class="view"><i class="fa fa-eye"></i> 9141</div> -->
                                    <h5><a href="{{route('anime.details', $show->id)}}">{{$show->name}}</a></h5>
                                </div>
                            @endforeach
                            <!-- <div class="product__sidebar__view__item set-bg" data-setbg="img/sidebar/tv-2.jpg">
                                <div class="ep">18 / ?</div>
                                <div class="view"><i class="fa fa-eye"></i> 9141</div>
                                <h5><a href="#">The Seven Deadly Sins: Wrath of the Gods</a></h5>
                            </div>
                            <div class="product__sidebar__view__item set-bg" data-setbg="img/sidebar/tv-3.jpg">
                                <div class="ep">18 / ?</div>
                                <div class="view"><i class="fa fa-eye"></i> 9141</div>
                                <h5><a href="#">Sword art online alicization war of underworld</a></h5>
                            </div>
                            <div class="product__sidebar__view__item set-bg" data-setbg="img/sidebar/tv-4.jpg">
                                <div class="ep">18 / ?</div>
                                <div class="view"><i class="fa fa-eye"></i> 9141</div>
                                <h5><a href="#">Fate/stay night: Heaven's Feel I. presage flower</a></h5>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>

        
    @endsection