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
                                    {{-- form  --}}
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-4 offset-1">
                                                <img src="{{ asset('storage/' . $product->image) }}" />

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
                                                    <input name="name" value={{ old('name', $product->name) }}
                                                        type="text"
                                                        class="form-control @error('name') is-invalid    @enderror"
                                                        aria-required="true" aria-invalid="false"
                                                        placeholder="Enter product Name...">
                                                    @error('name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror

                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Description</label>
                                                  <textarea name="description" placeholder="Enter your description ...." class=" form-control @error('description') is-invalid  @enderror" cols="20" rows="10">{{old('description',$product->description)}}</textarea>
                                                    @error('description')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Price</label>
                                                    <input name="price" type="number" value="{{ old('price',$product->price) }}"
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
                                                    <input name="time" type="text" value="{{ old('time',$product->waiting_time) }}"
                                                        class="form-control @error('time') is-invalid  @enderror"
                                                        aria-required="true" aria-invalid="false" placeholder="Enter cook time...">
                                                    @error('time')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Watched person</label>
                                                    <input name="view" value="{{$product->view_count}}"
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
