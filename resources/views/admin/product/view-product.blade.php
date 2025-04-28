@extends('admin.main')

@section('content')

<div class="container">
  
    <style>
        #productsTable_wrapper {
            width: max-content !important;
        }
    </style>
 
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">All Products</h4>
            </div>
            <div class="card-body">
              <div id="categoryTable-msg" class="mb-5 mt-2"></div>
              <div class="table-responsive">
                <table
                  id="productsTable"
                  class="display table table-striped table-hover" 
                  style="width: max-content !important;"
                >
                  <thead>
                    <tr>
                      <th>S.No.</th> 
                      {{-- <th>Product Id</th> --}}
                      <th>Product Name</th>
                      <th>Brand Name</th>
                      <th>Category Name</th>
                      <th>Product Size</th>
                      <th>Actual Price</th>
                      <th>Offer Price</th>
                      {{-- <th>Description</th>  --}}
                      <th>Main Image</th>
                      {{-- <th>Additional Image</th> --}}
                      <th>Product Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                       $sno=1; 
                    @endphp
                    @foreach ($products as $product)
                    <tr id="product-row-{{ $product->id }}">
                      <td>{{ $sno++ }}</td> 
                        {{-- <td>{{ $product->id }}</td>  --}}
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->brand ? $product->brand->brand_name : '-' }}</td> 
                        <td>{{ $product->category ? $product->category->category_name : '-' }}</td> 
                        <td>{{ $product->size }}</td>
                        <td>{{ $product->actual_price }}</td>
                        <td>{{ $product->offer_price }}</td>
                        {{-- <td><textarea class="form-control" id="" rows="5" style="width: 350px"> {{ $product->product_description }} </pre> </textarea></td>   --}}
                        <td><img src="{{ asset('admin-files/products/' . $product->main_img) }}" alt="product Image" width="50"></td>
                        {{-- <td> 
                        <div style="height: 100px; overflow-y:scroll;">
                            @php
                            $additionalImages = explode(',', $product->additional_images);
                        @endphp   
                        @foreach($additionalImages as $image)
                        <div class="mb-3" style="">
                            <img src="{{ asset('admin-files/products/' . $image) }}" alt="{{ $image }} Image" style="width: 100%; height:80px;">
                        </div> 
                        @endforeach
                        </div>
                        </td> --}}
                        <td>
                          <button class="btn product-status {{ $product->status == 1 ? 'btn-success' : 'btn-danger' }}" 
                                  data-id="{{ $product->id }}" 
                                  data-status="{{ $product->status }}">
                              {{ $product->status == 1 ? 'Active' : 'Inactive' }}
                          </button>
                      </td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ url('/product/edit/' . $product->id) }}" class="btn btn-primary mx-1">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="javascript:void(0)"  data-id="{{ $product->id }}" data-url="{{ route('product.delete', $product->id) }}" class="btn btn-danger mx-1 delete-product">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </div>
                            
                        </td>
                    </tr>
                    @endforeach
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
   
  </div>

@endsection

