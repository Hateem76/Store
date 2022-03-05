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
        function myfun(tenderId){
            document.getElementById('tender_id').value = tenderId;
            var tender = document.getElementById('tender_id').value;
            $('#myModal').modal('show');
        }
        function myfun2(){
            console.log('clicked');
            
        }
    </script> 
</head>

<body>

@include('Seller.layouts.sidebar2')
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
                              <h2 class=" pl-3">Tenders</h2>
                              {{-- <button class="btn text-white mb-2 btn-md mr-4" style="background-color: #184A45FF;">Create &RightArrow;</button> --}}
                          </div>
                        <div class="table-responsive">
                          <table id="example" style="width:100%" class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th>SNO</th>
                                <th>Tender Name</th>
                                <th>Quantity</th>
                                <th>Unit</th>
                                <th>Duration</th>
                                <th>Description</th>
                                <th class="text-center">Response</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($tenders as $tender)
                                <tr>
                                    <td>{{ $serialNo++ }}</td>
                                    <td>{{ $tender->product_name }}</td>
                                    <td>{{ $tender->quantity }}</td>
                                    <td>{{ $tender->unit }}</td>
                                    <td>{{ $tender->duration }}</td>
                                    <td>{{ $tender->description }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-info text-white" onclick="myfun({{ $tender->id }});">Add Product</button>
                                    </td>
                                  </tr>
                                @endforeach
                                @if (Session::has('errors'))
                                    <script type="text/javascript">
                                        alert('Response Was not Submitted.Check Errors there.')
                                    </script>
                                @endif      
                            </tbody>
                          </table>
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
