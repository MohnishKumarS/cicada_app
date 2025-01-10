@extends('admin.main')


@section('content')
<div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Brands</h3>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="card-title">Add Brands</div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6 col-lg-4">
                  @if(session('msg'))
                  <h5 class="alert alert-success">{{session('msg')}}</h5>
                  @endif
                    <form action="{{url('/brands/store')}}" method="POST" enctype="multipart/form-data">
                      @csrf 

                      <div class="form-group">
                        <label for="brand_name">Brand Name</label>
                        <input
                          name="brand_name"
                          type="text"
                          class="form-control"
                          id="brand_name"
                          placeholder="Enter brand name"
                          value="{{ old('brand_name') }}"
                          required
                        />
                        @error('brand_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="slug">Slug (Optional)</label>
                        <input
                          name="slug"
                          type="text"
                          class="form-control"
                          id="slug"
                          placeholder="Enter slug (optional)"
                          value="{{ old('slug') }}"
                        />
                        @error('slug')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="brand_icon">Brand Icon</label>
                        <input type="file" name="brand_icon" class="form-control-file" id="brand_icon">
                        @error('brand_icon')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="brand_image">Brand Image</label>
                        <input type="file" name="brand_image" class="form-control-file" id="brand_image">
                        @error('brand_image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="card-action">
                        <button type="submit" class="btn btn-success">Submit</button>
                        
                      </div>
                    </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection