@extends('admin.main')

@section('content')
<div class="row">
    <div class="col-md-6 col-lg-4">
        @if(session('msg'))
        <h5 class="alert alert-success">{{ session('msg') }}</h5>
        @endif

        <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="category_name">category Name</label>
                <input
                    name="category_name"
                    type="text"
                    class="form-control"
                    id="category_name"
                    value="{{ old('category_name', $category->category_name) }}"
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
                    value="{{ old('slug', $category->slug) }}"
                />
                @error('slug')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="category_image">category Image</label>
                <div class="d-flex align-items-center">
                    <div>
                        <input type="file" name="category_image" class="form-control-file" id="category_image">
                        @error('category_image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        @if ($category->category_image)
                        <img src="{{ asset('admin-files/category/' . $category->category_image) }}" alt="Brand Image" width="50">
                        @endif
                    </div>
                </div>     
            </div>

            <div class="form-group">
                <label for="brand_id">Select Brand</label>
                <select name="brand_id" id="brand_id" class="form-control">
                    <option value="" disabled>Select a brand</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ $brand->id == $category->brand_id ? 'selected' : '' }}>
                            {{ $brand->brand_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="card-action">
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
