@extends('Seller.layouts.app')
@section('content')
<link rel="stylesheet" href="asset('css/table.css')">
@include('partials.alerts')

<!-----Table Start-->
<div class="text-center mt-lg-5 mt-md-5 mt-sm-4">
    <h1>Users</h1>
    <hr class="mx-auto" style="width: 13%;">
</div>
<div class="row createBtn mx-auto ml-lg-5 ml-md-5  ml-xs-2">
    <a type="button" class="btn btn-success" href="{{ route('seller.products.create') }}" style="text-decoration:none;">Create &RightArrow;</a>
</div>
<div class="ml-lg-5 ml-md-5  ml-xs-2">
    <a type="button" class="btn btn-dark" href="{{ route('seller.stockInForm') }}" style="text-decoration:none;">Stock In</a>
</div>
<div class="ml-lg-5 ml-md-5  ml-xs-2">
    <a type="button" class="btn btn-warning" href="{{ route('seller.stockOutForm') }}" style="text-decoration:none;">Stock Out</a>
</div>

<div class="reports-container mt-5">
    <div>
        <table class="table table-bordered table-striped">
            <thead class="bg-dark text-white">
                <th>SNO</th>
                <th>Name</th>
                <th>Type</th>
                <th>Brand</th>
                <th>Weight</th>
                <th>Image</th>
                <th>Description</th>
                <th>Actions</th>
            </thead>
            @foreach ($products as $product)
            <tr>
                <td class="align-middle"> {{ $product->id }} </td>
                <td class="align-middle"> {{ $product->name }} </td>
                <td class="align-middle"> {{ $product->category->name }} </td>
                <td class="align-middle"> {{ $product->brand_name }} </td>
                <td class="align-middle"> {{ $product->weight }}&nbsp;&nbsp;{{ $product->unit }} </td>
                <td class="text-center"><img src="{{ asset('images/products/'.$product->image_path) }}" id="{{ $product->id }}" alt="" onclick="openImg('{{ $product->id }}')" style="width: 150px; height:75px; cursor: pointer;"></td>
                <td class="align-middle"> {{ $product->description }} </td>
                <td class="approval text-center align-middle">
                    <a href="{{ route('seller.products.edit',$product->id) }}" class="checkBtn btn btn-outline-success" role="button"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('seller.products.destroy',$product->id) }}" id="delete-form-{{ $product->id }}"  style="display: none;" method="POST">
                        @csrf
                        @method("DELETE")
                    </form>

                    <button class="crossBtn btn btn-outline-danger"onclick="event.preventDefault();
                        document.getElementById('delete-form-{{ $product->id }}').submit()">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
            @endforeach
            

        </table>
    </div>
</div>

<!-------Table End-->

<script>

    function openImg(imageId) {
        var largeImage = document.getElementById(imageId);
        var url=largeImage.getAttribute('src');
        window.open(url,'Image','width=largeImage.stylewidth,height=largeImage.style.height,resizable=1');
        // alert('hi');
        // fullImgBox.style.display = 'flex';
        // fullImg.src = imgPath;
    }

    

</script>




@endsection