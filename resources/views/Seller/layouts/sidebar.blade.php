<div class="sidebar">
    <div class="sidebar-brand">
      <h3><span class="lab la-accusoft"></span><span>Seller Dashboard</span></h3>
    </div>
    <div class="sidebar-menu">
      <ul>
        <li>
          <a href="{{ route('extras.login') }}" class="active"><span class="fas fa-tachometer-alt mr-3"></span>
            <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="{{ route('seller.products.index') }}"><span class="fa fa-truck-loading mr-3"></span>
            <span>Products</span>
          </a>
        </li>
        <li>
          <a href="{{ route('seller.tenders') }}"><span class="fa fa-tasks mr-3"></span>
            <span>New Tenders</span>
          </a>
        </li>
        <li>
          <a href="{{ route('seller.confirmationIndex') }}"><span class="fa fa-question mr-3"></span>
            <span>Orders Confirmation</span>
          </a>
        </li>
        <li>
          <a href="{{ route('seller.projects') }}"><span class="fa fa-project-diagram mr-3"></span>
              <span>Projects</span>
            </a>
        </li>
        <li>
          <a href="{{ route('profile.myContacts') }}"><span class="fa fa-address-book mr-3"></span>
            <span>My Contacts</span>
          </a>
        </li>
        <li>
          <a href="{{ route('chatify') }}"><span class="far fa-comment-dots mr-3"></span>
            <span>Chat</span>
          </a>
        </li>
        <li>
          <a href="{{ route('seller.users.index') }}"><span class="fa fa-users mr-3"></span>
            <span>Users</span>
          </a>
        </li>
        <li>
          <a href="{{ route('index') }}"><span class="fa fa-home mr-3"></span>
            <span>Home</span>
          </a>
        </li>
        <li>
          <a href="" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();  "><span class="fa fa-sign-out mr-3"></span>
            <span>Logout</span>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        </li>
      </ul>
    </div>
  </div>