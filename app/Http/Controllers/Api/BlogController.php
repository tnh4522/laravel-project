<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CommentRequest;
use App\Models\Blog;
use App\Models\CommentBlog;
use App\Models\RatingBlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /* get: blog/list */
    public function list()
    {
        $blogs = Blog::orderBy('updated_at', 'desc')->paginate(2);
        $blogs->load('rating');
        $blogs->load('author');
        return response()->json([
            'status' => 200,
            'data' => $blogs,
        ]);
    }
    /* get: blog/detail?id={id} */
    public function detail()
    {
        $blog = Blog::paginate(1, ['*'], 'id');
        $blog->load('rating');
        $blog->load('author');
        $blog->load('comment');
        return response()->json([
            'status' => 200,
            'data' => $blog,
        ]);
    }
    /* post: blog/comment/id */
    public function comment(CommentRequest $request, $id)
    {
        $data = $request->all();
        if($id) {
            $comment = CommentBlog::create($data);
            if(!empty($comment)) {
                return response()->json([
                    'status' => 200,
                    'data' => $comment,
                ]);
            }
        }
        return response()->json([
            'status' => 404,
            'error' => 'id not found'
        ]);
    }
    /* get: blog/rate/{id} */
    public function getRating($id)
    {
        if($id) {
            $rating = RatingBlog::where('id_blog', $id)->get();
            if(count($rating) > 0) {
                return response()->json([
                    'status' => 200,
                    'data' => $rating,
                ]);
            }
        }
        return response()->json([
            'status' => 404,
            'error' => 'id not found'
        ]);
    }
    /* post: blog/rate/{id} */
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
}
