@extends('admin.template.master')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Product List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('pizza#page') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>Add Product
                                </button>
                            </a>

                        </div>
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
                    @if (session('deleteSuccess'))
                        <!--alert message create-->
                        <div class='col-4 offset-8'>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-check"></i> {{ session('deleteSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    @if (session('updateSuccess'))
                        <!--alert message create-->
                        <div class='col-4 offset-8'>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-check"></i> {{ session('updateSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-3">
                            <h4 class="text-secondary">Search Key :<span class="text-danger"> {{ request('key') }}</span>
                            </h4>
                        </div>
                        <div class="col-3 offset-9">
                            <form action="" method="get">
                                <div class="d-flex">
                                    <input type="text" name="key" class="form-control" placeholder="search..."
                                        value={{ request('key') }}>
                                    <button class="btn bg-dark text-white" type="submit">
                                        <i class="fa-solid fa-magnifying-glass "></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-2 offset-10 btn bg-white shadow-sm py-1 px-1 text-center ">
                            <h3> <i class="fa-solid fa-database mr-2"></i> {{$products->total()}} </h3>
                        </div>
                    </div>
                    @if (count($products) != 0)
                        <div class="table-responsive table-responsive-data2 mt-3">
                            <table class="table table-data2 text-center  table-hover ">
                                <thead class=" text-info">
                                    <tr>
                                        <th> image </th>
                                        <th>CategoryId</th>
                                        <th>PizzaName</th>
                                        <th>CookingTime</th>
                                        <th>Price</th>
                                        <th>ViewCount</th>
                                        <th>ChefOptions</th>
                                        {{-- <th>Menu release Date</th> --}}
                                    </tr>
                                </thead>
                                <tbody class="bg-dark">
                                    @foreach ($products as $item)
                                        <tr class="tr-shadow   ">
                                            <td class="col-2">
                                                <img style="height: 100px; width:100px"
                                                    src="{{ asset('storage/' . $item->image) }}" alt="">
                                            </td>
                                            <td>{{ $item->category_id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td class="col-1">{{ $item->waiting_time . ' min' }}</td>
                                            <td>{{ $item->price . 'kyats' }} </td>
                                            <td>{{ $item->view_count .' person' }}</td>
                                            {{-- <td>{{ $item->created_at->format('j-F-Y') }}</td>  --}}
                                            <td>
                                                <div class="table-data-feature">
                                                   <a href="{{route('pizza#detail',$item->id)}}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                    title="View">
                                                    <i class="zmdi zmdi-more"></i>
                                                </button>
                                                   </a>
                                                    <a href="{{route('pizza#edit',$item->id)}}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{route('pizza#delete',$item->id)}}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{ $products->appends(request()->query())->links() }}
                                {{-- {{ $categories->links() }} --}}
                            </div>
                        </div>
                    @else
                        <h3 class="text-danger text-center mt-5">There is no product avaliable right now </h3>
                    @endif



                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>


@endsection
