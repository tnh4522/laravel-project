@extends('frontend.layouts.app')
@section('title', 'Register')
@section('content')
    <section id=""><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="signup-form"><!--sign up form-->
                        <h2>My Account</h2>
                        <form method="post" enctype="multipart/form-data">
                            @csrf
                            <div id="error-alert" class="alert alert-danger alert-dismissible" style="{{ session('error') ? '' : 'display: none' }}">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                {{ session('error') }}
                            </div>
                            <input type="hidden" name="level" value="{{ Auth::check() ? Auth::user()->level : 0 }}"/>
                            <input type="text" placeholder="Name" name="name" value="{{ Auth::check() ? Auth::user()->name : '' }}"/>
                            @if(isset($errors->messages()['name']))
                                @foreach($errors->messages()['name'] as $error)
                                    <p style="color:red">{{$error}}</p>
                                @endforeach
                            @endif
                            <input type="email" placeholder="Email Address" name="email" value="{{ Auth::check() ? Auth::user()->email : '' }}" disabled />
                            @if(isset($errors->messages()['email']))
                                @foreach($errors->messages()['email'] as $error)
                                    <p style="color:red">{{$error}}</p>
                                @endforeach
                            @endif
                            <input type="password" placeholder="Password" name="password"/>
                            @if(isset($errors->messages()['password']))
                                @foreach($errors->messages()['password'] as $error)
                                    <p style="color:red">{{$error}}</p>
                                @endforeach
                            @endif
                            <input type="password" placeholder="Confirm Password" name="password_confirmation"/>
                            @if(isset($errors->messages()['password_confirmation']))
                                @foreach($errors->messages()['password_confirmation'] as $error)
                                    <p style="color:red">{{$error}}</p>
                                @endforeach
                            @endif
                            <input type="text" placeholder="Phone" name="phone" value="{{ Auth::check() ? Auth::user()->phone : '' }}"/>
                            @if(isset($errors->messages()['phone']))
                                @foreach($errors->messages()['phone'] as $error)
                                    <p style="color:red">{{$error}}</p>
                                @endforeach
                            @endif
                            <input type="text" placeholder="Address" name="address" value="{{ Auth::check() ? Auth::user()->address : '' }}"/>
                            @if(isset($errors->messages()['address']))
                                @foreach($errors->messages()['address'] as $error)
                                    <p style="color:red">{{$error}}</p>
                                @endforeach
                            @endif
                            <select name="id_country">
                                @if(isset($countries))
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}"
                                                @if(Auth::user()->id_country == $country->id)
                                                    selected
                                            @endif>{{$country->country_name}}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @if(isset($errors->messages()['id_country']))
                                @foreach($errors->messages()['id_country'] as $error)
                                    <p style="color:red">{{$error}}</p>
                                @endforeach
                            @endif
                            <input type="file" name="avatar" accept="image/*"/>
                            @if(isset($errors->messages()['avatar']))
                                @foreach($errors->messages()['avatar'] as $error)
                                    <p style="color:red">{{$error}}</p>
                                @endforeach
                            @endif
                            <button type="submit" class="btn btn-default">Update</button>
                        </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->
@endsection
