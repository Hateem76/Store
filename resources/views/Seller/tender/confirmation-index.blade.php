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
        function myfun(duration,tenderId){
            // console.log(tenderId);
            n =  new Date();  // first_date1
            y = n.getFullYear();
            m = n.getMonth() + 1;
            d = n.getDate();
            var start_date1 = y + '-' + m + '-' + d;
            // end_date1
            n.setDate(n.getDate() + Number(duration));
            y = n.getFullYear();
            m = n.getMonth() + 1;
            d = n.getDate();
            var end_date1 = y + '-' + m + '-' + d;
            // console.log(start_date1);
            // console.log(end_date1);
            document.getElementById('start_date1').value = start_date1;
            document.getElementById('end_date1').value = end_date1;
            document.getElementById('tender_id').value = Number(tenderId);
            $('#myModal').modal('show');
        }
        function myfun2(){    // if checkbox is clicked
            var div1 = document.getElementById('div1');
            var div2 = document.getElementById('div2');
            if (document.getElementById('checkbox').checked) {
                div1.removeAttribute("hidden");
                div2.removeAttribute("hidden"); 
            } else {
                div1.setAttribute("hidden",true);
                div2.setAttribute("hidden",true); 
            }
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
            <h4 class="modal-title">Confirm Date</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <form action="{{ route('seller.confirmProject') }}" method="POST" >
                @csrf
                <div class="modal-body"> 
                    <div class="form-group row">
                        <div class="col-sm-5 mx-auto">
                            <label for="start_date1">Start Date:</label>
                            <input type="text" id="start_date1" name="start_date1" class="form-control bg-white" readonly>
                        </div>
                        <div class="col-sm-5 mx-auto">
                            <label for="end_date1">End Date:</label>
                            <input type="text" id="end_date1" name="end_date1"  class="form-control bg-white" readonly>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <div class="col-sm-10  mx-auto">
                            <input type="checkbox" id="checkbox" name="checkbox" class="" onclick="myfun2();">
                            <label for="checkbox">Edit Dates</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-5 mx-auto" id="div1" hidden>
                            <label for="start_date2">Start Date:</label>
                            <input type="date" id="start_date2" name="start_date2" class="form-control @error('start_date2') is-invalid @enderror">
                        </div>
                        <div class="col-sm-5 mx-auto" id="div2" hidden>
                            <label for="end_date2">End Date</label>
                            <input type="date" id="end_date2" name="end_date2"  class="form-control @error('end_date2') is-invalid @enderror">
                        </div>
                    </div>
                    <input type="text" id="tender_id" name="tender_id" value="0" hidden>
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
                              <h2 class=" pl-3">Tenders Confirmation</h2>
                              {{-- <button class="btn text-white mb-2 btn-md mr-4" style="background-color: #184A45FF;">Create &RightArrow;</button> --}}
                          </div>
                        <div class="table-responsive">
                          <table id="example" style="width:100%" class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th>SNO</th>
                                <th>Tender Name</th>
                                <th>My Product</th>
                                <th>Quantity</th>
                                <th>Unit</th>
                                <th>Duration</th>
                                <th>Description</th>
                                <th>Quotation</th>
                                <th>Confirmation Letter</th>
                                <th>Confirm Project</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($responses as $response)
                                <tr>
                                    <td>{{ $serialNo++ }}</td>
                                    <td>{{ $response->tender->product_name }}</td>
                                    <td>{{ $response->product->name }}</td>
                                    <td>{{ $response->tender->quantity }}</td>
                                    <td>{{ $response->tender->unit }}</td>
                                    <td>{{ $response->tender->duration }}</td>
                                    <td>{{ $response->tender->description }}</td>
                                    <td>
                                        <form action="{{ route('extras.downloadQuotation') }}" method="POST">
                                            @csrf
                                            <input type="text" name="quotation" value="{{ $response->quotation }}" hidden>
                                            <button class="btn btn-sm btn-warning" type="submit">Quotation?</button>
                                        </form>
                                    </td>
                                    @if ($response->confirmation_letter == 1)
                                    <td>
                                        <form action="{{ route('extras.downloadLetter') }}" method="POST">
                                            @csrf
                                            <input type="text" name="letter" value="{{ $response->letter_pdf }}" hidden>
                                            <button class="btn btn-sm btn-warning ml-3" type="submit">Letter?</button>
                                        </form>
                                    </td>
                                    <td class="text-center"><a href="" type="button" class="btn btn-success " onclick="event.preventDefault(); myfun('{{ $response->tender->duration }}','{{ $response->tender->id }}')"><i class="fa-solid fa-check"></i></a></td>
                                    @else
                                        <td>No confirmation Yet</td>
                                        <td>
                                        </td>
                                    @endif
                                    
                                  </tr>
                                @endforeach
                                    
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