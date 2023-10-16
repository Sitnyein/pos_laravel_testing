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
                                        <h3 class="text-center title-2">Admin Profile edit</h3>
                                    </div>
                                    <div class="my-2">
                                        <a href="{{ route('acc#detail') }}" class="text-decoration-none text-black"> <i
                                                class="fa-solid fa-arrow-left"></i>back</a>
                                    </div>

                                    <hr>
                                    <form action="{{route('acc#update',Auth::user()->id)}}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-4 offset-1">
                                                @if (Auth::user()->image == null)
                                                    <img src="{{ asset('image/default user.png') }}" class="shadow-sm ">
                                                @else
                                                    <img src="{{ asset('storage/' . Auth::user()->image) }}" />
                                                @endif
                                                <div class=" mt-3">
                                                    <input type="file" name="image" id=""
                                                        class="form-control">
                                                </div>
                                                <div class=" mt-3">
                                                    <button class="btn btn-dark text-white submit col-12">
                                                        Update
                                                        <i class="fa-solid fa-person-walking-dashed-line-arrow-right ml-2">
                                                        </i>

                                                    </button>
                                                </div>
                                            </div>

                                            <div class="  col-4 offset-1">
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Name</label>
                                                    <input name="name" value={{ old('name', Auth::user()->name) }}
                                                        type="text"
                                                        class="form-control @error('name') is-invalid    @enderror"
                                                        aria-required="true" aria-invalid="false"
                                                        placeholder="Enter Admin Name...">
                                                    @error('name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror

                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Email</label>
                                                    <input name="email" value={{ old('email', Auth::user()->email) }}
                                                        type="email"
                                                        class="form-control @error('email') is-invalid  @enderror "
                                                        aria-required="true" aria-invalid="false"
                                                        placeholder="Enter Admin Email...">
                                                    @error('email')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Phone</label>
                                                    <input name="phone" value={{ old('phone', Auth::user()->phone) }}
                                                        type="number"
                                                        class="form-control @error('phone') is-invalid @enderror"
                                                        aria-required="true" aria-invalid="false"
                                                        placeholder="Enter Admin phone...">
                                                    @error('phone')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">address</label>
                                                    <textarea name="address" placeholder="Enter Admin address" class="form-control @error('address') is-invalid  @enderror"
                                                        cols="30" rows="10">{{ old('address', Auth::user()->address) }} </textarea>
                                                    @error('address')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror

                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Gender</label>
                                                    <select name="gender" class="form-control">
                                                        <option value="male"
                                                            @if (Auth::user()->gender == 'male') selected @endif>Male</option>
                                                        <option value="female"
                                                            @if (Auth::user()->gender == 'female') selected @endif>Female
                                                        </option>

                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Role</label>
                                                    <input name="role" value={{ old('role', Auth::user()->role) }}
                                                        type="text" class="form-control" aria-required="true"
                                                        aria-invalid="false" disabled>
                                                </div>



                                            </div>
                                        </div>
                                    </form>

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
