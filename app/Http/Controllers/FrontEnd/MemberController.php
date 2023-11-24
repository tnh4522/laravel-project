<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.member.login');
    }
    /**
     * Login
     */
    public function login(LoginRequest $request) {
        $credentials = $request->only('email', 'password');
        $remember = $request->remember ? true : false;
        if (Auth::attempt($credentials, $remember)) {
            return redirect('/');
        }
        return redirect()->back()->with('error', 'Invalid email or password');
    }
    public function logout() {
        Auth::logout();
        return redirect('/');
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
        if(Auth::check()) {
            $countries = Country::all();
            return view('frontend.member.account', compact('countries'));
        }
        return redirect('/member/login');
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
    public function update(UserUpdateRequest $request)
    {
        if(Auth::check()) {
            $user = User::findOrFail(Auth::id());
            $data = $request->all();
            if(!empty($request->avatar)) {
                $data['avatar'] = $request->avatar->getClientOriginalName();
            }
            if($data['password']) {
                $data['password'] = bcrypt($data['password']);
            } else {
                $data['password'] = $user->password;
            }
            if($user->update($data)) {
                if(!empty($request->avatar)) {
                    $request->avatar->move('upload/user/avatar', $request->avatar->getClientOriginalName());
                }
                return redirect()->back()->with('success', 'Update profile successfully');
            }
            return redirect()->back()->with('error', 'Update profile failed');
        }
        return redirect('/member/login');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
