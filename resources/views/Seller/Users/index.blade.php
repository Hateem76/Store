@extends('Seller.layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
    @include('partials.alerts')
    <div class="text-center">
        <h1>Users</h1>
        <hr class="mx-auto" style="width: 13%;">
    </div>
    


    

    <div class="reports-container mt-5">
        <div class="row">
            <div class="table table-bordered table-striped">
                <table>
                    <thead class="" style="background-color: #00d6ab !important;">
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </thead>
                    @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $serialNo++ }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="approval">
                            <a href="{{ route('seller.users.edit',$user->id) }}" class="checkBtn btn btn-outline-success" role="button"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('seller.users.destroy',$user->id) }}" id="delete-user-form-{{ $user->id }}" style="display: none;" method="POST">
                                @csrf
                                @method("DELETE")
                            </form>

                            <button class="crossBtn btn btn-outline-danger"onclick="event.preventDefault();
                                document.getElementById('delete-user-form-{{ $user->id }}').submit()">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>

    <!-------Table End-->
@endsection