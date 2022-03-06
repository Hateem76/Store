@extends('Seller.layouts.app-dashboard')
@section('content')
<!----Card Section-->
<div class="cards">
    <a href="{{ route('seller.products.index') }}" id="products" style="display: none;"></a>
    <div class="card-single shadow-lg" onclick="document.getElementById('products').click();">
      <div>
        <h1>54</h1>
        <h4 class="font-weight-bold" style="">Products</h4>
      </div>
      <div>
        <span class="fa fa-truck-loading"></span>
      </div>
    </div>
    <a href="{{ route('seller.users.index') }}" id="users" style="display: none;"></a>
    <div class="card-single shadow-lg" onclick="document.getElementById('users').click();">
      <div>
        <h1>14</h1>
        <h4 class="font-weight-bold" style="">Users</h4>
      </div>
      <div>
        <span class="fa fa-users"></span>
      </div>
    </div>
    <a href="{{ route('profile.myContacts') }}" id="contacts" style="display: none;"></a>
    <div class="card-single shadow-lg" onclick="document.getElementById('contacts').click();">
      <div>
        <h1>10</h1>
        <h4 class="font-weight-bold" style="">My Contacts</h4>
      </div>
      <div>
        <span class="fas fa-tasks"></span>
      </div>
    </div>
  </div>
  <div class="cards">
    <a href="{{ route('seller.tenders') }}" id="tenders" style="display: none;"></a>
    <div class="card-single shadow-lg" onclick="document.getElementById('tenders').click();">
      <div>
        <h1>54</h1>
        <h4 class="font-weight-bold" style="">Tenders</h4>
      </div>
      <div>
        <span class="fa fa-comments-dollar"></span>
      </div>
    </div>
    <a href="{{ route('seller.confirmationIndex') }}" id="confirmation" style="display: none;"></a>
    <div class="card-single shadow-lg" onclick="document.getElementById('confirmation').click();">
      <div>
        <h1>14</h1>
        <h4 class="font-weight-bold" style="">Projects Confirmation</h4>
      </div>
      <div>
        <span class="fa fa-hands-helping"></span>
      </div>
    </div>
    <a href="{{ route('seller.projects') }}" id="projects" style="display: none;"></a>
    <div class="card-single shadow-lg" onclick="document.getElementById('projects').click();">
      <div>
        <h1>10</h1>
        <h4 class="font-weight-bold" style="">My Projects</h4>
      </div>
      <div>
        <span class="fas fa-tasks"></span>
      </div>
    </div>
  </div>
  <!------End of Card Section-->

@endsection
