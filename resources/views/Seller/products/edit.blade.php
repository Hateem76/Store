@extends('Seller.layouts.app')
@section('content')
<div class="container-fluid add-product-container shadow-lg mt-4"
        style="background-color: white; width:72%; height:auto; border-radius:10px;">
        <div class="row mt-2">
            <div class="text-bold mx-auto mt-5 mt-xs-1">
                <h1>Edit Product</h1>
                <hr>
            </div>

        </div>
        <form action="{{ route('seller.products.update',$product->id) }}" enctype="multipart/form-data" method="post">
            @method('PATCH')
            @csrf
            <div class="form-group justify-content-center row mx-auto">
                <div class="col-sm-5 mt-3">
                    <label>Product Name</label>
                    <input type="text" placeholder="Product name" id="name" name="name"  class="form-control @error('name') is-invalid @enderror"value="{{ old('name',$product->name) }}">
                    @error('name')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-sm-5 mt-3">
                    <label>Brand Name</label>
                    <input placeholder="Brand name" id="brand_name" name="brand_name" type="text" class="form-control @error('brand_name') is-invalid @enderror"value="{{ old('brand_name',$product->brand_name) }}">
                    @error('brand_name')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>

            </div>
            <div class="form-group justify-content-center row">
                <div class="col-sm-3 mt-sm-3 mt-xs-2">
                    <label>Item Type</label>
                    <select value=""  class="form-control @error('category') is-invalid @enderror" id="category" name="category">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            @if (old('category',$product->category_id)==$category->id)
                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('category')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-sm-3 mt-3 mt-xs-0">
                    <label for="">Weight Unit</label>
                    <select value=""  class="form-control @error('unit') is-invalid @enderror" id="unit" name="unit">
                        @if (old('unit',$product->unit)== 'kg')
                            <option value="kg" selected>Kg</option>
                            <option value="gram" >gram</option>
                            <option value="ton" >ton</option>
                        @elseif (old('unit',$product->unit)== 'gram')
                            <option value="gram" selected>gram</option>
                            <option value="kg" >Kg</option>
                            <option value="ton" >ton</option>
                        @elseif(old('unit',$product->unit)== 'ton')
                            <option value="ton" selected>ton</option>
                            <option value="gram" >gram</option>
                            <option value="kg" >Kg</option>
                        @endif
                    </select>
                    @error('unit')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-sm-3 mt-3 mt-xs-0">
                    <label for="">Product Weight</label>
                    <input type="number" step="0.1" name="weight" id="weight" class="form-control @error('weight') is-invalid @enderror"value="{{ old('weight',$product->weight) }}">
                    @error('weight')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-sm-3 mt-3">
                    <label>If want to Change Image</label>
                    <input type="file" accept=".jpg,.jpeg,.png" id="image_path" name="image_path" class="@error('image_path') is-invalid @enderror">
                    @error('image_path')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group justify-content-center row">
                <div class="col-sm-3 mt-sm-3 mt-xs-2">
                    <label>Rent Per Day(Dirham)</label>
                    <input type="number" id="rent_day" name="rent_day" step="0.1" class="form-control @error('rent_day') is-invalid @enderror"value="{{ old('rent_day',$product->rent_day) }}">
                    @error('rent_day')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-sm-3 mt-3 mt-xs-0">
                    <label>Rent Per Week(Dirham)</label>
                    <input type="number" id="rent_week" name="rent_week" step="0.1" class="form-control @error('rent_week') is-invalid @enderror"value="{{ old('rent_week',$product->rent_week) }}">
                    @error('rent_week')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-sm-3 mt-3">
                    <label>Rent Per Month(Dirham)</label>
                    <input type="number" id="rent_month" name="rent_month" step="0.1" class="form-control @error('rent_month') is-invalid @enderror"value="{{ old('rent_month',$product->rent_month) }}">
                    @error('rent_month')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group justify-content-center row">
                <div class="col-sm-10 mt-2">
                    <label for="">Description</label>
                    <textarea rows="3" placeholder="Description.." id="description" name="description"  class="form-control @error('description') is-invalid @enderror">{{ old('description',$product->description) }}</textarea>
                    @error('description')
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