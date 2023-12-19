@extends('user.utemplate.master')
@section('content')




    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{route('client#page')}}">Home</a>

                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="datatable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($cartlist as $c )
                        <tr>
                            {{-- <input type="hidden" value="{{$c->piza_price}}" id="pizaprice"> --}}
                            <td class="align-middle"><img src="{{ asset('storage/' . $c->piza_image) }}" alt="" style="width: 50px;"> {{$c->piza_name}} </td>
                            <td class="align-middle" id="price">{{$c->piza_price}}</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus" id="minus" >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{$c->qty}}" id="qty">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus" id="plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle" id="totalprice">{{$c->piza_price * $c->qty}} mmk</td>

                            <td class="align-middle"><button class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button></td>
                        </tr>


                        @endforeach
                    </tbody>
                </table>

            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6 >Subtotal</h6>
                            <h6 id="subtotal" class="subtotal">$150</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">3000mmk</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalprice">$160</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->




@endsection




@section('scriptSource')
    <script>
        $(document).ready(function() {

            // $("#subname").trigger( );



           $('.btn-plus').click(function() {
           $parentNode = $(this).parents("tr");
           $price = $parentNode.find("#price").text().replace("mmk","") * 1 ;
           $qty = $parentNode.find("#qty").val();

           $parentNode.find('#totalprice').html($price * ($qty*1) + " mmk");
             $pricetotal = 0;
           $('#datatable tr').each(function(index,row) {
               $pricetotal += Number($(row).find('#totalprice').text().replace("mmk",""));


           })

          $('#subtotal').html($pricetotal + " mmk");
          $('#finalprice').html($pricetotal + 3000 * 1 +  " mmk")



           })

           $('.btn-minus').click(function() {
            $parentNode = $(this).parents("tr");
            $price = $parentNode.find("#price").text().replace("mmk","") * 1 ;
           $qty = $parentNode.find("#qty").val();

           $parentNode.find('#totalprice').html($price * ($qty*1) + " mmk");


           $reducetotal = 0;
           $('#datatable tr').each(function(index,row) {
               $reducetotal += Number($(row).find('#totalprice').text().replace("mmk",""));
           })
           $('#subtotal').html($reducetotal + " mmk");

        })

    })
    </script>
@endsection

