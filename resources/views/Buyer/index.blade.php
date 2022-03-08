@extends('Buyer.layouts.app-dashboard')
@section('content')
<!----Card Section-->
<div class="cards">
    <a href="{{ route('seller.products.index') }}" id="products" style="display: none;"></a>
    <div class="card-single shadow-lg" onclick="document.getElementById('users').click();">
      <div>
        <h1>4</h1>
        <span>User Accounts</span>
      </div>
      <div class="icon-container bg-danger">
        <span class="fa fa-credit-card"></span>
      </div>
    </div>
    <a href="{{ route('buyer.users.index') }}" id="users" style="display: none;"></a>
    <div class="card-single shadow-lg" onclick="document.getElementById('users').click();">
      <div>
        <h1>4</h1>
        <span>User Accounts</span>
      </div>
      <div class="icon-container bg-danger">
        <span class="fa fa-users"></span>
      </div>
    </div>
    <a href="{{ route('profile.myContacts') }}" id="contacts" style="display: none;"></a>
    <div class="card-single shadow-lg" onclick="document.getElementById('contacts').click();">
      <div>
        <h1>10</h1>
        <span>My Contacts</span>
      </div>
      <div class="icon-container bg-danger">
        <span class="fa fa-address-book"></span>
      </div>
    </div>
  </div>
  <div class="cards">
    <a href="{{ route('buyer.tenders.index') }}" id="tenders" style="display: none;"></a>
    <div class="card-single shadow-lg" onclick="document.getElementById('tenders').click();">
      <div>
        <h1>20</h1>
        <span>Tenders</span>
      </div>
      <div class="icon-container bg-danger">
        <span class="fa fa-tasks"></span>
      </div>
    </div>
    <div class="card-single shadow-lg">
      <div>
        <h1>10</h1>
        <span>Deals</span>
      </div>
      <div class="icon-container bg-danger">
        <span class="fa fa-credit-card"></span>
      </div>
    </div>
    <a href="{{ route('buyer.projects') }}" id="projects" style="display: none;"></a>
    <div class="card-single shadow-lg" onclick="document.getElementById('projects').click();">
      <div>
        <h1>30</h1>
        <span>My Projects</span>
      </div>
      <div class="icon-container bg-danger">
        <span class="fa fa-project-diagram"></span>
      </div>
    </div>
  </div>
  <!------End of Card Section-->

@endsection