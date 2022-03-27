{{-- @extends('Seller.layouts.app')
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


@endsection --}}



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/sidebar2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buyer/tender_table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script type="text/javascript">
        function openImg(imageId) {
            var largeImage = document.getElementById(imageId);
            var url=largeImage.getAttribute('src');
            window.open(url,'Image','width=largeImage.stylewidth,height=largeImage.style.height,resizable=1');
            // alert('hi');
            // fullImgBox.style.display = 'flex';
            // fullImg.src = imgPath;
        }

    </script>
</head>

<body>

@include('Seller.layouts.sidebar2')


        <!------Main Content-->

        <div class="main-content">
            @include('Seller.layouts.header')


            <main>
                @include('Seller.layouts.logout-code')

                <!-----Table Start-->
            <div class="py-5">
                <div class="row setScroll py-5">
                  <div class="col-lg-10 mx-auto mt-2">
                    <div class="card rounded shadow border-0">
                      <div class="card-body px-5 py-4 bg-white rounded">
                        @include('partials.alerts')
                          <div class="row setScroll mb-2 d-flex" style="justify-content: space-between;">
                              <h2 class=" pl-3">Products</h2>
                              <div>
                                    <a type="button" class="btn btn-success btn-sm" href="{{ route('seller.products.create') }}" style="text-decoration:none;">Create</a>
                                    <a type="button" class="btn btn-dark btn-sm" href="{{ route('seller.stockInForm') }}" style="text-decoration:none;">Stock In</a>
                                    <a type="button" class="btn btn-warning btn-sm text-white" href="{{ route('seller.stockOutForm') }}" style="text-decoration:none;">Stock Out</a>
                              </div>
                          </div>
                        <div class="table-responsive">
                          <table id="example" style="width:100%" class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th>SNO</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Brand</th>
                                <th>Unit</th>
                                <th>Stock</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    <td>{{ $serialNo++ }}</td>
                                    <td> {{ $product->name }} </td>
                                    <td> {{ $product->category->name }} </td>
                                    <td> {{ $product->brand_name }} </td>
                                    <td> {{ $product->unit }} </td>
                                    <td> {{ $product->stock }}</td>
                                    <td class="text-center"><img src="{{ asset('images/products/'.$product->image_path) }}" id="{{ $product->id }}" alt="" onclick="openImg('{{ $product->id }}')" style="width: 150px; height:75px; cursor: pointer;"></td>
                                    <td> {{ $product->description }} </td>
                                    <td class="text-center">
                                        <div class="approval">
                                            <a href="{{ route('seller.products.edit',$product->id) }}" class="checkBtn btn btn-success" role="button"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('seller.products.destroy',$product->id) }}" id="delete-form-{{ $product->id }}"  style="display: none;" method="POST">
                                                @csrf
                                                @method("DELETE")
                                            </form>

                                            <button class="crossBtn btn btn-danger"onclick="event.preventDefault();
                                                document.getElementById('delete-form-{{ $product->id }}').submit()">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                  </tr>
                                @endforeach
                                         
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            </div>

            <!-------Table End-->

            <script>
                const response = document.getElementById('viewResponse');
                response.addEventListener('click',()=>{
                    document.getElementById('responseTable').classList.toggle('response-table');
                    document.getElementById('responseTable').classList.add('addTransition');
                })
            </script>

      

        </main>

    </div>

    <!---End of Main Content-->


   
    <script src="{{ asset('js/jquery-min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

</body>

</html>



