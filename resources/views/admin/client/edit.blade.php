@extends('admin.admin_layout.master')

@section('main_content')
<div class="content-wrapper" style="min-height: 1419.51px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ url('admin/branches/create') }}" class="d-none d-sm-inline-block shadow-sm">
                        <i class=" fa-sm text-white-50"></i> </a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Client </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            @include('common.notification')
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h2 class="card-title mb-0">Edit Client</h2>
                    <a href="{{ url('admin/clients') }}"
                        class="btn btn-sm btn-success shadow-sm">
                        <i class="fa fa-list fa-sm text-white-50"></i>&nbsp;Client List
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action='{{ url("admin/clients/update/$client->id") }}'' method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="date">Name:</label>
                            <input type="text"
                                placeholder="Name"
                                name="client_name"
                                value="{{ old('client_name', $client->client_name) }}"
                                class="form-control mb-1" />
                            @error('client_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="date">Address:</label>
                            <input type="text"
                                name="client_address"
                                placeholder="Address"
                                value="{{ old('client_address', $client->client_address) }}"
                                class="form-control mb-1" />
                            @error('client_address')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="date">Mobile:</label>
                            <input type="text"
                                name="client_phone_number"
                                placeholder="mobile"
                                value="{{ old('client_phone_number', $client->client_phone_number) }}"
                                class="form-control mb-1" />
                            @error('client_phone_number')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="date">GST:</label>
                            <input type="text" name="client_gst_number"
                                placeholder="GST" class="form-control mb-1"
                                value="{{ old('client_gst_number', $client->client_gst_number) }}" />
                            @error('client_gst_number')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror

                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <label for="date">Email:</label>
                            <input type="text"
                                name="client_email"
                                placeholder="Email" class="form-control mb-1"
                                value="{{ old('client_email', $client->client_email) }}" />
                            @error('client_email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="col-md-6">

                            <label for="date">Aadhar card</label>
                            <input type="text" 
                                name="client_aadhar_card" 
                                placeholder="Aadhar card"
                                value="{{ old('client_aadhar_card', $client->client_aadhar_card) }}" 
                                class="form-control mb-1 mb-1" />
                            @error('aadhar_card')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12">

                            <input type="submit" value="Edit" class="btn btn-primary float-right">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection