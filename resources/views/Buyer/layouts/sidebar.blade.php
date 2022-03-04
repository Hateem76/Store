<div class="sidebar">
    <div class="sidebar-brand">
      <h3><span class="lab la-accusoft"></span><span>Buyer Dashboard</span></h3>
    </div>
    <div class="sidebar-menu">
      <ul>
        <li>
          <a href="{{ route('extras.login') }}" class="active"><span class="fas fa-tachometer-alt mr-3"></span>
            <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="{{ route('buyer.tenders.index') }}"><span class="fa fa-comments-dollar mr-3"></span>
            <span>Tenders</span>
          </a>
        </li>
        <li>
          <a href="{{ route('buyer.projects') }}"><span class="fa fa-comments-dollar mr-3"></span>
              <span>Projects</span>
            </a>
        </li>
        <li>
          <a href="{{ route('profile.myContacts') }}"><span class="fa fa-user mr-3"></span>
            <span>My Contacts</span>
          </a>
        </li>
        <li>
          <a href="{{ route('buyer.users.index') }}"><span class="fa fa-user mr-3"></span>
            <span>Users</span>
          </a>
        </li>
        <li>
          <a href=""><span class="fa fa-sign-out mr-3"></span>
            <span>Logout</span>
          </a>
        </li>
      </ul>
    </div>
  </div>