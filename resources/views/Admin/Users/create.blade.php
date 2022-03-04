@extends('layouts.app')
@section('content')
<div class="form-container my-5">
    <div class="title_container">
        <h2 class="text-center">Create User</h2>
    </div>
        <form action="{{ route('admin.users.store') }}" method="POST">
            @include('Admin.partials.form',['create' => true])
        </form>
    </div>
@endsection