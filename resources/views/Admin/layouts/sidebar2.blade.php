<input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h3><span class="lab la-accusoft"></span><span>Dashboard</span></h3>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="{{ route('extras.login') }}" class="active"><span class="fas fa-tachometer-alt mr-3"></span>
                        <span>Dashboard</span>
                    </a>
                </li>
                {{-- <li>
                    <a href="{{ route('buyer.tenders.index') }}"><span class="fa fa-tasks mr-3"></span>
                        <span>Tenders</span>
                      </a>
                </li>
                <li>
                  <a href="{{ route('buyer.projects') }}"><span class="fa fa-project-diagram mr-3"></span>
                      <span>Projects</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile.myContacts') }}"><span class="fa fa-address-book mr-3"></span>
                      <span>My Contacts</span>
                    </a>
                  </li> --}}
                  <li>
                    <a href="{{ route('admin.category.index') }}"><span class="far fa-list-alt mr-3"></span>
                      <span>Categories</span>
                    </a>
                  </li>
                  <li>
                    <a href="{{ route('admin.users.index') }}"><span class="fa fa-users mr-3"></span>
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
