@extends('frontend.layouts.app')
@section('title', 'List Product')
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
                    <button type="button" class="btn btn-danger" id="confirmDelete">Confirm</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Modal -->
    <section id="cart_items">
        <div class="container">
            <div class="table-responsive cart_info">
                <div id="success-alert" class="alert alert-success alert-dismissible" style="{{ session('success') ? '' : 'display: none' }}">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('success') }}
                </div>
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td class="id_product">ID</td>
                        <td class="image">Image</td>
                        <td class="name">Name</td>
                        <td class="price">Price</td>
                        <td class="action">Action</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($products))
                        @foreach($products as $product)
                            <tr>
                                <td class="cart_product_id">
                                    <a href="/member/product/edit/{{$product->id}}">{{$product->id}}</a>
                                </td>
                                <td class="cart_product">
                                    <a href="/member/product/edit/{{$product->id}}">
                                        @php $images = json_decode($product->image, true); @endphp
                                        @if(is_array($images) && count($images) > 0)
                                            <img src="{{ asset('upload/product/85x84/' . $images[0]) }}" alt="" width="100px">
                                        @else
                                            <span>No Image</span>
                                        @endif
                                    </a>
                                </td>

                                <td class="cart_description">
                                    <h4><a href="/member/product/edit/{{$product->id}}">{{$product->name}}</a></h4>
                                    <p>Web ID: {{$product->web_id}}</p>
                                </td>
                                <td class="cart_price">
                                    <p>${{$product->price}}</p>
                                </td>
                                <td class="cart_delete">
                                    <a type="button" class="btn btn-primary" href="/member/product/edit/{{$product->id}}"><i class="fa fa-edit"></i></a>
                                    <a type="button" class="btn btn-primary btn-delete" data-toggle="modal" data-target="#exampleModal" data-product-id="{{$product->id}}" href="#"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section> <!--/#cart_items-->
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            let productId;
            $('.btn-delete').click(function () {
                productId = $(this).data('product-id');
            });
            $('#confirmDelete').click(function () {
                if (productId) {
                    window.location.href = "/member/product/delete/" + productId;
                }
            });
        });
    </script>
@endsection
