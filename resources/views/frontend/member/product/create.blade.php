@extends('frontend.layouts.app')
@section('title', 'Create Product')
@section('content')
    <section id=""><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="signup-form"><!--sign up form-->
                        <h2>Create Product</h2>
                        <form method="post" enctype="multipart/form-data">
                            @csrf
                            <div id="error-alert" class="alert alert-danger alert-dismissible" style="{{ session('error') ? '' : 'display: none' }}">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                {{ session('error') }}
                            </div>
                            <input type="hidden" name="user_id" value="{{ Auth::check() ? Auth::user()->id : '' }}"/>
                            <input type="text" placeholder="Product Name" name="name" />
                            @if(isset($errors->messages()['name']))
                                @foreach($errors->messages()['name'] as $error)
                                    <p style="color:red">{{$error}}</p>
                                @endforeach
                            @endif
                            <input type="text" placeholder="Price" name="price" />
                            @if(isset($errors->messages()['price']))
                                @foreach($errors->messages()['price'] as $error)
                                    <p style="color:red">{{$error}}</p>
                                @endforeach
                            @endif
                            <input type="text" placeholder="Web ID" name="web_id" />
                            @if(isset($errors->messages()['web_id']))
                                @foreach($errors->messages()['web_id'] as $error)
                                    <p style="color:red">{{$error}}</p>
                                @endforeach
                            @endif
                            <select name="category_id">
                                @if(isset($categories))
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->category}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @if(isset($errors->messages()['category_id']))
                                @foreach($errors->messages()['category_id'] as $error)
                                    <p style="color:red">{{$error}}</p>
                                @endforeach
                            @endif
                            <select name="brand_id">
                                @if(isset($brands))
                                    <option value="">Select Brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->brand}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @if(isset($errors->messages()['brand_id']))
                                @foreach($errors->messages()['brand_id'] as $error)
                                    <p style="color:red">{{$error}}</p>
                                @endforeach
                            @endif
                            <select name="availability">
                                <option value="1">In Stock</option>
                                <option value="0">Out of Stock</option>
                            </select>
                            @if(isset($errors->messages()['availability']))
                                @foreach($errors->messages()['availability'] as $error)
                                    <p style="color:red">{{$error}}</p>
                                @endforeach
                            @endif
                            <select name="condition" id="condition-select">
                                <option value="1">New</option>
                                <option value="0">On Sale</option>
                            </select>
                            @if(isset($errors->messages()['condition']))
                                @foreach($errors->messages()['condition'] as $error)
                                    <p style="color:red">{{$error}}</p>
                                @endforeach
                            @endif
                            <input type="text" placeholder="Sales" name="sales" id="sales-input" style="display: none;" value="0" />
                            @if(isset($errors->messages()['sales']))
                                @foreach($errors->messages()['sales'] as $error)
                                    <p style="color:red">{{$error}}</p>
                                @endforeach
                            @endif
                            <input type="text" placeholder="Description" name="description" />
                            @if(isset($errors->messages()['description']))
                                @foreach($errors->messages()['description'] as $error)
                                    <p style="color:red">{{$error}}</p>
                                @endforeach
                            @endif
                            <textarea name="details" placeholder="Detail"></textarea>
                            @if(isset($errors->messages()['details']))
                                @foreach($errors->messages()['details'] as $error)
                                    <p style="color:red">{{$error}}</p>
                                @endforeach
                            @endif
                            <input type="text" placeholder="Manufacturer" name="manufacturer" />
                            @if(isset($errors->messages()['manufacturer']))
                                @foreach($errors->messages()['manufacturer'] as $error)
                                    <p style="color:red">{{$error}}</p>
                                @endforeach
                            @endif
                            <input type="file" name="image[]" accept="image/*" multiple/>
                            @if(isset($errors->messages()['image']))
                                @foreach($errors->messages()['image'] as $error)
                                    <p style="color:red">{{$error}}</p>
                                @endforeach
                            @endif
                            <button type="submit" class="btn btn-default">Create</button>
                        </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $('#condition-select').change(function(){
                // Check if the selected value is '0' for 'On Sale'
                if($(this).val() === '0') {
                    // Show the sales input
                    $('#sales-input').show();
                } else {
                    // Hide the sales input
                    $('#sales-input').hide();
                }
            });
        });
    </script>
@endsection

