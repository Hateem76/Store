@extends('Seller.layouts.app')
@section('content')
@include('partials.alerts')
<div class="container-fluid add-product-container shadow-lg mt-4"
        style="background-color: white; width:72%; height:auto; border-radius:10px;">
        <div class="row mt-2">
            <div class="text-bold mx-auto mt-5 mt-xs-1">
                <h1>Add Stock</h1>
                <hr>
            </div>

        </div>
        <form action="{{ route('seller.stockIn') }}" method="post">
            @csrf
            <div class="form-group justify-content-center row mx-auto">
                <div class="col-sm-5 mt-3">
                    <label>Product Name</label>
                    <select value=""  class="form-control @error('name') is-invalid @enderror" id="name" name="name">
                        <option value="">Select Product</option>
                        @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                    
                </div>
                <div class="col-sm-5 mt-3">
                    <label>Quantity</label>
                    <input placeholder="Enter Quantity" id="quantity" name="quantity" type="text" class="form-control @error('quantity') is-invalid @enderror"value="{{ old('quantity') }}">
                    @error('quantity')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>

            </div>
            <div class="row mx-auto justify-content-center mt-4">
                <button type="submit" class="btn btn-dark btn-lg mt-4" style="width: 300px;">ADD</button>
            </div>

        </form>

    </div>

@endsection