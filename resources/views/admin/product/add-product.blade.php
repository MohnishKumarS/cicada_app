@extends('admin.main')


@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Add Product</div>
        </div>
        <div class="card-body">
          @if(session('msg'))
          <h5 class="alert alert-success">{{session('msg')}}</h5>
          @endif
          <form action="{{url('/product/store')}}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="row">
              <div class="col-md-6 col-lg-4">

                <div class="form-group">
                  <label for="product_name">Product Name</label>
                  <input
                    name="product_name"
                    type="text"
                    class="form-control"
                    id="product_name"
                    placeholder="Enter product name"
                    value="{{ old('product_name') }}"
                     />
                  @error('product_name')
                  <div class="mt-2 text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="actual_price">Actual price</label>
                  <input
                    name="actual_price"
                    type="text"
                    class="form-control"
                    id="actual_price"
                    placeholder="Enter Actual price"
                    value="{{ old('actual_price') }}" />
                  @error('actual_price')
                  <div class="mt-2 text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="size">Available Sizes:</label>
                  <select id="size" name="sizes[]"  class="form-control" multiple>
                      <option value="s">S</option>
                      <option value="m">M</option>
                      <option value="l">L</option>
                      <option value="xl">XL</option>
                      <option value="xxl">XXL</option>
                  </select>
                  @error('sizes')
                  <div class="mt-2 text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="colors">Colors</label>
                  <input
                    name="colors"
                    type="text"
                    class="form-control"
                    id="colors"
                    placeholder="Enter product name"
                    value="{{ old('colors') }}"
                     />
                  @error('colors')
                  <div class="mt-2 text-danger">{{ $message }}</div>
                  @enderror
                </div>


                <div class="form-group">
                  <label for="comment">Product Description</label>
                  <textarea class="form-control" name="product_description" id="comment" rows="5">{{ old('product_description') }}</textarea>
                  @error('product_description')
                  <div class="mt-2 text-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
                

              <div class="col-md-6 col-lg-4">

                <div class="form-group">
                  <label for="brand_id">Select Brand</label>
                  <select name="brand_id" id="brand_id" class="form-control">
                    <option value="" disabled >Select a brand</option>
                    @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                      {{ $brand->brand_name }}
                    </option>
                    @endforeach
                  </select>
                  
                  @error('brand_id')
                  <div class="mt-2 text-danger">{{ $message }}</div>
                  @enderror

                </div>

                <div class="form-group">
                  <label for="offer_price">Offer price</label>
                  <input
                    name="offer_price"
                    type="text"
                    class="form-control"
                    id="offer_price"
                    placeholder="Enter Offer price"
                    value="{{ old('offer_price') }}" />
                  
                    @error('offer_price')
                  <div class="mt-2 text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="">Main Image</label>
                  <input type="file" name="main_img" class="form-control-file" id="">
                  @error('main_img')
                  <div class="mt-2  text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="slug">Slug</label>
                  <input
                    name="slug"
                    type="text"
                    class="form-control"
                    id="slug"
                    placeholder="Enter product name"
                    value="{{ old('slug') }}"
                     />
                  
                </div>

              </div>

              <div class="col-md-6 col-lg-4">

                <div class="form-group">
                  <label for="category_id">Select Category</label>
                  <select name="category_id" id="category_id" class="form-control">
                    <option value="" disabled>Select a category</option>
                    @foreach($category as $c)
                        <option value="{{ $c->id }}" {{ old('category_id') == $c->id ? 'selected' : '' }}>
                            {{ $c->category_name }}
                        </option>
                    @endforeach
                </select>

                  @error('category_id')
                  <div class="mt-2 text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="quantity">Quantity</label>
                  <input
                    name="quantity"
                    type="text"
                    class="form-control"
                    id="quantity"
                    placeholder="Enter Quantity"
                    value="{{ old('quantity') }}"
                     />
                  @error('quantity')
                  <div class="mt-2 text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="">Additional Images</label>
                  <input type="file" name="additional_images[]" class="form-control-file" id="" multiple>
                </div>

                <div class="form-group">
                  <label>Trending</label><br>
                  <div class="d-flex">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="trending" value="1" id="trending1" checked="">
                      <label class="form-check-label" for="trending1">
                        Yes
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="trending" value="2" id="trending2" >
                      <label class="form-check-label" for="trending2">
                        No
                      </label>
                    </div>
                  </div>
                </div>


              </div>

              <div class="card-action">
                <button type="submit" class="btn btn-success">Submit</button>
              </div>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection