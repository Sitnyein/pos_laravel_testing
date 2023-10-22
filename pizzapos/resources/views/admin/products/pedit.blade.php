@extends('admin.template.master')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="container-fluid">
                        <div class="col-lg-10 offset-1">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Product item edit</h3>
                                    </div>
                                    <div class="my-2">
                                        <button class="btn btn-dark text-white" onclick="history.back()">
                                            <i class="fa-solid fa-arrow-left"></i>back</a>

                                        </button>
                                    </div>

                                    <hr>
                                    <span>form {{ $product->name }}</span>
                                    <hr>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
