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
                            <div id="delete-message" class="mb-5 mt-2"></div>
                            @if (session('msg'))
                                <h5 class="alert alert-success">{{ session('msg') }}</h5>
                            @endif
                            <div class="table-responsive">
                                <table id="brandsTable" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Brand Id</th>
                                            <th>Brand Name</th>
                                            <th>Brand Icon</th>
                                            <th>Brand Image</th>
                                            <th>Brand Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $sno = '';
                                        @endphp
                                        @foreach ($brands as $brand)
                                            @php $sno++ @endphp
                                            <tr id="brand-row-{{ $brand->id }}">
                                                <td>{{ $sno }}</td>
                                                <td>{{ $brand->id }}</td>
                                                <td>{{ $brand->brand_name }}</td>
                                                <td><img src="{{ asset('admin-files/brands/brand-icon/' . $brand->brand_icon) }}"
                                                        alt="{{ $brand->brand_name }} Icon" width="50"></td>
                                                <td><img src="{{ asset('admin-files/brands/brand-img/' . $brand->brand_img) }}"
                                                        alt="{{ $brand->brand_name }} Image" width="50"></td>
                                                <td>
                                                    <button
                                                        class="btn brand-status {{ $brand->brand_status == 1 ? 'btn-success' : 'btn-danger' }}"
                                                        data-id="{{ $brand->id }}"
                                                        data-status="{{ $brand->brand_status }}">
                                                        {{ $brand->brand_status == 1 ? 'Active' : 'Inactive' }}
                                                    </button>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ url('/brands/edit/' . $brand->id) }}"
                                                            class="btn btn-primary mx-1">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>
                                                        <a href="javascript:void(0)" data-id="{{ $brand->id }}"
                                                            data-url="{{ route('brands.delete', $brand->id) }}"
                                                            class="btn btn-danger delete-brand mx-1">
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
