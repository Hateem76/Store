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
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
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
@include('partials.alerts') 
@include('Buyer.layouts.sidebar2')

<div class="main-content">
    @include('Buyer.layouts.header')


    <main>
        @include('Buyer.layouts.logout-code')

<div class="table-container">
    <div class="text-center">
        <h1 class="mt-5">Users</h1>
        <hr class="mx-auto" style="width: 13%;">
    </div>
    <div class="row createBtn mx-auto">
        <a href="{{ route('buyer.users.create') }}" type="button" class="btn btn-success text-white" style="background-color: #184A45FF;">Create &RightArrow;</a>
    </div>

    <div class="reports-container mt-4">
        <div>
            <table class="table table-bordered table-striped">
                <thead class="text-white" style="background-color: #184A45FF;">
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th class="text-center">Actions</th>
                </thead>
                @foreach ($users as $user)
                    <tr style="background-color: white;">
                        <th scope="row">{{ $serialNo++ }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="text-center">
                            <a href="{{ route('buyer.users.edit',$user->id) }}" class="btn btn-sm btn-primary" role="button">Edit</a>
                            <button class="btn btn-sm btn-danger" onclick="event.preventDefault();
                                            document.getElementById('delete-user-form-{{ $user->id }}').submit()">Delete</button>
                            <form action="{{ route('buyer.users.destroy',$user->id) }}" id="delete-user-form-{{ $user->id }}" style="display: none;" method="POST">
                                @csrf
                                @method("DELETE")
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
            {{ $users->links() }}
        </div>
    </div>
</div>

    </main>
</div>
</body>
</html>