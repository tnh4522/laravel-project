@extends('admin.layouts.app')
@section('title', 'Edit Blog')
@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card card-body">
                    <form class="form-horizontal m-t-30" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="col-md-12">Title<strong style="color:red">*</strong></label>
                            <div class="col-md-12">
                                <input type="text" class="form-control form-control-line" name="title" placeholder="Enter title" value="{{ $blog->title }}" />
                                @if(isset($errors->messages()['title']))
                                    @foreach($errors->messages()['title'] as $error)
                                        <p style="color:red">{{$error}}</p>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Image<strong style="color:red">*</strong></label>
                            <div class="col-md-12">
                                <input type="file" class="form-control form-control-line" name="image" accept="image/*" id="image-blog" />
                                @if(isset($errors->messages()['image']))
                                    @foreach($errors->messages()['image'] as $error)
                                        <p style="color:red">{{$error}}</p>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Description<strong style="color:red">*</strong></label>
                            <div class="col-md-12">
                                <textarea rows="5" class="form-control form-control-line" name="description" placeholder="Enter description" >{{ $blog->description }}</textarea>
                                @if(isset($errors->messages()['description']))
                                    @foreach($errors->messages()['description'] as $error)
                                        <p style="color:red">{{$error}}</p>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Content<strong style="color:red">*</strong></label>
                            <div class="col-md-12">
                                <textarea rows="5" class="form-control form-control-line" name="content" id="content_text" >{{ $blog->content }}</textarea>
                                @if(isset($errors->messages()['content']))
                                    @foreach($errors->messages()['content'] as $error)
                                        <p style="color:red">{{$error}}</p>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="button" name="cancel" value="Cancel" class="btn btn-danger" onclick="window.location.href='/admin/blog/list'" />
                                <input type="submit" name="submit" value="Edit Blog" class="btn btn-success" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
    </div>
{{--    <script>--}}
{{--        const fileInput = document.querySelector(`#image-blog`);--}}

{{--        const myFile = new File(--}}
{{--            [""],--}}
{{--            "{{ $blog->image }}",--}}
{{--            { type: "image/*"}--}}
{{--        );--}}

{{--        const dataTransfer = new DataTransfer();--}}
{{--        dataTransfer.items.add(myFile);--}}
{{--        fileInput.files = dataTransfer.files;--}}
{{--    </script>--}}
@endsection
