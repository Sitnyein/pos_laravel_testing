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
                                        <h3 class="text-center title-2">Account info</h3>
                                    </div>
                                    <div class="my-2">
                                        <a href="{{ route('category#list') }}" class="text-decoration-none text-black"> <i
                                                class="fa-solid fa-arrow-left"></i>back</a>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-3 offset-2">
                                            @if (Auth::user()->image == null)
                                                @if (Auth::user()->gender == 'male')
                                                    <img src="{{ asset('image/default user.png') }}" class="shadow-sm">
                                                @else
                                                    <img src="{{ asset('image/girl.png') }}" class=" w-75 shadow-sm">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/' . Auth::user()->image) }}" />
                                            @endif
                                        </div>
                                        <div class="col-5 offset-1">
                                            <h4 class="my-2"> <i class="fa-solid fa-user-shield"></i>
                                                {{ Auth::user()->name }}
                                            </h4>
                                            <h4 class="my-2"> <i class="fa-solid fa-mars-stroke-up mr-2"></i>
                                                {{ Auth::user()->gender }}
                                            </h4>
                                            <h4 class="my-2"> <i class="fa-solid fa-at me-2"></i>
                                                {{ Auth::user()->email }}
                                            </h4>
                                            <h4 class="my-2"> <i class="fa-solid fa-phone me-2"></i>
                                                {{ Auth::user()->phone }}
                                            </h4>
                                            <h4 class="my-2"> <i class="fa-regular fa-address-book me-2"></i>
                                                {{ Auth::user()->address }}</h4>
                                            <h4 class="my-2"> <i class="fa-solid fa-user-clock mr-2"></i>
                                                {{ Auth::user()->created_at->format('j-F-y') }}</h4>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4 offset-2 mt-3">
                                            <a href="{{ route('acc#editpage') }}">
                                                <button class="btn bg-dark text-white submit">
                                                    <i class="fa-solid fa-pen-to-square me-2"></i> Edit profile
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
