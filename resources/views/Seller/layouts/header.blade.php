<header>
    <h3 class="font-weight-bold">
        <label for="nav-toggle">
        <span class="fas fa-bars mr-3 ml-2"></span>
        </label>
        {{ Auth::user()->name }}
    </h3>
    <div class="search-wrapper">
        <!-- <span class="fas fa-search"></span> -->
        <form action="{{ route('extras.searchProducts') }} " method="POST" class="d-flex">
            @csrf
            <input name="search" id="search" class="form-control @error('search') is-invalid @enderror" type="search" placeholder="Search..." />
            <select class="form-control selectbox" name="option" id="option">
                <option value="product">Product</option>
                <option value="vendor">Vendor/Seller</option>
            </select>
            <button class="btn ml-2 search-btn-header" type="submit">
            <i class="fa fa-search"></i>
            </button>
        </form>
    </div>
    <div class="user-wrapper profile">
        <img class="profile" src="{{ asset('images/bg/c1.jpg') }}" alt="">
        <div class="profile-name">
        <h5>
            @can('buyer')
                Buyer Account
            @endcan
            @can('seller')
                Seller Account
            @endcan
        </h5>
        </div>
    </div>
    </header>