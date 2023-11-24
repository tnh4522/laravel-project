@extends('admin.layouts.app')
@section('title', 'Blog List')
@section('content')
    <!-- ============================================================== -->
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>Warning</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    You are about to delete this blog. This action cannot be undone. Are you sure want to continue?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="confirmDelete">Confirm</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Modal -->
    <div class="container-fluid">
        <div class="d-flex justify-content-center m-2">
            <a href="/admin/blog/add" class="btn btn-primary">Add New Blog</a>
        </div>
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div id="success-alert" class="alert alert-success alert-dismissible" style="{{ session('success') ? '' : 'display: none' }}">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ session('success') }}
                        </div>
                        <div id="error-alert" class="alert alert-danger alert-dismissible" style="{{ session('error') ? '' : 'display: none' }}">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ session('error') }}
                        </div>
                    </div>
                    <div class="table-responsive-xl px-3" id="table-scroll">
                        <table class="table table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" style="width: 5%">ID</th>
                                <th scope="col" style="width: 10%">Image</th>
                                <th scope="col" style="width: 20%">Title</th>
                                <th scope="col" style="width: 25%">Description</th>
                                <th scope="col" style="width: 30%">Content</th>
                                <th scope="col" style="width: 10%" class="fix-col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($blogs))
                                @foreach($blogs as $blog)
                                    <tr>
                                        <td>{{$blog->id}}</td>
                                        <td><img src="{{asset('upload/blog/image/'.$blog->image)}}" alt="" style="width: 80px; height: 60px"></td>
                                        <td><p>{{$blog->title}}</p></td>
                                        <td><p>{{$blog->description}}</p></td>
                                        <td><p>{{$blog->content}}</p></td>
                                        <th style="display: flex"><a type="button" class="btn btn-primary" href="/admin/blog/edit/{{$blog->id}}"><i class="mdi mdi-tooltip-edit" style="font-size: 14px"></i></a>
                                            <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-blog-id="{{$blog->id}}" href="#"><i class="mdi mdi-close" style="font-size: 14px"></i></a>
                                        </th>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                let blogId;
                $('.btn-danger').click(function () {
                    blogId = $(this).data('blog-id');
                });
                $('#confirmDelete').click(function () {
                    if (blogId) {
                        window.location.href = "/admin/blog/delete/" + blogId;
                    }
                });
            });
        </script>
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
@endsection
