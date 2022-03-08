{{-- @extends('Seller.layouts.app')
@section('content')
@include('partials.alerts')
<div class="container-fluid add-product-container shadow-lg mt-4"
        style="background-color: white; width:72%; height:auto; border-radius:10px;">
        

    </div>

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
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buyer/tender_table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script type="text/javascript">
        function myfun(tenderId,userId){
            // console.log(tenderId);
            // console.log(user_id);
            document.getElementById('tender_id').value = tenderId;
            document.getElementById('user_id').value = userId;
            $('#myModal').modal('show');
        }
        function myfun2(){
            console.log('clicked');
            
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
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                        
                                    </div>
                                    <div class="col-sm-5 mt-3">
                                        <label>Quantity</label>
                                        <input placeholder="Enter Quantity" id="quantity" name="quantity" type="text" class="form-control @error('quantity') is-invalid @enderror"value="{{ old('quantity') }}">
                                        @error('quantity')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                    
                                </div>
                                <div class="row mx-auto justify-content-center mt-4 ">
                                    <button type="submit" class="btn btn-dark btn-lg mt-4" style="width: 300px;">ADD</button>
                                </div>
                            </form>
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