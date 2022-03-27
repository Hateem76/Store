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
    <link rel="stylesheet" href="{{ asset('css/buyer/tender_table_for_product.css') }}">
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


                        <div class="container-fluid add-product-container shadow-lg"
                        style="background-color: white; width:100%; height:auto; border-radius:10px;">

                          
                            <div class="row ">
                                <div class="text-bold mx-auto mt-2 mt-xs-1">
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
                    <label for="">Unit</label>
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
                    <label for="">Quantity</label>
                    <input type="number" step="0.1" name="quantity" id="quantity" class="form-control @error('quantity') is-invalid @enderror"value="{{ old('quantity',$product->quantity) }}">
                    @error('quantity')
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
                    <label>Currency</label>
                    <input type="text" id="currency" name="currency" class="form-control @error('currency') is-invalid @enderror"value="{{ old('currency',$product->currency) }}">
                    @error('currency')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-sm-3 mt-sm-3 mt-xs-2">
                    <label>Rent Per Day</label>
                    <input type="number" id="rent_day" name="rent_day" step="0.1" class="form-control @error('rent_day') is-invalid @enderror"value="{{ old('rent_day',$product->rent_day) }}">
                    @error('rent_day')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-sm-3 mt-3 mt-xs-0">
                    <label>Rent Per Week</label>
                    <input type="number" id="rent_week" name="rent_week" step="0.1" class="form-control @error('rent_week') is-invalid @enderror"value="{{ old('rent_week',$product->rent_week) }}">
                    @error('rent_week')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-sm-3 mt-3">
                    <label>Rent Per Month</label>
                    <input type="number" id="rent_month" name="rent_month" step="0.1" class="form-control @error('rent_month') is-invalid @enderror"value="{{ old('rent_month',$product->rent_month) }}">
                    @error('rent_month')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group justify-content-center row">
                <div class="col-sm-11 col-lg-11 col-md-11 mt-2">
                    <label for="">Description</label>
                    <textarea rows="3" placeholder="Description.." id="description" style="border-radius: 10px;" name="description"  class="form-control @error('description') is-invalid @enderror">{{ old('description',$product->description) }}</textarea>
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