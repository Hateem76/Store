@extends('Seller.layouts.app')
@section('content')
<script type="text/javascript">
    function myfun(tenderId){
        document.getElementById('tender_id').value = tenderId;
        var tender = document.getElementById('tender_id').value;
        $('#myModal').modal('show');
    }
    function myfun2(){
        console.log('clicked');
        
    }
</script> 
@include('partials.alerts')
<!-- The Modal -->
<div class="modal fade mt-4" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Submit Response</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <form action="{{ route('seller.tendersResponse') }}" method="POST" enctype="multipart/form-data" >
                @csrf
                <div class="modal-body">  
                    <div class="form-group row">
                    <div class="col-sm-5 mx-auto">
                        <label for="name">Product Name:</label>
                        <select class="form-control @error('name') is-invalid @enderror" id="name" name = "name">
                            <option value="">Select Product</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="text" name="tender_id" id="tender_id" hidden>
                    <div class="col-sm-5 mx-auto">
                        <label for="quotation">Choose Quotation File</label>
                        <input type="file" id="quotation" name="quotation" accept=".pdf" class="form-control @error('quotation') is-invalid @enderror">
                    </div>
                    </div>

                    <button type="submit" class="btn text-white btn-block"style = "background-color: #184A45FF;">Submit</button>  
                </div>
            </form>
            <!-- Modal footer -->
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

    @foreach ($tenders as $tender)
    <div class="d-flex mt-4 ml-5">
        <h3 class="m-3">{{ $serialNo++ }}</h3>
        <h3 class="m-3">{{ $tender->product_name }}</h3>
        <h3 class="m-3">{{ $tender->quantity }}</h3>
        <h3 class="m-3">{{ $tender->duration }}</h3>

        <br>
        <button type="button" data-toggle="modal" data-target="#myModal"  id="modal-button" onclick="alert('clicked')" hidden></button>
    <button class="btn  btn-lg text-white" style="background-color: #184A45FF;" onclick="myfun({{ $tender->id }});">Add Product</button>

    </div>
    @endforeach
    @if (Session::has('errors'))
        <script type="text/javascript">
            alert('Response Was not Submitted.Check Errors there.')
        </script>
    @endif

@endsection