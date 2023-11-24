@extends('frontend.layouts.app')
@section('content')
    <section id="form"><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Login to your account</h2>
                        <form method="post">
                            @csrf
                            <div id="error-alert" class="alert alert-danger alert-dismissible" style="{{ session('error') ? '' : 'display: none' }}">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                {{ session('error') }}
                            </div>
                            <input type="email" placeholder="Email Address" name="email" />
                            @if(isset($errors->messages()['email']))
                                @foreach($errors->messages()['email'] as $error)
                                    <p style="color:red">{{$error}}</p>
                                @endforeach
                            @endif
                            <input type="password" placeholder="Your Password" name="password" />
                            @if(isset($errors->messages()['password']))
                                @foreach($errors->messages()['password'] as $error)
                                    <p style="color:red">{{$error}}</p>
                                @endforeach
                            @endif
                            <input type="hidden" name="level">
                            <span>
								<input type="checkbox" class="checkbox" name="remember" />
								Keep me signed in
							</span>
                            <a href="/guest/register">Do not have an account?</a>
                            <button type="submit" class="btn btn-default">Login</button>
                        </form>
                    </div><!--/login form-->
                </div>
            </div>
        </div>
    </section><!--/form-->
@endsection
