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

@include('Buyer.layouts.sidebar2')
<!-- The Modal -->
<div class="modal fade mt-4" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Confirmation Letter</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <form action="{{ route('buyer.confirmationLetter') }}" method="POST" enctype="multipart/form-data" >
                @csrf
                <div class="modal-body">  
                    <div class="form-group row">
                    <input type="text" name="tender_id" id="tender_id" hidden>
                    <input type="text" name="user_id" id="user_id" hidden>
                    <div class="col mx-auto">
                        <label for="confirmation_letter">Choose Letter File</label>
                        <input type="file" id="confirmation_letter" name="confirmation_letter" accept=".pdf" class="form-control @error('confirmation_letter') is-invalid @enderror">
                        @error('confirmation_letter')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
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
            @include('Buyer.layouts.header')


            <main>
                @include('Buyer.layouts.logout-code')

                <!-----Table Start-->
            <div class="py-5">
                <div class="row setScroll py-5">
                  <div class="col-lg-11 mx-auto mt-2">
                    <div class="card rounded shadow border-0">
                      <div class="card-body px-5 py-4 bg-white rounded">
                        @include('partials.alerts') 
                          <div class="row setScroll mb-2 d-flex" style="justify-content: space-between;">
                              <h2 class=" pl-3">Tenders</h2>
                              <a href="{{ route('buyer.tenders.create') }}" class="btn text-white mb-2 btn-md mr-4" type="button" style="background-color: #184A45FF;">Create &RightArrow;</a>
                          </div>
                        <div class="table-responsive">
                          <table id="example" style="width:100%" class="table table-striped table-bordered">
                            <thead>
                              <tr style="font-size: 14px;">
                                <th>SNO</th>
                                <th>Tender Number</th>
                                <th>Responses</th>
                                <th>Opening Date</th>
                                <th>Closing Date</th>
                                <th>Description</th>
                                <th>Public/Private</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($tenders as $tender)
                                <tr style="font-size: 14px;">
                                    <td>{{ $serialNo++ }}</td>
                                    <td>TN{{ $tender->id }}</td>
                                    <td>
                                        @php
                                            $count = $tender->tender_responses()->count();
                                        @endphp
                                        {{ $count }}
                                    </td>
                                    <td>{{ $tender->opening_date }}</td>
                                    <td>{{ $tender->closing_date }}</td>
                                    <td><div style="height:40px; overflow-y:scroll; width:150px;">{{ $tender->description }}</div></td>
                                    <td>@if ($tender->public_private == 0)
                                        Private
                                        @else
                                        Public
                                    @endif</td>
                                    <td>
                                        <div class="approval">
                                            <button title="Edit" class="checkBtn btn btn-sm btn-info">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button title="Delete" class="crossBtn btn btn-sm btn-danger">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                            <a href="{{ route('buyer.tenders.show',$tender->id) }}" type="button" class=" crossBtn btn-sm btn btn-secondary">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
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



