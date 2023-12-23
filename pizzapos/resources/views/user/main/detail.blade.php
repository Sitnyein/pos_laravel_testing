@extends('user.utemplate.master')
@section('content')



    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            {{-- back button  --}}
            <div class="my-4">
                <a href="{{ route('client#page') }}" class="text-decoration-none text-black"> <i
                        class="fa-solid fa-arrow-left"></i>back</a>
            </div>

      
            @if (session('createSuccess'))
            <!--alert message create-->
            <div class='col-4 offset-8'>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check"></i> {{ session('createSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
            </div>
        @endif


            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class="w-100 h-100"  src="{{ asset('storage/' . $pizaid->image) }}" alt="image">
                            >
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3 class=" text-uppercase">{{$pizaid->name}}</h3>
                    <input type="hidden" id="userid" value="{{Auth::user()->id}}">
                    <input type="hidden" id="orderid" value="{{$pizaid->id}}">
                    <div class="d-flex mb-3">
                        <div class="text-primary mr-2">
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            <small class="far fa-star"></small>
                        </div>
                        <small class="pt-1">{{$pizaid->view_count + 1 }} views</small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{$pizaid->price}} mmk </h3>
                    <p class="mb-4 description"> {{$pizaid->description}} </p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control bg-secondary border-0 text-center" id="ordercount" value="1">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" id="addtoCart" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($products as $p )
                    <div class="product-item bg-light">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="{{ asset('storage/' . $p->image) }}" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square"  href="{{route('order#cart',$p->id)}}"><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href="{{route('piza#detail',$p->id)}}"><i class="fa-solid fa-circle-info"></i>                                   </a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">{{$p->name}}</a>

                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>{{$p->price}} mmk</h5><h6 class="text-muted ml-2"><del>10000 mmk</del></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small>(99)</small>
                            </div>
                        </div>
                    </div>

                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->



</html>




@endsection



@section('scriptSource')
    <script>
        $(document).ready(function() {
            $data =  {'productid':$('#orderid').val(), }

            $.ajax({
                      type: 'get',
                        url: 'http://localhost:8000/user/ajax/increase/viewcount',
                        data: $data,
                        dataType: 'json',

                    })

            $('#addtoCart').click(function() {

             $source = {
                'userid' :$('#userid').val(),
                'pizzaid':$('#orderid').val(),
                'count' :$('#ordercount').val()
             }
            //  console.log($source);


             $.ajax({
                      type: 'get',
                        url: 'http://localhost:8000/user/ajax/cart',
                        data: $source,
                        dataType: 'json',
                        success: function(response) {
                            console.log(response);
                         if(response.status == 'success') {
                            window.location.href = "http://localhost:8000/user/clientpage";
                         }
                        }
                    })

            })

        })
    </script>
@endsection
