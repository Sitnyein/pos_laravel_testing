@extends('admin.template.master')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-3 offset-8">
                            <a href=""><button
                                    class="btn bg-dark text-white my-3">List</button></a>
                        </div>
                    </div>
                    <div class="col-lg-6 offset-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Create your Category</h3>
                                </div>
                                <hr>
                                <form action="{{route('pizza#create')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label class="control-label mb-1">Name</label>
                                        <input name="name" type="text" value="{{ old('name') }}"
                                            class="form-control @error('name') is-invalid  @enderror"
                                            aria-required="true" aria-invalid="false" placeholder="Enter your pizza name...">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-1">Category</label>
                                        <select name="categoryId" class=" form-control @error('categoryId') is-invalid  @enderror">
                                        <option value="" disabled selected>Choose One Category</option>
                                            @foreach ($categories as $c )
                                         <option value="{{$c->id}}">{{$c->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('categoryId')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-1">Description</label>
                                      <textarea name="description" placeholder="Enter your description ...." class=" form-control @error('description') is-invalid  @enderror" cols="20" rows="10">{{old('description')}}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-1">Image</label>
                                        <input name="image" type="file"
                                            class="form-control @error('image') is-invalid  @enderror"
                                            aria-required="true" aria-invalid="false" >
                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-1">Price</label>
                                        <input name="price" type="number" value="{{ old('price') }}"
                                            class="form-control @error('price') is-invalid  @enderror"
                                            aria-required="true" aria-invalid="false" placeholder="Enter product price...">
                                        @error('price')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label mb-1">Waiting_time</label>
                                        <input name="time" type="text" value="{{ old('time') }}"
                                            class="form-control @error('time') is-invalid  @enderror"
                                            aria-required="true" aria-invalid="false" placeholder="Enter cook time...">
                                        @error('time')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>


                                    <div>
                                        <button id="payment-button" type="submit"
                                            class="btn btn-lg btn-info btn-block">
                                            <span id="payment-button-amount">Create</span>
                                            {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                            <i class="fa-solid fa-circle-right"></i>
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

