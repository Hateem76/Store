@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-6">
                <h1>
                    Users
                </h1>
            </div>
            <div class="col-6">
                <a href="{{ route('admin.users.create') }}"class="btn btn-success font-italic float-right">Create&rarr;</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="{{ route('admin.users.edit',$user->id) }}" class="btn btn-sm btn-primary" role="button">Edit</a>
                                    <button class="btn btn-sm btn-danger" onclick="event.preventDefault();
                                                    document.getElementById('delete-user-form-{{ $user->id }}').submit()">Delete</button>
                                    <form action="{{ route('admin.users.destroy',$user->id) }}" id="delete-user-form-{{ $user->id }}" style="display: none;" method="POST">
                                        @csrf
                                        @method("DELETE")
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                      {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection