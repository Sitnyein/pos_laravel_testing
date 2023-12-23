@extends('admin.template.master')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">

                    <div class="mb-2">
                        <a href="{{ route('admin#orderlist') }}" class="text-decoration-none text-black"> <i
                                class="fa-solid fa-arrow-left"></i>back</a>
                    </div>
                    <div>


                        <div class="row col-6 ">
                            <div class="card ">
                                <div class="card-header">
                                    <h3>Order Info</h3>
                                    <small>Include Delievery Charges</small>

                                </div>
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col">Customer</div>
                                        <div class="col">{{ strtoupper($orderprice->username) }}</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">Order Code</div>
                                        <div class="col">{{ $orderprice->ordercode }}</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">Total Price</div>
                                        <div class="col">{{ $orderprice->total_price }} mmk </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">Order Date</div>
                                        <div class="col">{{ $orderprice->created_at->format('F-j-y') }}</div>
                                    </div>

                                    <div class="row ">
                                        <div class="col">Order status</div>
                                        <div class="col">
                                            @if ($orderprice->status == 0)
                                                <span class="text-warning">Pending.....</span>
                                            @elseif ($orderprice->status == 1)
                                                <span class="text-success">Success.....</span>
                                            @else
                                                <span class="text-danger">Reject.....</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>






                        {{-- @if (count($user) != 0) --}}
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>

                                        <th>Product Id</th>
                                        <th>Product image</th>
                                        <th>Product Name</th>
                                        <th>QTY</th>
                                        <th>Price</th>

                                    </tr>
                                </thead>
                                <tbody id="ordertable">
                                @foreach ($order as $o)
                                    <tr>

                                        <td class="align-middle">{{ $o->id }}</td>

                                        <td class="col-2"><img src="{{ asset('storage/' . $o->product_image) }}" alt=""
                                            style="width: 70%"> </td>

                                        <td class="align-middle">{{ $o->productname }}</td>
                                        <td class="align-middle">{{$o->qty}}</td>

                                        <td class="align-middle">{{ $o->total }}</td>




                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                            <div class="mt-3">
                                {{-- {{ $user->links() }}  --}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endsection
