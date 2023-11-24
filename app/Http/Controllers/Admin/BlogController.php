<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.blog.list', [
            'blogs' => Blog::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {
        $data = $request->all();
        if(!empty($request->image)) {
            $data['image'] = $request->image->getClientOriginalName();
        }
        if(Blog::create($data)) {
            if(!empty($request->image)) {
                $request->image->move('upload/blog/image', $request->image->getClientOriginalName());
            }
            return redirect('admin/blog/list')->with('success', 'Create blog success!');
        }
        return redirect()->back()->with('error', 'Create blog failed!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.blog.edit', [
            'blog' => Blog::find($id),
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
    public function update(BlogRequest $request, string $id)
    {
        $data = $request->all();
        $blog = Blog::findOrfail($id);
        if(!empty($request->image)) {
            $data['image'] = $request->image->getClientOriginalName();
        }
        if($blog->update($data)) {
            if(!empty($request->image)) {
                $request->image->move('upload/blog/image', $request->image->getClientOriginalName());
            }
            return redirect('admin/blog/list')->with('success', 'Update success!');
        }
        return redirect()->back()->with('error', 'Update failed!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Auth::check() && Auth::user()->level == User::LEVEL_ADMIN) {
            return Blog::find($id)->delete()
                ? redirect()->back()->with('success', 'Delete success!')
                : redirect()->back()->with('error', 'Delete failed!');
        }
        return redirect('/login');
    }
}
