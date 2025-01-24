@extends('admin.main')


@section('content')
<div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="card-title">Add Category</div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6 col-lg-4">
                  @if(session('msg'))
                  <h5 class="alert alert-success">{{session('msg')}}</h5>
                  @endif
                    <form action="{{url('/category/store')}}" method="POST" enctype="multipart/form-data">
                      @csrf 

                      <div class="form-group">
                        <label for="brand_name">Category Name</label>
                        <input
                          name="category_name"
                          type="text"
                          class="form-control"
                          id="category_name"
                          placeholder="Enter category name"
                          value="{{ old('category_name') }}"
                          required
                        />
                        @error('category_name')
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
                        <label for="brand_id">Select Brand</label>
                        <select name="brand_id" id="brand_id" class="form-control">
                            <option value="" disabled selected>Select a brand</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                            @endforeach
                        </select>
                        @error('brand_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                      <div class="form-group">
                        <label for="category_image">category Image</label>
                        <input type="file" name="category_image" class="form-control-file" id="category_image">
                        @error('category_image')
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
@endsection