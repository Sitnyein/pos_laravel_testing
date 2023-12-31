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
                            <a href="{{ route('category#createpage') }}" class="me-5">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add item
                                </button>
                         
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
                            <i class="fa-solid fa-check"></i> {{ session('deleteSuccess') }}
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
                        <form action="{{ route('category#list') }}" method="get">
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
                        <h3> <i class="fa-solid fa-database mr-2"></i> {{ $categories->total() }} </h3>
                    </div>
                </div>

                    @if (count($categories) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>
                                      <th>ID</th>
                                        <th>Category Name</th>
                                        <th>Created Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $item)
                                        <tr class="tr-shadow">
                                            <td>{{ $item->id }}</td>
                                            <td class="col-6">{{ $item->name }}</td>
                                            <td>{{ $item->created_at->format('j-F-Y') }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    {{-- <button class="item" data-toggle="tooltip" data-placement="top"
                                        title="View">
                                        <i class="zmdi zmdi-more"></i>
                                    </button> --}}
                                                    <a href="{{route('category#editpage',$item->id)}}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>
                                                    <a href=" {{ route('category#delete', $item->id) }} ">
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
                                {{ $categories->appends(request()->query())->links() }}
                                {{-- {{ $categories->links() }} --}}
                            </div>
                        </div>
                    @else
                        <h3 class="text-danger text-center mt-5">There is no categoty here</h3>
                    @endif

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>


@endsection
