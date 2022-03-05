<div class="logout-container">
    <ul>
      <a href="{{ route('profile.show') }}" class="text-dark" style="text-decoration: none;"><li>Profile</li></a>
      <a href="{{ route('logout') }}" class="text-dark" style="text-decoration: none;" onclick="event.preventDefault();
      document.getElementById('logout-form').submit();  "><li>Logout</li></a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
      </form>
    </ul>
  </div>
  <div class="logout-container2">
    <ul>
      <a href="{{ route('profile.show') }}" class="text-dark" style="text-decoration: none;"><li>Profile</li></a>
      <a href="{{ route('logout') }}" class="text-dark" style="text-decoration: none;" onclick="event.preventDefault();
      document.getElementById('logout-form').submit();  "><li>Logout</li></a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
      </form>
    </ul>
  </div>
  <script>
    document.querySelector('.profile').addEventListener('click', (e) => {
      document.querySelector('.logout-container').classList.toggle('show');
    });

    document.querySelector('.user-icon-mob-container').addEventListener('click', () => {
      document.querySelector('.logout-container2').classList.toggle('show');
    });
  </script>

  <!-----Search bar for mobile device-->
  <div class="search-container">
      <form action="{{ route('extras.searchProducts') }} " method="POST" class="form-inline">
          @csrf
          <input name="search" id="search" class="mobile-input-search @error('search') is-invalid @enderror" type="search" placeholder="Search..." />
          <select class="form-control selectbox" name="option" id="option">
              <option value="product">Product</option>
              <option value="vendor">Vendor/Seller</option>
          </select>
          <button class="mobile-search-btn btn" >
              <li class="fa fa-search"></li>
          </button>
      </form>
  </div>