@extends('Admin.layouts.app-dashboard')
@section('content')
<!----Card Section-->
<div class="cards">
    <a href="{{ route('admin.users.index') }}" id="users" style="display: none;"></a>
    <div class="card-single shadow-lg" onclick="document.getElementById('users').click();">
      <div>
        <h1>{{ $users }}</h1>
        <span>User Accounts</span>
      </div>
      <div class="icon-container bg-success">
        <span class="fa fa-credit-card"></span>
      </div>
    </div>
    <a href="{{ route('admin.category.index') }}" id="category" hidden></a>
    <div class="card-single shadow-lg" onclick="document.getElementById('category').click();">
      <div>
        <h1>{{ $categories }}</h1>
        <span>Categories</span>
      </div>
      <div class="icon-container bg-danger">
        <span class="fa fa-users"></span>
      </div>
    </div>
    <div class="card-single shadow-lg" onclick="document.getElementById('contacts').click();">
      <div>
        <h1>0</h1>
        <span>Nothing here</span>
      </div>
      <div class="icon-container bg-dark">
        <span class="fa fa-address-book"></span>
      </div>
    </div>
  </div>
  <div class="cards">
    <div class="card-single shadow-lg" onclick="document.getElementById('tenders').click();">
      <div>
        <h1>0</h1>
        <span>Nothing here</span>
      </div>
      <div class="icon-container bg-warning">
        <span class="fa fa-tasks"></span>
      </div>
    </div>
    <div class="card-single shadow-lg">
      <div>
        <h1>0</h1>
        <span>Nothing here</span>
      </div>
      <div class="icon-container bg-secondary">
        <span class="fa fa-credit-card"></span>
      </div>
    </div>
    <div class="card-single shadow-lg" onclick="document.getElementById('projects').click();">
      <div>
        <h1>0</h1>
        <span>Nothing here</span>
      </div>
      <div class="icon-container bg-info">
        <span class="fa fa-project-diagram"></span>
      </div>
    </div>
  </div>
  <!------End of Card Section-->

@endsection