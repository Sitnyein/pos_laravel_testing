@extends('user.utemplate.master')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('client#page') }}">Home</a>

                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid">
        @if (count($cartlist) != 0)
            <div class="row px-xl-5">
                <div class="col-lg-8 table-responsive mb-5">
                    <table class="table table-light table-borderless table-hover text-center mb-0" id="datatable">
                        <thead class="thead-dark">
                            <tr>
                                <th>Products</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @foreach ($cartlist as $c)
                                <tr>
                                    <input type="hidden" id="cartid" value="{{ $c->id }}">
                                    <input type="hidden" id="userid" value="{{ Auth::user()->id }}">
                                    <input type="hidden" id="productid" value="{{ $c->product_id }}">

                                    {{-- <input type="hidden" value="{{$c->piza_price}}" id="pizaprice"> --}}
                                    <td class="col-2"><img src="{{ asset('storage/' . $c->piza_image) }}" alt=""
                                            style="width: 70%"> </td>
                                    <td class="align-middle">{{ $c->piza_name }}</td>
                                    <td class="align-middle" id="price">{{ $c->piza_price }}</td>
                                    <td class="align-middle">
                                        <div class="input-group quantity mx-auto" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-primary btn-minus" id="minus">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text"
                                                class="form-control form-control-sm bg-secondary border-0 text-center"
                                                value="{{ $c->qty }}" id="qty">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-primary btn-plus" id="plus">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle" id="totalprice">{{ $c->piza_price * $c->qty }} mmk</td>

                                    <td class="align-middle"><button class="btn btn-sm btn-danger btnremove "><i
                                                class="fa fa-times"></i></button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

                <div class="col-lg-4">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                            Summary</span></h5>
                    <div class="bg-light p-30 mb-5">
                        <div class="border-bottom pb-2">
                            <div class="d-flex justify-content-between mb-3">
                                <h6>Subtotal</h6>
                                <h6 id="subtotal" class="subtotal">$$$$</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Tax</h6>
                                <h6 class="font-weight-medium">3000mmk</h6>
                            </div>
                        </div>
                        <div class="pt-2">
                            <div class="d-flex justify-content-between mt-2">
                                <h5>Total</h5>
                                <h5 id="finalprice">$$$$</h5>
                            </div>
                            <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="orderbtn">Proceed To
                                Checkout</button>

                                <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="clearbtn">Clear Cartlist</button>
                        </div>
                    </div>
                </div>

            </div>
        @else
            <h3 class="text-danger text-center shadow-sm    py-3">There is no order piza list <i
                    class="fa-solid fa-pizza-slice"></i></h3>
        @endif
    </div>
    <!-- Cart End -->
@endsection




@section('scriptSource')
    <script src={{ asset('js/cart.js') }}></script>

    <script>
        $(document).ready(function() {
            $('#orderbtn').click(function() {
                $orderlist = [];
                $random = Math.floor(Math.random() * 100000115);
                $('#datatable tbody tr').each(function(index, row) {
                    $orderlist.push({
                        'userid': $(row).find('#userid').val(),
                        'productid': $(row).find('#productid').val(),
                        'qty': $(row).find('#qty').val(),
                        'total': $(row).find('#totalprice').text().replace("mmk", "") * 1,
                        'ordercode': $random
                    });
                });

                $.ajax({
                    type: 'get',
                    url: 'http://localhost:8000/user/ajax/order',
                    data: Object.assign({}, $orderlist),
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if (response.status == 'success') {
                            window.location.href = "http://localhost:8000/user/clientpage";
                        }
                    }
                })



            })


            //btn remove
            $('.btnremove').click(function() {
                $parentNode = $(this).parents("tr");
                $cartid = $parentNode.find('#cartid').val();

                $.ajax({
                    type: 'get',
                    url: 'http://localhost:8000/user/ajax/singlecart',
                    data: {'cartid' : $cartid},
                    dataType: 'json',
                    success: function(response) {
                       console.log(response)
                    }
                })

                    $parentNode.remove();
                    $pricetotal = 0;
                    $('#datatable tbody tr').each(function(index,row) {
                        $pricetotal += Number($(row).find('#totalprice').text().replace("mmk",""));
                    })

                   $('#subtotal').html($pricetotal + " mmk");
                   $('#finalprice').html($pricetotal + 3000 * 1 +  " mmk")

            })

            //clear cart list
            $('#clearbtn').click(function() {
                $.ajax({
                    type: 'get',
                    url: 'http://localhost:8000/user/ajax/clearcart',
                    dataType: 'json',
                    success: function(response) {

                        if (response.status == 'success') {
                            window.location.href = "http://localhost:8000/user/clientpage";
                        }
                    }
                })

            })
        })
    </script>
@endsection
