@extends('frontend.layouts.frontend')
@section('content')
<div class="ps-breadcrumb">
    <div class="ps-container">
        <ul class="breadcrumb">
            <li><a href="{{route('index')}}">Home</a></li>
            <li>Orders</li>
        </ul>
    </div>
</div>
<div class="ps-page--shop">
    <div class="ps-container">
        <div class="ps-shop-banner">
        </div>
        <div class="ps-layout--shop">
            <div class="ps-layout__left">
                @include('frontend.includes.sidemenu')
            </div>
            <div class="ps-layout__right">
                <div class="ps-shopping ps-tab-root">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <strong>Success!</strong> {{ $message }}
                    </div>
                    @endif
                    @if ($error = Session::get('error'))
                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <strong>Success!</strong> {{ $error }}
                    </div>
                    @endif
                    <div class="ps-block--vendor-dashboard">
                        <div class="ps-block__header">
                            <h3>My Orders</h3>
                        </div>
                        <div class="ps-block__content">
                            <div class="table-responsive">
                                <table class="table ps-table ps-table--vendor">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Transaction Number</th>
                                            <th>Order Date</th>
                                            <th>Total Discount</th>
                                            <th>Total Tax</th>
                                            <th>Total Amount</th>
                                            <th>Order Status</th>
                                            <th>View Info</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($orderDetails as $key => $order)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$order->transaction_id}}</td>
                                            <td>{{date('d M Y', strtotime( $order->created_at))}}</td>
                                            <td>{{env('PRICE_SYMBOL', 'Rs ')}}{{$order->total_discount}}</td>
                                            <td>{{env('PRICE_SYMBOL', 'Rs ')}}{{$order->total_tax}}</td>
                                            <td>{{env('PRICE_SYMBOL', 'Rs ')}}{{$order->total}}</td>
                                            <td>{{$order->status}}</td>
                                            <td>
                                                <a href="{{route('my-orders-details',$order->transaction_id)}}" class="ps-btn view-order tooltips" data-placement="top" title="Ver el Pedido"><i class="icon-eye"></i></a>
                                            </td>
                                        </tr>

                                        @empty
                                        <tr>
                                            <th colspan="8">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                    <div class="alert alert-info" role="alert">
                                                        Order not found!!!
                                                    </div>
                                                </div>
                                            </th>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra-js')

@endsection