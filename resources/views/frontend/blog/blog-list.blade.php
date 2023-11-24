@extends('frontend.layouts.app')
@section('title', 'Blog')
@section('content')
    <div class="col-sm-9">
        <div class="blog-post-area">
            <h2 class="title text-center">Latest From our Blog</h2>
            @if(isset($blogs))
                @foreach($blogs as $blog)
                    <div class="single-blog-post">
                        <h3>{{ $blog->title }}</h3>
                        <div class="post-meta">
                            <ul>
                                <li><i class="fa fa-user"></i> {{ $blog->author->name  }}</li>
                                <li><i class="fa fa-clock-o"></i> {{ $blog->updated_at->format('H:i') }}</li>
                                <li><i class="fa fa-calendar"></i> {{ $blog->updated_at->format('Y-m-d') }}</li>
                            </ul>
                            <span>
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
                        <a href="">
                            <img src="{{ asset('upload/blog/image/'.$blog->image) }}" alt="" />
                        </a>
                        <p>{{ $blog->description }}</p>
                        <a  href="/blog/detail?id={{ $blog->id }}" class="btn btn-primary">Read More</a>
                    </div>
                @endforeach
            @endif
            <div class="pagination-area">
                <ul class="pagination">
                    {{ $blogs->links('pagination::bootstrap-4') }}
                </ul>
            </div>
        </div>
    </div>
@endsection
