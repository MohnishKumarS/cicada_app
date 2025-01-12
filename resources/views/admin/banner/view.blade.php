@extends('admin.main')

@section('content')

<div class="container">
    <div class="page-inner">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">All Banners</h4>
            </div>
            <div class="card-body">
              <div id="delete-message" class="mb-5 mt-2"></div>
              <div class="table-responsive">
                <table
                  id="bannersTable"
                  class="display table table-striped table-hover"
                >
                  <thead>
                    <tr>
                      <th>S.No.</th> 
                      <th>Banner Image</th>
                      <th>Order</th>
                      <th>Status</th>
                      <th>View</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                       $sno=""; 
                    @endphp
                    @foreach ($banners as $banner)
                   @php $sno++ @endphp
                    <tr id="banner-row-{{ $banner->id }}">
                      <td>{{ $sno }}</td> 

                        <td><img src="{{ asset('admin-files/banners/' . $banner->image) }}" alt="Banner Icon" width="50"></td>
                        <td>{{$banner->order}}</td>
                        <td>
                          <button class="btn banner-status {{ $banner->status == 1 ? 'btn-success' : 'btn-danger' }}" 
                                  data-id="{{ $banner->id }}" 
                                  data-status="{{ $banner->status }}">
                              {{ $banner->status == 1 ? 'Active' : 'Inactive' }}
                          </button>
                      </td>
                      <td>{{$banner->view}}</td>
                        <td>
                          <div class="d-flex">
                            <a href="{{ route('editBanner', $banner->id) }}" class="btn btn-primary mx-1">
                              <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a href="javascript:void(0)"  data-id="{{ $banner->id }}" data-url="{{ route('deleteBanner', $banner->id) }}"
                              class="btn btn-danger delete-banner mx-1">
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

