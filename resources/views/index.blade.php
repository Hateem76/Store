@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div id="carouselExampleControls" class="carousel slide " data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class=" img-fluid" src="" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="img-fluid " src="" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="img-fluid" src="" alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col">

        </div>
      </div>
      <div class="row mb-5 mt-5 justify-content-around">
        <h3>Hateem</h3>
        {{-- <div class="col-3">

        </div>
        <div class="col-3">

        </div>
        <div class="col-3">

        </div>
        <div class="col-3">

        </div> --}}
      </div>
    </div>
@endsection