@extends('user.utemplate.master')
@section('content')
    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter By Category</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class=" d-flex align-items-center justify-content-between mb-3 bg-dark text-white px-3 py-1">
                            <label class="mt-2"  for="">Categories</label>
                            <span class=" badge border font-weight-normal">{{ count($category)}}</span>
                        </div>
                        <a href=" {{route('client#page') }}" class="text-dark">
                            <label for="price-1">ALL</label>
                        </a>
                        @foreach ($category as $c)
                         <div class=" d-flex align-items-center justify-content-between mb-3 pt-1">
                            <a href=" {{route('user#filter', $c->id ) }}" class="text-dark">
                                <label for="price-1">{{$c->name}}</label>
                            </a>
                         </div>
                        @endforeach
                    </form>
                </div>
                <!-- Price End -->




            </div>
            <!-- Shop Sidebar End -->

            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                                <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    <select name="sortingname" id="sorting" class="form-control">
                                        <option value="">Choose price</option>
                                        <option value="asc">Ascending </option>
                                        <option value="desc">Descending</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- control ajax javascript  --}}
                   <span class="row" id="homejs">
                   @if(count($product) != 0)
                   @foreach ($product as $p)
                   <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                       <div class="product-item bg-light mb-4">
                           <div class="product-img position-relative overflow-hidden">
                               <img class="img-fluid w-100 h-50"
                                   src="{{ asset('storage/' . $p->image) }}" alt="">
                                <div class="product-action">
                                   <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                   <a class="btn btn-outline-dark btn-square" href="{{route('piza#detail',$p->id)}}"><i class="fa-solid fa-circle-info"></i>                                   </a>
                                   <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>

                               </div>
                           </div>
                           <div class="text-center py-4">
                               <a class="h6 text-decoration-none text-truncate" href="">{{ $p->name }}</a>
                               <div class="d-flex align-items-center justify-content-center mt-2">
                                   <h5>{{ $p->price }} mmk</h5>
                               </div>

                           </div>
                       </div>
                   </div>
               @endforeach
                   @else
                   <h3 class="text-danger text-center shadow-sm    py-3">There is no piza <i class="fa-solid fa-pizza-slice"></i></h3>
                   @endif

                   </span>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {

            $('#sorting').change(function() {
                $eventoption = $('#sorting').val();

                if ($eventoption == 'asc') {
                    $.ajax({
                        type: 'get',
                        url: 'http://localhost:8000/user/ajax',
                        data: {
                            'status': 'asc'
                        },
                        dataType: 'json',
                        success: function(response) {
                           $list = '';
                           for ( $i =0 ; $i < response.length ; $i++ ) {

                            $list += `
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" style="height: 250px"
                                    src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                 <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>

                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name }</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>${response[$i].price } mmk</h5>
                                </div>

                            </div>
                        </div>
                    </div>
                            `;

                           }
                           $('#homejs').html($list);
                        }
                    })
                } else if ($eventoption == 'desc') {
                    $.ajax({
                        type: 'get',
                        url: 'http://localhost:8000/user/ajax',
                        data: {
                            'status': 'desc'
                        },
                        dataType: 'json',
                        success: function(response) {
                            $list = '';
                           for ( $i =0 ; $i < response.length ; $i++ ) {
                            // console.log(`${response[$i].name}`);
                            $list += `
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" style="height: 250px"
                                    src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                 <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>

                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href=""> ${response[$i].name }</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5> ${response[$i].price } mmk</h5>
                                </div>

                            </div>
                        </div>
                    </div>
                            `;

                           }
                           $('#homejs').html($list);
                        }
                    })
                }
            })
        })
    </script>
@endsection
