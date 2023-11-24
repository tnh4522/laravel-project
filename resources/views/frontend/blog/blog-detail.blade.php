@extends('frontend.layouts.app')
@section('title', 'Blog Detail')
@section('content')
    <div class="col-sm-9">
        @foreach($blogs as $blog)
            <div class="blog-post-area">
                <h2 class="title text-center">Latest From our Blog</h2>
                <div class="single-blog-post">
                    <h3>{{ $blog->title }}</h3>
                    <div class="post-meta">
                        <ul>
                            <li><i class="fa fa-user"></i> {{ $blog->author->name }}</li>
                            <li><i class="fa fa-clock-o"></i> {{ $blog->updated_at->format('H:i') }}</li>
                            <li><i class="fa fa-calendar"></i> {{ $blog->updated_at->format('Y-m-d') }}</li>
                        </ul>
                        <span class="rating-blog">
                            @if($blog->rating->count() > 0)
                                {{ number_format($blog->rating->sum('rating') / $blog->rating->count(), 1) }}
                                @php
                                    $fullStars = floor($blog->rating->sum('rating') / $blog->rating->count());
                                    $halfStar = round($blog->rating->sum('rating') / $blog->rating->count()) > $fullStars;
                                    $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                                @endphp
                                @for ($i = 0; $i < $fullStars; $i++)
                                    <i class="fa fa-star"></i>
                                @endfor
                                @if ($halfStar)
                                    <i class="fa fa-star-half-o"></i>
                                @endif
                                @for ($i = 0; $i < $emptyStars; $i++)
                                    <i class="fa fa-star-o"></i>
                                @endfor
                                ({{ $blog->rating->count() }} votes)
                            @else
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            @endif
                        </span>
                    </div>
                    <strong>{{ $blog->description }}</strong>
                    <a href="">
                        <img src="{{ asset('upload/blog/image/'.$blog->image) }}" alt="">
                    </a>
                    {!! $blog->content !!}
                    <div class="pager-area">
                        <ul class="pager pull-right">
                            <!-- Previous Page Link -->
                            @if (!$blogs->onFirstPage())
                                <li><a href="{{ $blogs->previousPageUrl() }}" rel="prev">Pre</a></li>
                            @endif
                            <!-- Next Page Link -->
                            @if ($blogs->hasMorePages())
                                <li><a href="{{ $blogs->nextPageUrl() }}" rel="next">Next</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div><!--/blog-post-area-->

            <div class="rating-area">
                <ul class="ratings">
                    <li class="rate-this">Rate this item:</li>
                    <li>
                        <div class="rate">
                            <div class="vote">
                                <input type="hidden" value="{{ $blog->id }}" class="blog-id">
                                <div class="star_1 ratings_stars"><input value="1" type="hidden"></div>
                                <div class="star_2 ratings_stars"><input value="2" type="hidden"></div>
                                <div class="star_3 ratings_stars"><input value="3" type="hidden"></div>
                                <div class="star_4 ratings_stars"><input value="4" type="hidden"></div>
                                <div class="star_5 ratings_stars"><input value="5" type="hidden"></div>
                                @foreach($blog->rating as $rating)
                                    @if(Auth::check() && $rating->id_user === Auth::user()->id)
                                        <span class="rate-user">{{ number_format($rating->rating, 1) }}</span>
                                    @else
                                        <span class="rate-np"></span>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </li>
                </ul>
                <ul class="tag">
                    <li><a class="confirm-rate color">Rate</a></li>
                </ul>
            </div><!--/rating-area-->

            <div class="socials-share">
                <a href=""><img src="{{ asset('frontend/images/blog/socials.png') }}" alt=""></a>
            </div><!--/socials-share-->

            <div class="response-area">
                <h2>3 RESPONSES</h2>

                <ul class="media-list">
                    @foreach($blog->comment as $comment)
                        @if($comment->id_parent === 0)
                            <li class="media" id="{{ $comment->id }}">
                                <a class="pull-left">
                                    <img class="media-object" src="{{ asset('upload/user/avatar/'.$comment->image_user) }}" alt="">
                                </a>
                                <div class="media-body">
                                    <ul class="single-post-meta">
                                        <li><i class="fa fa-user"></i>{{ $comment->name_user }}</li>
                                        <li><i class="fa fa-clock-o"></i> {{ $comment->updated_at->format('H:i') }}</li>
                                        <li><i class="fa fa-calendar"></i> {{ $comment->updated_at->format('Y-m-d') }}</li>
                                    </ul>
                                    <p>{{ $comment->comment }}</p>
                                    <a class="btn btn-primary reply-comment"><i class="fa fa-reply"></i>Replay</a>
                                </div>
                            </li>
                        @else
                            <li class="media second-media" id="{{ $comment->id }}">
                                <a class="pull-left">
                                    <img class="media-object" src="{{ asset('upload/user/avatar/'.$comment->image_user) }}" alt="">
                                </a>
                                <div class="media-body">
                                    <ul class="single-post-meta">
                                        <li><i class="fa fa-user"></i>{{ $comment->name_user }}</li>
                                        <li><i class="fa fa-clock-o"></i> {{ $comment->updated_at->format('H:i') }}</li>
                                        <li><i class="fa fa-calendar"></i> {{ $comment->updated_at->format('Y-m-d') }}</li>
                                    </ul>
                                    <p>{{ $comment->comment }}</p>
                                    <a class="btn btn-primary reply-comment"><i class="fa fa-reply"></i>Replay</a>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div><!--/Response-area-->
            <div class="replay-box">
                <div class="row">
                    <div class="col-sm-12">
                        <h2>Leave a replay</h2>

                        <div class="text-area">
                            <div class="blank-arrow">
                                <label>{{ Auth::check() ? Auth::user()->name : 'Your Name' }}</label>
                            </div>
                            <span>*</span>
                            <input type="hidden" value="{{ Auth::check() ? Auth::user()->id : '' }}" class="user-id" name="user_id">
                            <input type="hidden" value="{{ $blog->id }}" class="blog-id" name="blog_id">
                            <textarea name="message" rows="11"></textarea>
                            <a class="btn btn-primary post-comment">Post Comment</a>
                        </div>
                    </div>
                </div>
            </div><!--/Repaly Box-->
        @endforeach
    </div>
@endsection
