
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
                            <a href="{{route('pizza#page')}}">
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
                        <h3> <i class="fa-solid fa-database mr-2"></i> 15 </h3>
                    </div>
                </div>
       {{-- table  --}}


                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>


@endsection
