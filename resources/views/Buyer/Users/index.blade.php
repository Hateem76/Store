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

<div class="main-content">
    @include('Buyer.layouts.header')


    <main>
        @include('Buyer.layouts.logout-code')


    <!-----Table Start-->
    <div class="py-5">
        <div class="row setScroll py-5">
          <div class="col-lg-10 mx-auto mt-2">
            <div class="card rounded shadow border-0">
              <div class="card-body px-5 py-4 bg-white rounded">
                @include('partials.alerts') 
                  <div class="row setScroll mb-2 d-flex" style="justify-content: space-between;">
                      <h2 class=" pl-3">Users</h2>
                      <a href="{{ route('buyer.users.create') }}" type="button" class="btn text-white" style="background-color: #184A45FF;">Create &RightArrow;</a>
                      {{-- <button class="btn text-white mb-2 btn-md mr-4" style="background-color: #184A45FF;">Create &RightArrow;</button> --}}
                  </div>
                <div class="table-responsive">
                  <table id="example" style="width:100%" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>SNo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th class="text-center">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr style="background-color: white;">
                                <th scope="row">{{ $serialNo++ }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="text-center">
                                    <a href="{{ route('buyer.users.edit',$user->id) }}" class="btn btn-sm btn-primary" role="button"><i class="fas fa-edit"></i></a>
                                    <button class="btn btn-sm btn-danger" onclick="event.preventDefault();
                                                    document.getElementById('delete-user-form-{{ $user->id }}').submit()"><i class="fa-solid fa-trash-can"></i></button>
                                    <form action="{{ route('buyer.users.destroy',$user->id) }}" id="delete-user-form-{{ $user->id }}" style="display: none;" method="POST">
                                        @csrf
                                        @method("DELETE")
                                    </form>
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

    </main>
</div>
</body>
</html>