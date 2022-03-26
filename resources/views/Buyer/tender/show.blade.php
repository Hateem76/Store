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
            document.getElementById('tender_id').value = tenderId;
            document.getElementById('user_id').value = userId;
            $('#sendConfirmationLetter').modal('show');
        }
        function remarks_x_del(responseId,calledBy){
            if(calledBy == 'delete'){
                // alert('delete');
                document.getElementById('response_id').value = responseId; 
                document.getElementById("remarks_x_del_form").action = "{{ route('buyer.deleteResponse') }}";
                document.getElementById("remarks_x_del_form").submit();
            }
            else if(calledBy == 'remarks'){
                // alert('remarks');
                document.getElementById('response_id').value = responseId; 
                document.getElementById("remarks_x_del_form").action = "{{ route('buyer.submitRemarks') }}";
                $('#submitRemarks').modal('show');
            }
        }

    </script>
</head>

<body>

    

@include('Buyer.layouts.sidebar2')

<!-- Confirmation Modal -->
<div class="modal fade mt-4" id="sendConfirmationLetter">
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
                        <div class="col-11 mx-auto">
                            <label for="confirmation_letter">Choose Letter File</label>
                            <input type="file" id="confirmation_letter" name="confirmation_letter" accept=".pdf" class="form-control @error('confirmation_letter') is-invalid @enderror">
                            @error('confirmation_letter')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-11 mx-auto mb-3">
                            <label for="confirmation_link">Link of Files (either choose pdf file or use link.If both are chosen then link will be used.)</label>
                            <input type="text" id="confirmation_link" name="confirmation_link"  class="form-control @error('confirmation_link') is-invalid @enderror">
                            @error('confirmation_link')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn text-white btn-block"style = "background-color: #184A45FF;">Approve</button>  
                </div>
            </form>
            <!-- Modal footer -->
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- The Modal -->
<div class="modal fade mt-4" id="submitRemarks">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Submit Remarks</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <form action="" method="POST" id="remarks_x_del_form">
                @csrf
                <div class="modal-body">  
                    <div class="form-group row">
                    <input type="text" name="id" id="id" hidden value="{{ $tender->id }}">
                    <input type="text" name="response_id" id="response_id" hidden value="">
                    <div class="col mx-auto">
                        <label for="buyer_remarks">Remarks</label>
                        <textarea id="buyer_remarks" rows="3" name="buyer_remarks" class="form-control"  style="border-radius: 25px;"></textarea>
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
                

                 <!----- First Table Start-->
            <div class="py-lg-5 pt-4">
                <div class="row setScroll pt-lg-5">
                  <div class="col-lg-11 mx-auto mt-2">
                    <div class="card rounded shadow-md">
                      <div class="card-body px-5 py-4 bg-white rounded">
                        @include('partials.alerts')
                          <div class="row setScroll mb-3 d-flex" style="justify-content: space-between;">
                              <h3 class=" pl-3">Tender Details</h3>
                              <!-- <button class="btn btn-success mb-2 btn-md mr-4">&leftarrow; Back</button> -->
                          </div>
                        <div class="table-responsive">
                          <table id="example" style="width:100%;" class="table table-striped table-bordered">
                            <thead>
                              <tr style="font-size: 14px;">
                                <th colspan="">Tender No</th>
                                <th colspan="">Description</th>
                                <th colspan="">Publishing Date</th>
                                <th colspan="">Closing Date</th>
                                <th>Location</th>
                                <th>Unit</th>
                                <th>QTY</th>
                                <th>Currency</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr style="font-size: 14px;">
                                <td colspan="">TN{{ $tender->id }}</td>
                                <td colspan="">{{ $tender->description }}</td>
                                <td colspan="">{{ $tender->opening_date }}</td>
                                <td colspan="">{{ $tender->closing_date }}</td>
                                <td>{{ $tender->location }}</td>
                                <td>{{ $tender->unit }}</td>
                                <td>{{ $tender->quantity }}</td>
                                <td>{{ $tender->currency }}</td>
                             
                            </tr>                 
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>

            <!-------First Table End-->

             <!----- Second Table Start-->
             <div class="py-4">
                <div class="row setScroll">
                  <div class="col-lg-10 mx-auto mt-2">
                    <div class="card rounded shadow-sm">
                      <div class="card-body px-5 py-4 bg-white rounded">
                          <div class="row setScroll mb-3 d-flex" style="justify-content: space-between;">
                              <h3 class=" pl-3">Responses</h3>
                              <!-- <button class="btn btn-success mb-2 btn-md mr-4">&leftarrow; Back</button> -->
                          </div>
                        <div class="table-responsive">
                          <table id="example" style="width:100%;" class="table table-bordered">
                            <thead>
                              <tr style="font-size: 14px;">
                                <th>Seller</th>
                                {{-- <th>Unit Rate</th> --}}
                                {{-- <th>Discount</th> --}}
                                <th>Unit Price</th>
                                <th>Attachments</th>
                                <th class="text-center">Action</th>
                              </tr>
                            </thead>
                            <tbody style="font-size: 14px;">
                                @foreach ($tender->tender_responses as $response)
                                @if($response->deleted == 0)
                                <div class="response-row-container">
                                    <tr style="background-color: #e5e5e5;">
                                        <td><a href="{{ route('extras.vendorProfile',$response->user->id) }}" class="text-danger" style="text-decoration:none;">{{ $response->user->name }}</a>
                                        </td>
                                        {{-- <td>100</td> --}}
                                        {{-- <td>10</td> --}}
                                        <td>{{ $response->price }}</td>
                                        <td class="text-center">
                                            @if ($response->attachments_link == null)
                                                <form action="{{ route('extras.downloadQuotation') }}" method="POST">
                                                    @csrf
                                                    <input type="text" name="quotation" value="{{ $response->quotation }}" hidden>
                                                    <button class="btn btn-sm btn-secondary text-white" type="submit">quotation <i class="fa fa-download"></i></button>
                                                </form>
                                            @else
                                                <a target="_blank" href="{{ $response->attachments_link }}">Files Link</a>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="buttons-container d-flex">
                                                @cannot('confirmation-letter',$tender)
                                                    <button title="Approve" class="btn btn-sm btn-info" onclick="myfun('{{ $response->tender_id }}','{{ $response->user_id }}')">
                                                        <i class="fas fa-thumbs-up text-white"></i>
                                                    </button>
                                                @endcannot
                                                @can('response-confirmation-letter',$response)
                                                    <a href="{{ route('buyer.cancelLetter',[$response->user_id,$response->tender_id]) }}" title="Cancel Letter" class="btn btn-dark btn-sm" type="button">
                                                        <i class="fas fa-times text-white"></i>
                                                    </a>
                                                @endcan
                                                <button title="Delete" class="btn ml-2 btn-sm" style="background-color: #FF420F;" onclick="remarks_x_del('{{ $response->id }}','delete');">
                                                    <i class="fa-solid fa-trash-can text-white"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>
                                        <div class="remarks d-flex" >
                                            <h6 style="font-weight: 600;" class="pt-1">Remarks:</h6>
                                            <div class="add-response ml-3" style="cursor: pointer;" title="Create">
                                                @if ($response->buyer_remarks == null)
                                                    <i class="fa-solid fa-circle-plus text-success" onclick="remarks_x_del('{{ $response->id }}','remarks');" style="font-size: 25px;"></i>
                                                @endif
                                            </div>
                                        </td>
                                        <td colspan="5">
                                            <div class="remarks-txt ml-3 pt-1 ">
                                                You only have one chance for Remarks. Please Be precise.
                                            </div>
                                        </div>
                                    </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        <div class="remarks d-flex">
                                            <h6 style="font-weight: 600;" class="pt-1">Seller Remarks</h6>
                                    
                                        </td>
                                        <td colspan="5">
                                            <div class="remarks-txt ml-3 pt-1 text-secondary">
                                                {{ $response->description }}
                                            </div>
                                        </div>
                                    </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                <h6 class="ml-1" style="font-weight: 600;">Buyer Remarks</h6>
                                            </td>
                                            <td colspan="5">
                                                <div class="remarks-txt ml-3 pt-1 text-secondary">
                                                    {{ $response->buyer_remarks }}
                                                </div>
                                            </div>
                                        </td> 
                                    </tr> 
                                </div>
                                @endif
                                @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>

            <!-------Second Table End-->


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



