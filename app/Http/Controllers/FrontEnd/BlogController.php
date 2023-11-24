<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\CommentBlog;
use App\Models\RatingBlog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::orderBy('updated_at', 'desc')->paginate(2);
        $blogs->load('rating');
        $blogs->load('author');
        return view('frontend.blog.blog-list', [
            'blogs' => $blogs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $blog = Blog::paginate(1, ['*'], 'id');
        $blog->load('rating');
        $blog->load('author');
        $blog->load('comment');
        return view('frontend.blog.blog-detail', [
            'blogs' => $blog,
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    // rating
    public function rating(Request $request)
    {
        if(Auth::check()) {
            if($request->ajax()) {
                $user_id = Auth::user()->id;
                $rating = RatingBlog::where('id_user', $user_id)->where('id_blog', $request->id_blog)->first();
                if(empty($rating)) {
                    $data = $request->all();
                    $data['id_user'] = $user_id;
                    $query = RatingBlog::create($data);
                    if($query) {
                        return response()->json([
                            'status' => 200,
                            'message' => 'RatingBlog success',
                            'data' => $data,
                        ]);
                    }
                    return response()->json([
                        'status' => 200,
                        'message' => 'RatingBlog success',
                        'data' => $data,
                    ]);
                }
                return response()->json([
                    'status' => 'error',
                    'message' => 'You have rated this blog',
                    'data' => $rating,
                ]);
            }
        }
        return response()->json([
            'status' => 'error',
            'message' => 'You must login to rate this blog',
        ]);
    }
    // comment
    public function comment(Request $request)
    {
        if(Auth::check()) {
            if($request->ajax()) {
                $user_id = Auth::user()->id;
                $user_name = Auth::user()->name;
                $user_avatar = Auth::user()->avatar;
                $data = $request->all();
                $data['id_user'] = $user_id;
                $data['name_user'] = $user_name;
                $data['image_user'] = $user_avatar;
                $query = CommentBlog::create($data);
                if($query) {
                    return response()->json([
                        'status' => 200,
                        'message' => 'CommentBlog success',
                        'data' => $data,
                        'id_comment' => $query->id,
                        'created_at' => $query->updated_at->format('H:i'),
                        'updated_at' => $query->updated_at->format('Y-m-d'),
                    ]);
                }
            }
        }
        return response()->json([
            'status' => 'error',
            'message' => 'You must login to comment this blog',
        ]);
    }
}
