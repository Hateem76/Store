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
<!-- The Modal -->
<div class="modal fade mt-4" id="tender_details">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Tender Details</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <table class="table-bordered">
                
            </table>
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
                              <h2 class=" pl-3">Projects</h2>
                              {{-- <button class="btn text-white mb-2 btn-md mr-4" style="background-color: #184A45FF;">Create &RightArrow;</button> --}}
                          </div>
                        <div class="table-responsive">
                          <table id="example" style="width:100%" class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th>SNO</th>
                                <th>Tender Name</th>
                                <th>Buyer</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                <tr>
                                    <td>{{ $serialNo++ }}</td>
                                    <td>{{ $project->tender->product_name }}</td>
                                    <td><a href="{{ route('extras.vendorProfile',$project->buyer) }}" class="text-danger" style="text-decoration: none;">Buyer</a></td>
                                    <td>{{ $project->date_from }}</td>
                                    <td>{{ $project->date_to }}</td>
                                    <td>@if ($project->status == 0)
                                            Running
                                        @else
                                            Finished
                                        @endif
                                    </td>
                                    <td class="">
                                        <div class="approval">
                                            {{-- <button title="Edit" class="checkBtn btn btn-success">
                                                <i class="fas fa-edit"></i>
                                            </button> --}}
                                            <button title="Delete" class="crossBtn btn btn-danger">
                                                <i class="fa-solid fa-trash-can"></i>
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



