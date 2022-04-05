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
                            <h1>Set Category</h1>
                            <hr>
                        </div>
            
                    </div>
                    <form action="{{ route('admin.setCategory') }}" method="post">
                        @csrf
                        <div class="form-group justify-content-center row mx-auto">
                            <div class="col-sm-5 mt-3">
                                <label class="form-label">Position</label>
                                <select name="position" id="position" class="form-control">
                                    <option value="cat1">1</option>
                                    <option value="cat2">2</option>
                                    <option value="cat3">3</option>
                                    <option value="cat4">4</option>
                                    <option value="cat5">5</option>
                                    <option value="cat6">6</option>
                                </select>
                            </div>
                            <div class="col-sm-5 mt-3">
                                <label class="form-label">Image</label>
                                <select name="category" id="category" class="form-control">
                                    @foreach ($catIds as $catId)
                                        <option value="{{ $catId }}">Cat{{ $catId }}</option>
                                    @endforeach
                                </select>
                            </div>
            
                        </div>
                        <div class="row mx-auto justify-content-center mt-4 ">
                            <button type="submit" class="btn btn-dark btn-lg mt-4 mb-4" style="width: 300px;">Done</button>
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