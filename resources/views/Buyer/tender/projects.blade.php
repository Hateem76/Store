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
    <link rel="stylesheet" href="{{ asset('css/order-confirm.css') }}">
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
            @include('Buyer.layouts.header')


            <main>
                @include('Buyer.layouts.logout-code')

                <!-----Table Start-->
            <!-- Order Confirmation Start -->
          @foreach ($projects as $project)
          <div class="container" style="padding-top: 120px;">
            <div class="row mx-auto">
                <div class="confirmed-txt bg-success py-1 px-1 py-md-2 px-md-3  rounded col-md-4 col-10 mx-auto d-flex justify-content-center align-items-center">
                    <i class="fa-solid fa-circle-check text-white fa-2x "></i>
                    <h3 class="text-white pl-3 pt-2" style="font-weight: bold;letter-spacing: 1px;">Order Confirmed</h3>
                </div>
            </div>
            
            <div class="row mx-auto py-4">
                <div class="col-md-10 mx-auto">
                <table class="table table-bordered border bg-white shadow-sm border rounded">
                    <thead>
                    <tr>
                    <th>Serial No</th>
                    <th>Order Confirmation No</th>
                    <th>Issued Date</th>
                </tr>
            </thead>
                <tbody>
                    <tr>
                        <td>{{ $serialNo++ }}</td>
                        <td>OC{{ $project->id }}</td>
                        <td>{{ $project->date_from }}</td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>

        <div class="row px-md-4 px-2 rounded" style="background-color: rgb(240, 221, 192);">
            <div class="buyer-details col-md-6 py-3" style="border-right: 1px solid rgba(0,0,0,.4);">
                <h4>Buyer : {{ $project->buyer->name }}</h4>
                <div class="details py-2 d-flex justify-content-start" style="gap: 9rem;">
                    <h6>Profile ID No :  PID{{ $project->buyer->id }}</h6>
                    <h6>City :  {{ $project->buyer->address }}</h6>                        
                </div>
                <h6>Contact No :  {{ $project->buyer->number }}</h6>
            </div>
            <div class="buyer-details col-md-6 py-3">
                <h4>Seller : {{ $project->seller->name }}</h4>
                <div class="details py-2 d-flex justify-content-start" style="gap: 9rem;">
                    <h6>Profile ID No :  PID{{ $project->seller->id }}</h6>
                    <h6>City : {{ $project->seller->address }}</h6>                        
                </div>
                <h6>Contact No :  {{ $project->seller->number }}</h6>
            </div>
        </div>

        <div class="row note-txt pt-4 pb-3 mx-auto">
            <h5 style="font-weight: bold;" class="text-center mx-auto text-danger">This Order Confirmation is issued from Buyer to seller with mutually agrees for the Following</h5>
        </div>
        <div class="row note-txt py-0 pl-5 pb-4">
            <h6 style="font-weight: bold;" class="text-center pl-md-5 pl-3">Terms and Conditions :</h6>
        </div>

        <div class="remarks row px-md-2 py-md-3 px-1 py-3" style="border: 2px solid rgb(94, 146, 167);border-radius: 10px;">
            <div class="col-md-11">
                <h5 style="font-weight: 600;">Buyer Remarks : </h5>
                <p>{{ $project->buyer_remarks }} </p>
            </div>
        </div>

        <div class="remarks row px-2 py-3 mt-4 mb-5" style="border: 2px solid rgb(94, 146, 167);border-radius: 10px;">
            <div class="col-md-11">
                <h5 style="font-weight: 600;">Seller Remarks : </h5>
                <p> {{ $project->seller_remarks }}</p>
            </div>
        </div>


        </div>
        @endforeach

  <!-- Order Confirmation End -->

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



