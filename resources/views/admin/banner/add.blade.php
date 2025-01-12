@extends('admin.main')


@section('content')
<div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Banner</h3>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="card-title">Add Banner</div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6 col-lg-4">
                  @if(session('msg'))
                  <h5 class="alert alert-success">{{session('msg')}}</h5>
                  @endif
                    <form action="{{url('/banner/store')}}" method="POST" enctype="multipart/form-data">
                      @csrf 


                      <div class="form-group">
                        <label for="banner_icon">Banner Icon</label>
                        <input type="file" name="banner_icon" class="form-control-file" id="banner_icon">
                        @error('banner_icon')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label>Status</label><br>
                        <div class="d-flex">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="1" id="status1" checked>
                            <label class="form-check-label" for="status1">
                              Show
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="0" id="status2" >
                            <label class="form-check-label" for="status2">
                              Hide
                            </label>
                          </div>
                        </div>
                        @error('status')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="order">Order</label>
                        <input
                          name="order"
                          type="number"
                          class="form-control"
                          id="order"
                          placeholder="Enter order for image"
                          value="{{ old('order') }}"
                        />
                        @error('order')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label>Site View</label><br>
                        <div class="d-flex">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="view" value="mobile" id="view1" checked="">
                            <label class="form-check-label" for="view1">
                              Mobile
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="view" value="desktop" id="view2" >
                            <label class="form-check-label" for="view2">
                                Desktop
                            </label>
                          </div>
                        </div>
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