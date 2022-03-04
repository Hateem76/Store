@extends('layouts.app')
@section('content')
<div class="form-container my-5">
    <div class="title_container">
        <h2 class="text-center">Edit User</h2>
    </div>
                <form action="{{ route('admin.users.update',$user->id) }}" method="POST">
                    @method('PATCH')
                    @include('Admin.partials.form')
                </form>
</div>
@endsection