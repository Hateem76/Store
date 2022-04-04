@extends('Admin.layouts.app')
@section('content')
     <!-----Table Start-->
     <div class="py-5">
        <div class="row setScroll py-5">
          <div class="col-lg-10 mx-auto mt-2">
            <div class="card rounded shadow border-0">
              <div class="card-body px-5 py-4 bg-white rounded">
                @include('partials.alerts')
                <div class="container-fluid add-product-container shadow-lg mt-4"
                style="background-color: white; width:72%; height:auto; border-radius:10px;">
                    <div class="row mt-2">
                        <div class="text-bold mx-auto mt-5 mt-xs-1">
                            <h1>Create Category</h1>
                            <hr>
                        </div>
            
                    </div>
                    <form action="{{ route('admin.category.store') }}" method="post">
                        @csrf
                        <div class="form-group justify-content-center row mx-auto">
                            <div class="col-10 mt-3">
                                <label>Name</label>
                                <input placeholder="Enter name" id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror"value="{{ old('name') }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
            
                        </div>
                        <div class="row mx-auto justify-content-center mt-4 ">
                            <button type="submit" class="btn btn-dark btn-lg mt-4 mb-4" style="width: 300px;">Create</button>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>

    <!-------Table End-->


@endsection