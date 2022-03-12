@extends('Buyer.layouts.app')
@section('content')

<div class="py-5">
    <div class="row setScroll py-5">
      <div class="col-lg-10 mx-auto mt-2">
        <div class="card rounded shadow border-0">
          <div class="card-body px-5 py-4 bg-white rounded">
              <div class=" mb-2 " style="">
                  <h2 class="text-center pl-3">Create Tender</h2>
                  {{-- <button class="btn text-white mb-2 btn-md mr-4" style="background-color: #184A45FF;">Create &RightArrow;</button> --}}
              </div>
            <div class=" mt-3">
                <form action="{{ route('buyer.tenders.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" class="form-control" name="name" id="name" placeholder="tender name.." @if ($speacial == 'yes')
                        value = "{{ $product->name }}"
                    @endif>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <input type="text" class="form-control mt-3" name="quantity" id="quantity" placeholder="quantity..">
                    @error('quantity')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <input type="text" class="form-control mt-3" name="unit" id="unit" placeholder="unit..">
                    @error('unit')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <input type="date" class="form-control mt-3" name="opening_date" id="opening_date">
                    @error('opening_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <input type="date" class="form-control mt-3" name="closing_date" id="closing_date">
                    @error('closing_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <input type="file" accept=".pdf" class="form-control mt-3" name="tender_file" id="tender_file">
                    @error('tender_file')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <textarea class="form-control mt-3" style="border-radius: 25px;" rows="3"  name="description" id="description"></textarea>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    @if ($speacial == 'yes')
                        <input type="hidden" name="speacial" value="yes">
                        <input type="hidden" name="seller" value="{{ $sellerId }}">
                    @else
                        <input type="hidden" name="speacial" value="no">
                        <div class="form-group mt-3">
                            <input type="radio" class="" name="public_private" id="public_private" value="1">
                            Public <span class="text-secondary">(Visible to all sellers)</span>
                        </div>
                        <input type="radio" name="public_private" id="public_private" value="0">
                            Private <span class="text-secondary">(Visible to your Contacts)</span>
                        <br>
                        @error('public_private')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    @endif
                    <button type="submit" class="btn btn-dark form-control mt-3">Create</button>
                </form>
            </div>
          </div>
        </div>
      </div>
  </div>
@endsection