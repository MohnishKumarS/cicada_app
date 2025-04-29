@extends('admin.main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Edit Product</div>
                </div>
                <div class="card-body">
                    @if (session('msg'))
                        <h5 class="alert alert-success">{{ session('msg') }}</h5>
                    @endif
                    <div id="delete-message" class="mb-5 mt-2"></div>
                    <form action="{{ url('/product/update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="product_name">Product Name</label>
                                    <input name="product_name" type="text" class="form-control" id="product_name"
                                        placeholder="Enter product name"
                                        value="{{ old('product_name', $product->product_name) }}" />
                                    @error('product_name')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="actual_price">Actual price</label>
                                    <input name="actual_price" type="text" class="form-control" id="actual_price"
                                        placeholder="Enter actual price"
                                        value="{{ old('actual_price', $product->actual_price) }}" />
                                    @error('actual_price')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="size">Available Sizes:</label>
                                    <select id="size" name="sizes[]" class="form-control" multiple>
                                        @php
                                            $sizes = explode(',', $product->size);
                                        @endphp
                                        <option value="s" {{ in_array('s', $sizes) ? 'selected' : '' }}>S</option>
                                        <option value="m" {{ in_array('m', $sizes) ? 'selected' : '' }}>M</option>
                                        <option value="l" {{ in_array('l', $sizes) ? 'selected' : '' }}>L</option>
                                        <option value="xl" {{ in_array('xl', $sizes) ? 'selected' : '' }}>XL</option>
                                        <option value="xxl" {{ in_array('xxl', $sizes) ? 'selected' : '' }}>XXL</option>
                                    </select>
                                    @error('sizes')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="colors">Colors</label>
                                    <input name="colors" type="text" class="form-control" id="colors"
                                        placeholder="Enter product name" value="{{ old('color', $product->color) }}" />
                                    @error('colors')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="comment">Product Description</label>
                                    <textarea class="form-control" name="product_description" id="comment" rows="5">{{ old('product_description', $product->product_description) }}</textarea>
                                    @error('product_description')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="brand_id">Select Brand</label>
                                    <select name="brand_id" id="brand_id" class="form-control">
                                        <option value="" disabled>Select a brand</option>
                                        @foreach ($brand as $b)
                                            <option value="{{ $b->id }}"
                                                {{ old('brand_id', $product->brand_id) == $b->id ? 'selected' : '' }}>
                                                {{ $b->brand_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('brand_id')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="offer_price">Offer price</label>
                                    <input name="offer_price" type="text" class="form-control" id="offer_price"
                                        placeholder="Enter offer price"
                                        value="{{ old('offer_price', $product->offer_price) }}" />
                                    @error('offer_price')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input name="slug" type="text" class="form-control" id="slug"
                                        placeholder="Enter slug" value="{{ old('slug', $product->slug) }}" />
                                </div>

                                <div class="form-group">
                                    <label for="">Main Image</label>
                                    <input type="file" name="main_img" class="form-control-file" id="">
                                    <div class="mt-2">
                                        <img src="{{ asset('admin-files/products/' . $product->main_img) }}"
                                            width="65" />
                                    </div>
                                    @error('main_img')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="category_id">Select Category</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="" disabled>Select a category</option>
                                        @foreach ($category as $c)
                                            <option value="{{ $c->id }}"
                                                {{ old('category_id', $product->category_id) == $c->id ? 'selected' : '' }}>
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
                                    <input name="quantity" type="text" class="form-control" id="quantity"
                                        placeholder="Enter quantity" value="{{ old('quantity', $product->quantity) }}" />
                                    @error('quantity')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Trending</label><br>
                                    <div class="d-flex">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="trending"
                                                value="1" id="trending1"
                                                {{ old('trending', $product->trending) == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="trending1">
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="trending"
                                                value="0" id="trending2"
                                                {{ old('trending', $product->trending) == 0 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="trending2">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Additional Images</label>
                                    <input type="file" name="additional_images[]" class="form-control-file"
                                        id="" multiple>
                                    <div class="mt-2" id="additional-images-list">
                                        @php
                                            $additionalImages = array_filter(explode(',', $product->additional_images));
                                        @endphp

                                        @if (!empty($additionalImages))
                                            @foreach ($additionalImages as $image)
                                                <div class="d-inline-block text-center m-2"
                                                    data-image="{{ $image }}">
                                                    <img src="{{ asset('admin-files/products/' . $image) }}"
                                                        width="65" height="65" style="object-fit: cover;" />
                                                    <br>
                                                    <button type="button"
                                                        class="btn btn-sm btn-danger mt-1 delete-additional-image"
                                                        data-image="{{ $image }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            @endforeach
                                        @else
                                            <p>No images found.</p>
                                        @endif
                                    </div>


                                </div>

                            </div>

                            <div class="card-action">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            $('.delete-additional-image').click(function() {
                let button = $(this);
                let imageName = button.data('image');

                if (confirm('Are you sure you want to delete this image?')) {
                    $.ajax({
                        url: '{{ route('product.deleteAdditionalImage') }}', // 👈 Define this route
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            image: imageName,
                            product_id: '{{ $product->id }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                button.closest('div[data-image]')
                            .remove(); // Remove the image div from UI
                                $('#delete-message').html(
                                    '<div class="alert alert-success">Image deleted successfully!</div>'
                                );

                            } else {

                                $('#delete-message').html(
                                    '<div class="alert alert-danger">Failed to delete image.</div>'
                                );
                            }
                        },
                        error: function() {

                            $('#delete-message').html(
                                '<div class="alert alert-danger">Something went wrong.</div>'
                            );
                        }
                    });
                }
            });
        });
    </script>
@endpush
