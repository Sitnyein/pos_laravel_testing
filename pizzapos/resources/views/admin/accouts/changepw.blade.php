{{-- //same// change =edit=page  --}}

@extends('admin.template.master')

@section('content')
<div class="main-content items-center ">
    <div class="section__content section__content--p30 ">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="container-fluid">
                    <div class="col-lg-6 offset-3 mt-5">
                        <div class="card mt-5 shadow-lg">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Change Password</h3>
                                </div>
                                @if (session('success'))
                                    <!--alert message update-->
                                    <div class='col-12'>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <i class="fa-solid fa-check"></i> {{ session('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    </div>
                                @endif
                                @if (session('notMatch'))
                                    <!--alert message old ps wrong-->
                                    <div class='col-12'>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <i class="fa-solid fa-check"></i> {{ session('notMatch') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    </div>
                                @endif
                                <hr>
                                <form action="{{route('change#password')}}" method="post" novalidate="novalidate">
                                    @csrf
                                    <div class="form-group">
                                        <label class="control-label mb-1">Old password</label>
                                        <input name="oldPassword" type="password"
                                            class="form-control @error('oldPassword') is-invalid  @enderror"
                                            aria-required="true" aria-invalid="false"
                                            placeholder="Enter old password...">
                                        @error('oldPassword')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">New password</label>
                                        <input name="newPassword" type="password"
                                            class="form-control   @error('newPassword') is-invalid @enderror"
                                            aria-required="true" aria-invalid="false"
                                            placeholder="Enter new password...">

                                        @error('newPassword')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror


                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Comfrim password</label>
                                        <input name="comfrimPassword" type="password"
                                            class="form-control @error('comfrimPassword') is-invalid  @enderror"
                                            aria-required="true" aria-invalid="false"
                                            placeholder="Enter confrim password...">
                                        @error('comfrimPassword')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div>
                                        <button id="payment-button" type="submit"
                                            class="btn btn-lg btn-info btn-block">
                                            <span id="payment-button-amount">Change Password</span>
                                            {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                            <i class="fa-solid fa-key"></i>
                                        </button>
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

@endsection
