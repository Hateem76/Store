@can('buyer')
    @php
        $check = 'Buyer.layouts.app';
    @endphp    
@endcan

@extends($check)
@section('content')
<div class="py-5">
    <div class="row setScroll py-5">
      <div class="col-lg-10 mx-auto mt-2">
        <div class="card rounded shadow border-0">
          <div class="card-body px-5 py-4 bg-white rounded">
              <div class="row setScroll mb-2 d-flex" style="justify-content: space-between;">
                  <h2 class=" pl-3">Contacts</h2>
                  {{-- <button class="btn text-white mb-2 btn-md mr-4" style="background-color: #184A45FF;">Create &RightArrow;</button> --}}
              </div>
            <div class="table-responsive">
              <table id="example" style="width:100%" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>SNO</th>
                    <th>Contact Name</th>
                  </tr>
                </thead>
                <tbody>
        
                    @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $serialNo++ }}</td>
                        <td><a class="ml-5" href="{{ route('extras.vendorProfile',$contact->user_id) }}"> {{ $contact->user->name }} </a></td>
                      </tr>
                    @endforeach
                             
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
  </div>
@endsection
