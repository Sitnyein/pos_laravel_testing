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
                                        <h3 class="text-center title-2">{{$item->name}} info</h3>
                                    </div>
                                    <div class="my-2">
                                        <a href="{{ route('product#list') }}" class="text-decoration-none text-black"> <i
                                                class="fa-solid fa-arrow-left"></i>back</a>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-4 offset-1">

                                                <img src="{{ asset('storage/' . $item->image) }}" />

                                        </div>
                                        <div class="col-5 offset-1">
                                            <h4 class="my-2"> <i class="fa-solid fa-user-shield"></i>
                                                {{ $item->category_id }}
                                            </h4>
                                            <h4 class="my-2"> Price ::
                                                {{ $item->price }} kyats
                                            </h4>
                                            <h4 class="my-2"> Watch ::
                                                {{ $item->view_count }} person
                                            </h4>
                                            <h4 class="my-2"> cook-time::
                                                {{ $item->waiting_time }} min
                                            </h4>

                                            <h4 class="my-2"> <i class="fa-solid fa-user-clock mr-2"></i>
                                                {{ $item->created_at->format('j-F-y') }}</h4>

                                        </div>
                                    </div>
                                    <div class="mt-4 mb-5  text-dark">
                                        <span>
                                            {{$item->description}}
                                        </span>
                                    </div>
                                    <div class="row">
                                        <div class=" text-center mt-3">
                                            <a href="{{route('pizza#edit',$item->id)}}">
                                                <button class="btn bg-dark text-white submit">
                                                    <i class="fa-solid fa-pen-to-square me-2"></i> Edit product item
                                                </button>
                                            </a>
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
