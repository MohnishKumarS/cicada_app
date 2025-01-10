@extends('admin.main')

@section('content')
<div class="row">
    <div class="col-md-6 col-lg-4">
        @if(session('msg'))
        <h5 class="alert alert-success">{{ session('msg') }}</h5>
        @endif

        <form action="{{ route('brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="brand_name">Brand Name</label>
                <input
                    name="brand_name"
                    type="text"
                    class="form-control"
                    id="brand_name"
                    value="{{ old('brand_name', $brand->brand_name) }}"
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
                    value="{{ old('slug', $brand->slug) }}"
                />
                @error('slug')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="brand_icon">Brand Icon</label>
                <div class="d-flex align-items-center">
                    <div>
                        <input type="file" name="brand_icon" class="form-control-file" id="brand_icon">
                        @error('brand_icon')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        @if ($brand->brand_icon)
                        <img src="{{ asset('admin-files/brands/brand-icon/' . $brand->brand_icon) }}" alt="Brand Icon" width="50">
                        @endif
                    </div>
                </div>     
            </div>

            <div class="form-group">
                <label for="brand_image">Brand Image</label>
                <div class="d-flex align-items-center">
                    <div>
                        <input type="file" name="brand_image" class="form-control-file" id="brand_image">
                        @error('brand_image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        @if ($brand->brand_img)
                        <img src="{{ asset('admin-files/brands/brand-img/' . $brand->brand_img) }}" alt="Brand Image" width="50">
                        @endif
                    </div>
                </div>     
            </div>

            <div class="card-action">
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
