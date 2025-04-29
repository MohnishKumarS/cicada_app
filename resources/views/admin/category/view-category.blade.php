@extends('admin.main')

@section('content')

<div class="container">
    <div class="page-inner">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">All Brands</h4>
            </div>
            <div class="card-body">
              @if (session('msg'))
              <h5 class="alert alert-success">{{ session('msg') }}</h5>
          @endif
              <div id="categoryTable-msg" class="mb-5 mt-2"></div>
              <div class="table-responsive">
                <table
                  id="categoriesTable"
                  class="display table table-striped table-hover"
                >
                  <thead>
                    <tr>
                      <th>S.No.</th> 
                      <th>Category Id</th>
                      <th>Category Name</th>
                      <th>Brand Name</th>
                      <th>Category Image</th>
                      <th>Category Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                       $sno=""; 
                    @endphp
                    @foreach ($categories as $category)
                   @php $sno++ @endphp
                    <tr id="category-row-{{ $category->id }}">
                      <td>{{ $sno }}</td> 
                        <td>{{ $category->id }}</td> 
                        <td>{{ $category->category_name }}</td>
                        <td>{{ $category->brand ? $category->brand->brand_name : '-' }}</td> 
                        <td><img src="{{ asset('admin-files/category/' . $category->category_image) }}" alt="{{ $category->category_name }} Image" width="50"></td>
                        <td>
                          <button class="btn category-status {{ $category->status == 1 ? 'btn-success' : 'btn-danger' }}" 
                                  data-id="{{ $category->id }}" 
                                  data-status="{{ $category->status }}">
                              {{ $category->status == 1 ? 'Active' : 'Inactive' }}
                          </button>
                      </td>
                        <td>
                          <div class="d-flex">
                            <a href="{{ url('/category/edit/' . $category->id) }}" class="btn btn-primary mx-1">
                              <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a href="javascript:void(0)"  data-id="{{ $category->id }}" data-url="{{ route('category.delete', $category->id) }}"
                              class="btn btn-danger delete-category mx-1">
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
  </div>

@endsection

