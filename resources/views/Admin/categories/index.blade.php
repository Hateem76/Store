<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Dashboard</title>
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/sidebar2.css') }}">
        <link rel="stylesheet" href="{{ asset('css/card.css') }}">
        <link rel="stylesheet" href="{{ asset('css/buyer/tender_table.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script>
            $(document).ready(function () {
                $('.navbar-toggler, .overlay').on('click', function () {
                    $('.mobileMenu').toggleClass('open');
                    $('.overlay').toggleClass('openOverlay');
                });
            })
        </script>

    </head>
    <body>
        @include('partials.alerts') 
        @include('Admin.layouts.sidebar2')

          <!------Main Content-->

        <div class="main-content">
            @include('Admin.layouts.header')

            <main>

                @include('Admin.layouts.logout-code')
                <!-----Table Start-->
<div class="py-5">
    <div class="row setScroll py-5">
      <div class="col-lg-10 mx-auto mt-2">
        <div class="card rounded shadow border-0">
          <div class="card-body px-5 py-4 bg-white rounded">
            @include('partials.alerts') 
              <div class="row setScroll mb-2 d-flex" style="justify-content: space-between;">
                  <h2 class=" pl-3">Categories</h2>
                  <a href="{{ route("admin.category.create") }}" class="btn text-white mb-2 btn-md mr-4" style="background-color: #184A45FF;">Create &RightArrow;</a>
              </div>
            <div class="table-responsive">
              <table id="example" style="width:100%" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th class="text-center">Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr style="background-color: white;">
                            <th scope="row">cat{{ $category->id }}</th>
                            <td>{{ $category->name }}</td>
                            <td class="text-center">
                                {{-- <a href="{{ route('buyer.users.edit',$user->id) }}" class="btn btn-sm btn-primary" role="button"><i class="fas fa-edit"></i></a> --}}
                                <button class="btn btn-sm btn-danger" onclick="event.preventDefault();
                                                document.getElementById('delete-user-form-{{ $category->id }}').submit()"><i class="fa-solid fa-trash-can"></i></button>
                                <form action="{{ route('admin.category.destroy',$category->id) }}" id="delete-user-form-{{ $category->id }}" style="display: none;" method="POST">
                                    @csrf
                                    @method("DELETE")
                                </form>
                            </td>
                        </tr>
                    @endforeach
                             
                </tbody>
              </table>
              {{ $categories->links() }}
            </div>
          </div>
        </div>
      </div>
  </div>

<!-------Table End-->
                
            </main>
        </div>

  <!---End of Main Content-->
 
        <script src="{{ asset('js/jquery-min.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    </body>
</html>