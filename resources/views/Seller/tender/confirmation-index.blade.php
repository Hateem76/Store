@extends('Seller.layouts.app')
@section('content')
@include('partials.alerts')
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



@foreach ($tenders as $tender)
<div class="d-flex mt-4 ml-5">
    <h3 class="m-3">{{ $serialNo++ }}</h3>
    <h3 class="m-3">{{ $tender->product->name }}</h3>
    <h3 class="m-3">{{ $tender->tender->quantity }}</h3>
    <h3 class="m-3">{{ $tender->tender->quantity }}</h3>
    <form action="{{ route('extras.downloadQuotation') }}" method="POST">
        @csrf
        <input type="text" name="quotation" value="{{ $tender->quotation }}" hidden>
        <button class="btn btn-sm btn-warning" type="submit">Quotation?</button>
    </form>
    @if ($tender->confirmation_letter == 1)
        <form action="{{ route('extras.downloadLetter') }}" method="POST">
            @csrf
            <input type="text" name="letter" value="{{ $tender->letter_pdf }}" hidden>
            <button class="btn btn-sm btn-dark ml-3" type="submit">Letter?</button>
            <a href="" onclick="event.preventDefault(); myfun('{{ $tender->tender->duration }}','{{ $tender->tender->id }}')">Confirm</a>
        </form>
    @else
        <h3 class="m-3">No confirmation Yet</h3>
    @endif
    <br>
</div>
@endforeach


@endsection